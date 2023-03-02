<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>회원가입</title>

  <link rel="stylesheet" type="text/css" href="./join_black.css" >
</head>
<body>
    <form action="server.php" method="POST">
    <h2>회원가입</h2>

    <?php if(isset($_GET['error'])) { ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>

    <?php if(isset($_GET['success'])) { ?>
    <p class="success"><?php echo $_GET['success']; ?></p>
    <?php } ?>


    <label>아이디</label>
    <input type="text" placeholder="아이디..." name="user_id">

    <label>비밀번호</label>
    <input type="password" placeholder="비밀번호..." name="user_pw">

    <label>비밀번호 확인</label>
    <input type="password" placeholder="비밀번호..." name="user_pw2">

    <button type="submit">회원가입</button>
    <a href="login.php" class="save">(이미 회원 이신가요?) 로그인 하러 가기</a>

    </form>
    
</body>
</html>