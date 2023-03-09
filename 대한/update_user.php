<?php
session_start();

/* 로그인 사용자 */
$user_id = $_SESSION["md_id"];

/* DB 연결 */
include "db.php";

/* 쿼리 작성 */
$sql = "select * from manage_user where user_id = $user_id;";

/* 쿼리 전송 */
$result = mysqli_query($db,$sql);

/* 결과 가져오기 */
$array = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script type = "text/javascript">
    function edit_check(){

      var pw = document.getElementById("pw");
      var pw_confirm = document.getElementById("pw_confirm");
      var nickname = document.getElementById("user_nickname");

      if(pw.value){
        var pw_len = pw.value.length;
        if( pw_len < 3 || pw_len > 8){
          var err_txt = document.querySelector(".err_pw");
          err_txt.textContent = "비밀번호는 4~8글자만 입력할 수 있습니다.";
          pw.focus();
          return false;
        };
      };

      if(pw.value){
        if(pw.value != pw_confirm.value){
          var err_txt = document.querySelector(".err_pw_confirm");
          err.txt.textContent = "비밀번호를 확인해 주세요.";
          pw_confirm.focus();
          return false;
        };
      };

      if(nickname.value){
        var nickname_len = nickname.value.length;
        if(nickname_len < 1 || nickname_len > 8){
          var err_txt = document.querySelector(".err_nickname");
          err_txt.textContent = "닉네임은 1~8글자만 입력할 수 있습니다.";
          // focus() => .앞의 요소에 초점을 맞춤 (사용자가 입력할 수 있는 상태가 되도록 커서를 위치)
          nickname.focus();
          return false;
        };
      };
    };

    function del_check(){
      var check = confirm("정말 탈퇴하시겠습니까?\n탈퇴한 아이디는 사용하실 수 없습니다.");

      if(check == true){
        location.href = "delete.php";
      ;}
    }; 
  </script>
</head>
<body>
<form name="edit_form" action="edit_ok.php" method="post" onsubmit="return edit_check()">
<!-- fieldset 태그는 관련된 폼 요소들을 하나의 그룹으로 묶는 역할 -->
<fieldset>
    <legend>정보 수정</legend>
    <p>
      <div class="txt">ID</div>
      <?php echo $array["user_id"]; ?>
    </p>

    <p>
      <div class="txt">PW</div>
      <?php echo $array["user_pw"]; ?>
    </p>

    <p>
      <label for="pw" class="txt">PassWord</label>
      <input type="password" name="pw" id="pw" class="pw">
      <br>
      <span class="err_pw">* 비밀번호는 3~8글자만 입력할 수 있습니다.</span>
    </p>

    <p>
      <label for="pw_confirm" class="txt">confirm_PassWord</label>
      <input type="password" name="pw_confirm" id="pw_confirm" class="pw_confirm">
      <br>
      <span class="err_pw_confirm"></span>
    </p>

    <p>
      <label for="nickname" class="txt">PassWord</label>
      <input type="text" name="nickname" id="nickname" class="nickname">
      <br>
      <span class="err_nickname">* 닉네임는 1~8글자만 입력할 수 있습니다.</span>
    </p>

    <p class="btn_wrap">
      <button type="button" class="btn" onclick="history.back()">이전으로</button>
      <button type="button" class="btn" onclick="location.href'index.php'">홈으로</button>
      <button type="button" class="btn" onclick="del_check()">회원탈퇴</button>
      <button type="submit" class="btn">정보수정</button>
    </p>
</fieldset>
</form>
  
</body>
</html>