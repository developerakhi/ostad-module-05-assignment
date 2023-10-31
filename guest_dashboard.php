<?php
    session_start();

    $user = $_SESSION["loggin"] ?? [];

    if (empty($user)) {
        header("Location: logout.php");
        exit;
    }

    if ($user["role"] != "") {
        header("Location: logout.php");
        exit;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Guest User Dashboard!</h1>
</body>
</html>