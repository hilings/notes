require 'net/smtp'

EMAIL_ACCOUNTS = {
  :gmail => {
    :address  => 'email1@gmail.com',
    :password => 'password1'
  }
}

RECIPIENTS = {
  :person1    => 'email2@gmail.com'
}

from = EMAIL_ACCOUNTS[:gmail][:address]
password = EMAIL_ACCOUNTS[:gmail][:password]


to = RECIPIENTS[:person1]
message = <<MESSAGE_END
From: Gmail <#{from}>
To: Person1 <#{to}>
Subject: What is your lunch today~

Hi,

Good noon!
What is your lunch today?

From Gmail

#{Time.now.to_s}
MESSAGE_END


smtp = Net::SMTP.new('smtp.gmail.com', 587)
#context = OpenSSL::SSL::SSLContext.new
#context.verify_mode = OpenSSL::SSL::VERIFY_NONE
smtp.enable_starttls()
smtp.start('gmail.com', from, password, :login) do
  smtp.send_message(message, from, to)
end


