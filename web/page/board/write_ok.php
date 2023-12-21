<?php

include $_SERVER['DOCUMENT_ROOT']."/db.php";

//각 변수에 write.php에서 input name값들을 저장한다
$userid = $_POST['userid'];
$username = $_POST['name'];
$title = $_POST['title'];
$content = $_POST['content'];
$date = date('Y-m-d H-i');
if($userid && $username &&  $title && $content){
    $sql = mq("insert into board(id,name,title,content,date) values('".$userid."','".$username."','".$title."','".$content."','".$date."')"); 
    echo "<script>
    alert('글쓰기 완료되었습니다.');
    location.href='/';</script>";
}else{
    echo "<script>
    alert('글쓰기에 실패했습니다.');
    history.back();</script>";
}
?>

