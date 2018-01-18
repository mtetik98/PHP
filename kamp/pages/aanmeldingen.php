<?php
	$aanmeldingen = Aanmelding::find();
?>
<table>
	<tr>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
	</tr>
	<?php
		foreach($aanmeldingen as $aanmelding){
	?>
	<tr>
		<td><?= $aanmelding->getVoornaam(); ?></td>
		<td><?= $aanmelding->getAchternaam(); ?></td>
		<td><?= $aanmelding->getLeeftijd(); ?></td>
		<td><?= $aanmelding->getKampId(); ?></td>
	</tr>
	<?php } ?>
</table>