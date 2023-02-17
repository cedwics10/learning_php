-- 1. Nombre de pilotes différents pour chaque avion en service
select vo_avion,count( distinct vo_pilote) from vol group by vo_avion;
-- 2. Nombre de vols différents pour chaque pilote ordonné par le nombre de vol, puis le nom des pilotes.
select pi_nom,count(distinct vo_id) nbvol 
from vol, pilote
where vo_pilote=pi_id
group by vo_pilote 
order by nbvol, pi_nom;
-- 2bis. Nombre de vols différents pour chaque pilote (avec jointure gauche).
select pi_nom,count(distinct vo_id) nbvol 
from pilote left join vol
on vo_pilote=pi_id
group by vo_pilote 
order by nbvol, pi_nom;
-- 3. Pilotes (ordre croissant des numéros) assurant plus d’un vol (Afficher: Numéro et nom des pilotes,  nombre de vols)
-- 4. Nombre de vols assurés au départ de Nice ou de Paris par chaque pilote (Afficher: Numéros des pilotes, nombre de vols)
-- 5. Nombre de vols assurés au départ ou à l'arrivée de Nice par chaque pilote (Afficher: Numéros des pilotes,  nombre de vols)
-- 7. Liste des avions de capacité égale ou supérieure à la moyenne (requêtes imbriquées)
-- 8. Capacité mini et maxi des BOEING
-- 9. Capacité moyenne des avions localisés à Paris avec 2 chiffres après la virgule
-- 10. Capacité moyenne des avions par modele
-- 11. Capacité totale des avions de la table avion
