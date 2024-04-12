<?php
session_start();
unset($_SESSION["user"]);
echo ("До скорых встреч!");
echo '<meta http-equiv="refresh" content="3, URL=home1.php" > ';



?>