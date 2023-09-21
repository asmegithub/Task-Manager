<?php
require 'db.php';
if ($_SERVER["QUERY_STRING"]) {
    // $s = $_SERVER["QUERY_STRING"];
    // parse_str($s, $a);
    // $param = $a['title'];
    $param = $_GET['title'];
    $sql1 = "SELECT * FROM `sub-tasks` where title='$param' and complete='0'";
    $sql2 = "SELECT * FROM `sub-tasks` where title='$param'and complete='1'";
    $uncompleted = $conn->query($sql1);
    $completed = $conn->query($sql2);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sub-tasks</title>
    <link rel="stylesheet" href="../css/progress.css">
    <link rel="stylesheet" href="../css/cards.css">
    <style>
        .main-content .container .card:hover .content {
            top: 160px;
            height: 250px;
        }

        .main-content .container .card:hover .content p {
            font-size: 1.5em;
            line-height: 1.5;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <h2>Our Task Manager</h2>
        </div>
        <a href="Home.php">Home</a>
    </nav>
    <div class="main-content">
        <div class="progress-body">
            <p>Task progression</p>
            <div class="progress-container">
                <div class="circular-progress">
                    <div class="value-container">
                        0%
                    </div>
                </div>
            </div>
            <a href="#hash" onclick="smoothScroll('hash')"><button>Details</button></a>
        </div>
        <div class="category top-category">
            <h3 id="hash">Uncompleted Tasks</h3>
        </div>
        <div class="container">
            <?php
            if ($uncompleted->num_rows > 0) :
                while ($row = $uncompleted->fetch_assoc()) : ?>
                    <div class="card sub-card">
                        <div class="title">
                            <?php echo $row["task"]; ?>
                        </div>
                        <div class="content">
                            <p>Start Date: <?php echo $row["startDate"]; ?><br>
                                End Date: <?php echo $row["endDate"]; ?>
                                <br>Click to Finish this Task:
                            </p>
                            <a href="task-comletion-controller.php?task=<?= $row["task"] ?> title=<?= $param ?>"><button>Complete</button></a>
                        </div>
                    </div>
            <?php endwhile;
            endif; ?>
        </div>
        <div class="category">
            <h3>Completed Tasks</h3>
        </div>
        <div class="container">
            <?php
            if ($completed->num_rows > 0) :
                while ($row = $completed->fetch_assoc()) : ?>
                    <div class="card completed sub-card">
                        <div class="title">
                            <?php echo $row["task"]; ?>
                        </div>
                        <div class="content">
                            <p>End Date: <?php echo $row["endDate"]; ?><br>
                                Start Date: <?php echo $row["startDate"]; ?>
                            <p id="completed">Task has been completed!</p>
                            </p>
                        </div>
                    </div>
            <?php endwhile;
            endif; ?>
        </div>
    </div>
    <footer>
        <div class="contactus">
            <div>
                <a href="#">Contact us</a>
            </div>
            <div>
                <a href="#">Developed By:</a>
            </div>
            <a href="#"></a>
        </div>
    </footer>
    <!-- script to calculate the progression -->
    <script>
        let progressBar = document.querySelector(".circular-progress");
        let valueContainer = document.querySelector(".value-container");

        let progressValue = 0;
        let progressEndValue = <?= round(($completed->num_rows / ($completed->num_rows + $uncompleted->num_rows)) * 100) ?>;
        let speed = 10;
        let progress = setInterval(() => {
            progressValue++;
            valueContainer.textContent = `${progressValue}%`;
            progressBar.style.background = `conic-gradient(
                            #4d5bf9 ${progressValue * 3.6}deg,
                            #cadcff ${progressValue * 3.6}deg
                        )`;
            if (progressValue == progressEndValue) {
                clearInterval(progress);
            }
        }, speed);
    </script>
    <script src="../js/smooth-scroller.js"></script>
</body>

</html>