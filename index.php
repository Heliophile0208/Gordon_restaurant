<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gordon's Crown</title>
    <style>
        body {
            font-family: 'Times New Roman', sans-serif;
            margin: 0 auto;
            padding: 0;
            height:100vh;
            background-color: #2a4d28;
        }

        .header {
            background-color: #2a4d28;
            color: #DAA520;
            text-align: left;
            padding: 20px 0px 20px 60px;
            margin:0 auto;
            z-index:99;
            width:850px;
            border:3px solid #DAA520;
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
            margin: 0px auto;
            width: 680px;
            min-height: 100vh;
            background-color: white;
            padding:10px 50px 10px 110px; 
        }

        .nav a {
            display: block;
            color: #DAA520;;
            text-decoration: none;
            padding: 15px 20px;
            font-weight: bold;
            background-color: #3b603a;
            margin-bottom: 10px;
            text-align: right;
            border-radius: 5px;
            margin-left:20px;
            width:100px;
        }

        .nav a:hover {
            background-color: green;
color:white
        }
      .nav  .active {
        background-color:green;
color:white
        }

        .content h2 {
            color: #2a4d28;
            margin-bottom: 20px;
            font-size: 36px;
        }

        .content p {
            line-height: 1.8;
            margin-bottom: 20px;
            color: #333;
            font-size: 20px;
        }

        .restaurant-img {
            width: 100%;
            max-width: 700px;
            margin: 0 auto 20px auto;
            display: block;
            border-radius: 8px;
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
    </div>
</a>
  <div class="header-fold">&nbsp;</div>
   
    <!-- Navigation Section -->
    <div class="nav">
        <a class="active" href="index.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="contact.php">Contact</a>
        <a href="login.php">Login</a>
    </div>

    <!-- Main Content Section -->

    <div class="content">

        <h2 style="color: #DAA520;">Welcome to Gordon's Crown</h2>
        
        <div style="display: flex; align-items: center;">
            <img style="margin-right: 10px; width: 300px; height: 300;" src="PNG/nhahang.jpg" alt="Gordon's Crown Restaurant" class="restaurant-img">

            <p style="margin-left: 20px;">
                Gordon's fabulous Crown in the middle of London is a brilliant British country pub and restaurant. The Crown is a simple and down-to-earth pub and restaurant where every bite is British quality, served with the culinary magic of super Chef Gordon. The pub is a beautiful Tudor building complete with charming and cozy interior.
            </p>
        </div>

        <div>
            <p style="margin-top:-20px; font-size:12px">
                The pub's walls are adorned with Tudor features, creating an atmosphere of heritage and tradition. The menu changes according to the seasons and market availability. Desserts are hearty and simply divine. The atmosphere at the Crown is completely unpretentious and wonderfully relaxed.
            </p>
        </div>
    </div>

</body>
</html>
