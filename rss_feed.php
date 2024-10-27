<?php
include('db.php');


header("Content-Type: application/rss+xml; charset=UTF-8");


$sql = "
SELECT m.*, 
       IFNULL(COUNT(v.rating), 0) AS total_votes,
       IFNULL(AVG(v.rating), 0) AS avg_rating 
FROM menu m 
LEFT JOIN votes v ON m.id = v.menu_id 
GROUP BY m.id 
ORDER BY m.title";

$result = $conn->query($sql);

echo '<?xml version="1.0" encoding="UTF-8" ?>';
?>
<rss version="2.0">
<channel>
    <title>Menu of Gordon's Crown</title>
    <link>http://localhost:8000/menu.php</link>
    <description>Menu of Gordon's Crown.</description>
    <language>vi</language>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $avg_rating = round($row['avg_rating'], 1);
            $total_votes = $row['total_votes'];
            ?>
            <item>
                <title><?php echo htmlspecialchars($row['title']); ?></title>
                <link>http://yourwebsite.com/vote.php?menu_id=<?php echo $row['id']; ?></link>
                <description>
                    <![CDATA[
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <p>Price £<?php echo number_format($row['price'], 0, ',', '.'); ?> </p>
                        <p>Rating: <?php echo $avg_rating; ?> (<?php echo $total_votes; ?> <?php echo $total_votes == 1 ? 'rating' : 'ratings'; ?>)</p>
                    ]]>
                </description>
                <pubDate><?php echo date(DATE_RSS); ?></pubDate>
            </item>
            <?php
        }
    } else {
        echo "<item><title>There are no dishes on the menu</title></item>";
    }
    ?>

</channel>
</rss>