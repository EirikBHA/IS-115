CREATE DATABASE IF NOT EXISTS Modul10;

USE Modul10;

CREATE TABLE user (
                      id              INT AUTO_INCREMENT,
                      password        VARCHAR(150),
                      name      VARCHAR(150),
                      CONSTRAINT pk_user PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS jobs
(
    id            INT auto_increment,
    job_name         VARCHAR(100) not null,
    description VARCHAR(2000) not null,
    location      VARCHAR(50) not null,
    contact_id       INT         not null,
    deadline     DATETIME        not null,
    metadata       VARCHAR(1000)        not null,
    constraint jobs_pk
        primary key (id)
);

ALTER TABLE `jobs` ADD `category` ENUM('Yrkesfaglig', 'Helse', 'Teknologi', 'Turistliv', 'Økonomi') AFTER `metadata`;