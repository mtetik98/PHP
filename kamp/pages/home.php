<?php
    $kampen = Kamp::find()
?>
<table>
    <tr>
        <th>Naam</th>
        <th>Eigenaar</th>
        <th>Begeleider</th>
        <th></th>
    </tr>
    <?php
        foreach($kampen as $kamp){
            $id = $kamp->getId();
            echo '<tr>';
            echo '<td>' . $kamp->getNaam() . '</td>';
            echo '<td>' . $kamp->getEigenaar()->getNaam() . '</td>';
            echo '<td>' . $kamp->getBegeleider()->getUsername() . '</td>';
            echo '<td><a' . App::link('aanmelden&id=' . $id) . '><i class="fa fa-share"></i></a></td>';
            echo '</tr>';
        }
    ?>
</table>