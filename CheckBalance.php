<?php include 'links.php'; 

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

<!DOCTYPE html>
<html>
<head></head>
<body>

<h1>Transaction Website</h1>

<form method="post">
    <h2>Check Balance</h2>
    <input type="hidden" name="action" value="check_balance">
    <table>
        <tr>
            <td><label>Phone Number: </label></td>
            <td><input type="text" name="phone" required></td>
        </tr>
        <tr>
            <td><label>Password: </label></td>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;"><input type="submit" value="Check Balance"></td>
        </tr>
    </table>
</form>

<?php if ($balance): ?>
    <div style="color: green;"><?= $balance ?></div>
<?php endif; ?>

<?php if ($message): ?>
    <div style="color: red;"><?= $message ?></div>
<?php endif; ?>

</body>
</html>