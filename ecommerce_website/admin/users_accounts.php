<?php

include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}



if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
    $delete_users->execute([$delete_id]);
    $delete_order = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
    $delete_order->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart->execute([$delete_id]);
    $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
    $delete_wishlist->execute([$delete_id]);
    $deletemessages = $conn->prepare("DELETE FROM `messages` WHERE user_id = ?");
    $deletemessages->execute([$delete_id]);
    header('location:users_accounts.php');
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user accounts</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="../css/admin_style.css?v=<?php echo time(); ?>">

</head>
<body>


<?php include '../components/admin_header.php' ?>

<!--users account-->


<section class="accounts">
    <h1 class="heading">user accounts</h1>

    <div class="box-container">

        <?php
            $select_account = $conn->prepare("SELECT * FROM `users`");
            $select_account->execute();
            if ($select_account->rowCount() > 0) {
                while ($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)) {
                    
        ?>
        <div class="box">
            <p> user id : <span><?= $fetch_accounts['id'];?></span> </p>
            <p> username : <span><?= $fetch_accounts['name'];?></span> </p>
            <p> email : <span><?= $fetch_accounts['email'];?></span> </p>
            <a href="user_accounts.php?delete=<?= $fetch_accounts['id']?>" 
            class="delete-btn" onclick="return confirm('delete this account?');">delete</a>  
        </div>
        <?php
            }
            }else {
                echo '<p class="empty">no accounts available</p>';
            }
        
        ?>
    </div>
</section>






<!--custom js-->

<script src="../js/admin_script.js"></script>

</body>
</html>