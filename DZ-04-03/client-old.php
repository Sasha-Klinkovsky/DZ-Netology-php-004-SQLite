<?php

// Создаём подключение к базе данных (файл будет создан автоматически в папке где находится индексный файл, если его нет)
$pdo = new PDO("sqlite:database.db");

// Создаём таблицу client
$sql = "CREATE TABLE IF NOT EXISTS client (
    id INTEGER PRIMARY KEY AUTOINCREMENT, 
    name_client TEXT, 
    phone_client TEXT
)";

// Выполняем SQL-запрос
$pdo->exec($sql);

echo "Таблица 'client' успешно создана!" . '<br>';



// SQL-запросы на добавление магазинов
$sql = "
    INSERT INTO client (name_client, phone_client) VALUES ('Миша', '+7(900)-000-00-00');
    INSERT INTO client (name_client, phone_client) VALUES ('Саша', '+7(938)-155-15-33');
    INSERT INTO client (name_client, phone_client) VALUES ('Артем', '+7(900)-200-10-10');
    INSERT INTO client (name_client, phone_client) VALUES ('Тома', '+7(800)-300-20-10');
    INSERT INTO client (name_client, phone_client) VALUES ('Коля', '+7(930)-400-80-55');
";

// Добовляем 5 клиентов в таблицу client
$pdo->exec($sql);