<?php
$result='';
ob_start();
?>
<div class="subscribe">
          <h2> SUBSCRIBE <span class="triangle-bottomright"> </span> </h2>
          <div class="social"> 
          
          <a href="https://www.facebook.com/pages/Hotel-Peninsula/465434183525835?ref=br_tf" target="_blank"><i class="fa fa-facebook"> </i> </a>
          <a href="https://www.youtube.com/watch?v=UmxYhiyVLJ0" target="_blank"><i class="fa fa-youtube"> </i> </a>
       <!--   <a href="#"><i class="fa fa-dribbble"> </i> </a>
          <a href="#"><i class="fa fa-rss"> </i></a>--> </div>
        </div>

<?php 
$result = ob_get_clean();
$jVars['module:socialmedia_block']= $result;
?>
