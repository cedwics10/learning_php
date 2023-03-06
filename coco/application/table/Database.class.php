<?php
class Database
{

    static public function creer(string $sqlfile): string
    {
        $sql = file_get_contents($sqlfile);
        Table::$link->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
        Table::$link->exec($sql);
        return $sql;
    }

    static public function dataset()
    {        
        $message="";

        $nbu = 9;
        $o=new Utilisateur();
        $row=[];
        $row["uti_id"]=0;
        for($i=0; $i<$nbu; $i++) {
            $row["uti_nom"]="nom$i";
            $row["uti_prenom"]="prenom$i";
            $row["uti_email"]="email$i@user";
            $row["uti_mdp"]=password_hash("mdp",PASSWORD_DEFAULT);
            $row["uti_profil"]="client";
            $o->save($row);
        }

        $row["uti_nom"]="admin";
        $row["uti_prenom"]="admin";
        $row["uti_email"]="admin@user";
        $row["uti_mdp"]=password_hash("mdp",PASSWORD_DEFAULT);
        $row["uti_profil"]="admin";
        $o->save($row);

        $message .= "<p>Génération de $nbu utilisateurs + 1 admin</p>";    

        $o = new Voyage();
        $nbv=50;
        $row = [];
        $row["voy_id"] = 0;
        for ($i = 1; $i <= $nbv; $i++) {
            $ts=mktime(mt_rand(0,23),0,0,mt_rand(1,12),mt_rand(1,31),2022);
            $row["voy_debut"]=date("Y-m-d H:i:s",$ts);
            $row["voy_fin"]=date("Y-m-d H:i:s",$ts+mt_rand(3,10)*24*60*60);
            $row["voy_pays"]=mt_rand(1,241);
            $row["voy_prix"]=mt_rand(300,3500);
            $o->save($row);
        }
        $message .= "<p>Génération des voyages</p>";

        $c=new Commande();
        $row["com_id"]=0;
        for($i=1; $i<=$nbu;$i++) {
            $row["com_utilisateur"]=$i;
            $row["com_voyage"]=mt_rand(1,$nbv);
            $row["com_quantite"]=mt_rand(1,4);
            $c->save($row);
        }

        $message .= "<p>Génération des commandes</p>";

        return $message;
    }
}
