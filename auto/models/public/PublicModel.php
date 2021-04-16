<?php

class PublicModel extends Driver{

    public function findOrdiByCat(Ordinateur $computeur){

        $sql = "SELECT * FROM ordinateur o
        INNER JOIN categorie c
        ON o.id_cat = c.id_cat
         WHERE o.id_cat=:id";
        $result = $this->getRequest($sql, ["id"=>$computeur->getCategorie()->getId_cat()]);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        $computeur = [];
        foreach($rows as $row){

            $newOrdi = new Ordinateur();

            $newOrdi->setId_ordi($row->id_ordi);
            $newOrdi->setMarque($row->marque);
            $newOrdi->setModele($row->modele);
            $newOrdi->setPrix($row->prix);
            $newOrdi->setAnnee($row->annee);
            $newOrdi->setQuantite($row->quantite);
            $newOrdi->setImage($row->image);
            $newOrdi->setDescription($row->description);
            $newOrdi->getCategorie()->setId_cat($row->id_cat);
            $newOrdi->getCategorie()->setNom_cat($row->nom_cat);

            array_push($computeur, $newOrdi);

        }
        return $computeur;
    }

    public function updateStock(Ordinateur $o){

        $sql = "UPDATE ordinateur SET quantite = :quantite WHERE id_ordi = :id";
        $result = $this->getRequest($sql, ['quantite'=>$o->getQuantite(), 'id'=>$o->getId_ordi()]);

        return $result->rowCount();

    }
}