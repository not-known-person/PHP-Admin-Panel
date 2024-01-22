<?php
require "../config/config.php";
require "../includes/header.php";
if (isset($_SESSION["username"])) {
  header("location :" . ROOT_DIR . "");
}
if (isset($_POST['submit'])) {
  if ((empty($_POST['email'])) or (empty($_POST['password']))) {
    echo "<script>alert('Fill all the required fields')</script>";
  } else {
    $email = $_POST['email'];
    $password = $_POST['password'];
    try {
      $query = $conn->prepare("SELECT * FROM users WHERE email=:email");
      $query->execute([
        ":email" => $email,
      ]);
      $fetch = $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $Exception) {
      echo $Exception->getMessage();
    }
    if ($query->rowCount() > 0) {
      if (password_verify($password, $fetch["password"])) {
        $_SESSION['username'] = $fetch['name'];
        $_SESSION['email'] = $fetch['email'];
        $_SESSION['avatar'] = $fetch['avatar'];
        $_SESSION['id'] = $fetch['id'];
        header('location: ' . ROOT_DIR . '');
      }
    }
  }
}
?>
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="main-col">
        <div class="block">
          <h1 class="pull-left">Login</h1>
          <h4 class="pull-right">A Simple Forum</h4>
          <div class="clearfix"></div>
          <hr>
          <form role="form" enctype="multipart/form-data" method="post" action="login.php">

            <div class="form-group">
              <label>Email Address*</label> <input type="email" class="form-control" name="email"
                placeholder="Enter Your Email Address">
            </div>

            <div class="form-group">
              <label>Password*</label> <input type="password" class="form-control" name="password"
                placeholder="Enter A Password">
            </div>

            <input name="submit" type="submit" class="color btn btn-default" value="Login" />
          </form>
        </div>
      </div>
    </div>
    <?php require "../includes/footer.php"; ?>