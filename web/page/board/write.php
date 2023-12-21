<?php
	include $_SERVER['DOCUMENT_ROOT']."/header2.php";
	include $_SERVER['DOCUMENT_ROOT']."/db.php";

	if(isset($_SESSION['userid'])){
		$sql = mq("select * from member where id='".$_SESSION['userid']."'");
		$member = $sql->fetch_array();
?>
<div id="board_write">
        <h1><a href="/">자유게시판</a></h1>
        <h4>글을 작성하는 공간입니다.</h4>
            <div id="write_area">
                <form action="write_ok.php" method="post">
                    <div id="in_title">
                        <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required></textarea>
                    </div>
                    <div class="wi_line"></div>
			<div><input type="hidden" name="name" value="<?php echo $member["name"]; ?>">
			</div>
		
			<div><input type="hidden" name="userid" value="<?php echo $member["id"]; ?>"></div>
			
			<div id="in_content">
                        <textarea name="content" id="ucontent" placeholder="내용" required></textarea>
                    </div>
                    <div class="bt_se">
                        <button type="submit">글 작성</button>
                    </div>
                </form>
            </div>
	</div>
<?php }else{
	echo "<script>alert('로그인 후 글 작성 가능합니다.'); history.back();</script>";
}?>
    </body>
</html>
