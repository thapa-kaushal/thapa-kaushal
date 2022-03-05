
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>COURSES</title>
</head>
<body>
    <h1 id="">
</body>
</html>
    

<?php

include "DbConnect.php";
 $db = new DbConnect();
 $conn = $db->connect();

$stmt = $conn->prepare("SELECT * FROM videos WHERE video_type = 2");
$stmt->execute();
$videos = $stmt->fetchALL(PDO::FETCH_ASSOC);
echo "<div class='row '>" ;

foreach($videos as $video) {
    echo "<label>".$video['title']."</label>";
    echo "<div class='col-md-6'>";



echo '<iframe width="560" height="315" 
   src="https://www.youtube.com/embed/'.$video['video_id'].'" 
   title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    echo "</div>";


}
echo "</div>";

?>

</body>
</html>