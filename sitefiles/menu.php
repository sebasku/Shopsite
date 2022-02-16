<header>
    <a id="top_banner" href="<?php echo $path;?>index.php">
        <img src="<?php echo $path;?>img/banner.jpg" alt="Brak banera">
    </a>

    <div id="menu">
            <ul>
                <?php 
                    $whoen=array(1,
                                0);

                    $whopl=array('KOBIETA',
                                'MĘŻCZYZNA');

                    $category=array('shirts',
                                't-shirts',
                                'hoodies',
                                'sweaters',
                                'trousers',
                                'jeans');

                    $name=array('Koszule',
                                'T-shirty',
                                'Bluzy',
                                'Swetry',
                                'Spodnie',
                                'Jeansy');

                    for($i=0;$i<count($whopl);$i++){
                                    echo '<li><button id="dropbtn'.$i.'">'.$whopl[$i].'</button></li>';
                    }
                     
                    ?>  
            </ul>
    </div>

    <div id="rightbar">
                <ul>
                    <?php
                        if(isset($_SESSION['user']))
                            if($_SESSION['role']==="Admin" || $_SESSION['role']==="Moderator") 
                                echo '<li><a href="'.$path.'admin/adminpanel.php">PANEL</a></li>'; 
                        if(isset($_SESSION['user'])) 
                            echo '<li><a href="'.$path.'sitefiles/logout.php">WYLOGUJ</a></li>';
                        else
                            echo '<li><a href="'.$path.'usites/logreg.php">KONTO</a></li>';
                    ?>
                    <li><a href="<?php echo $path;?>usites/cart.php">KOSZYK</a></li>
                </ul>
    </div>
</header>

<?php if(isset($_SESSION['user'])) echo '<div id="menu_user"><p>Witaj</p><p><span>'.$_SESSION['user'].'</span></p></div>'; ?>

<?php          
    for($i=0;$i<count($whopl);$i++){
        echo '<div id="dropdown-content'.$i.'"><ul>';
        echo '<li><a href="'.$path.'usites/viewitems.php?isWoman='."all".'">Wszystkie przedmioty</a></li>';
        for($j=0;$j<count($category);$j++){
            echo '<li><a href="'.$path.'usites/viewitems.php?isWoman='.$whoen[$i].'&category='.$category[$j].'">'.$name[$j].'</a></li>';
        }
        echo "</ul></div>";
    }
?>        