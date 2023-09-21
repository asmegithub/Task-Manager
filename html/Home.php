<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $conn = require __DIR__ . "/signup_db.php";
    $sql = "select * from signup_db where id={$_SESSION['user_id']}";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}
$sql = "SELECT * FROM `task-log`";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="../css/cards.css">
    <!-- <link rel="stylesheet" href="../css/animation.css"> -->
</head>

<body>
    <?php if (isset($user)) : ?>
        <nav class="navbar">
            <div class="logo">
                <h2>Our Task Manager</h2>
            </div>
            <a href="logout.php">Logout</a>
        </nav>
        <div class="cool-section">
            <div id="welcome-div">
                <p>Hello <?= htmlspecialchars($user['firstname']) ?>,</p>
                <p>Welcome To our Task Manager Website.</p>
                <a href="#registernow" onclick="smoothScroll('registernow')"><button>Get Started</button></a>
            </div>
        </div>
        <div class="main-content">
            <div id="registernow" class="container">
                <?php
                if ($result->num_rows > 0) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <a href="fetch.php?title=<?= $row["title"] ?>">
                            <div class="card">
                                <div class="title">
                                    <p><?php echo $row["title"] ?></p>
                                </div>
                                <div class="content">
                                    <p><?php echo $row["description"]; ?></p>
                                    <a href="fetch.php?title=<?= $row["title"] ?>" id="detail">More</a>
                                </div>
                            </div>
                        </a>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="registration-section">
            <div id="content">
                <form action="registration-controller.php" method="post">
                    <div id="input-form">
                        <p>Register Your Task Here</p>
                        <div class="title">
                            <input type="text" name="title" placeholder="Title" id="myinput">
                        </div>
                        <div class="description">
                            <textarea name="new-task" id="mytextarea" cols="70" rows="10" placeholder="Description"></textarea>
                        </div>
                        <div class="button-section">
                            <input type="submit" value="Register" class=" registerbtn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <footer>
            <!-- <p>Developed by:</p>
            <div>
                <p>Asmare Zelalem</p>
                <p>Abriham Belayneh</p>
                <p>Betselot Tamene</p>
            </div>
            <div>
                <p>Haileamlak Belachew</p>
                <p>Helina Bikes</p>
            </div> -->
        </footer>
    <?php else :
        header("Location:login.php");
    endif; ?>
    <script src="../js/smooth-scroller.js"></script>
</body>

</html>