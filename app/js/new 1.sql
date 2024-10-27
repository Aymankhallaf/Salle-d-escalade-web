-- Create users table
CREATE TABLE users (
   id_user TINYINT UNSIGNED AUTO_INCREMENT NOT NULL,
   username VARCHAR(50) NOT NULL,
   password VARCHAR(255) NOT NULL,
   fname VARCHAR(50) NOT NULL,
   lname VARCHAR(50) NOT NULL,
   email VARCHAR(255) NOT NULL,
   role VARCHAR(10) NOT NULL DEFAULT 'visiteur',
   PRIMARY KEY (id_user),
   UNIQUE (username),
   UNIQUE (email)
);

-- Create category table
CREATE TABLE category (
   id_category TINYINT UNSIGNED AUTO_INCREMENT NOT NULL,
   name_category VARCHAR(50) NOT NULL,
   description_category VARCHAR(255),
   PRIMARY KEY (id_category),
   UNIQUE (name_category)
);

-- Create photo table
CREATE TABLE photo (
   id_photo SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
   url VARCHAR(255) NOT NULL,
   alt_text VARCHAR(50) NOT NULL,
   PRIMARY KEY (id_photo),
   UNIQUE (url)
);

-- Create links table
CREATE TABLE links (
   id_links SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
   url_link VARCHAR(255),
   PRIMARY KEY (id_links)
);

-- Create post table
CREATE TABLE post (
   id_post SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
   title VARCHAR(256) NOT NULL,
   paragraph VARCHAR(1000),
   created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
   updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   id_links SMALLINT UNSIGNED,
   id_photo SMALLINT UNSIGNED,
   id_user TINYINT UNSIGNED NOT NULL,
   PRIMARY KEY (id_post),
   UNIQUE (id_links),
   UNIQUE (id_photo),
   FOREIGN KEY (id_links) REFERENCES links(id_links) ON DELETE SET NULL,
   FOREIGN KEY (id_photo) REFERENCES photo(id_photo) ON DELETE SET NULL,
   FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
);

-- Create product table
CREATE TABLE product (
   id_product TINYINT UNSIGNED AUTO_INCREMENT NOT NULL,
   name_product VARCHAR(50) NOT NULL,
   description_product VARCHAR(255) NOT NULL,
   price DECIMAL(10, 2) UNSIGNED NOT NULL,
   discount TINYINT,
   id_links SMALLINT UNSIGNED,
   id_photo SMALLINT UNSIGNED,
   PRIMARY KEY (id_product),
   UNIQUE (id_links),
   FOREIGN KEY (id_links) REFERENCES links(id_links) ON DELETE SET NULL,
   FOREIGN KEY (id_photo) REFERENCES photo(id_photo) ON DELETE SET NULL
);

-- Create comment table
CREATE TABLE comment (
   id_comment INT UNSIGNED AUTO_INCREMENT NOT NULL,
   content VARCHAR(255),
   writed_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
   id_product TINYINT UNSIGNED NOT NULL,
   id_post SMALLINT UNSIGNED NOT NULL,
   id_user TINYINT UNSIGNED NOT NULL,
   PRIMARY KEY (id_comment),
   FOREIGN KEY (id_product) REFERENCES product(id_product) ON DELETE CASCADE,
   FOREIGN KEY (id_post) REFERENCES post(id_post) ON DELETE CASCADE,
   FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
);

-- Create tags table
CREATE TABLE tags (
   id_category TINYINT UNSIGNED NOT NULL,
   id_post SMALLINT UNSIGNED NOT NULL,
   PRIMARY KEY (id_category, id_post),
   FOREIGN KEY (id_category) REFERENCES category(id_category) ON DELETE CASCADE,
   FOREIGN KEY (id_post) REFERENCES post(id_post) ON DELETE CASCADE
);
