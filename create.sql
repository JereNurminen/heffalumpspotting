DROP DATABASE IF EXISTS a1600526;
create database a1600526;
use a1600526;

CREATE TABLE observations (
		id			INTEGER AUTO_INCREMENT,
		spotter 	VARCHAR(32),
		amount 		INTEGER,
		place 		VARCHAR(255),
		description VARCHAR(255),
		spot_time	DATE,
		PRIMARY KEY (id)
);

INSERT INTO observations (spotter, amount, place, description, spot_time)
VALUES ('Jere', 5, '00970', 'A happy heffalump family by the riverside.', '2018-05-15');

INSERT INTO observations (spotter, amount, place, description, spot_time)
VALUES ('Jorma', 154, '27320', 'So many...', '1986-12-25');

INSERT INTO observations (spotter, amount, place, description, spot_time)
VALUES ('Jari', 42, '37210', 'A happy heffalump family by the riverside.', '2018-05-15');

INSERT INTO observations (spotter, amount, place, description, spot_time)
VALUES ('Jimi', 531, '06660', 'Hullo heffalumps!', '2017-03-02');

INSERT INTO observations (spotter, amount, place, description, spot_time)
VALUES ('Jokke', 13, '00420', 'Happy pink elephants!', '2006-06-09');

