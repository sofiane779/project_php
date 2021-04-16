<?php

class adminOrdiModel extends Driver{

    public function getOrdinateurs($search = null){

        if(!empty($search)){
            $sql = "SELECT * 
                    FROM ordinateur o
                    INNER JOIN categorie c
                    ON o.id_cat = c.id_cat
                    WHERE marque LIKE :marque OR modele LIKE :modele OR nom_cat LIKE :nom_cat
                    ORDER BY id_ordi ";
            $searchParams = ["marque"=>"$search%", "modele"=>"$search%", "nom_cat"=>"$search%"];
            $result = $this->getRequest($sql, $searchParams);
            //$voitures = $result->fetchAll(PDO::FETCH_OBJ);

        }else{
            $sql = "SELECT * 
                    FROM ordinateur o
                    INNER JOIN categorie c
                    ON o.id_cat = c.id_cat
                    ORDER BY id_ordi";
            $result = $this->getRequest($sql);
        }
       
        $ordinateurs = $result->fetchAll(PDO::FETCH_OBJ);

        $datas = [];
        //$cat = new Categorie();

        foreach ($ordinateurs as $ordinateur) {

            $o = new Ordinateur();
            $o->setId_ordi($ordinateur->id_ordi);
            $o->setMarque($ordinateur->marque);
            $o->setModele($ordinateur->modele);
            $o->setImage($ordinateur->image);
            $o->setPrix($ordinateur->prix);
            $o->setQuantite($ordinateur->quantite);
            $o->setAnnee($ordinateur->annee);
            $o->setDescription($ordinateur->description);
            $o->getCategorie()->setId_cat($ordinateur->id_cat);
            $o->getCategorie()->setNom_cat($ordinateur->nom_cat);
            array_push($datas, $o);

        }
        if($result->rowCount() > 0){
            return $datas;
        }else{
            return "No record ...";
        }
    }

    
    public function insertOrdinateur(Ordinateur $ordinateur){

        $sql = "INSERT INTO ordinateur(marque, modele, prix, annee, quantite, image, description, id_cat)
                VALUES(:marque, :modele, :prix, :annee, :quantite, :image, :descr, :id_cat)";
        
        $tabParams = ["marque"=>$ordinateur->getMarque(),"modele"=>$ordinateur->getModele(), "prix"=>$ordinateur->getPrix(), "annee"=>$ordinateur->getAnnee(), "quantite"=>$ordinateur->getQuantite(), "image"=>$ordinateur->getImage(), "descr"=>$ordinateur->getDescription(), "id_cat"=>$ordinateur->getCategorie()->getId_cat()]; 

        $result= $this->getRequest($sql, $tabParams);
        
        return $result;
    }

    public function deleteOrdinateur(Ordinateur $ordinateur){

        $sql = "DELETE FROM ordinateur WHERE id_ordi = :id";
        $result = $this->getRequest($sql, ['id'=>$ordinateur->getId_ordi()]);

        return $result->rowCount();
    }

    public function ordinateurItem(Ordinateur $oParam){

        $sql = "SELECT * FROM ordinateur WHERE id_ordi = :id";
        $result = $this->getRequest($sql, ['id'=>$oParam->getId_ordi()]);
        
        if($result->rowCount() > 0){

            $ordiRow = $result->fetch(PDO::FETCH_OBJ);
            $editOrdi = new Ordinateur();
            $editOrdi->setId_ordi($ordiRow->id_ordi);
            $editOrdi->setMarque($ordiRow->marque);
            $editOrdi->setModele($ordiRow->modele);
            $editOrdi->setPrix($ordiRow->prix);
            $editOrdi->setQuantite($ordiRow->quantite);
            $editOrdi->setAnnee($ordiRow->annee);
            $editOrdi->setImage($ordiRow->image);
            $editOrdi->setDescription($ordiRow->description);
            $editOrdi->getCategorie()->setId_cat($ordiRow->id_cat);

            return $editOrdi;
        }

    }

    public function updateOrdinateur(Ordinateur $updateO){
        if($updateO->getImage() === ""){
            $sql = "UPDATE ordinateur
                SET marque = :marque, modele = :modele, prix = :prix, annee = :annee, quantite = :quantite, description = :description, id_cat = :id_cat
                WHERE id_ordi = :id_ordi";
                
          $tabParams = ["marque"=>$updateO->getMarque(),"modele"=>$updateO->getModele(), "prix"=>$updateO->getPrix(), "annee"=>$updateO->getAnnee(), "quantite"=>$updateO->getQuantite(), "description"=>$updateO->getDescription(), "id_cat"=>$updateO->getCategorie()->getId_cat(), "id_ordi"=>$updateO->getId_ordi()];

        }else{

            $sql = "UPDATE ordinateur
                    SET marque = :marque, modele = :modele, prix = :prix, annee = :annee, quantite = :quantite, image = :image, description = :description, id_cat = :id_cat
                    WHERE id_ordi = :id_ordi";
                    
              $tabParams = ["marque"=>$updateO->getMarque(),"modele"=>$updateO->getModele(), "prix"=>$updateO->getPrix(), "annee"=>$updateO->getAnnee(), "quantite"=>$updateO->getQuantite(), "image"=>$updateO->getImage(), "description"=>$updateO->getDescription(), "id_cat"=>$updateO->getCategorie()->getId_cat(), "id_ordi"=>$updateO->getId_ordi()];
        }

          $result = $this->getRequest($sql, $tabParams);

         return $result->rowCount();
    }
}