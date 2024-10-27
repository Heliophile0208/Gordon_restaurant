<?php
session_start(); 

$message = '';
$message_class = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === '123') {
        $_SESSION['user_id'] = 1; 
        $_SESSION['username'] = 'admin';
        header("Location: login.php"); // Redirect to the same page to show user info
        exit();
    } else {
        $message = 'Incorrect Username or Password!';
        $message_class = 'error';
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php"); // Redirect to login page after logout
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gordon's Crown</title>
    <style>
        body {
            font-family: 'Times New Roman', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #2a4d28;
        }

        .header {
            background-color: #2a4d28;
            color: #DAA520;
            text-align: left;
            padding: 20px 0 20px 60px;
            margin: 0 auto;
            width: 850px;
            border: 3px solid #DAA520;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 1);
        }

        .header p {
            margin: 0;
            font-size: 40px;
        }

        .header h1 {
            margin: 0;
            font-size: 16px;
        }

        .nav {
            height: 100vh;
            width: 180px;
            padding-top: 60px;
            z-index: 1;
            float:left;
            margin-left: 450px;
        }

        .content {
            margin: 0 auto;
            width: 680px;
            min-height: 100vh;
            background-color: white;
            padding: 10px 50px 10px 110px; 
        }

        .nav a {
            display: block;
            color: #DAA520;
            text-decoration: none;
            padding: 15px 20px;
            font-weight: bold;
            background-color: #3b603a;
            margin-bottom: 10px;
            text-align: right;
            border-radius: 5px;
            margin-left: 20px;
            width: 100px;
        }

        .nav a:hover {
            background-color: green;
            color:white;
        }

        .nav .active {
            background-color: green;
            color:white;
        }

        .content h2 {
            color: #DAA520;
            margin-bottom: 20px;
            font-size: 36px;
        }

        .content p {
            line-height: 1.8;
            margin-bottom: 20px;
            color: #333;
            font-size: 20px;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        
input[type="text"]:focus, input[type="password"]:focus {
            border-color: #DAA520;
            outline: none;
        }

        input[type="submit"] {
            background-color: #3b603a;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: green;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }

        .user-info {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

       

        .logout {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #DAA520;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .logout:hover {
            background-color: #c49c20;
        }

        .return-menu {
            margin-top: 20px;
            font-size: 14px;
        }
.header-fold {
    background-color: #2a4d28;
    height: 100px;
    position: relative;
    margin-top: -80px;
    z-index: -1;
    clip-path: polygon(0);
border:3px solid #DAA520
}
    </style>
</head>
<body>

<div style="background-color:white; width:850px; margin:0px auto; padding:20px 0px">&nbsp;</div>
<a style="text-decoration:none" href="index.php">       

<div class="header">
    <h1>Dedicated to delicious British Food</h1>
    <p>Gordon's Crown</p>
</div></a>
 <div class="header-fold">&nbsp;</div>

<!-- Navigation Section -->
<div class="nav">
    <a href="index.php">Home</a>
    <a href="menu.php">Menu</a>
    <a href="contact.php">Contact</a>
    <a class="active" href="login.php">Login</a>
</div>

<!-- Main Content Section -->
<div class="content">
    <h2>Login</h2>
    <?php if ($message): ?>
        <div class="<?php echo $message_class; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['username'])): ?>
        <p class="user-info">Welcome, <?php echo $_SESSION['username']; ?>!</p>
        <a class="logout" href="login.php?logout=true">Logout</a>
    <?php else: ?>
        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <input type="submit" value="Login">
        </form>
    <?php endif; ?>

    <div class="return-menu">
        <a href="menu.php">Return to menu</a>
    </div>
</div>

</body>
</html>