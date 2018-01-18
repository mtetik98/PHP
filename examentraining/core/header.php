<?php
//Create your menu here
?>
<nav>
    <div>
        <?php if($_SESSION['role'] == "user") { ?>
            <ul class="left">
                <li><a href="?page=home">home</a></li>
                <li><a href="?page=overzicht">overzicht</a></li>
            </ul>
        <?php }if($_SESSION['role'] == "admin") { ?>
            <ul class="left">
                <li><a href="?page=home">home</a></li>
                <li><a href="?page=alle_laptops">alle laptops</a></li>
            </ul>
        <?php } ?>
        <ul class="right">
            <?php if($_SESSION['role'] == "guest") { ?>
                <li><a href="?page=login">login</a></li>
                <li><a href="?page=register">register</a></li>
            <?php } else { ?>
                <li><a href="?page=account">account</a></li>
                <li><a href="?page=logout">logout</a></li>
            <?php } ?>
        </ul>
    </div>
</nav>