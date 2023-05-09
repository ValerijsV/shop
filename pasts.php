<html>
   
   <head>
      <title>Sending HTML email using PHP</title>
   </head>
   
   <body>
      
      <?php
         $to = "ansis.sika@gmail.com";
         $subject = "Testa vēstule no webkursi.lv";
         
         $message = "<b>Vēstules teksts</b>";
         $message .= "<h1>Virsraksts</h1>";
         
         $header = "From:admin@webkursi.lv \r\n";
         $header .= "Cc:ansis.s@inbox.lv \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
      ?>
      
   </body>
</html>