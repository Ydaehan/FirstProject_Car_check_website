<?php
  include '../db/db.php';
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>view</title>
</head>
<body>
  <?php
    $_SESSION['now_board_id'] = isset($_GET["id"]);
    // 작동 확인
    // echo isset($_SESSION['now_board_id'])?'ok':'no';
    // echo isset($_GET["id"])?'ok':'no';
    $id = isset($_GET["id"])?$_GET["id"]:$_SESSION['now_board_id'];
    // 작동 확인
    // echo isset($id)?$id:'no';
    $select_result = makeQuery("select * from free_board where id = $id");
    $array = getArray($select_result);
    $views = $array['views'] + 1;
    /* 이전 다음 버튼을 눌렀을 경우 조회수가 오르지 않게 수정 */
    $update_result = makeQuery("update free_board set views = '$views' where id = '$id'");
    $select_result = makeQuery("select * from free_board where id = $id");
    $board = getArray($select_result);
  ?>
  <div id="board_read">
    <h2><?php echo $board['title']; ?></h2>
    <div id="user_info" align=right>
      작성자 : <?php echo $board['user_id']; ?> 등록일자 : <?php echo $board['upload_date']; ?> 조회: <?php echo $board['views'];?>
      <div id="bo_line"></div> <!-- css 선 긋기 용 -->
    </div>
    <div id="bo_content">
      <?php echo nl2br("$board[contents]")?>
      <!-- nl2br() 함수는 \n 을 br태그로 바꾸어주는 php함수 -->
    </div>
  
    <!-- 목록으로 이동 및 수정 삭제 기능 추가 -->
    <div id="bo_ser">
      <ul>
        <li><a href="./freeBoardIndex.php">[목록으로]</a></li>  <!-- 목록이동 -->
        
        <?php 
        // 로그인 하지 않은 경우 $login_user_id 값은 "" 로 저장
        $login_user_id = isset($_SESSION['md_id'])?$_SESSION['md_id']:"";

        // 로그인된 계정과 글을 등록한 유저의 계정이 일치하면 활성화
        if ($board['user_id']== $login_user_id){?>
          <li><a href="./freeBoardModify.php?board_id=<?php echo $id ?>">[수정]</a></li>  <!-- 글 수정 -->
          <li><a href="../db/delete_ok.php?board_id=<?php echo $id ?>">[삭제]</a></li>  <!-- 글 삭제 -->
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="reply_view">
    <!-- 댓글보는 기능 -->
    <h3>댓글목록</h3>
          <?php
            include "../db/replyPaging.php";
            /* paging : 시작 번호 = (현재 페이지 번호 - 1) * 페이지 당 보여질 데이터 수 */
            $start = ($page - 1) * $list_num;
            /* paging : 쿼리 작성 - limit 몇번부터, 몇개 */ /* paging : 쿼리 전송 */
            $select_result = makeQuery("select * from reply where board_id = '$id' order by id DESC limit $start, $list_num ;");

            /* paging : 글번호 */
            $cnt = $start + 1;
            
            /* paging : 회원정보 가져오기(반복) */
            while($array = getArray($select_result)){
        ?>
        <tr class="rep_bo">
          <td><?php echo $cnt?></td>
          <td><?php echo $array["user_id"]?></td>
          <td><?php echo $array["content"]?></td>
          <td><?php $dateString = $array["upload_date"];
                $dateTime = date_create($dateString);
                $formatDate = date_format($dateTime,"Y/m/d H:i:s");
                echo $formatDate ?></td>
          <br>
        </tr>
        <?php
          /* paging */
          $cnt++; }
        ?>
  </div>
 
  <p class="pager">
    <?php
    /* paging : 이전 페이지 */
    if($page <= 1){
    ?>
    <a href="./freeBoardView.php?page=1&id=<?php echo $id?>">이전</a>
    <?php } else { ?>
    <a href="./freeBoardView.php?page=<?php echo ($page - 1);?>&id=<?php echo $id?>">이전</a>
    <?php };?>
    <?php 
    /* pager : 페이지 번호 출력 */
    for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){
    ?>
    <a href="./freeBoardView.php?page=<?php echo $print_page; ?>&id=<?php echo $id?>"><?php echo $print_page; ?></a>
    <?php };?>

    <!-- paging: 다음 페이지 -->
    <?php
    if($page >= $total_page){
    ?>
    <a href="./freeBoardView.php?page=<?php echo $total_page; ?>&id=<?php echo $id?>">다음</a>
    <?php } else { ?>
    <a href="./freeBoardView.php?page=<?php echo ($page + 1); ?>&id=<?php echo $id?>">다음</a>
    <?php };?>
  </p>
  <!-- 댓글 입력 폼-->
  <div class="reply_ins">
    <form action="../db/reply_ok.php?board_id=<?php echo $id;?>" method="post">
      <div style="margin-top:10px;">
        <textarea name="content" id="reply_content" id="re_content"></textarea>
        <button id="rep_bt" class="re_bt">댓글</button>
      </div>
    </form>
  </div>
</body>
</html>