<?php
    if(!isset($_GET['categorie'])){
        $getList = Product::find();
    }else{
        $getList = Product::findBy('categorie', $_GET['categorie']);
    }

    if(isset($_GET['add_product_id'])){
        $addProduct = $_GET['add_product_id'];
    }
    $categorie = Categorie::find();

    if(isset($_SESSION['cartt'])){
        $count = count($_SESSION['cartt']);
    }
    if(isset($_GET['purchase'])){
        App::addError('Bedankt, uw bestelling is geplaatst');
    }
?>
<style>
    .badge:after{
        content: '<?= $count; ?>';
    }
</style>
<div id="categorie">
    <h4>Kies een categorie</h4>
    <br/><br>
    <?php foreach($categorie as $categorieen){ ?>
        <a <?= App::link('home&categorie='.$categorieen->getId()) ?>><h5><?= $categorieen->getNaam(); ?></h5></a>
    <?php } ?>
</div>
<div class="container">
    <div id="productPage">
        <div class="popup">
            <div class="header">
                <li class="close fa fa-remove" onclick="document.getElementById('productPage').style.display = 'none';blurOff();"></li>
            </div>
            <h5 style="text-align: center;border-bottom: dashed 1px black;">Aan winkelmand toevoegen</h5>
            <?php
                if(isset($addProduct)){
                    $prod = Product::findById($addProduct);
                    $prodNaam = $prod->getNaam();
                    $prodOmschrijving = $prod->getOmschrijving();
                    $prodPrijs = $prod->getPrijs();
                };
            ?>
            <table id="winkelmand">
                <tr>
                    <th>Product</th>
                    <th>Omschrijving</th>
                    <th>Prijs</th>
                    <th>Aantal</th>
                </tr>
                <tr>
                    <td><?= $prodNaam; ?></td>
                    <td style="max-width: 100px;"><?= $prodOmschrijving; ?></td>
                    <td>&euro; <?= $prodPrijs; ?></td>
                    <td>1</td>
                </tr>
            </table>
            <a <?= App::link('cart&add_product_id=' . $addProduct); ?>><button class="addCart">Toevoegen aan winkelmand</button></a>
        </div>
    </div>
    <?php foreach($getList as $producten){ ?>
        <div id="item<?= $producten->getId(); ?>" class="item">
            <?= $producten->getNaam(); ?>
            <br/>
            <?= $producten->getOmschrijving(); ?>
            <br/>
            <a <?= App::link('home&add_product_id=' . $producten->getId()); ?>>
                <button style="display: inline-block;" class="btn-purchase" id="button-purchase<?= $producten->getId(); ?>" value="<?= $producten->getPrijs(); ?>">
                    &euro; <?= $producten->getPrijs(); ?>
                </button>
            </a>
        </div>
    <?php } ?>
</div>
<script>
    $('[id^="button-purchase"]').hover(function(){
        var id = $(this).attr('id').replace(/button-purchase/g, '');
        $('#button-purchase'+id).css('height', '198px');
        $('#button-purchase'+id).css('top', '-2px');
        $('#button-purchase'+id).css('opacity', '0.9');
        $('#button-purchase'+id).html('<li class="icon fa fa-shopping-basket"></li><br><br/>Toevoegen aan winkelmand');
    });

    $('[id^="button-purchase"]').mouseout(function(){
        var id = $(this).attr('id').replace(/button-purchase/g, '');
        var prijs = $('#button-purchase'+id).attr('value');
        $('#button-purchase'+id).css('height', '40px');
        $('#button-purchase'+id).css('top', '156px');
        $('#button-purchase'+id).css('opacity', '1');
        $('#button-purchase'+id).html('&euro; '+prijs);
    });

    function blurAll(){
        $('.item').css('filter','blur(2px)');
        $('body').css('backgroundColor','rgba(0,0,0,0.3)');
        $('#categorie').css('filter', 'blur(2px)');
    }

    function blurOff(){
        $('.item').css('filter','blur(0px)');
        $('body').css('backgroundColor','rgba(0,0,0,0)');        
        $('#categorie').css('filter', 'blur(0px)');
    }
</script>
<?php
    if(isset($_GET['add_product_id'])){
        if(App::getUser()){
            echo '<script>document.getElementById("productPage").style.display = "block";blurAll();</script>';
        }else{
            App::addError('U moet eerst inloggen');
        }
    }
?>