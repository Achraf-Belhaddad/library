CREATE DATABASE gestion_produits;

USE gestion_produits;

CREATE TABLE produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prix_unitaire DECIMAL(10, 2) NOT NULL,
    categorie VARCHAR(255) NOT NULL
);

INSERT INTO produits (nom, prix_unitaire, categorie) VALUES 
('Ordinateur Portable', 999.99, 'Électronique'), 
('Smartphone', 699.99, 'Électronique'), 
('Tablette', 299.99, 'Électronique'), 
('Chaise de Bureau', 89.99, 'Mobilier'), 
('Bureau', 149.99, 'Mobilier'), 
('Lampe de Bureau', 19.99, 'Éclairage'), 
('Imprimante', 129.99, 'Électronique'), 
('Câble HDMI', 9.99, 'Accessoires'), 
('Clé USB', 15.99, 'Accessoires'), 
('Casque Audio', 59.99, 'Électronique'), 
('Moniteur', 199.99, 'Électronique'), 
('Clavier', 49.99, 'Accessoires'), 
('Souris', 29.99, 'Accessoires'), 
('Disque Dur Externe', 79.99, 'Accessoires'), 
('Chargeur', 39.99, 'Accessoires'), 
('Webcam', 89.99, 'Accessoires'), 
('Microphone', 109.99, 'Accessoires'), 
('Scanner', 129.99, 'Électronique'), 
('Routeur Wi-Fi', 69.99, 'Électronique'), 
('Tablette Graphique', 149.99, 'Accessoires');

CREATE TABLE `user_form` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
)

ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

  ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;


  CREATE TABLE `cart` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4