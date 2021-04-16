
<?php ob_start(); ?>
<h1 class="display-6 text-center font-monospace text-decoration-underline">Liste Ordinateurs</h1>
 <div class="row">
     <div class="col-4 offset-8">
     <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="input-group">
        <input class="form-control text-center" type="search" name="search" id="search" placeholder="Rechecher...">
        <button type="submit" class="btn btn-outline-secondary" name="soumis"><i class="fas fa-search"></i></button>
     </form>
     </div>
 </div>
  <table class="table table-striped">
      <thead>
          <tr>
              <th>Id</th>
              <th>Marque</th>
              <th>Modele</th>
              <th>Prix</th>
              <th>Image</th>
              <th>Quantite</th>
              <th>Année</th>
              <th>Description</th>
              <th>Categorie</th>
              <th colspan="2" class="text-center">Actions</th>
          </tr>
      </thead>
      <tbody>
          
          <tr>
          <?php if(is_array($computeurs)){ foreach ($computeurs as  $computeur) { ?>
              <td><?=$computeur->getId_ordi();?></td>
              <td><?=$computeur->getMarque();?></td>
              <td><?=$computeur->getModele();?></td>
              <td><?=$computeur->getPrix();?></td>
              <td><img src="./assets/images/<?=$computeur->getImage();?>" alt="" width="100"></td>
              <td><?=$computeur->getQuantite();?></td>
              <td><?=$computeur->getAnnee();?></td>
              <td ><?=$computeur->getDescription();?></td>
              <td><?=$computeur->getCategorie()->getNom_cat();?></td>
              <td class="text-center">
                <a class="btn btn-warning" href="index.php?action=edit_ordi&id=<?=$computeur->getId_ordi();?>">
                    <i class="fas fa-pen"></i>
                </a>
              </td>
              
              <td  class="text-center">
                <a class="btn btn-danger" href="index.php?action=delete_ordi&id=<?=$computeur->getId_ordi();?>"
                    onclick="return confirm('Etes vous sûr de ...')">
                    <i class="fas fa-trash"></i>
                </a>
              </td>
              
          </tr>
          <?php }}else{ echo"<tr class='text-center text-danger'><td colspan='10' >".$computeurs."</td></tr>";} ?>
      </tbody>
  </table>
<?php 
    $contenu = ob_get_clean();
    require_once('./templateAdmin.php');
?>
