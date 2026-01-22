<?php
session_start();
include_once "db.php";

if (!isset($_SESSION['username'])) {
    header("Location: Adminlogin.php");
    exit;
}

$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT * FROM `user` WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$adminData = $result->fetch_assoc();
?>
<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                </li>
            </ul>

            <div class="d-flex">
                <?php if (isset($_SESSION['username'])) { ?>
                    <button id="logout" class="btn btn-danger">Logout</button>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>

<main class="container mt-4">
    <h1>Hello, <?= htmlspecialchars($adminData['username']) ?></h1>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$('#logout').on('click', function(e) {
    e.preventDefault();

    $.ajax({
        url: 'Logout.php',
        type: 'POST',
        dataType: 'json',
        success: function(res) {
            if (res.status === 'success') {
                window.location.href = 'Adminlogin.php';
            }
        }
    });
});
</script>

</body>
</html>
