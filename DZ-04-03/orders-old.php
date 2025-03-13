<?php

// Создаём подключение к базе данных (файл будет создан автоматически в папке где находится индексный файл, если его нет)
$pdo = new PDO("sqlite:database.db");

// Создаём таблицу order
$sql = "CREATE TABLE IF NOT EXISTS orders (
    id INTEGER PRIMARY KEY AUTOINCREMENT, 
    created_at DATETIME, 
    id_shop INT,
    id_client INT
)";

// Выполняем SQL-запрос
$pdo->exec($sql);

echo "Таблица 'orders' успешно создана!" . '<br>';



// SQL-запросы на добавление товаров
$sql = "
    INSERT INTO orders (created_at, id_shop, id_client) VALUES ('25-01-2025 07:30:23', 2, 1);
    INSERT INTO orders (created_at, id_shop, id_client) VALUES ('26-01-2025 08:40:33', 2, 1);
    INSERT INTO orders (created_at, id_shop, id_client) VALUES ('26-01-2025 10:20:55', 3, 2);
    INSERT INTO orders (created_at, id_shop, id_client) VALUES ('26-01-2025 15:30:11', 1, 4);
    INSERT INTO orders (created_at, id_shop, id_client) VALUES ('27-01-2025 08:45:59', 5, 4);
";

// Добовляем 5 заказов в таблицу order
$pdo->exec($sql);