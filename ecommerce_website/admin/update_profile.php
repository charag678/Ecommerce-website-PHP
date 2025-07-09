<?php
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit;
}

$message = []; // ✅ Initialize message as an array

// Fetch current admin profile
$select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
$select_profile->execute([$admin_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

// Handle form submission
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    // Update name
    $update_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
    $update_name->execute([$name, $admin_id]);

    // Get existing password
    $select_old_pass = $conn->prepare("SELECT password FROM `admins` WHERE id = ?");
    $select_old_pass->execute([$admin_id]);
    $fetch_prev_pass = $select_old_pass->fetch(PDO::FETCH_ASSOC);
    $prev_pass = $fetch_prev_pass['password'];

    // Get raw password inputs
    $old_pass_raw = $_POST['old_pass'] ?? '';
    $new_pass_raw = $_POST['new_pass'] ?? '';
    $confirm_pass_raw = $_POST['confirm_pass'] ?? '';

    // Sanitize inputs (and trim spaces)
    $old_pass_raw = filter_var(trim($old_pass_raw), FILTER_SANITIZE_STRING);
    $new_pass_raw = filter_var(trim($new_pass_raw), FILTER_SANITIZE_STRING);
    $confirm_pass_raw = filter_var(trim($confirm_pass_raw), FILTER_SANITIZE_STRING);

    // Check if any password field is filled
    if (!empty($old_pass_raw) || !empty($new_pass_raw) || !empty($confirm_pass_raw)) {

        if (empty($old_pass_raw) || empty($new_pass_raw) || empty($confirm_pass_raw)) {
            $message[] = 'Please fill in all password fields!';
        } else {
            $old_pass = sha1($old_pass_raw);
            $new_pass = sha1($new_pass_raw);
            $confirm_pass = sha1($confirm_pass_raw);

            if ($old_pass !== $prev_pass) {
                $message[] = 'Old password not matched!';
            } elseif ($new_pass !== $confirm_pass) {
                $message[] = 'Confirm password not matched!';
            } else {
                // Update password
                $update_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
                $update_pass->execute([$confirm_pass, $admin_id]);
                $message[] = 'Password updated successfully!';
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Update</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css?v=<?php echo time(); ?>">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<!-- profile update start -->
<section class="form-container">
    <?php if (!empty($message) && is_array($message)): ?>
        <?php foreach ($message as $msg): ?>
            <div class="message"><?= htmlspecialchars($msg) ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <form action="" method="POST">
        <h3>Update Profile</h3>
        <input type="text" name="name" maxlength="20" required placeholder="Enter your username" class="box"
               oninput="this.value = this.value.replace(/\s/g, '')"
               value="<?= htmlspecialchars($fetch_profile['name']) ?>">

        <input type="password" name="old_pass" maxlength="20" placeholder="Enter your old password" class="box"
               oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="new_pass" maxlength="20" placeholder="Enter your new password" class="box"
               oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="confirm_pass" maxlength="20" placeholder="Confirm your new password" class="box"
               oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="Update Now" name="submit" class="btn">
    </form>
</section>
<!-- profile update end -->

<script src="../js/admin_script.js"></script>
</body>
</html>

