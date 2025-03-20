# A-social-networking-site-I-made-up






Запрос для создания БД:
    
    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        login VARCHAR(255) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL
    );
    

