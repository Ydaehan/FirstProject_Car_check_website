<?php
include "./db.php";
session_start();
header("Content-Type:text/html;charset=utf-8");
$id = $_GET["board_id"];
// reply의 board_id 컬럼이 free_board의 id를 참조 하고 있기 때문에
// 먼저 reply의 데이터를 삭제 후 free_board 의 데이터 삭제
// 하려고 했지만 번거로워서 reply 테이블의 외래키 참조 제약 조건을 변경함
// ALTER TABLE reply ADD CONSTRAINT reply_ibfk_1 FOREIGN KEY (board_id) REFERENCES free_board(id)
// ON DELETE CASCADE ON UPDATE CASCADE;

// 위 와 같이 제약 조건을 변경하면 기본키를 참조하고 있던 외래키도 기본키의 데이터가 지워지면
// 함께 지워짐
$del_sql = makeQuery("delete from free_board where id=$id");

$id_AI_reset_sql = makeQuery("alter table free_board AUTO_INCREMENT = 1");
$id_AI_count_set = makeQuery("SET @COUNT=0");
$id_AI_sort_sql = makeQuery("update free_board set id = @COUNT:=@COUNT+1");
$id_AI_reset_sql = makeQuery("alter table reply AUTO_INCREMENT = 1");
$id_AI_count_set = makeQuery("SET @COUNT=0");
$id_AI_sort_sql = makeQuery("update reply set id = @COUNT:=@COUNT+1");
echo "<script>
    alert('삭제 되었습니다.');
    location.href='../freeBoard/freeBoardIndex.php';</script>";
?>

