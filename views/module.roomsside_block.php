<?php
$result='';
ob_start();
?>

<div class="our-rooms">
          <h2> Our Rooms <span class="triangle-bottomright"> </span> </h2>
          <ul>
            <li> <a href="pkgdetails5-deluxe+room+with+balcony"> Deluxe Room with Balcony </a> </li>
            <li> <a href="pkgdetails9-super+deluxe+room"> Super Deluxe Room </a> </li>
            <li> <a href="pkgdetails10-honeymoon+super+deluxe"> Honeymoon Super Deluxe </a> </li>
          </ul>
        </div>

<?php 
$result = ob_get_clean();
$jVars['module:roomsside_block']= $result;
?>
