<?

$conn = mysql_connect('localhost', 'hzhang', 'abc123');
mysql_select_db('test', $conn);


$action = $_REQUEST['action'];


if('get' == $action){
    $sql = "SELECT * FROM (
                SELECT *
                FROM chat_log
                ORDER BY id DESC
                LIMIT 10
            ) AS t
            ORDER BY id";

    $results = mysql_query($sql, $conn);

    while($row = mysql_fetch_assoc($results)){
        $id = $row['id'];
        $user_id = $row['user_id'];
        $content = $row['content'];
        $date_time = $row['date_time'];

        echo "$user_id $date_time<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$content<br />";
    }
}

if('post' == $action){
    $user_id = mysql_real_escape_string($_REQUEST['user_id']);
    $content = mysql_real_escape_string($_REQUEST['content']);
    $date_time = date('Y-m-d D H:i:s');
    
    
    $sql = "INSERT INTO chat_log
            (user_id, content, date_time)
            VALUES
            ($user_id, '$content', NOW())";

    $results = mysql_query($sql, $conn);

    echo "$user_id\t$content\t$date_time\n";
}




mysql_close($conn);



?>
