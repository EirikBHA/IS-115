INSERT INTO modul7.applications (title, description, type) VALUES ('Søknad på jobb', 'Jeg er veldig interessert og kvalifisert for denne jobben', 'Utvikler');
INSERT INTO modul7.applications (title, description, type) VALUES ('Stillingssøknad', 'Jeg føler min følelse for denne jobben føles riktig', 'Professor');

INSERT INTO modul7.user (username, password, email, first_name, last_name) VALUES ('Eirikha', 'passord', 'Eirik@mail.com', 'Eirik', 'Eriksen');
INSERT INTO modul7.user ( username, password, email, first_name, last_name) VALUES ('KevinKA', 'TestPassord', 'Kevin@kev.no', 'Kevin', 'Johnsen');

INSERT INTO modul7.jobs (user_id, application_id, title, description) VALUES (1, 1, "Utvikler jobb", "Liker du å kode? Søk denne jobben!");
INSERT INTO modul7.jobs (user_id, application_id, title, description) VALUES (2, 2, 'Professor stilling', 'Liker du å lære? Eller å lære å lære? Søk denne jobben!');

SELECT * FROM applications;