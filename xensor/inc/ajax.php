<?php
 include('/include/mojang-api.class.php');
  $user = $_POST['user']

    $uid ="";
   
   $uid .=" <p>
      <strong>";
       
        $uuid = MojangAPI::getUuid($user);
        if (!empty($uuid)) {
           $uid .= ('UUID: <b>' . $uuid . '</b><br>');

          // Get his name history
          $history = MojangAPI::getNameHistory($uuid);
          $uid .= ('First username: <b>' . reset($history)['name'] . '</b><br>');

          // Print player's head
          $img = '<img src="' . MojangAPI::embedImage(MojangAPI::getPlayerHead($uuid)) . '" alt="Head of MTC">';
          $uid .= ('Skin:<br>' . $img . '<br>');
        }
        else {
          $uid .= ("User is not valid");
        }
       
      $uid .="</strong></p>";
  
  
  echo $uid;
 
?>