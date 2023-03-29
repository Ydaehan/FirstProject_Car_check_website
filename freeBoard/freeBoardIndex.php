<?php
  /* DB 연결 */
  include '../db/db.php';
  session_start();
  $md_id = isset($_SESSION["md_id"])? $_SESSION["md_id"]:"";

  /* 쿼리 작성 */ /* 쿼리 전송 */
  $result = makeQuery("select * from free_board;");

  /* paging : 전체 데이터 수 */
  $num = mysqli_num_rows($result);

  /* paging : 한 페이지 당 데이터 개수 */
  $list_num = 5;

  /* paging : 한 블럭 당 페이지 수 */
  $page_num = 3;

  /* paging : 현재 페이지 */
  $page = isset($_GET["page"])? $_GET["page"] : 1;

  /* paging : 전체 페이지 수 = 전체 데이터 / 페이지당 데이터 개수, ceil : 올림값 , floor : 내림값 
  , round : 반올림 */
  $total_page = ceil($num / $list_num);

  /* paging : 전체 블럭 수 = 전체 페이지 수 / 블럭 당 페이지 수 */
  $total_block = ceil($total_page / $page_num);
  
  /* paging : 현재 블럭 번호 = 현재 페이지 번호 / 블럭 당 페이지 수 */
  $now_block = ceil($page / $page_num);

  /* paging : 블럭 당 시작 페이지 번호 = (해당 글의 블럭번호 - 1) * 블럭당 페이지 수 + 1 */
  $s_pageNum = ($now_block - 1) * $page_num + 1;

  /* 데이터가 0개인 경우 */
  if($s_pageNum <= 0){
    $s_pageNum = 1;
  };

  /* paging : 블럭 당 마지막 페이지 번호 = 현재 블럭 번호 * 블럭 당 페이지 수 */
  $e_pageNum = $now_block * $page_num;

  // 마지막 번호가 전체 페이지 수를 넘지 않도록
  if($e_pageNum > $total_page){
    $e_pageNum = $total_page;
  };
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>자유게시판</title>
</head>
<body>
  <!-- Title -->
  <h1>자유게시판</h1>
  <a href="../index.php">홈으로</a>
  <h3>자유롭게 글을 쓸 수 있는 게시판 입니다.</h3>
  <!-- Search Block -->
  
  <!-- View freeBoard List -->
  <p>게시글 총합 : <?php echo $num; ?></p>
  <tr class="board_head">
    <td>번호</td>
    <td>제목</td>
    <td>작성자</td>
    <td>작성일</td>
    <td>조회수</td>
  </tr>
  <!-- Board Paging -->
  <?php
    /* paging : 시작 번호 = (현재 페이지 번호 - 1) * 페이지 당 보여질 데이터 수 */
    $start = ($page - 1) * $list_num;

    /* paging : 쿼리 작성 - Limit 몇번부터, 몇개 */
    /* paging : 쿼리 전송 */
    $result = makeQuery("select * from free_board order by id DESC limit $start, $list_num;");

    /* paging : 글번호 */
    $cnt = $start + 1;

    /* paging : 자유게시판 정보 불러오기(반복) */
    while($array = getArray($result)){
  ?>
  <br>
    <tr class="free_brd">
        <td><?php echo $cnt?></td>                  <!-- 번호 -->
        <td><a href="./freeBoardView.php?id=<?php echo $array['id'] ?>"><?php echo $array["title"]?></a></td>       <!-- 제목 -->
        <td><?php echo $array["user_id"]?></td>     <!-- 작성자 -->
        <td><?php $dateString = $array["upload_date"];
                  $dateTime = date_create($dateString);
                  $formatDate = date_format($dateTime,"Y/m/d");
                  echo $formatDate?></td> <!-- 작성 일자 -->
        <td><?php echo $array["views"]?></td>       <!-- 조회수 -->
    </tr>
    <?php 
      /* paging */
      $cnt++;
    }?>
  <!-- Write button but user must be login -->

  <p class="pager">
    <?php
    /* paging : 이전 페이지 */
    if($page <= 1){
    ?>
    <a href="./freeBoardIndex.php?page=1">이전</a>
    <?php } else { ?>
    <a href="./freeBoardIndex.php?page=<?php echo ($page - 1); ?>">이전</a>
    <?php };?>
    <?php 
    /* pager : 페이지 번호 출력 */
    for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){
    ?>
    <a href="./freeBoardIndex.php?page=<?php echo $print_page; ?>"><?php echo $print_page; ?></a>
    <?php };?>

    <!-- paging: 다음 페이지 -->
    <?php
    if($page >= $total_page){
    ?>
    <a href="./freeBoardIndex.php?page=<?php echo $total_page; ?>">다음</a>
    <?php } else { ?>
    <a href="./freeBoardIndex.php?page=<?php echo ($page + 1); ?>">다음</a>
    <?php };?>
  </p>

  <button type="button" class="write_btn" onclick="location.href='../db/login_check.php'">글쓰기</button>
</body>
</html>