<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Gordon's Crown</title>
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
            margin-left: 10%;
        }

        .content {
            height: 100vh;;
            margin: 0 auto;
            width: 680px;
            background-color: white;
            padding: 10px 30px 10px 130px; 
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

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .success {
            color: green;
            font-weight: bold;
            margin-top: 10px;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-top: 10px;
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
<div style="background-color:white; width:850px; margin:0 auto; padding:20px 0;">&nbsp;</div>
<a style="text-decoration:none" href="index.php">       
    <div class="header">
        <h1>Dedicated to delicious British Food</h1>    
        <p>Gordon's Crown</p>
    </div>
</a>
 <div class="header-fold">&nbsp;</div>
<!-- Navigation Section -->
<div class="nav">
    <a href="index.php">Home</a>
    <a href="menu.php">Menu</a>
    <a class="active" href="contact.php">Contact</a>
    <a href="login.php">Login</a>
</div>

<!-- Main Content Section -->
<div class="content">
    <h2>Contact Us</h2>
    
    <?php
    
    $message = '';
    $message_class = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $messageContent = isset($_POST['message']) ? $_POST['message'] : '';

        
        if ($name && $email && $messageContent) {
           

            $to = "salutations0208@gmail.com"; 
            $subject = "New contact form submission from $name";
            $body = "Name: $name\nEmail: $email\nMessage:\n$messageContent";
            $headers = "From: $email";

            if (mail($to, $subject, $body, $headers)) {
                $message = 'Your message has been sent successfully!';
                $message_class = 'success';
            } else {
                $message = 'There was a problem sending your message. Please try again.';
                $message_class = 'error';
            }
        } else {
            $message = 'Please fill in all fields!';
            $message_class = 'error';
        }
    }
    ?>

    <?php if ($message): ?>
        <div class="<?php echo $message_class; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <input type="submit" value="Send Message">
    </form>
</div>

</body>
</html>
