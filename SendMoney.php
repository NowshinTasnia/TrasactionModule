<?php include 'links.php'; 

if (isset($_REQUEST['action'])) {
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
<head></head>
<body>

<form method="post">
  <h2>Send Money</h2>
    <input type="hidden" name="action" value="send_money">
  <table>
    <tr>
      <td><label>Sender Phone Number: </label></td>
      <td><input type="text" name="sender_phone" required></td>
    </tr>
    <tr>
      <td><label>Sender Password: </label></td>
      <td><input type="password" name="sender_password" required></td>
    </tr>
    <tr>
      <td><label>Amount (TK): </label></td>
      <td><input type="number" name="amount" required></td>
    </tr>
    <tr>
      <td><label>Receiver Phone Number: </label></td>
      <td><input type="text" name="receiver_phone" required></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;"><input type="submit" value="Send Money"></td>
    </tr>
  </table>
</form>

<?php if ($message): ?>
    <div style="color: <?= strpos($message, 'Successful') !== false ? 'green' : 'red' ?>;">
        <?= $message ?>
    </div>
<?php endif; ?>

</body>
</html>