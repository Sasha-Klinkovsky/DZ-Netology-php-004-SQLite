<?php

// Создаём подключение к базе данных (файл будет создан автоматически в папке где находится индексный файл, если его нет)
$pdo = new PDO("sqlite:database.db");

// Создаём таблицу order_product
$sql = "CREATE TABLE IF NOT EXISTS order_product (
    id INTEGER PRIMARY KEY AUTOINCREMENT, 
    id_order INT, 
    id_product INT,
    price INT,
    count INT,
    name_product_order TEXT
)";

// Выполняем SQL-запрос
$pdo->exec($sql);

echo "Таблица 'order_product' успешно создана!" . '<br>';



// SQL-запросы на добавление товаров
$sql = "
    INSERT INTO order_product (id_order, id_product, price, count, name_product_order)
    SELECT 2, id, price_product, count_product, name_product FROM product WHERE id = 2;
    
    INSERT INTO order_product (id_order, id_product, price, count, name_product_order)
    SELECT 4, id, price_product, count_product, name_product FROM product WHERE id = 4;
    
    INSERT INTO order_product (id_order, id_product, price, count, name_product_order)
    SELECT 5, id, price_product, count_product, name_product FROM product WHERE id = 5;
    
    INSERT INTO order_product (id_order, id_product, price, count, name_product_order)
    SELECT 5, id, price_product, count_product, name_product FROM product WHERE id = 3;
    
    INSERT INTO order_product (id_order, id_product, price, count, name_product_order)
    SELECT 3, id, price_product, count_product, name_product FROM product WHERE id = 1;
";

// Добовляем 5 заказов в таблицу order_product
$pdo->exec($sql);