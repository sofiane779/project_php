<?php ob_start();?>

<div class="container text-center">
<h2 class="m-5">Confirmation de commande</h2>
<p class="text-primary">Merci pour votre achat !</p> 

<div class="text-center m-5">
    <img src="./assets/images/genial.jpg" alt="" width="800">
</div>
</div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>