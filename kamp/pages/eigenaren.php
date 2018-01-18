<?php
	$eigenaren = Eigenaar::find();

  	if (isset($_POST['naam'])) {
    	Eigenaar::change($_GET['Eid'], htmlspecialchars($_POST['naam']), $_POST['email'], $_POST['telefoon']);
  	}
?>
<a href="?page=neweigenaar"><p class="new">Nieuwe eigenaar toevoegen <i class="fa fa-plus-circle"></i></p></a>
<table>
    <thead>
      	<tr>
	      	<th>ID</th>
	      	<th>Naam</th>
	      	<th>Email</th>
	        <th>Telefoon</th>
	        <th></th>
	      	<th></th>
      	</tr>
    </thead>
    <tbody>
      <?php
        foreach ($eigenaren as $eigenaar) { 
          $id = $eigenaar->getId();?>
	        <tr>
	        	<td><?= $eigenaar->getId(); ?></td>
	        	<td><?= $eigenaar->getNaam(); ?></td>
	            <td><?= $eigenaar->getEmail(); ?></td>
	            <td><?= $eigenaar->getTelefoon(); ?></td>
	            <td><a <?= App::link("eigenaren&Eid=".$id);?> class="fa fa-edit"></i></td>
	            <td><a href=?page=delete&Eid=<?= $id ?>><li class="fa fa-remove"></li></a></td>
	        </tr>
	    <?php } ?>
    </tbody>
</table>
<?php if(isset($_GET['Eid'])){
    $change = Eigenaar::findById($_GET['Eid']);
    echo App::formPopup("Wijzigen", $change->getChangeForm());
} ?>