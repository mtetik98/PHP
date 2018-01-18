<?php
//Create your menu here
?>
<nav>
    <div>
    	<?php if($_SESSION['role'] == "bestuurslid") { ?>
    	<ul class="left">
			<li><a href="?page=users">users</a></li>
		</ul>
		<ul class="left">
			<li><a href="?page=kampen">kampen</a></li>
		</ul>
		<ul class="left">
			<li><a href="?page=eigenaren">eigenaren</a></li>
		</ul>
		<ul class="left">
			<li><a href="?page=aanmeldingen">aanmeldingen</a></li>
		</ul>
        <?php }if($_SESSION['role'] == "guest") { ?>
		<ul class="left">
			<li><a href="?page=home">home</a></li>
		</ul>
        <?php } ?>
        <ul class="right">
            <?php if($_SESSION['role'] == "guest") { ?>
			<li>
				<a href="?page=login">login</a>
			</li>
			<!--<li>
				<a href="?page=register">register</a>
			</li>-->
            <?php } else { ?>
			<li>
				<a href="?page=account">mijn profiel</a>
			</li>
			<li>
				<a href="?page=logout">logout</a>
			</li>
            <?php } ?>
        </ul>
    </div>
</nav>