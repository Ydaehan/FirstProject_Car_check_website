
<!DOCTYPE html>
<html lang="kr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./test.css">
  <title>Document</title>
</head>
<div class="logo">
  <strong>자동차 정비 웹 프로젝트</strong>
</div>
<body style="overflow: hidden;">
<form action="login_server.php" method="POST">
    <h2>로그인</h2>

    <button type = "button" id="home_btn"><a href="index.php">Home</a></button>

    <?php if(isset($_GET['error'])) { ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>


    <label>아이디</label>
    <input type="text" placeholder="아이디..." name="user_id">

    <label>비밀번호</label>
    <input type="password" placeholder="비밀번호..." name="user_pw">

    <button type="submit" name="login_btn">로그인</button>
    <a href="join.php" class="save">아직 회원이 아니신가요?(회원가입 하러가기</a>
    

    </form>
  
        <?php
        session_start();
        if(isset($_SESSION['md_id'])){ ?>
          <a class="text" href="./logout.php">logout</a>
          <h1>반갑습니다</h1>
        <?php }
            else{ ?>
              <a class="text" href="./login.php">login</a>
            <?php } ?>
      </ul>
    </div>
    
  </div>
  
  
</body>
</html>

