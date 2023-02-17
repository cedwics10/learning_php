<?php
//affiche la liste des villes dans des balises <option>
//$id_selected : id de la ville pré-sélectionnée dans la liste
function OPTION_ville($id_selected) {
    global $link;

    $sql="select * from ville order by vi_nom";
    //exécute la requête et retourne un objet PDOStatment
    $stmt=$link->query($sql);
    $data=$stmt->fetchAll();
    foreach($data as $num => $ligne) {
        extract($ligne);
        $sel=($id_selected==$vi_id) ? "selected" : "";
        echo "<option $sel value='$vi_id'>$vi_nom</option>";
    }
}

function OPTION_avion($id_selected) {
    global $link;

    $sql="select * from avion order by av_id";
    $result=$link->query($sql);
    $data=$result->fetch_all(MYSQLI_ASSOC);
    foreach($data as $num => $ligne) {
        extract($ligne);
        $sel=($id_selected==$av_id) ? "selected" : "";
        echo "<option $sel value='$av_id'>$av_id - $av_const - $av_modele</option>";
    }
}

function OPTION_pilote($id_selected) {
    global $link;

    $sql="select * from pilote order by pi_id";
    $result=$link->query($sql);
    $data=$result->fetch_all(MYSQLI_ASSOC);
    foreach($data as $num => $ligne) {
        extract($ligne);
        $sel=($id_selected==$pi_id) ? "selected" : "";
        echo "<option $sel value='$pi_id'>$pi_nom</option>";
    }
}


function mhe($chaine) {
    return htmlentities($chaine,ENT_QUOTES,"UTF-8");
}
