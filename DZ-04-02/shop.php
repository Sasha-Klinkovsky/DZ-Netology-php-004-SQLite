<?php

// Создаём подключение к базе данных (файл будет создан автоматически в папке где находится индексный файл, если его нет)
$pdo = new PDO("sqlite:database.db");

// Создаём таблицу shop
$sql = "CREATE TABLE IF NOT EXISTS shop (
    id INTEGER PRIMARY KEY AUTOINCREMENT, 
    name_shop TEXT, 
    address_shop TEXT
)";

// Выполняем SQL-запрос
$pdo->exec($sql);

echo "Таблица 'shop' успешно создана!" . '<br>';


// SQL-запросы на добавление магазинов
$sql = "
    INSERT INTO shop (name_shop, address_shop) VALUES ('Магазин-1', 'Шолохова 5');
    INSERT INTO shop (name_shop, address_shop) VALUES ('Магазин-2', 'Садовая 7');
    INSERT INTO shop (name_shop, address_shop) VALUES ('Магазин-3', 'Платова 6А');
    INSERT INTO shop (name_shop, address_shop) VALUES ('Магазин-4', 'Ленина 55');
    INSERT INTO shop (name_shop, address_shop) VALUES ('Магазин-5', 'Рябышева 17');
";

// Добовляем 5 магазов в таблицу shop
$pdo->exec($sql);