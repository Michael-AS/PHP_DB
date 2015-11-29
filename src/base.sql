CREATE TABLE adm_estfis (
	est_codigo SMALLINT PRIMARY KEY,
	est_fantasma VARCHAR(50) NOT NULL,
	est_rsocial VARCHAR(50) NOT NULL,
	est_cnpj CHAR(18) NOT NULL DEFAULT '00.000.000/0000-00',
	est_ie VARCHAR(20) NOT NULL
);

CREATE TABLE adm_usu (
	usu_login VARCHAR(30) PRIMARY KEY NOT NULL,
	usu_nome VARCHAR(120) NOT NULL,
	usu_senha VARCHAR(30) NOT NULL
);

INSERT INTO adm_usu VALUES ('master', 'Administrador', 'iso9000');