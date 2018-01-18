<?php
  $users = User::find();

  if(isset($_POST['role'])){
    User::change($_GET['id'], htmlspecialchars($_POST['email']), htmlspecialchars($_POST['username']), htmlspecialchars($_POST['role']));
  }
?>
<a href="?page=newuser"><p class="new">Nieuwe user toevoegen <i class="fa fa-plus-circle"></i></p></a>
<table>
  <thead>
    <tr>
    	<th>Email</th>
      <th>Username</th>
      <th>Role</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($users as $user) { 
        $id = $user->getId();?>
        <tr>
        	<td><?= $user->getEmail(); ?></td>
          <td><?= $user->getUsername(); ?></td>
        	<td><?= $user->getRole(); ?></td>
          <td><a <?= App::link("users&id=".$id);?> class="fa fa-edit"></i></td>
          <td><a href=?page=delete&id=<?= $id ?>><li class="fa fa-remove"></li></a></td>
        </tr>
    <?php } ?>
  </tbody>
</table>
<?php 
  if(isset($_GET['id'])){
    $change = User::findById($_GET['id']);
    echo App::formPopup("Wijzigen", $change->getChangeForm());
  }
?>