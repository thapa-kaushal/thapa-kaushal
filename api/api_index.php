<?php

include "DbConnect.php";
 $db = new DbConnect();
 $conn = $db->connect();

$key        = "AIzaSyDKNVTCTM613dE-CVXc_joLrqNGAXjFfWI";
$base_url   = "https://www.googleapis.com/youtube/v3/";
$channelId  = "UCuT0rj__qEq_ZO3kYwun4Qg";
$maxResult  = 10;
$video_type = isset($_GET['vtype']) ? 1 : 2;

  if($video_type == 1) { 
    $API_URL   = $base_url . "search?order=date&part=snippet&channelId=".$channelId."&maxResults=".$maxResult."&key=".$key;
      getVideos($API_URL);
  }else {
    $API_URL   = $base_url . "playlists?order=date&part=snippet&channelId=".$channelId."&maxResults=".$maxResult."&key=".$key;
    getPlaylists($API_URL);
  }
  
     
  
  function getPlaylists($API_URL) {
      global $conn;
    $playlists = json_decode( file_get_contents( $API_URL ) );

    foreach ($playlists->items as $video) {
       
        $sql = "INSERT INTO `videos` (`id`, `video_type`, `video_id`, `title`, `thumbnail_url`, `published_at`)
              VALUES (NULL, 2, :vid, :title, :turl, :pdate)";
    
        $stmt = $conn->prepare($sql);
      
            $stmt->bindparam(":vid"   , $video->id);
            $stmt->bindparam(":title" , $video->snippet->title);
            $stmt->bindparam(":turl"  , $video->snippet->thumbnails->high->url);
            $stmt->bindparam(":pdate" , $video->snippet->publishedAt);
    
        $stmt->execute();
        
       }
    
  }
  function getVideos($API_URL) {
    global $conn;
    $videos   = json_decode( file_get_contents( $API_URL ) );
   
  foreach ($videos->items as $video) {
   
     $sql = "INSERT INTO `videos` (`id`, `video_type`, `video_id`, `title`, `thumbnail_url`, `published_at`)
           VALUES (NULL, 1, :vid, :title, :turl, :pdate)";
 
     $stmt = $conn->prepare($sql);
   
         $stmt->bindparam (":vid"   , $video->id->videoId );
         $stmt->bindparam (":title" , $video->snippet->title);
         $stmt->bindparam (":turl"  , $video->snippet->thumbnails->high->url);
         $stmt->bindparam (":pdate" , $video->snippet->publishedAt);
 
     $stmt->execute();
 
    }
  }
  

?>

 
