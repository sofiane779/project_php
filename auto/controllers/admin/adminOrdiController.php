<?php

class adminOrdiController{

    private $adom;

    public function __construct()
    {
        $this->adom = new adminOrdiModel();
        $this->adcat = new AdminCategorieModel();
    }

    public function listOrdinateurs(){
        AuthController::isLogged();
        //var_dump($_POST);
        if(isset($_POST['soumis']) && !empty($_POST['search'])){
            $search = trim(htmlspecialchars(addslashes($_POST['search'])));
            $computeurs = $this->adom->getOrdinateurs($search);
            require_once('./views/admin/ordinateur/adminOrdiItems.php');
  
        }else{
            $computeurs = $this->adom->getOrdinateurs();
            require_once('./views/admin/ordinateur/adminOrdiItems.php');
        }
        
    }

    public function addOrdinateurs(){
        AuthController::isLogged();

        if(isset($_POST['soumis']) && !empty($_POST['marque']) && !empty($_POST['prix'])){
            $marque = trim(htmlentities(addslashes($_POST['marque'])));
            $modele = trim(htmlentities(addslashes($_POST['modele'])));
            $prix = trim(htmlentities(addslashes($_POST['prix'])));
            $quantite = trim(htmlentities(addslashes($_POST['quantite'])));
            $annee = trim(htmlentities(addslashes($_POST['annee'])));
            $id_cat = trim(htmlentities(addslashes($_POST['cat'])));
            $description = trim(htmlentities(addslashes($_POST['desc'])));
            $image = $_FILES['image']['name'];

            $newO = new Ordinateur();
            $newO->setMarque($marque);
            $newO->setModele($modele);
            $newO->setPrix($prix);
            $newO->setQuantite($quantite);
            $newO->setAnnee($annee);
            $newO->getCategorie()->setId_cat($id_cat);
            $newO->setDescription($description);
            $newO->setImage($image);

            $destination = './assets/images/';
            move_uploaded_file($_FILES['image']['tmp_name'],$destination.$image);
            $ok = $this->adom->insertOrdinateur($newO); 
            if($ok){
                header('location:index.php?action=list_ordi');
            }
        }
        //affichage du formulaire
       $tabCat = $this->adcat->getCategories();
        require_once('./views/admin/ordinateur/adminAddOrdi.php');
    }

    public function removeOrdinateur(){
        AuthController::isLogged();
        AuthController::accessUser();
       if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)){
           $id = $_GET['id'];
           $delV = new Ordinateur();
           $delV->setId_ordi($id);
           $nb = $this->adom->deleteOrdinateur($delV);

           if($nb > 0){
               header('location:index.php?action=list_ordi');
           }
           
       } 
    }

    public function editOrdinateur(){
        
        AuthController::isLogged();
        if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)){
            $id = $_GET['id'];
            $editO = new Ordinateur();
            $editO->setId_ordi($id);
            $editOrd = $this->adom->ordinateurItem($editO);
            
           $tabCat = $this->adcat->getCategories();
           
           if(isset($_POST['soumis']) && !empty($_POST['marque']) && !empty($_POST['prix'])){
               
               $marque = trim(htmlentities(addslashes($_POST['marque'])));
               $modele = trim(htmlentities(addslashes($_POST['modele'])));
               $prix = trim(htmlentities(addslashes($_POST['prix'])));
               $quantite = trim(htmlentities(addslashes($_POST['quantite'])));
               $annee = trim(htmlentities(addslashes($_POST['annee'])));
               $id_cat = trim(htmlentities(addslashes($_POST['cat'])));
               $description = trim(htmlentities(addslashes($_POST['desc'])));
               $image = $_FILES['image']['name'];
               
               $editOrd->setMarque($marque);
               $editOrd->setModele($modele);
               $editOrd->setPrix($prix);
               $editOrd->setQuantite($quantite);
               $editOrd->setAnnee($annee);
               $editOrd->getCategorie()->setId_cat($id_cat);
               $editOrd->setDescription($description);
               $editOrd->setImage($image);
               
               $destination = './assets/images/';
               move_uploaded_file($_FILES['image']['tmp_name'],$destination.$image);
               $ok = $this->adom->updateOrdinateur($editOrd); 
               //if($ok > 0){
                   header('location:index.php?action=list_ordi');
                //}
            }
            require_once('./views/admin/ordinateur/adminEditOrdi.php');
        }
    }
}