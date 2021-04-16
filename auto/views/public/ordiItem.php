<?php ob_start();?>

<div class="container mt-3" id="loli">
<div class="row ">
<div class="col-8">
<div class="card mb-3" >
  <div class="row g-0">
    <div class="col-md-4">
      <img src="./assets/images/<?=$image;?>" alt="..." width="500">
    </div>
    <div class="col-md-4 ">
      <div class="card-body ">
        <h5 class="card-title text-end"><?=$marque;?>-<?=$modele;?></h5>
        <p class="card-text text-end text-danger"> <?=$prix;?> €</p>
      </div>
    </div>
  </div>
</div>
</div>
<div class="col-3">
<h4 class="text-center">Validation</h4>
  <form action="" method="¨POST" class="mb-3">
  <label for="email" >Email*</label>
  <input type="email" id="email" class="form-control">
  <label for="quant" >Quantité*</label>
  <input type="number" id="quant" class="form-control" min="1" value="1" max="<?=$nb;?>">
  <input type="hidden" id="ref" value="<?=$id;?>">
  <input type="hidden" id="modele" value="<?=$modele;?>">
  <input type="hidden" id="marque" value="<?=$marque;?>">
  <input type="hidden" id="prix" value="<?=$prix;?>">
  <input type="hidden" id="nb" value="<?=$nb;?>">
 
  <button id="checkout-button" class="btn btn-success col-12 mt-3">Valider</button>
  </form>
</div>
</div>
</div>

<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>