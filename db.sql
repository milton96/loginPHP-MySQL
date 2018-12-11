create database login;

create table usuarios(
	id int auto_increment primary key,
	usuario varchar(30),
	password varchar(150),
	tipo int,
	passencrip varchar(150)
);