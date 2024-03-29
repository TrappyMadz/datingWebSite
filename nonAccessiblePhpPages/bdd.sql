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

DROP table messages;
CREATE TABLE messages (
  id int NOT NULL,
  content text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  pseudo_sender text NOT NULL,
  pseudo_recipient text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP table abonnements;
CREATE TABLE abonnements (
  id int NOT NULL,
  date_debut date,
  date_fin date
);

DROP table vus;
CREATE TABLE vus(
  id int NOT NULL,
  liste_id VARCHAR(255)
)