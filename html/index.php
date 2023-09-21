<?php
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = require __DIR__ . "/signup_db.php";
    $sql = sprintf(
        "select * from signup_db 
        where email= '%s'",
        $conn->real_escape_string($_POST['username'])
    );
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
    if ($user) {
        if (password_verify($_POST['password'], $user['password_hash'])) {
            session_start();
            session_regenerate_id();
            $_SESSION['user_id'] = $user['id'];
            header("Location:Home.php");
            exit;
        }
    }
    $is_invalid = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            text-align: center;
            /* background-color: lightblue ; */
        }

        @media screen and (max-width:772px) {
            .landing {
                flex-direction: column;
            }
        }

        .landing {
            display: flex;
            text-align: center;
            margin: 80px auto;
        }

        .welcome,
        .loginform {
            text-align: center;
            /* width: 45%; */
            height: 100%;
            margin: auto;
        }

        form {
            text-align: center;
        }

        input {
            border-radius: 10px;
            border-style: solid;
            height: 50px;
            margin: 10px auto;
            padding-left: 10px;
            width: 90%;
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
            /* background-color: gr; */
        }

        input[type="submit"] {
            background-color: darkorange;
        }

        a {
            color: blue;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="landing">
        <div class="welcome">
            <img src="../images/tak1.jpg" alt="Task Manager">
        </div>
        <div class="loginform">
            <h2>Login to your account</h2>
            <?php
            if ($is_invalid) : ?>
                <em>invalid login</em>
            <?php endif; ?>
            <form method="POST">
                <input type="email" name="username" id="" placeholder="Email" value="<?= htmlspecialchars($_POST['username'] ?? "") ?>"><br>
                <input type="password" name="password" id="" placeholder="password"><br>
                <input type="submit" value="Login">
                <span id="createAcc">Don't have an account?<a href="signup.php"> Create Account</a></span>
            </form>
        </div>
    </div>

</body>

</html>