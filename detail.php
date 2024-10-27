<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?message=Vui lòng đăng nhập trước khi bình chọn.");
    exit();
}

$menu_id = isset($_GET['menu_id']) ? intval($_GET['menu_id']) : 0;
$message = '';
$message_class = '';

if (!isset($_SESSION['rated_dishes'])) {
    $_SESSION['rated_dishes'] = [];
}

if (in_array($menu_id, $_SESSION['rated_dishes'])) {
    $message = 'Menu đã được bình chọn!';
    $message_class = 'info';
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
        $captcha_answer_value = isset($_POST['captcha_answer_value']) ? intval($_POST['captcha_answer_value']) : 0;
        $captcha_answer = $_SESSION['captcha_answer'];

        if ($captcha_answer === $captcha_answer_value) {
            if ($rating > 0 && $menu_id > 0) {
                $stmt = $conn->prepare("INSERT INTO votes (menu_id, rating, user_id) VALUES (?, ?, ?)");
                $user_id = $_SESSION['user_id'];
                $stmt->bind_param("iii", $menu_id, $rating, $user_id);
                $stmt->execute();
                $stmt->close();

                $_SESSION['rated_dishes'][] = $menu_id;

                $message = 'Bình chọn thành công!';
                $message_class = 'success';
            } else {
                $message = 'Vui lòng chọn đánh giá!';
                $message_class = 'error';
            }
        } else {
            $message = 'CAPTCHA không chính xác.';
            $message_class = 'error';
        }
    }
}

$sql = "SELECT m.*, 
               IFNULL(COUNT(v.rating), 0) AS total_votes,
               IFNULL(AVG(v.rating), 0) AS avg_rating 
        FROM menu m 
        LEFT JOIN votes v ON m.id = v.menu_id 
        WHERE m.id = ?
        GROUP BY m.id";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $menu_id);
$stmt->execute();
$result = $stmt->get_result();
$dish = $result->fetch_assoc();
$stmt->close();

$num1 = rand(1, 10);
$num2 = rand(1, 10);
$_SESSION['captcha_answer'] = $num1 + $num2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $dish['title']; ?> - Gordon's Crown</title>
    <style>
        body {
            font-family: 'Times New Roman', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #2a4d28;
            font-size: 16px;
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

        .header h1 {
            margin: 0;
            font-size: 16px;
        }

  .header p {
            margin: 0;
            font-size: 40px;
        }
        .nav {
            height: 100vh;
            width: 180px;
            padding-top: 60px;
            z-index: 1;
            float: left;
            margin-left: 450px;
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
            color: white;
        }

        .nav .active {
            background-color: green;
            color: white;
        }

        .content {
            margin: 0 auto;
            width: 680px;
            min-height: 100vh;
            background-color: white;
            padding: 10px 50px 10px 110px;
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

        .info {
            color: orange; 
            font-weight: bold;
            margin-top: 10px;
        }

        .dish-title {
            color: #dda520;
            font-size: 24px;
            padding: 10px 0px;
            margin-top: 0px; 
            font-weight: bold;
            font-size: 36px;
        }

        .modal {
            display: none; 
            position: fixed; 
            z-index: 1000; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto; 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px; 
            text-align: center; 
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

   .header-fold {
            background-color: #2a4d28;
            height: 100px;
            position: relative;
            margin-top: -80px;
            z-index: -1;
            border: 3px solid #DAA520;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .modal-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        input[type="submit"],
        button {
            background-color: #28a745; 
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover,
        button:hover {
            background-color: #218838; 
        }
    </style>
</head>
<body>

<div style="background-color:white; width:850px; margin:0 auto; padding:20px 0;">&nbsp;</div>
<div class="header">
    <h1>Dedicated to delicious British Food</h1>
 <p>Gordon's Crown</p>
</div>

<div class="header-fold">&nbsp;</div>
<div class="nav">
    <a href="index.php">Home</a>
    <a class="active" href="menu.php">Menu</a>
    <a href="contact.php">Contact</a>
    <a href="login.php">Login</a>
</div>

<div class="content">
   <div style="margin: 20px">
        <a style =' padding: 10px 0px' href="menu.php"> ← Back to menu</a>
        <div class="dish-title">
            <?php echo $dish['title']; ?> - £<?php echo $dish['price']; ?>
        </div>
        <div style="color: #DDA520; font-size: 24px;">
            <?php echo $dish['category']; ?>
        </div>

        <img src="<?php echo $dish['image']; ?>" alt="<?php echo $dish['title']; ?>" style="max-width: 450px;">
        <p><?php echo $dish['description']; ?></p>

        <p><strong style='color:#dda520'>Rating:</strong> <?php echo round($dish['avg_rating'], 1); ?> (<?php echo $dish['total_votes']; ?> ratings)</p>

        <a id="add-rating-link" href="#" onclick="showRatingModal()">Add a rating</a>
        
        <div id="ratingModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close" onclick="hideRatingModal()">&times;</span>
                <h2>Thêm Đánh Giá</h2>
                <form id="rating-form" method="post">
                    <label for="rating">Chọn đánh giá:</label>
                    <select name="rating" id="rating" required>
                        <option value="">-- Chọn --</option>
                        <option value="1">1 - Rất tệ</option>
                        <option value="2">2 - Tệ</option>
                        <option value="3">3 - Trung bình</option>

<option value="4">4 - Tốt</option>
                        <option value="5">5 - Tuyệt vời</option>
                    </select>

                    <label for="captcha">CAPTCHA: <?php echo $num1; ?> + <?php echo $num2; ?> = ?</label>
                    <input type="number" name="captcha_answer_value" required>

                    <div class="modal-buttons">
                        <input type="submit" value="Gửi Đánh Giá">
                        <button type="button" onclick="hideRatingModal()">Hủy</button>
                    </div>
                </form>

 
            </div>
        
</div> <?php if ($message): ?>
                    <div class="<?php echo $message_class; ?>"><?php echo $message; ?></div>
                <?php endif; ?>

              
    </div>

</div>

<script>
    function showRatingModal() {
        document.getElementById('ratingModal').style.display = 'block';
    }

    function hideRatingModal() {
        document.getElementById('ratingModal').style.display = 'none';
    }

    window.onclick = function(event) {
        var modal = document.getElementById('ratingModal');
        if (event.target === modal) {
            hideRatingModal();
        }
    }
</script>

</body>
</html>