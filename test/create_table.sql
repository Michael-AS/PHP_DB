CREATE DATABASE base;
GO

CREATE TABLE adm_usu (
	usu_login VARCHAR(30) PRIMARY KEY NOT NULL,
	usu_nome VARCHAR(120) NOT NULL,
	usu_senha VARCHAR(30) NOT NULL
);

INSERT INTO adm_usu VALUES ('master', 'Administrador', 'iso9000');