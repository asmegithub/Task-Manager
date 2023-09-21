<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        body {
            text-align: center;
        }

        @media screen and (max-width:772px) {
            .register {
                flex-direction: column;
            }
        }

        .register {
            display: flex;
            text-align: center;
            margin: 80px auto;
        }

        .welcome,
        .registerform {
            text-align: center;
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
    <div class="register">
        <div class="registerform">
            <form action="process-signup.php" method="POST">
                <h2>Register to our Task Manager</h2>
                <input type="text" name="firstname" id="" placeholder="First Name"><br>
                <input type="text" name="lastname" id="" placeholder="Last Name"><br>
                <input type="email" name="email" id="" placeholder="Email"><br>
                <input type="password" name="password" id="" placeholder="password"><br>
                <input type="submit" value="Register">
                <span id="login">Already have an account?<a href="index.php"> Login </a></span>
            </form>
        </div>
        <div class="welcome">
            <img src="../images/tak1.jpg" alt="Task Manager">
        </div>
    </div>
</body>

</html>