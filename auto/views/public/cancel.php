<?php ob_start();?>

<div class="container">
<h2>Echec du réglement</h2>
<p>Vérifiez vos coordonnées bancaires </p>


</div>
<?php

    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>