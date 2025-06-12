<?php
    if (isset($_POST['logout'])){
        session_unset();
    }
?>
<header>
    <div>
        
    </div>
    <div>     
        <a href="index.php" target="_self"><img src="images/svg/logo2.png"  alt="My Game Tracker Logo"></a>
    </div>
    <div>
        <?php
            if (isset($_SESSION['logged'])){
        ?>
    
        <form action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
            <input type="submit" name="logout" value="Log-Out">
        </form>
    
        <?php
            }
        ?>
    
        <a href="login-registration.php" target="_self"><i class="fa-solid fa-user"></i></a>
    </div>
</header>