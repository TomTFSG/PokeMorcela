<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['player'] = $_POST['username'];

    header("Location: choice.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POKEMORCELA</title>
    <link href="../css/basic.css" rel="stylesheet">
    <link href="../css/start.css" rel="stylesheet">
</head>
<body>
    <form method="POST">
        <input name="username" placeholder="Enter your name">
        <button type="submit">Start Adventure</button>
    </form>
</body>
</html>
