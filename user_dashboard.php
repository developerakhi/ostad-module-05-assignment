<?php
    session_start();

    $user = $_SESSION["loggin"] ?? [];

    if (empty($user)) {
        header("Location: logout.php");
        exit;
    }

    if ($user["role"] != "user") {
        header("Location: logout.php");
        exit;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome to user dashboard!</h1>
</body>
</html>