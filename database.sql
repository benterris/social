DROP TABLE users;
DROP TABLE posts;

CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
first_name VARCHAR(255) NOT NULL,
last_name VARCHAR(255) NOT NULL,
phone_number VARCHAR(255),
bio TEXT,
picture_path VARCHAR(255),
birth_date DATETIME
);

CREATE TABLE posts (
id INT AUTO_INCREMENT PRIMARY KEY,
user_id_sender INT,
user_id_receiver INT,
created DATETIME DEFAULT NULL,
content TEXT
);

