CREATE SCHEMA avaliacao2;

CREATE TABLE professor(
    idprofessor INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome varchar(45),
    sobrenome varchar(45),
    disciplina varchar(45));

CREATE TABLE laboratorio(
    idlaboratorio INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    curso varchar(45));

CREATE TABLE reserva(
    idreserva INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    laboratorio_idlaboratorio INT,
    data date,
    professor_idprofessor INT,
    FOREIGN KEY (laboratorio_idlaboratorio) references laboratorio (idlaboratorio),
    FOREIGN KEY (professor_idprofessor) references professor (idprofessor));