<?php
include $_SERVER['DOCUMENT_ROOT']."/header.php";
include $_SERVER['DOCUMENT_ROOT']."/db.php";
?>
<div id="board_area"> 
	<h1>About 이야기</h1>
	<h4>하고 싶은 말 다 해</h4>
		<span id="mem_info">
			<?php
				if(isset($_SESSION['userid'])){ //세션 userid가 있으면 페이지를 보여줍니다
					// lo_point변수에 sql쿼리결과를 저장
					$sql = mq("select * from levelpoint where userid='".$_SESSION['userid']."'");
					$lo_point = $sql->fetch_array();
			?>
			<?php echo $_SESSION['userid']; ?>님 어서오세요. &nbsp;&nbsp;&nbsp;<a href="/page/member/logout.php">로그아웃</a><br />
			
			?>
			<?php }else{ ?><!--세션 userid체크해서 세션값 없으면 로그인 폼 표시 -->
				<form action="/page/member/login_ok.php" method="post">
					<ul>
						<li><input type="text" name="userid" placeholder="아이디" required /></li>
						<li><input type="text" name="userpw" placeholder="비밀번호" required /></li>
						<li><input type="submit" value="로그인"></li>
						<li> <a href='/page/member/join_form.php'>회원가입</a></li>
					</ul>
				</form>
			<?php } ?>
		</span>
		<div id="board_list">
			<p><b>게시판 선택</b></p>
				<ul>
					<li><a href="/page/board/board.php">공지사항</a></li>
					<li><a href="/page/board/board2.php">자유게시판</a></li>
					<li><a href="/page/board/board3.php">문의게시판</a></li>
				</ul>
			</div>
			<table class="list-table">
				<thead>
					<tr>
						<th width="70">번호</th>
						<th width="100">제목</th>
						<th width="120">글쓴이</th>
						<th width="100">작성일</th>
					</tr>
				</thead>
				<?php
					$sql = mq("select * from board order by idx desc limit 0,5");  
					while($board = $sql->fetch_array()){

					$title=$board["title"]; 
						if(strlen($title)>30){ 
							$title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
						}
					?>
					<tbody>
						<tr>
							<td><?php echo $board['idx']; ?></td>
							<td><a href='#'><?php echo $title; ?></a></td>
							<td><?php echo $board['name']?></td>
							<td><?php echo $board['date']?></td>
						</tr>
					</tbody>
				<?php } ?>
			</table>
			<div id="write_btn">
				<a href="/page/board/write.php"><button>글쓰기</button></a>
			</div>
		</div>
	</div>
</body>
</html>
