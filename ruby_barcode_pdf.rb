#!/usr/bin/ruby
# encoding: utf-8

# install gem prawn, for PDF format
require 'prawn'

# install gem barby, for barcode
require 'barby'
require 'barby/barcode/code_39'
require 'barby/outputter/prawn_outputter'


order_ids = [
  "C4",
  "2014123456",
  "PC2014123456"]


pdf = Prawn::Document.new(:page_size => [61.2, 90], :page_layout => :landscape, :margin => 7)

order_ids.each.with_index do |order_id, index|
  align = 2
  if order_id =~ /p/i
    label = order_id[0] + "-" + order_id[-6..-1]
    label_short = order_id[0] + order_id[-5..-1]
  elsif order_id =~ /c/i
    label = order_id
    label_short = order_id
    align = 20
  else
    label = order_id[0,4] + "-" + order_id[4,6]
    label_short = order_id[4, 6]
  end

  puts "index=#{index+1}"
  puts label
  puts label_short

  barcode = Barby::Code39.new(label_short)
  outputter = Barby::PrawnOutputter.new(barcode)

  puts "page_count=#{pdf.page_count}"
  if pdf.page_count < (index + 1)
    pdf.start_new_page
    puts "new page added, now page_count=#{pdf.page_count}"
  end

  pdf.text_box(label, :size => 10, :align => :center, :valign => :top)
  outputter.annotate_pdf(pdf, :x => align, :y => 12, :xdim => 0.7, :height => 27)
  pdf.text_box("*#{label_short}*", :size => 8, :align => :center, :valign => :bottom, :character_spacing => 3)

  puts
end


# for pdf export
#pdf.render_file("barcode.pdf")


=begin
# for rails, render pdf into browser
# a few config before render
# 1. in Gemfile, add

    gem 'prawn'
    gem 'barby'

# 2. config/initializers/mime_types.rb, add

    Mime::Type.register "application/pdf", :pdf

# 3. in controller, add following:

    respond_to do |format|
      format.pdf do
        send_data pdf.render, type: "application/pdf", disposition: "inline"
      end
    end

=end

















puts 







