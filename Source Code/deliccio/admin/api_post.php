<?php
include ("../dbconnection.php");

     //We create our own function to submit our link
     //Certain hosts do not support the usage of "fopen"
     function ismscURL($conn){

      $http = curl_init($conn);

      curl_setopt($http, CURLOPT_RETURNTRANSFER, TRUE);
      $http_result = curl_exec($http);
      $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
      curl_close($http);

      return $http_result;
     }

     if(isset($_POST["submit"])){

      $destination = urlencode($_POST["dest"]);
      $message = $_POST["msg"];
      $message = html_entity_decode($message, ENT_QUOTES, 'utf-8'); 
      $message = urlencode($message);
      
      $username = urlencode("xxx");
      $password = urlencode("xxx");
      $sender_id = urlencode("66300");
      $type = (int)$_POST['type'];

      $fp = "https://www.isms.com.my/isms_send.php";
      $fp .= "?un=$username&pwd=$password&dstno=$destination&msg=$message&type=$type&sendid=$sender_id";
      //echo $fp;
      
      $result = ismscURL($fp);
      echo $result;
     }

     ?>
     <html>
     <head>
     <title>API Sample</title>
     <meta http-equiv="Content-Type" content="utf-8">
     </head>
     <body>
     <form method="post" action="api_post.php">
     Destination: <input name="dest" type="text"><br>
     Message: <textarea name="msg" rows="10"></textarea><br>
     Type: <input type="radio" name="type" value="1" checked> ASCII <input type="radio" name="type" value="2"> Unicode<br>
     <input type="submit" name="submit" value="Send">
     </form>
     </body>
     </html>