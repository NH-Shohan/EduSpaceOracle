<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>EduSpace</title>
</head>

<body>
   <footer>
      <div class="container footer-container">
         <?php
         // Define an array of links for each page
         $links = array(
            "Courses" => "courses.php",
            "Login" => "login.php",
            "Registration" => "registration.php",
            "FAQ" => "faq.php"
         );

         // Define an array of links for each social media
         $socials = array(
            "Facebook" => "https://www.facebook.com/eduspace",
            "Twitter" => "https://www.twitter.com/eduspace",
            "Youtube" => "https://www.youtube.com/eduspace",
            "Instagram" => "https://www.instagram.com/eduspace"
         );
         ?>

         <div class="footer-col">
            <div class="footer-cls" id="for-address">
               <h3>EDUSPACE</h3>
               <address> Land View Commercial Center.
                  <br> 4th Floor, 28 Gulshan North C/A,<br>
                  Dhaka-1212
               </address>
            </div>
            <div class="footer-cls">
               <h3>SEND MESSAGE</h3>
               <p>Get in touch and discover how we can help.
                  <br> We aim to be in touch.
               </p>
               <p>(+880) 1767884923</p>
               <p>mail@eduspae.io</p>
            </div>
            <div class="footer-cls">
               <h3>PAGES</h3>
               <?php
               // Loop through each page and echo an a tag with the link
               foreach ($links as $page => $link) {
                  echo "<a href='$link'>$page</a><br>";
               }
               ?>
            </div>
            <div class="footer-cls">
               <h3>SOCIALS</h3>
               <?php
               // Loop through each social media and echo an a tag with the link
               foreach ($socials as $social => $link) {
                  echo "<a href='$link'>$social</a><br>";
               }
               ?>
            </div>
         </div>
         <hr> <br>
         <p class="end_footer">Powered by EduSpace. All rights reserved. copyright © 2023</p>
      </div>
   </footer>
</body>

</html>