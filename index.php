<?php
session_start();
if(!isset($_SESSION['user']))
{
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task_1</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="index1.css">
</head>
<body>
    <div class="container">

    <h3>HELLO <p></p>, WELLCOME TO MOONRAFT </h3>
    <a href="logout.php" class="btn btn-warning">Logout</a>
    </div>

</body>
</html>