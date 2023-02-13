CREATE DATABASE kupiprodai
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;
USE kupiprodai;

CREATE TABLE users(
    id int PRIMARY KEY AUTO_INCREMENT,
    creation_time datetime NOT NULL,
    name varchar(122) NOT NULL,
    email varchar(64) NOT NULL UNIQUE,
    avatar varchar(64),
    password varchar(64) NOT NULL
);

CREATE TABLE categories(
    id int PRIMARY KEY AUTO_INCREMENT,
    creation_time datetime NOT NULL,
    name varchar(64) NOT NULL,
    img varchar(128),
    symbol_code varchar(122) NOT NULL
);

CREATE TABLE publications(
    id int PRIMARY KEY AUTO_INCREMENT,
    creation_time datetime NOT NULL,
    title varchar(122) NOT NULL,
    description varchar(255) NOT NULL,
    publication_categories int NOT NULL,
    creator_id int NOT NULL,
    price int NOT NULL,
    is_sell tinyint(1),
    FOREIGN KEY (creator_id) REFERENCES users(id)
);

CREATE TABLE publications_categories(
    id int PRIMARY KEY AUTO_INCREMENT,
    category_id int NOT NULL,
    publication_id int NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (publication_id) REFERENCES publications(id) 
);

CREATE TABLE comments(
    id int PRIMARY KEY AUTO_INCREMENT,
    creation_time datetime NOT NULL,
    text text NOT NULL,
    user_id int NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE publications_files(
    id int PRIMARY KEY AUTO_INCREMENT,
    creation_time datetime NOT NULL,
    publication_id int NOT NULL,
    name varchar(122) NOT NULL,
    path varchar(512) NOT NULL,
    FOREIGN KEY (publication_id) REFERENCES publications(id)
);

INSERT into categories (name, symbol_code, creation_time, img)
VALUES ('Дом', 'house', NOW(), '/uploads/category/cat.jpg'),
('Электроника', 'electronics', NOW(), '/uploads/category/cat02.jpg'),
('Одежда', 'clothes', NOW(), '/uploads/category/cat03.jpg'),
('Спорт/отдых', 'sport', NOW(), '/uploads/category/cat04.jpg'),
('Авто', 'auto', NOW(), '/uploads/category/cat05.jpg'),
('Книги', 'books', NOW(), '/uploads/category/cat06.jpg');