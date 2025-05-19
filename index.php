<?php
$con = mysqli_connect('localhost', 'root', '', 'transaction_db');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";
$balance = "";

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

    if ($_REQUEST['action'] === 'send_money') {
        $sender = $_REQUEST['sender_phone'];
        $receiver = $_REQUEST['receiver_phone'];
        $password = md5($_REQUEST['sender_password']);
        $amount = floatval($_REQUEST['amount']);

        $sender_query = mysqli_query($con, "SELECT balance FROM users WHERE phone='$sender' AND password='$password'");
        $receiver_query = mysqli_query($con, "SELECT phone FROM users WHERE phone='$receiver'");

        if (mysqli_num_rows($sender_query) === 1 && mysqli_num_rows($receiver_query) === 1) {
            $sender_data = mysqli_fetch_assoc($sender_query);
            if ($sender_data['balance'] >= $amount) {
                mysqli_query($con, "UPDATE users SET balance = balance - $amount WHERE phone = '$sender'");
                mysqli_query($con, "UPDATE users SET balance = balance + $amount WHERE phone = '$receiver'");
                $message = "Successful transaction of TK $amount from $sender to $receiver.";
            } else {
                $message = "Insufficient balance.";
            }
        } else {
            $message = "Invalid sender or receiver information.";
        }
    }
}
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

<!-- Send Money Form -->
<form method="post">
    <h2>Send Money</h2>
    <input type="hidden" name="action" value="send_money">
    <label>Sender Phone Number: <input type="text" name="sender_phone" required></label><br><br>
    <label>Sender Password: <input type="password" name="sender_password" required></label><br><br>
    <label>Amount (TK): <input type="number" name="amount" required></label><br><br>
    <label>Receiver Phone Number: <input type="text" name="receiver_phone" required></label><br><br>
    <input type="submit" value="Send Money">
</form>

<?php if ($message): ?>
    <div style="color: <?= strpos($message, 'Successful') !== false ? 'green' : 'red' ?>; font-weight: bold;">
        <?= $message ?>
    </div>
<?php endif; ?>

</body>
</html>
