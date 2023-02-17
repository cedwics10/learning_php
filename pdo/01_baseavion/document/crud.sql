-- create
insert into ville values (null, "Marseille");
insert into ville (vi_nom,vi_id) values ("Villejuif",null);
insert into ville values (null, "ville 1"),(null, "ville 2"),(null, "ville 3")

-- read
select * from ville;

-- update
update ville set vi_nom="tutu" where vi_id=10;
update avion set av_capacite=123, av_modele="A380" where av_id=100;

-- delete
delete from ville where vi_id=12;

-- transaction avec rollback/commit
SET autocommit = 0
begin;
delete from ville where vi_id=14;
rollback;


