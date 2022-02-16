<?php
if(isset($_SESSION['message'])){
    echo '<div id="message"';
        echo "<p>".$_SESSION['message']."</p>";
    echo "</div>";
    unset($_SESSION['message']);
} 
?>