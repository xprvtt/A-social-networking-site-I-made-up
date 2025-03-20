# A-social-networking-site-I-made-up

Локальный сайт выдуманной социальной сети "Proxima", созданный как небольшой курсовой проект.

Использует MySQL посредством XAMPP.

Реализованы:

1. Регистрация;
    
2. Вход;
    
3. Соответствующие страницы сайта;
    

Регистрация проходит с применением хеширования пароля.
    
Запрос для создания БД:
    
    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        login VARCHAR(255) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL
    );
    

