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

echo '****************************************************' . '<br>';
// Выводим информацию о магазине с id = 1
$infoShop = $shop1->find(1);
print_r ($infoShop);

echo '<br>';
echo '<br>';

echo '****************************************************' . '<br>';
// Удаляем магазин с id = 2
$shop1->delete(2);

echo '<br>';
echo '<br>';

// изменим запись в заказе
$order1->update(5, ['28-01-2025 10:12:58', 3, 2]);

// удаляем заказ 4
$order1->delete(4);


// Запрос на получение всех заказов
$sql = "SELECT * FROM orders";

// Выполняем запрос
$result = $pdo->query($sql);

// Выводим данные таблицы product
foreach ($result as $row) {
    echo "ID: " . $row['id'] . "<br>";
    echo "Время заказа: " . $row['created_at'] . "<br>";
    echo "id магазина: " . $row['id_shop'] . "<br>";
    echo "Название магазина: " . $row['name_shop'] . "<br>";
    echo "id клиента: " . $row['id_client'] . "<br>";
    echo "Имя клиента: " . $row['name_client'] . "<br>";
    echo "----------------------<br>";
}



// поиск заказа по id

$infoOrder = $order1->find(5);
print_r ($infoOrder);

$infoOrder = $order1->find(23);
print_r ($infoOrder);