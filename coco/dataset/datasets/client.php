<?php
const NOMBRE_DE_CLIENTS = 20;

//génération des clients         
$tab = [];
for ($i = 1; $i <= NOMBRE_DE_CLIENTS; $i++) {
    $cli_nom = "client $i";
    $cli_identifiant = "client$i";
    // password_hash($mot_de_passe, , PASSWORD_DEFAULT); - crypte le mot de passe $mot_de_passe
    $cli_mdp = password_hash("client$i", PASSWORD_DEFAULT);
    $cli_email = "c$i@client.fr";
    $tab[] = "(null,'$cli_nom','$cli_identifiant','$cli_mdp','$cli_email')";
}
$sql = "insert into client values " . implode(",", $tab);
mysqli_query($link, $sql);
echo "<p>génération de " . NOMBRE_DE_CLIENTS . " clients</p>";
?>