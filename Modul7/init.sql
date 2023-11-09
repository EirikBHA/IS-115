use Modul7;
CREATE TABLE user (
                      id              INT AUTO_INCREMENT,
                      username        VARCHAR(150) NOT NULL UNIQUE,
                      password        VARCHAR(150),
                      email           VARCHAR(200),
                      first_name      VARCHAR(150),
                      last_name       VARCHAR(150),
                      CONSTRAINT pk_user PRIMARY KEY (id)
);

CREATE TABLE applications (
    id              INT AUTO_INCREMENT,
    user_id         INT,
    job_id          INT,
    title           VARCHAR(100),
    description     VARCHAR(1000),
    type            ENUM('Utvikler', 'Tømrer', 'Rørlegger' , 'Lege', 'Professor'),
    CONSTRAINT pk_application PRIMARY KEY (id),
    CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES user(id)
);



CREATE TABLE jobs (
    id              INT AUTO_INCREMENT,
    user_id         INT,
    application_id  INT,
    title           VARCHAR(100),
    description     VARCHAR(1000),
    CONSTRAINT pk_job PRIMARY KEY (id),
    CONSTRAINT fk_application FOREIGN KEY (application_id) REFERENCES applications(id),
    CONSTRAINT fk_user_job FOREIGN KEY (user_id) REFERENCES user(id)
);