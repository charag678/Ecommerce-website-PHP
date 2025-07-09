<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}else {
    $user_id = '';
}

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_user->execute([$email]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
      $message[] = 'user already exist!';
    }else {
        if($pass != $cpass){
            $message[] = 'confirm password not matched!';
        }else{
            $insert_user = $conn->prepare("INSERT INTO `users` (name, email, password) VALUES (?,?,?)");
            $insert_user->execute([$name, $email, $cpass]);
            $message[] = 'registered successfully, please login now!';
        }
    }
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    

<?php include 'components/user_header.php';?>


<!--user register-->

<section class="form-container">

    <form action="" method="post">
        <h3>register now</h3>
        <input type="text" name="name" required maxlength="20" placeholder="enter your name" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="pass" required maxlength="20" placeholder="enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="cpass" required maxlength="20" placeholder="confirm your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="register now" class="btn" name="submit">
        <p>already have an account?</p>
        <a href="user_login.php" class="option-btn">login now</a>
    </form>

</section>















<?php include 'components/footer.php';?>

<!--custom js-->
<script src="js/script.js"></script>


</body>
</html>