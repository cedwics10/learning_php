-- cours en ligne sur le langage SQL : http://sql.sh/cours

-- 1. liste de tous les numéros d’avions
select av_id from avion ;
-- 2. Liste des noms des pilotes
SELECT  pi_nom FROM pilote;
-- 3. Liste des constructeurs d’avions
SELECT av_const FROM avion;
-- 4. Liste des vols pour Nice
SELECT vo_id, vi_nom FROM vol,ville WHERE vo_site_arrivee = vi_id AND vi_nom = 'Nice';
-- 5. Liste des avions qui ont plus de 200 places
SELECT av_id,av_modele FROM avion WHERE av_capacite >= 200;
-- 6. Liste des avions AIRBUS localisés à Toulouse
SELECT av_id, av_modele, vi_nom 
FROM avion, ville 
WHERE av_site = vi_id AND av_const='Airbus' AND vi_nom = 'Toulouse';
-- 7. Liste des avions AIRBUS allant à Paris
SELECT vo_id, av_id, av_modele, av_const, vi_nom
FROM avion, ville, vol 
WHERE vo_site_arrivee = vi_id AND vo_avion = av_id AND av_const='Airbus' AND vi_nom = 'Paris';
-- 8bis. Liste des vols Paris-Nice
select vo_id, depart.vi_nom "ville départ",arrivee.vi_nom "ville arrivée" 
from vol,ville depart,ville arrivee 
where vo_site_depart=depart.vi_id and vo_site_arrivee=arrivee.vi_id 
and depart.vi_nom="Paris" and arrivee.vi_nom="Nice";

-- 8. Liste des vols Paris-Nice et Toulouse-Paris
select vo_id, depart.vi_nom "ville départ",arrivee.vi_nom "ville arrivée" 
from vol,ville depart,ville arrivee 
where vo_site_depart=depart.vi_id and vo_site_arrivee=arrivee.vi_id 
and ( 
    (depart.vi_nom="Paris" and arrivee.vi_nom="Nice") 
    or 
    (depart.vi_nom="Toulouse" and arrivee.vi_nom="Paris") 
);

-- 9. Liste des avions Airbus et Boeing
   
-- 10.  Liste des Airbus ou des avions de plus de 200 places
    
-- 11. Liste des avions AIRBUS qui ne sont pas localisés à Toulouse
select av_id, av_const, vi_nom
from avion,ville
where av_site=vi_id and av_const="airbus" and not (vi_nom = "toulouse");
   
-- 12. Liste des Airbus qui ne vont pas à Paris
select vo_id,vi_nom, av_const 
from vol, ville, avion
where vo_avion=av_id and vo_site_arrivee=vi_id and vi_nom<>"paris" and av_const="airbus";
   
-- 13. Liste des avions pour Paris qui ne sont pas des Airbus
select vo_id,vi_nom, av_const 
from vol, ville, avion
where vo_avion=av_id and vo_site_arrivee=vi_id and vi_nom="paris" and av_const<>"airbus";
    
-- 14. Liste de tous les vols avec le nom des avions
  
-- 15. Type et capacité des avions en service (donc des avions qui volent !)
select distinct av_id, av_modele, av_capacite
from vol, avion
where vo_avion=av_id

-- 15bis liste des avions qui ne sont pas en service
select av_id, vo_id
from avion left join vol on av_id=vo_avion
where vo_id is null;

-- requête imbriquée
select av_id 
from avion
where av_id not in (select distinct av_id from vol, avion where vo_avion=av_id)

-- 16. Liste des avions partant de Paris et localisé à Paris : 
select vo_avion
from vol
where vo_site_depart=2 and vo_avion in (select av_id from avion where av_site=2);

select av_id
from vol, avion
where vo_avion=av_id and vo_site_depart=2 and av_site=2;

-- 17. Liste des avions partant d'une ville et localisé dasn cette meme ville
select vo_avion, vi_nom, av_site
from vol, ville, avion
where vo_avion=av_id and av_site=vi_id 
and vo_site_depart=av_site

-- 18. Liste des vols dont le pilote est localisé dans la ville de départ
select vo_id,pi_nom, vi_nom
from vol, pilote,ville
where vo_pilote=pi_id and pi_site=vi_id
and pi_site=vo_site_depart;

-- 19. Liste des vols dont le pilote et l'avion sont localisés dans la ville de départ
select vo_id,pi_nom, av_id, vi_nom
from vol, pilote,ville, avion
where vo_pilote=pi_id and pi_site=vi_id and vo_avion= av_id
and pi_site=vo_site_depart and av_site=vo_site_depart; 

-- 20. Nom des pilotes en service
  
-- 20bis. Nom des pilotes qui ne sont pas en service
  
-- jointure gauche

-- 21. Nom des avions ayant une même capacité (auto-jointure) 

