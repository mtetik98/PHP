<?php
  $kampen = Kamp::find();

  if (isset($_POST['naam'])) {
    Kamp::change($_GET['Kid'], htmlspecialchars($_POST['naam']), $_POST['datumVan'], $_POST['datumTot'], $_POST['maxAantal'], 
      $_POST['begeleider']);
  }
?>
<a href="?page=newkamp"><p class="new">Nieuwe kamp toevoegen <i class="fa fa-plus-circle"></i></p></a>
<table>
    <thead>
      <tr>
      	<th>ID</th>
      	<th>Naam</th>
      	<th>Datum Van</th>
        <th>Datum Tot</th>
        <th>Max aantal</th>
        <th>Begeleider(s)</th>
        <th>Eigenaar</th>
        <th></th>
      	<th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach ($kampen as $kamp) { 
          $id = $kamp->getId();?>
	        <tr>
        	<td><?= $kamp->getId(); ?></td>
        	<td><?= $kamp->getNaam(); ?></td>
            <td><?= $kamp->getDatumVan(); ?></td>
            <td><?= $kamp->getDatumTot(); ?></td>
            <td><?= $kamp->getMaxAantal(); ?></td>
            <td><?= $kamp->getBegeleider()->getUsername(); ?></td>
            <td><?= $kamp->getEigenaar()->getNaam(); ?></td>
            <td><a <?= App::link("kampen&Kid=".$id);?> class="fa fa-edit"></i></td>
            <td><a href=?page=delete&Kid=<?= $id ?>><li class="fa fa-remove"></li></a></td>
	        </tr>
	    <?php } ?>
    </tbody>
</table>
<?php if(isset($_GET['Kid'])){
    $change = Kamp::findById($_GET['Kid']);
    echo App::formPopup("Wijzigen", $change->getChangeForm());
} ?>