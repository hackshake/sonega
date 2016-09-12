<html>
   
   <head>
      <title>Sending HTML email using PHP</title>
   </head>
   
   <body>
      
      <?php
      $fname="Shashwat";$lname="Shukla";
         $to = "shashwatshukla.2013@vit.ac.in";
         $subject = "Online Game Scheduler-Email Validation";
         $message .="<h1>Online Game Scheduler</h1>";
         $message .= "<p>Hello $fname&nbsp$lname! Thank you for registering for Online Game Scheduler";
         $message .="Please copy the following link to your browser window in order to activate your account.";
         $message .="mytestmailer.netne.net/game_scheduler/gamehome.php";
         $header = "From:Online Game Scheduler \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
            echo "$retval";
         }
      ?>
      
   </body>
</html>