
USE bdd;

DROP table utilisateurs;
CREATE TABLE utilisateurs(
    id INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(255) NOT NULL,
    pseudo VARCHAR(255) NOT NULL,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    statut VARCHAR(255) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    ville VARCHAR(255) NOT NULL,
    lien VARCHAR(10000) NOT NULL
 
);
SELECT * FROM utilisateurs; 
