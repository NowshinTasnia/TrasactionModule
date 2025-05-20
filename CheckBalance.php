
<?php
$message = "";
$balance = "";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaction Website</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f4f4f4; }
        form { background: #fff; padding: 20px; margin-bottom: 20px; border-radius: 5px; box-shadow: 0 0 10px #ccc; }
        h2 { color: #333; }
    </style>
</head>
<body>

<h1>Transaction Website</h1>

<form method="post">
    <h2>Check Balance</h2>
    <input type="hidden" name="action" value="check_balance">
    <label>Phone Number: <input type="text" name="phone" required></label><br><br>
    <label>Password: <input type="password" name="password" required></label><br><br>
    <input type="submit" value="Check Balance">
</form>

<?php if ($balance): ?>
    <div style="color: green; font-weight: bold;"><?= $balance ?></div>
<?php endif; ?>

</body>
</html>


<?php
if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] === 'check_balance') {
        $phone = $_REQUEST['phone'];
        $password = md5($_REQUEST['password']);
        $result = mysqli_query($con, "SELECT balance FROM users WHERE phone='$phone' AND password='$password'");
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $balance = "Balance for $phone is TK " . $row['balance'];
        } else {
            $message = "Invalid phone number or password.";
        }
    }
}
?>