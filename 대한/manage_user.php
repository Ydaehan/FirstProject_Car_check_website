<?php
    /* DB 연결 */
    include 'db.php';
    session_start();

    $md_id = isset($_SESSION["md_id"])? $_SESSION["md_id"]:"";
    $user_nickname = isset($_SESSION["user_nickname"])? $_SESSION["user_nickname"]:"";
    
    
    /* 쿼리 작성 */
    $sql = "select * from manage_user;";
    
    /* 쿼리 전송 */
    $result = mysqli_query($db, $sql);

    /* 결과 가져오기 */
    // $array = mysqli_fetch_array($result) // for문
    // $num = mysqli_num_rows($result);

    /* paging : 전체 데이터 수 */
    $num = mysqli_num_rows($result);
    
    /* paging : 한 페이지 당 데이터 개수 */
    $list_num = 5;
    
    /* paging : 한 블럭 당 페이지 수 */
    $page_num = 3;

    /* paging : 현재 페이지 */
    $page = isset($_GET["page"])? $_GET["page"] : 1;

    /* paging : 전체 페이지 수 = 전체 데이터 / 페이지당 데이터 개수, ceil : 올림값, floor : 내림값, 
        round : 반올림 */
    $total_page = ceil($num / $list_num);
    // echo "전체 페이지 수 : ".$total_page;

    /* paging : 전체 블럭 수 = 전체 페이지 수 / 블럭 당 페이지 수 */
    $total_block = ceil($total_page / $page_num);

    /* paging : 현재 블럭 번호 = 현재 페이지 번호 / 블럭 당 페이지 수 */
    $now_block = ceil($page / $page_num);

    /* paging : 블럭 당 시작 페이지 번호 = (해당 글의 블럭번호 - 1) * 블럭당 페이지 수 + 1 */
    $s_pageNum = ($now_block - 1) * $page_num + 1;

    // 데이터가 0개인 경우
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
    <title>회원 DB 관리</title>
</head>
<body>
    회원 정보 관리<br>
    <h2>* 관리자 페이지 *</h2>
    <p>"<?php echo $user_nickname?>"님,안녕하세요.</p>
    <p>
        <button type = "button" id="home_btn"><a href="index.php">Home</a></button>
        <a href="list.php">회원 관리</a>
        <a href="logout.php">Logout</a>
    </p>
    <hr>
    <!-- $num 은 위쪽에 테이블 내 데이터 전체 갯수 -->
    <p>총 <?php echo $num; ?></p>
    <table>
        <tr class="title">
            <td>아이디</td>
            <td>닉네임</td>
        </tr>
    </table>
    
</body>
</html>