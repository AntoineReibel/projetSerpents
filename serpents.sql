-- Suppression de la base de données si elle existe
DROP DATABASE IF EXISTS serpents;

-- Création de la base de données
CREATE DATABASE serpents;

-- Utilisation de la base de données
USE serpents;

-- Création de la table des races
CREATE TABLE races(
   id_races INT AUTO_INCREMENT,
   nomRace VARCHAR(50),
   PRIMARY KEY(id_races)
);

-- Création de la table des serpents
CREATE TABLE serpents(
   id_serpents INT AUTO_INCREMENT,
   nomSerpent VARCHAR(50),
   poids INT,
   dureeDeVie DATETIME,
   dateNaissance DATETIME,
   isMale TINYINT(1),
   idRace INT NOT NULL,
   idMere INT Default NULL,
   idPere INT Default NULL,
   isDead TINYINT(1) Default 0,
   inLoveRoom TINYINT(1) Default 0,
   PRIMARY KEY(id_serpents),
   FOREIGN KEY(idRace) REFERENCES races(id_races)
);

-- Insertion de 5 races de serpents
INSERT INTO races (nomRace) VALUES 
('Python'),
('Cobra'),
('Vipère'),
('Anaconda'),
('Boa');

-- Insertion de 15 serpents fictifs avec des noms
-- INSERT INTO serpents (nomSerpent, poids, dureeDeVie, dateNaissance, isMale, isDead, idrace) VALUES
-- ('Naga', 2, '2024-08-10 12:00:00', NOW(), 1, 0, 1),
-- ('Aspic', 3, '2024-09-15 10:30:00', NOW(), 1, 0, 2),
-- ('Kaa', 4, '2025-01-20 14:20:00', NOW(), 1, 0, 3),
-- ('Medusa', 5, '2024-11-05 09:45:00', NOW(), 1, 0, 4),
-- ('Nagini', 2, '2024-10-25 11:10:00', NOW(), 0, 0, 5),
-- ('Orochimaru', 3, '2024-07-30 08:40:00', NOW(), 0, 0, 1),
-- ('Quetzalcoatl', 4, '2025-02-12 13:15:00', NOW(), 0, 0, 2),
-- ('Rattles', 5, '2024-12-18 10:50:00', NOW(), 0, 0, 3),
-- ('Slinky', 2, '2024-11-08 12:20:00', NOW(), 1, 0, 4),
-- ('Vasuki', 3, '2024-10-02 09:35:00', NOW(), 1, 0, 5),
-- ('Wiggles', 4, '2025-03-05 14:45:00', NOW(), 1, 0, 1),
-- ('Xylo', 5, '2024-10-15 11:25:00', NOW(), 1, 0, 2),
-- ('Yig', 2, '2024-12-28 08:55:00', NOW(), 0, 0, 3),
-- ('Zmei', 3, '2024-09-01 13:05:00', NOW(), 0, 0, 4),
-- ('Serpent15', 4, '2025-04-10 10:15:00', NOW(), 0, 0, 5);
