<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>CAR</title>
    <link rel="stylesheet" type="text/css" href="text.css">
    <link rel="stylesheet" type="text/css" href="grid.css">
    <script src="sideBar.js"></script>
    <script src="textHide.js"></script>
  </head>
  <body>
    <div class="container">
      <div id="title">
        <h1><a href="index.php">Title</a></h1>
      </div>
      <!-- 상단 메뉴 -->
      <div id="menu">
        <ul id="list">
          <li><a href="1.html">나의 차량</a></li>
          <li><a href="2.html">점검 목록</a></li>
          <li><a href="3.html">menu3</a></li>
          <li><a href="4.html">menu4</a></li>
          <li><a href="5.html">menu5</a></li>
        </ul>
      </div>
      <!-- 좌측 퀵메뉴 -->
      <ul id="sideBar">
        <li><a href="javascript:scroll('side1');">SIDE1</a></li>
        <li><a href="javascript:scroll('side2');">SIDE2</a></li>
        <li><a href="javascript:scroll('side3');">SIDE3</a></li>
        <li><a href="javascript:scroll('side4');">SIDE4</a></li>
        <li><a href="javascript:scroll('side5');">SIDE5</a></li>
      </ul>
      <!-- 중앙 페이지 본문 -->
      <div id="main">
        <h3>SIDE1</h3>
        <input type="button" value="close" onclick="showHide(this,'side1')">
        <div id="side1">
          <script>
            for (let i = 0; i < 100; i++) {
              document.write("HELLO" + "<br>");
            }
          </script>
        </div>
        <br>
        <h3>SIDE2</h3>
        <input type="button" value="close" onclick="showHide(this,'side2')">
        <div id="side2">
          <script>
            for (let i = 0; i < 100; i++) {
              document.write("WORLD" + "<br>");
            }
          </script>
        </div>
        <br>
        <h3>SIDE3</h3>
        <input type="button" value="close" onclick="showHide(this,'side3')">
        <div id="side3">
          <script>
            for (let i = 0; i < 100; i++) {
              document.write("AGAIN" + "<br>");
            }
          </script>
        </div>
        <br>
        <h3>SIDE4</h3>
        <input type="button" value="close" onclick="showHide(this,'side4')">        
        <div id="side4">
            <script>
              for (let i = 0; i < 100; i++) {
                document.write("^_^" + "<br>");
              }
            </script>
        </div>
        <br>
        <h3>SIDE5</h3>
        <input type="button" value="close" onclick="showHide(this,'side5')">
        <div id="side5">
          <script>
                for (let i = 0; i < 100; i++) {
                  document.write("HAHA" + "<br>");
                }
          </script>
        </div> 
      </div>
      <!-- 로그인 메뉴 -->
      <div id="login">
          <form action="login_server.php" method="POST">
            <?php if(isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <input type="text" placeholder="아이디..." name="user_id"><br>
            <input type="password" placeholder="비밀번호..." name="user_pw">
            <button type="submit" name="login_btn">로그인</button><br>
            <a href="join.php" class="save">아직 회원이 아니신가요?(회원가입 하러가기)</a>
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
      </div>
    </div>
    <footer>
      <p>2023.02.27</p>
    </footer>
  </body>
</html>
