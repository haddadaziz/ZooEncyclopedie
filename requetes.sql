CREATE DATABASE zoo_encyclopedie;
USE zoo_encyclopedie;

-- Création des tables
CREATE TABLE habitat(
    id_habitat INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_habitat VARCHAR(50) NOT NULL,
    description_habitat TEXT
);

CREATE TABLE animal (
    id_animal INTEGER AUTO_INCREMENT PRIMARY KEY,
    nom_animal VARCHAR(50) NOT NULL,
    regime_animal VARCHAR(50) NOT NULL,
    image_animal VARCHAR(50),
    habitat_animal INT NOT NULL,
    FOREIGN KEY (habitat_animal) REFERENCES habitat(id_habitat)
);

-- Ajouter un animal
INSERT INTO habitat(nom_habitat,description_habitat) VALUES
('Savane' , 'Vaste plaine herbeuse'),
('Jungle', 'Forêt tropical humide'),
('Océan', 'Grand bassin d'' eau salée'),
('Désert', 'Zone aride et sableuse');

INSERT INTO animal (nom_animal, regime_animal, image_animal, habitat_animal) VALUES 
('Éléphant', 'Herbivore', 'elephant.jpg', 1),
('Guépard', 'Carnivore', 'guepard.jpg', 1),
('Zèbre', 'Herbivore', 'zebre.jpg', 1);

INSERT INTO animal (nom_animal, regime_animal, image_animal, habitat_animal) VALUES 
('Toucan', 'Omnivore', 'toucan.jpg', 2),
('Jaguar', 'Carnivore', 'jaguar.jpg', 2),
('Paresseux', 'Herbivore', 'paresseux.jpg', 2);

INSERT INTO animal (nom_animal, regime_animal, image_animal, habitat_animal) VALUES 
('Pieuvre', 'Carnivore', 'pieuvre.jpg', 3),
('Tortue de mer', 'Omnivore', 'tortue.jpg', 3),
('Méduse', 'Carnivore', 'meduse.jpg', 3);

INSERT INTO animal (nom_animal, regime_animal, image_animal, habitat_animal) VALUES 
('Fennec', 'Omnivore', 'fennec.jpg', 4),
('Scorpion', 'Carnivore', 'scorpion.jpg', 4),
('Cobra', 'Carnivore', 'cobra.jpg', 4);

-- Modifications des informations d'un animal
UPDATE animal 
SET nom_animal = 'LION'
WHERE id_animal = 1;

UPDATE animal
SET regime_animal = 'Herbivore'
WHERE id_animal = 6;

UPDATE animal
SET image_animal = 'https://t4.ftcdn.net/jpg/08/83/98/19/360_F_883981992_kdENkQGUjYpRTxfTAMv9NJIBn4Wc5ujB.jpghttps://t4.ftcdn.net/jpg/08/83/98/19/360_F_883981992_kdENkQGUjYpRTxfTAMv9NJIBn4Wc5ujB.jpg'
WHERE id_animal = 4;

UPDATE animal
SET habitat_animal = 3
WHERE id_animal = 12;

UPDATE habitat
SET description_habitat = 'Vaste plaine herbeuse, ou seche'
WHERE id_habitat = 1;

-- Supprimer un animal

DELETE FROM animal
WHERE id_animal = 5;