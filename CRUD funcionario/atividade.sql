create database nexus_db;
use nexus_db;

create table usuarios (
	id_usuario int auto_increment primary key,
    nome varchar (50) not null,
    endereco varchar (100) not null,
    telefone varchar (20) unique not null,
    email varchar (100) unique not null
);

desc usuarios;