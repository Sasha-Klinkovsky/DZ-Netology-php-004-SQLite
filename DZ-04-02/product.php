<?php

// Создаём подключение к базе данных (файл будет создан автоматически в папке где находится индексный файл, если его нет)
$pdo = new PDO("sqlite:database.db");

// Создаём таблицу product
$sql = "CREATE TABLE IF NOT EXISTS product (
    id INTEGER PRIMARY KEY AUTOINCREMENT, 
    name_product TEXT, 
    price_product INT,
    count_product INT
)";

// Выполняем SQL-запрос
$pdo->exec($sql);

echo "Таблица 'product' успешно создана!" . '<br>';



// SQL-запросы на добавление товаров
$sql = "
    INSERT INTO product (name_product, price_product, count_product) VALUES ('Велошлем', 3000, 30);
    INSERT INTO product (name_product, price_product, count_product) VALUES ('Перчатки', 1500, 25);
    INSERT INTO product (name_product, price_product, count_product) VALUES ('Насос', 2300, 12);
    INSERT INTO product (name_product, price_product, count_product) VALUES ('Горный байк', 15600, 7);
    INSERT INTO product (name_product, price_product, count_product) VALUES ('Городской велосипед', 17200, 18);
";

// Добовляем 5 товаров в таблицу product
$pdo->exec($sql);