<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gordon's Crown</title>
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
            float: left;
            margin-left: 10%;
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
            color: white
        }

        .nav .active {
            background-color: green;
            color: white;
        }

        .jump {
            background-color: #3b603a;
            height: auto;
            width: 150px;
            position: absolute;
            right: 220px;
            top: 300px;
            padding: 20px;
            z-index: 2;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5);
            color: white;
        }

        .jump h3 {
            margin: 0 0 10px;
            font-size: 18px;
            color: #DAA520;
        }

        .jump ul {

            padding: 0px 15px;
        }

        .jump li a {
            color: white;

        }

        .jump li a:hover {
            color: green;
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
            border: 3px solid #DAA520;
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
        <a class="active" href="menu.php">Menu</a>
        <a href="contact.php">Contact</a>
        <a href="login.php">Login</a>
    </div>

    <!-- Main Content Section -->
    <div class="content">
        <div class="jump">

            <h3>Jump to...</h3>
            <div style="border-top:3px solid #DDA520"></div>

            <ul>
                <?php

                $categorySql = "SELECT DISTINCT category FROM menu ORDER BY category";
                $categoryResult = $conn->query($categorySql);
                if ($categoryResult->num_rows > 0) {
                    while ($catRow = $categoryResult->fetch_assoc()) {
                        echo "<li><a href='#{$catRow['category']}'>{$catRow['category']}</a></li>";
                    }
                }
                ?>
            </ul>
        </div>

        <h2>Menu of Gordon's Crown</h2>
        <div style="display: block; align-items: flex-start;">

            <?php
            $sql = "
SELECT m.*, 
       IFNULL(COUNT(v.rating), 0) AS total_votes,
       IFNULL(AVG(v.rating), 0) AS avg_rating 
FROM menu m 
LEFT JOIN votes v ON m.id = v.menu_id 
GROUP BY m.category, m.id
ORDER BY m.category, m.title";

            $result = $conn->query($sql);
            $current_category = '';

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($current_category != $row['category']) {
                        if ($current_category != '') {
                            echo "</ul>";
                        }

                        $current_category = $row['category'];

                        $groupSql = "
            SELECT COUNT(v.rating) AS group_votes,
                   IFNULL(AVG(v.rating), 0) AS group_avg 
            FROM menu m 
            LEFT JOIN votes v ON m.id = v.menu_id 
            WHERE m.category = '{$current_category}'";

                        $groupResult = $conn->query($groupSql);
                        $groupData = $groupResult->fetch_assoc();

                        $rating_plural = $groupData['group_votes'] == 1 ? "rating" : "ratings";
                        $avg_rating = round($groupData['group_avg'], 1);
                        $group_votes = $groupData['group_votes'];

                        echo "<h3 style='color:#DDA520; margin-bottom:3px;' id='{$current_category}'>{$current_category}</h3>";
                        echo "<div  style='border-top:3px solid #DDA520; width:500px'></div>";
                        echo "<div style='color:#DDA520; margin-top:5px'>Rating: {$avg_rating} ({$group_votes} {$rating_plural})</div><br>";
                        echo "<ul style=' color:black; padding-left: 20px; margin-left: 20px;'>";


                        echo "<img src='{$row['image']}' alt='Hình ảnh món ăn đầu tiên trong danh mục' style='max-width: 450px; margin-bottom: 10px; margin-left:-20px'>"; // Hiển thị hình ảnh không cần thẻ <li>
                    }

                    echo "<li style='color:black; margin-bottom: 10px;'>
                <a style='color:black' href='detail.php?menu_id={$row['id']}'>{$row['title']} - £{$row['price']}</a>
              </li>";
                }

                echo "</ul>";
            } else {
                echo "Không có món ăn nào.";
            }
            ?>



        </div>
    </div>
    </div>
    <!-- RSS Feed Link -->
    <div style="margin-top: 20px; background-color:#2a4d28; text-align:center">
        <a style='color:white;' href="rss_feed.php">RSS Feed for Dishes</a>
    </div>
    </div>
</body>

</html>
