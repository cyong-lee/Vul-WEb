<?php
include $_SERVER['DOCUMENT_ROOT'] . "/db.php";

if (isset($_SESSION['userid'])) {
    $bno = $_GET['idx'];
    $sql = mq("select * from board where idx='$bno';");
    $sql_id = $sql->fetch_array();

    if ($sql_id['id'] == $_SESSION['userid']) {
        $sql = mq("delete from board where idx='$bno';");
        ?>
        <script type="text/javascript">alert("삭제되었습니다.");</script>
        <meta http-equiv="refresh" content="0;url=/" />
        <?php
    } else {
        echo "<script>alert('작성자가 아닙니다.'); history.back();</script>";
    }
} else {
    echo "<script>alert('로그인 후 글 삭제 가능합니다.'); history.back();</script>";
}
?>
