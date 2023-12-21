<?php
include $_SERVER['DOCUMENT_ROOT'] . "/header.php";
include $_SERVER['DOCUMENT_ROOT'] . "/db.php";

// 페이지 변수 설정
$page = isset($_GET['page']) ? $_GET['page'] : 1; // 기본 페이지는 1로 설정
$posts_per_page = 5; // 페이지당 보여줄 게시물 수

// 전체 게시물 수를 가져오기
$total_posts = mq("select count(*) as cnt from board")->fetch_array()['cnt'];

// 전체 페이지 수 계산
$total_pages = ceil($total_posts / $posts_per_page);

// 현재 페이지에 해당하는 데이터 가져오기
$start = ($page - 1) * $posts_per_page; // 시작 인덱스 계산

// 사용자 정보를 가져오는 쿼리
if (isset($_SESSION['userid'])) {
    $user_sql = mq("select * from member where id='" . $_SESSION['userid'] . "'");
    $lo_point = $user_sql->fetch_array();
}

// 게시판 데이터를 가져오는 쿼리
$board_sql = mq("select * from board order by idx desc limit $start, $posts_per_page");
?>

<div id="board_area" class="container">
    <h1 class="page-title">About 모든 이야기</h1>
    <h4 class="subtitle">어떤 내용이든 환영이야</h4>

    <!-- 사용자 정보 -->
    <div id="mem_info" class="user-info">
        <?php if (isset($_SESSION['userid'])) : ?>
            <div class="welcome-text">
                <?php echo $_SESSION['userid']; ?>님 어서오세요. &nbsp;&nbsp;&nbsp;<a href="/page/member/logout.php">로그아웃</a>
            </div>
        <?php else : ?>
            <div class="login-form-container">
                <form action="/page/member/login_ok.php" method="post" class="login-form">
                    <ul>
                        <li><input type="text" name="userid" placeholder="아이디" required /></li>
                        <li><input type="password" name="userpw" placeholder="비밀번호" required /></li>
                        <li><input type="submit" value="로그인">
                            <a href='/page/member/join_form.php'>회원가입</a></li>
                    </ul>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <!-- 게시판 선택 -->
    <div id="board_list" class="board-list">
        <p class="section-title"><b>게시판 선택</b></p>
        <ul>
            <li><a href="/page/board/board.php">공지사항</a></li>
            <li><a href="/page/board/board2.php">자유게시판</a></li>
            <li><a href="/page/board/board3.php">문의게시판</a></li>
        </ul>
    </div>

    <!-- 글쓰기 버튼 -->
    <div id="write_btn" class="write-button">
        <a href="/page/board/write.php"><button>글쓰기</button></a>
    </div>

    <!-- 게시물 목록 테이블 -->
    <table class="list-table">
        <thead>
            <tr>
                <th width="40">번호</th>
                <th width="300">제목</th>
                <th width="100">글쓴이</th>
                <th width="150">작성일</th>
            </tr>
        </thead>
        <?php while ($board = $board_sql->fetch_array()): ?>
            <tbody>
                <tr>
                    <td><?php echo $board['idx']; ?></td>
                    <td width="200"><a href="read.php?idx=<?php echo $board["idx"]; ?>"><?php echo $board["title"]; ?></a></td>
                    <td><?php echo $board['name'] ?></td>
                    <td><?php echo $board['date'] ?></td>
                </tr>
            </tbody>
        <?php endwhile; ?>
    </table>

    <!-- 페이지 네비게이션 -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <a href="?page=<?php echo $i; ?>" <?php if ($page == $i) echo 'class="active"'; ?>><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>

    <br>
    <br>
</div>

</body>
</html>

