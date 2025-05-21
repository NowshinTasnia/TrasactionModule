<?php
$con = mysqli_connect('localhost', 'root', '', 'transaction_db');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$message = "";
$balance = "";
?>


<html>
<head>
    <title>Transaction Website</title>
  <style>
    body {
        font-family: 'Times New Roman';
        font-size: 24px;
        background-color:rgb(234, 238, 228);
        padding: 20px;
    }

    form {
        background: #fff;
        max-width: 500px;
        margin: 50px auto;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    h1, h2 {
        text-align: center;
        color: #333;
    }

    button {
      background-color: #4CAF50;
      color: white;
      padding: 15px 30px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #45a049;
    }

    div{   
        text-align: center;
        font-weight: bold;
    }

    label {
        font-size: 20px;
        color: rgb(48, 5, 204);
        font-weight: bold;
    }

    input[type="text"],
    input[type="password"],
    input[type="number"] {
        font-size: 20px;
        width: 100%;
        padding: 8px;
        margin-top: 4px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    input[type="submit"] {
        font-family: 'Times New Roman';
        font-size: 28px;
        align: center;
        background-color:rgb(13, 110, 42);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
    }

    table {width: 100%;}
    td {padding: 10px;}
  </style>
</head>
</html>