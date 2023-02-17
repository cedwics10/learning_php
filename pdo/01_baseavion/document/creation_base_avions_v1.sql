--
-- base de données: 'baseavion'
--
create database if not exists baseavion default character set utf8 collate utf8_general_ci;
use baseavion;
-- --------------------------------------------------------
-- creation des tables

set foreign_key_checks =0;

-- table avion
drop table if exists avion;
create table avion (
	av_id int not null auto_increment primary key,
	av_const varchar(20),
	av_modele varchar(10),
	av_capacite int,
	av_site int not null
)engine=innodb;

-- table pilote
drop table if exists pilote;
create table pilote (
	pi_id int not null auto_increment primary key,
	pi_nom varchar(20),
	pi_site int not null
)engine=innodb;

-- table vol
drop table if exists vol;
create table vol (
	vo_id char(5) not null unique ,
	vo_avion int not null,
	vo_pilote int not null ,
vo_site_depart int not null,
	vo_site_arrivee int not null,
	vo_heure_depart time,
	vo_heure_arrivee time
)engine=innodb; 

-- table ville
drop table if exists ville;
create table ville( 
	vi_id int not null auto_increment primary key,
	vi_nom varchar(50)
)engine=innodb;

set foreign_key_checks =1;

-- contraintes
alter table vol add constraint cs1 foreign key (vo_pilote) references pilote(pi_id);
alter table vol add constraint cs2 foreign key (vo_avion) references avion(av_id);
alter table avion add constraint cs3 foreign key (av_site) references ville(vi_id);
alter table pilote add constraint cs4 foreign key (pi_site) references ville(vi_id);
alter table vol add constraint cs5 foreign key (vo_site_depart) references ville(vi_id);
alter table vol add constraint cs6 foreign key (vo_site_arrivee) references ville(vi_id);

-- jeu de données ville 
insert into ville values (1, 'nice');
insert into ville values (2, 'paris');
insert into ville values (3, 'toulouse');
insert into ville values (4, 'grenoble');
insert into ville values (5, 'lyon');
insert into ville values (6, 'bastia');
insert into ville values (7, 'brive');
insert into ville values (8, 'nante');

-- jeu de données avion
insert into avion values(100,	'airbus',	'a320',	300,	1);
insert into avion values(101,	'boeing',	'b707',	250,	2);
insert into avion values(102,	'airbus',	'a320',	300,	3);
insert into avion values(103,	'caravelle',	'caravelle',200,3);
insert into avion values(104,	'boeing',	'b747',	400,	2);
insert into avion values(105,	'airbus',	'a320',	300,	5);
insert into avion values(106,	'atr',		'atr42', 	50,	2);
insert into avion values(107,	'boeing',	'b727',	300,	5);
insert into avion values(108,	'boeing',	'b727',	300,	8);
insert into avion values(109,	'airbus',	'a340',	350,	6);

-- jeu de données pilote
insert into pilote values(1,'serge',	1);
insert into pilote values(2,'jean',		2);
insert into pilote values(3,'claude',	4);
insert into pilote values(4,'robert',	8);
insert into pilote values(5,'michel',	2);
insert into pilote values(6,'lucien',	3);
insert into pilote values(7,'bertrand',	5);
insert into pilote values(8,'herve',	6);
insert into pilote values(9,'luc',		2);

-- jeu de données vol
insert into vol values('it100', 100,	1,	1,	2, 	'07:00',	'09:00');
insert into vol values('it101', 100,	2,	2, 3,	'11:00',	'12:00');
insert into vol values('it102', 101,	1,	 2, 1,	'12:00',	'14:00');
insert into vol values('it103', 105,	3,	4, 3,	'09:00',	'11:00');
insert into vol values('it104', 105,	3,	3, 4,	'17:00',	'19:00');
insert into vol values('it105', 107,	7,	5, 2,	'06:00',	'07:00');
insert into vol values('it106', 109,	8,	6, 2,	'10:00',	'13:00');
insert into vol values('it107', 106,	9,	 2, 7,	'07:00',	'08:00');
insert into vol values('it108', 106,	9,	7, 2,	'19:00',	'20:00');
insert into vol values('it109', 107,	7,	2, 5,	'18:00',	'19:00');
insert into vol values('it110', 102,	2,	 3, 2,	'15:00',	'16:00');
insert into vol values('it111', 101,	4,	 1, 8,	'17:00',	'19:00');




