<?php
//Create your menu here
?>
<nav>
    <div>
    	<?php if($_SESSION['role'] == "admin"): ?>
	    	<ul class="left">
				<li><a href="?page=home">home</a></li>
			</ul>
			<ul class="left">
				<li><a href="?page=producten">producten</a></li>
			</ul>
			<ul class="left">
				<li><a href="?page=bestellingen">bestellingen</a></li>
			</ul>
        <?php endif; ?>

        <?php if($_SESSION['role'] == "guest"): ?>
			<ul class="left">
				<li><a href="?page=home">home</a></li>
			</ul>
        <?php endif; ?>

        <?php if($_SESSION['role'] == "user"): ?>
        	<ul class="left">
				<li><a href="?page=home">home</a></li>
			</ul>
			<ul class="left">
				<li><a href="?page=bestellingen">mijn bestellingen</a></li>
			</ul>
		<?php endif; ?>

        <ul class="right">
            <?php if($_SESSION['role'] == "guest") { ?>
			<li>
				<a href="?page=login">login</a>
			</li>
			<li>
				<a href="?page=register">register</a>
			</li>
            <?php } else { ?>
			<li>
				<a href="?page=account">mijn profiel</a>
			</li>
			<li>
				<a href="?page=logout">logout</a>
			</li>
			<li>
				<a href="?page=shopping_cart"><i class="count fa fa-shopping-basket fa-5x icon-grey badge"></i></a>
			</li>
            <?php } ?>
        </ul>
    </div>
</nav>