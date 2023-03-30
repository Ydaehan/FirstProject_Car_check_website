<?php
  include ('../db/db.php');
  session_start();
  if(!function_exists('freeBoardSearch')){
    function freeBoardSearchPaging($argCategory,$argSearch_con,$argStart,$argList_num){
      if($argCategory != "" && $argSearch_con != ""){
        if($argCategory == "title"){
          $sql = "SELECT * FROM free_board WHERE title LIKE '%".$argSearch_con."%' ORDER BY id DESC limit $argStart, $argList_num;";
        }else if ($argCategory == "user_id"){
          $sql = "SELECT * FROM free_board WHERE user_id LIKE '%".$argSearch_con."%' ORDER BY id DESC limit $argStart, $argList_num;";      
        }else{
          $sql = "SELECT * FROM free_board WHERE contents LIKE '%".$argSearch_con."%' ORDER BY id DESC limit $argStart, $argList_num;";  
        }
      }else{
        $sql = "SELECT * FROM free_board ORDER BY id DESC limit $argStart, $argList_num;";
      }
      return $result = makeQuery($sql);
    }

    function freeBoardSearch($argCategory,$argSearch_con){
      if($argCategory != "" && $argSearch_con != ""){
        if($argCategory == "title"){
          $sql = "SELECT * FROM free_board WHERE title LIKE '%".$argSearch_con."%';";
        }else if ($argCategory == "user_id"){
          $sql = "SELECT * FROM free_board WHERE user_id LIKE '%".$argSearch_con."%';";
        }else{
          $sql = "SELECT * FROM free_board WHERE contents LIKE '%".$argSearch_con."%';";            
        }
      }else{
        $sql = "SELECT * FROM free_board;";
      }
      return $result = makeQuery($sql);
    }
  }
?>