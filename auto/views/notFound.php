<?php ob_start();?>

<div class="container">
    <h1 class="text-center text-danger ">Page 404</h1>
        <p class="text-center ">Ah je pense que vous vous êtes perdu ! </p>
           
            <div class="text-center">
                <img src="./assets/images/404P.png" alt="" srcset="">
            </div>
            
            <?=$errorMsg;?>
</div>
<?php

    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>