<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}else {
    $user_id = '';
}

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select_user->execute([$email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        $_SESSION['user_id'] = $row['id'];
         header('location:home.php');
    }else {
        $message[] = 'incorrect email or password!';
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    

<?php include 'components/user_header.php';?>

<!--user login-->

<section class="form-container">

    <form action="" method="post">
        <h3>login now</h3>
        <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="pass" required maxlength="20" placeholder="enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="login now" class="btn" name="submit">
        <p>don't have an account?</p>
        <a href="user_register.php" class="option-btn">register now</a>
    </form>

</section>















<?php include 'components/footer.php';?>

<!--custom js-->
<script src="js/script.js"></script>


</body>
</html>