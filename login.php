
<?php require "config.php" ?>
<?php require "includes/header.php"; ?>
<?php
  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])) {
    $email=$_POST['email'];
    $password=$_POST['password'];
    $errorMess ="";
    if($email==""){
      $errorMess="Your email field is empty !";
    }elseif($password=="") {
      $errorMess="Your password field is empty !";
    }else {
      $sql = "SELECT * FROM users WHERE email =:email";
      $statement = $pdo->prepare($sql);
      $statement->execute([":email"=>$email]);
      $data=$statement->fetch(PDO::FETCH_ASSOC);
      if($statement->rowCount()>0) {
         if(password_verify($password,$data['password'])) {
          $_SESSION['username'] = $data['username'];
          $_SESSION['email'] = $data['email'];
          header("Location: index.php");
          exit;
         }else {
          $errPass="password wrong";
         }
      }else {
        $logErr="You are not resgistered !";
      }
    }
  }
?>

<main class="form-signin w-50 m-auto">
  <form method="POST" action="login.php">
    <!-- <img class="mb-4 text-center" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
    <h1 class="h3 mt-5 fw-normal text-center">Please sign in</h1>

    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <?php 
    if(!empty($errorMess)) {
       echo "<p style ='color:red;'>$errorMess</p>";
    }elseif(isset($errPass)){
      echo "<p style ='color:red;'>$errPass</p>";
    }elseif(isset($logErr)){
      echo "<p style ='color:red;'>$logErr</p>";
    }
  ?>
    <h6 class="mt-3">Don't have an account  <a href="register.php">Create your account</a></h6>
  </form>
  
</main>
<?php require "includes/footer.php"; ?>
