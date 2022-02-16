<?php 
if(count($errors)>0){
    echo '<div id="errors_messages"';
    foreach ($errors as $error) 
        echo "<p>".$error."</p>";
    echo "</div>";
} 
?>