<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vente d'Ordinateur</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/templatePublic.css">

</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white ">
        <div class="container-fluid">
          <a class="navbar-brand m-3 p-3" href="index.php">High-Tech </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active m-3 p-3" aria-current="page" href="index.php">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link m-3 p-3" href="index.php?action=apropos">A propos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link m-3 p-3" href="index.php?action=contact">Contact</a>
              </li>
            
             
            </ul>
            
          </div>
        </div>
      </nav>
</header>
<main class="m-3">
    <?=$contenu;?>
</main>
<footer id="footer">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white p-5">
        <div class="container-fluid">
          <a class="navbar-brand px-5" href="#">High-Tech</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active " aria-current="page" href="#">Accueil</a>
              </li>
              <li class="nav-item px-5"> <a class="nav-link active" href="">Condition générale</a></li>
              <li class="nav-item px-5"><a class="nav-link active" href="">Politique de confidentialité</a></li>
              <li class="nav-item px-5"><a class="nav-link active" href="">faq</a></li>
              
            </ul>
            <div class="">
            <i class="text-center p-5">Copyright</i> <i class="fa fa-copyright" aria-hidden="true"> 2021</i> 
            </div>
            
            <input type="text-right" placeholder="Notre newsletter..."><button class="btn btn-secondary m-1">Envoyer</button>
            
        </div>
        </div>
      </nav>
</footer >
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="./assets/js/scriptStripe.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>