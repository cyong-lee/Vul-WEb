<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php";

$bno = $_GET['idx'];
$userid = $_POST['userid'];
$title = $_POST['title'];
$content = $_POST['content'];

$sql = mq("select * from board where idx='$bno';");
$sql_id = $sql->fetch_array();


if ($sql_id['id'] == $userid) {

$sql = mq("update board set title='".$title."',content='".$content."' where idx='".$bno."'"); ?>

<script type="text/javascript">alert("수정되었습니다."); </script>
<meta http-equiv="refresh" content="0 url=/page/board/read.php?idx=<?php echo $bno; ?>">

<?php
}
else {
    echo "작성자가 아닙니다.";
}
?>


