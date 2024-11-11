CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('lecteur', 'auteur', 'admin') NOT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE authors (
    id_author INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    bio TEXT,
    contact_info TEXT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id_user)
);

CREATE TABLE categories (
    id_category INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT
);

CREATE TABLE books (
    id_book INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author_id INT,
    category_id INT,
    description TEXT,
    publication_year YEAR,
    price DECIMAL(10, 2),
    file_path VARCHAR(255),
    language VARCHAR(50),
    cover_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES authors(id_author),
    FOREIGN KEY (category_id) REFERENCES categories(id_category)
);

INSERT INTO users (username, email, password, role) VALUES
('john_doe', 'john@gmail.com', 'password_1', 'lecteur'),
('jane_author', 'jane@gmail.com', 'password_2', 'lecteur'),
('user1', 'user1@gmail.com', 'password_3', 'lecteur');
('alice_reader', 'alice@example.com', 'hashed_password_4', 'lecteur'),
('mark_writer', 'mark@example.com', 'hashed_password_5', 'auteur'),
('lucy_admin', 'lucy@example.com', 'hashed_password_6', 'admin'),
('bob_reader', 'bob@example.com', 'hashed_password_7', 'lecteur');


INSERT INTO categories (name, description) VALUES
('Littérature et Fiction', 'Livres de fiction incluant les romans, la poésie, et le théâtre.'),
('Science-Fiction et Fantasy', 'Livres de science-fiction, fantasy, et mondes imaginaires.'),
('Biographies et Mémoires', 'Récits biographiques et autobiographies de figures célèbres.'),
('Développement Personnel', 'Livres pour améliorer les compétences personnelles et professionnelles.');
('Policier et Suspense', 'Mystery, thriller, and suspense novels.'),
('Histoire', 'Books covering historical events and eras.'),
('Science', 'Books on various scientific topics.'),
('Art et Culture', 'Books on art, music, cinema, and culture.');

    ('Folk Tales', 'A collection of culturally significant folk tales from the Middle East'),
    ('Religion', 'Sacred and religious texts'),
    ('Autobiography', 'Personal life stories written by the author'),
    ('Fiction', "arrative literature created from the author\'s imagination.");



INSERT INTO authors (name, bio, contact_info, user_id) VALUES
('Jane Austen', 'Auteure anglaise connue pour ses romans sur la société britannique.', 'contact_jane@gmail.com', 2);
('Mark Twain', 'American author known for "The Adventures of Tom Sawyer" and "Huckleberry Finn".', 'mark@gmail.com', 5),
('Alice Walker', 'American author, poet, and activist, known for "The Color Purple".', 'alice@gmail.com', 4),
('George Orwell', 'British author famous for "1984" and "Animal Farm".', 'orwell@gmail.com', 6),
('Gabriel Garcia Marquez', 'Colombian novelist, known for "One Hundred Years of Solitude".', 'gabriel@gmail.com', 3);

    ('Unknown', 'Commonly attributed to ancient Arab and Persian storytellers'),
    ('Not applicable', 'Islamic holy text'),
    ('طه حسين', 'Taha Hussein, an Egyptian writer known for his autobiographical and cultural works.'),
    ('غسان كنفاني', 'Ghassan Kanafani, a Palestinian writer and political activist.');



INSERT INTO books (title, author_id, category_id, description, publication_year, price, file_path, language, cover_image) VALUES
('Pride and Prejudice', 1, 1, 'Un classique de la littérature anglaise sur les relations sociales.', 1813, 9.99, '/files/pride_and_prejudice.pdf', 'English', '/images/pride_and_prejudice_cover.jpg'),
('1984', 1, 2, 'Un roman dystopique explorant les dangers du totalitarisme.', 1949, 15.99, '/files/1984.pdf', 'English', '/images/1984_cover.jpg'),
('Sapiens: A Brief History of Humankind', 1, 3, "Une exploration fascinante de l\'histoire humaine.", 2011, 18.99 , '/files/sapiens.pdf', 'French', '/images/sapiens_cover.jpg')
('The Color Purple', 6, 1, 'A Pulitzer Prize-winning novel that explores themes of racial and gender inequality.', 1982, 12.99, '/files/color_purple.pdf', 'English', '/images/The_Color_Purple.jpg'),
('Animal Farm', 7, 2, 'A satirical novel about a farm where animals revolt against their human owner.', 1945, 7.99, '/files/animal_farm.pdf', 'English', '/images/Animal_Farm.jpg'),
('ألف ليلة وليلة', 1, 1, 'Un recueil de contes populaires du Moyen-Orient qui sont historiquement importants dans la littérature arabe.',800, 20.99, NULL, 'Arabic','/images/alf_laila.jpg')
('رجال في الشمس', 13, 1, 'رواية للكاتب الفلسطيني غسان كنفاني تسلط الضوء على معاناة اللاجئين الفلسطينيين.', 1963, 10.99, '/files/rijal_fi_al_shams.pdf', 'Arabic', '/images/rijal_fi_al_shams.jpg');;


