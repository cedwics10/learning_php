-- sélectionner tous les champs
select * from avion;
-- sélectionner certains champs
select av_id,av_const from avion;
-- trier suivant un champs
select av_id,av_const from avion order by av_const;
select av_id,av_const from avion order by av_const desc;
select av_id,av_const from avion order by av_const desc, av_id;
-- selectionner certaines lignes
select av_id,av_const from avion where av_capacite=200;
select av_id,av_const from avion where av_capacite>=200 and av_capacite<=300;
select * from avion where av_const="AIRBUS";
select * from avion where av_const="AIRBUS" or av_const="Boeing" order by av_const;
select * from avion where av_const not in ("AIRBUS","Boeing") order by av_const;
select av_id,av_const from avion where av_capacite between 200 and 300;
-- élimination des doublons
select distinct av_const from avion;
select distinct av_id, av_const from avion;
select distinct av_capacite, av_const from avion;
-- renommer les entetes de colonnes
select av_const constructeur,av_capacite "nb sièges" from avion;
select av_id id, av_modele modele,vi_nom ville
from avion,ville 
where vi_id=av_site and vi_nom="toulouse";

-- jointure
select * from avion,ville where vi_id=av_site;
select * from avion inner join ville on vi_id=av_site;
select av_id, av_modele,vi_nom from avion,ville where vi_id=av_site;

select av_id, av_modele,vi_nom 
from avion,ville 
where vi_id=av_site and vi_nom="toulouse";

-- liste des vols avec le nom du pilote et le constructeur de l'avion.
select vo_id, pi_nom, av_const 
from vol,pilote,avion
where vo_pilote=pi_id and av_id=vo_avion

-- jointure gauche : tous les enregistrements de la table ville et éventuellement ceux d'avion
 
-- exemple : liste des pilotes et des villes associées
select pi_id, pi_nom,vi_nom
from pilote,ville
where pi_site=vi_id;

-- exemple : liste des villes sans pilote
select vi_nom
from ville left join pilote on pi_site=vi_id
where pi_id is null;

-- jointures avec 4 tables
select vo_id, av_modele, pi_nom, vdepart.vi_nom départ
from vol, avion, pilote, ville vdepart
where vo_avion=av_id and vo_pilote=pi_id and vo_site_depart=vdepart.vi_id;

-- jointures avec 5 tables
select vo_id, av_modele, pi_nom, vdepart.vi_nom départ, varrivee.vi_nom arrivée
from vol, avion, pilote, ville vdepart, ville varrivee
where vo_avion=av_id and vo_pilote=pi_id and vo_site_depart=vdepart.vi_id and vo_site_arrivee=varrivee.vi_id;

