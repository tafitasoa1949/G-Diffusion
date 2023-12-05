create database facturation;
\c facturation

create table admin(
    id serial primary key,
    nom varchar(50) not null,
    prenoms varchar(50),
    email varchar(50) not null unique,
    motdepasse varchar(50) not null
);

INSERT INTO admin VALUES(DEFAULT,'RATSIMBAHARISON','tafitasoa','tafitasoa@gmail.com','tft');

create table societe(
    id varchar(20) primary key,
    doit varchar(100) not null,
    nif varchar(50) not null,
    stat varchar(50) not null,
    email varchar(50) unique,
    adresse varchar(50),
    contact bigint,
    responsable varchar(50)
);

create table client_particulier(
    id varchar(20) primary key,
    nom varchar(100) not null,
    prenoms varchar(50) not null,
    email varchar(50) unique,
    adresse varchar(50),
    contact bigint
);

CREATE TABLE diffusion (
    id varchar(20) PRIMARY KEY,
    idproprietaire varchar(20),
    description varchar(500),
    quantite int default 0,
    prix_unitaire decimal(14,2),
    date timestamp
);

create table type_facture(
    id serial primary key,
    type varchar(20)
);

INSERT INTO type_facture (type) VALUES
('Facture'),
('Proforma');


create table mode_paiement(
    id serial primary key,
    nom varchar(20)
);

INSERT INTO mode_paiement (nom) VALUES
('Especes'),
('Virement bancaire'),
('Cheque');


create table status(
    id serial primary key,
    nom varchar(20)
);

INSERT INTO status (nom) VALUES
('Suivant contrat'),
('PLM(Plan Media)'),
('Bon de commande');


create table facture(
    id varchar(20) primary key,
    iddiffusion varchar(20) REFERENCES diffusion(id),
    idtype int REFERENCES type_facture(id),
    idmode_payement int REFERENCES mode_paiement(id),
    idstatus int REFERENCES status(id),
    remise decimal(14,2),
    taxe decimal(14,2),
    date timestamp
);

create or replace view diffusion_societe as SELECT d.id,s.id as idproprietaire,s.doit,d.description,d.quantite,d.prix_unitaire,d.date
FROM diffusion as d
LEFT JOIN societe as s ON d.idproprietaire = s.id
LEFT JOIN client_particulier as c ON d.idproprietaire = c.id where c.nom is null;

create or replace view diffusion_client as SELECT d.id,c.id as idproprietaire,c.nom,c.prenoms,d.description,d.quantite,d.prix_unitaire,d.date
FROM diffusion as d
LEFT JOIN societe as s ON d.idproprietaire = s.id
LEFT JOIN client_particulier as c ON d.idproprietaire = c.id where s.doit is null;

