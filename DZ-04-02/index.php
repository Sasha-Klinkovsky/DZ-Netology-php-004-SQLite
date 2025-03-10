<?php

echo 'Hello word';
echo '<br>';
echo "----------------------<br>";

require_once 'shop.php';
require_once 'client.php';
require_once 'product.php';
require_once 'orders.php';
require_once 'order_product.php';


echo '<br>';
echo '<br>';

// Запрос на получение всех магазинов
$sql = "SELECT * FROM shop";

// Выполняем запрос
$result = $pdo->query($sql);

// Выводим данные таблицы shop
foreach ($result as $row) {
    echo "ID: " . $row['id'] . "<br>";
    echo "Название магазина: " . $row['name_shop'] . "<br>";
    echo "Адрес магазина: " . $row['address_shop'] . "<br>";
    echo "----------------------<br>";
}

echo '****************************************************' . '<br>';

// Запрос на получение всех клиентов
$sql = "SELECT * FROM client";

// Выполняем запрос
$result = $pdo->query($sql);

// Выводим данные таблицы client
foreach ($result as $row) {
    echo "ID: " . $row['id'] . "<br>";
    echo "Имя покупателя: " . $row['name_client'] . "<br>";
    echo "Номер телефона: " . $row['phone_client'] . "<br>";
    echo "----------------------<br>";
}

echo '****************************************************' . '<br>';

// Запрос на получение всех товаров
$sql = "SELECT * FROM product";

// Выполняем запрос
$result = $pdo->query($sql);

// Выводим данные таблицы product
foreach ($result as $row) {
    echo "ID: " . $row['id'] . "<br>";
    echo "Товар: " . $row['name_product'] . "<br>";
    echo "Стоимость: " . $row['price_product'] . "<br>";
    echo "Количество: " . $row['count_product'] . "<br>";
    echo "----------------------<br>";
}


echo '****************************************************' . '<br>';

// Запрос на получение всех заказов
$sql = "SELECT * FROM order_product";

// Выполняем запрос
$result = $pdo->query($sql);

// Выводим данные таблицы product
foreach ($result as $row) {
    echo "ID заказа: " . $row['id_order'] . "<br>";
    echo "ID Товара: " . $row['id_product'] . "<br>";
    echo "Стоимость: " . $row['price'] . "<br>";
    echo "Количество: " . $row['count'] . "<br>";
    echo "Наименование товара: " . $row['name_product_order'] . "<br>";
    echo "----------------------<br>";
}