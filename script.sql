create database rds_aws;

use rds_aws;
drop table post;

CREATE TABLE post(
    id INT PRIMARY KEY AUTO_INCREMENT,
    post VARCHAR(255),
    post_nome VARCHAR(100),
    post_data DATETIME
) ENGINE = InnoDB;

CREATE TABLE usuarios	(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    username VARCHAR(50),
    password VARCHAR(50),
    imagem VARCHAR(100)
) ENGINE = InnoDB;

ALTER TABLE post ADD CONSTRAINT fk_usuarios FOREIGN KEY ( id ) REFERENCES usuarios ( id ) ;