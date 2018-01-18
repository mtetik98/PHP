<?php
    echo Laptop::createForm()->getHTML();
    if(isset($_POST['merk'])){
        $_POST['user'] = App::getUser()->getId();
        $_POST['ssd'] = isset($_POST['ssd']) ? 1 : 0;
        Laptop::saveTableRow($_POST);
    }

    //$laptops = App::getUser()->getLaptops();
    $laptops = Laptop::find();
?>
    <style>
        table{
            border-collapse: collapse;
            float: right;
            width: 50%;
            margin-right: 15%;
            margin-top: -25%;
        }

        th, td{
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even){background-color: #f2f2f2}
    </style>

    <table border="0">
        <tr style="background-color: lightblue;">
            <th>Merk</th>
            <th>Cores</th>
            <th>Kloksnelheid</th>
            <th>Geheugen</th>
            <th>Schermgrootte</th>
            <th>Opslag</th>
            <th>SSD</th>
            <th>Eigenaar</th>
        </tr>
        <?php foreach($laptops as $laptop){ ?>
            <tr>
                <td><?= $laptop->getMerk(); ?></td>
                <td><?= $laptop->getCores(); ?></td>
                <td><?= $laptop->getKloksnelheid(); ?></td>
                <td><?= $laptop->getGeheugen(); ?></td>
                <td><?= $laptop->getSchermgrootte(); ?></td>
                <td><?= $laptop->getOpslag(); ?></td>
                <td><?= $laptop->getSSD() ? "Ja" : "Nee"; ?></td>
                <td><?= $laptop->getUser()->getUsername(); ?></td>
            </tr>
        <?php } ?>
    </table>