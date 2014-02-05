<?
/*
$conn = mysql_connect('localhost', 'hzhang', 'abc123');
mysql_select_db('test', $conn);

$sql = "
        SELECT
            *
        FROM example";

$results = mysql_query($sql, $conn);


while($row = mysql_fetch_assoc($results)){
    
}

mysql_close($conn);
*/

?>

<html>
<head>
<style>
    body    {background-color:lightyellow;background-image:url(fatalframe21.jpgg)}
    h1      {color:red}
    table   {border:2px solid black;border-collapse:collapse}
    td      {border:0px solid black}
</style>

<script>
    function getTime(){
        var d=new Date();

        var YYYY=d.getFullYear();
        var MM=d.getMonth()+1;
        if (MM<10)            MM='0'+MM;
        var DD=d.getDate();
        if (DD<10)            DD='0'+DD;

        var DAY=d.getDay();
        switch(DAY){
            case 0:                DAY='Sun';                break;
            case 1:                DAY='Mon';                break;
            case 2:                DAY='Tue';                break;
            case 3:                DAY='Wed';                break;
            case 4:                DAY='Thu';                break;
            case 5:                DAY='Fri';                break;
            case 6:                DAY='Sat';
        }

        var hh=d.getHours();
        if (hh<10)            hh='0'+hh;
        var mm=d.getMinutes();
        if (mm<10)            mm='0'+mm;
        var ss=d.getSeconds();
        if (ss<10)            ss='0'+ss;

        var t=''+YYYY+'-'+MM+'-'+DD+' '+DAY+' '+hh+':'+mm+':'+ss;
        return t;
    }

    
    function updateTime(){
        document.getElementById("content_time").innerHTML=getTime();
    }

    //set up auto update
    var int=self.setInterval(function(){updateTime();ajaxGet();}, 1000);



<!--

    function ajaxGet(){
        var ajaxRequest;

        //Browser Support Code
        try{
            ajaxRequest=new XMLHttpRequest();
        }
        catch(e){
            alert("Your browser nuts!");
            return false;
        }

        ajaxRequest.onreadystatechange=function(){
            if(ajaxRequest.readyState==4){
                document.getElementById("output").innerHTML=ajaxRequest.responseText;
            }
        }
        ajaxRequest.open("GET", "chat_serverAJAX.php?action=get", true);
        ajaxRequest.send(null);
    }

    function ajaxPost(){
        var ajaxRequest;

        //Browser Support Code
        try{
            ajaxRequest=new XMLHttpRequest();
        }
        catch(e){
            alert("Your browser nuts!");
            return false;
        }

        ajaxRequest.onreadystatechange=function(){
            if(ajaxRequest.readyState==4){
                //document.getElementById("output").innerHTML=ajaxRequest.responseText;
            }
        }
        var content = document.getElementById("content").value;
        ajaxRequest.open("GET", "chat_serverAJAX.php?action=post&user_id=3&content="+content, true);
        ajaxRequest.send(null);
    }

//-->

    function onTextareaChange(){
        var event = window.event;
        var content = document.getElementById("content").value;
        if(event.keyCode == 13 && content !== ''){
            ajaxPost();
            document.getElementById("content").value='';
        }
        
    }

</script>

</head>

<body>
<h1>Chat Room</h1>


<table>
    <tr style="border:1px solid blue">
        <td colspan="2" style="text-align:left;vertical-align:top;width:200px;height:400px;word-wrap:break-word">
            <div id="output">Chat Log Goes Here</div>
        </td>
    </tr>
    <tr>
        <td style="text-align:left">
            <?= "hilings" ?>
            <input type="hidden" name="user_id" value="3" />
        </td>
        <td rowspan="3">
            <textarea id="content" name="input" rows="8" cols="30" onKeyup="onTextareaChange()"></textarea>
        </td>
    </tr>
    <tr>
        <td style="text-align:right">
            <label id="content_time" name="time_submit"><?= date('Y-m-d D H:i:s') ?></label>
        </td>
    </tr>
    <tr>
        <td style="horizontal-align:center;vertical-align:bottom">
            <button style="width:180px;height:50;" onClick="ajaxPost()">Submit</button>
        </td>
    </tr>
</table>





</body>
</html>




<?
/*
DROP TABLE IF EXISTS `test`.`chat_log`;

CREATE TABLE `test`.`chat_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(5) NOT NULL,
  `content` varchar(250) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
;
*/

?>
