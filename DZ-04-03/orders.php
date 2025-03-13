<?php

require_once __DIR__ . '/DatabaseWrapper/DatabaseWrapper.php';
require_once 'shop.php';
require_once 'client.php';

/*
Класс заказы 
*/


class Orders implements DatabaseWrapper
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;

        // Создаем таблицу orders (если её нет)
        $sql = "CREATE TABLE IF NOT EXISTS orders (
            id INTEGER PRIMARY KEY AUTOINCREMENT, 
            created_at DATETIME, 
            id_shop INT,
            name_shop TEXT, 
            id_client INT,
            name_client TEXT
        )";

        $this->pdo->exec($sql);
        echo "Таблица 'orders' успешно создана" . '<br>';
    }

    // Метод: получаем название магазина по ID
    private function getShopName(int $id_shop): string
    {
        $stmt = $this->pdo->prepare("SELECT name_shop FROM shop WHERE id = ?");
        $stmt->execute([$id_shop]);
        return $stmt->fetchColumn() ?: 'Неизвестный магазин';
    }

    // Метод: получаем имя клиента по ID
    private function getClientName(int $id_client): string
    {
        $stmt = $this->pdo->prepare("SELECT name_client FROM client WHERE id = ?");
        $stmt->execute([$id_client]);
        return $stmt->fetchColumn() ?: 'Неизвестный клиент';
    }

    // Добавление заказа
    public function insert(array $tableColumns, array $values): array
    {
        $created_at = $values[0];
        $id_shop = $values[1];
        $id_client = $values[2];

        // Получаем имя магазина и клиента
        $name_shop = $this->getShopName($id_shop);
        $name_client = $this->getClientName($id_client);

        $sql = "INSERT INTO orders (created_at, id_shop, name_shop, id_client, name_client) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$created_at, $id_shop, $name_shop, $id_client, $name_client]);

        return compact('created_at', 'id_shop', 'name_shop', 'id_client', 'name_client');
    }

    // Обновление заказа
    public function update(int $id, array $values): array
    {
        $created_at = $values[0];
        $id_shop = $values[1];
        $id_client = $values[2];

        // Получаем актуальные названия
        $name_shop = $this->getShopName($id_shop);
        $name_client = $this->getClientName($id_client);

        $sql = "UPDATE orders 
                SET created_at = ?, id_shop = ?, name_shop = ?, id_client = ?, name_client = ? 
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$created_at, $id_shop, $name_shop, $id_client, $name_client, $id]);

        return compact('id', 'created_at', 'id_shop', 'name_shop', 'id_client', 'name_client');
    }

    // Поиск заказа
    public function find(int $idOrder): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$idOrder]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }

    // Удаление заказа
    public function delete(int $idOrder): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->execute([$idOrder]);

        if ($stmt->rowCount()) {
            echo "Заказ с номером $idOrder удален" . '<br>';
            return true;
        } else {
            echo "Ошибка! Заказа с номером $idOrder не существует" . '<br>';
            return false;
        }
    }
}

// Подключаем базу данных
$pdo = new PDO("sqlite:database.db");

// Создаем объект класса Orders
$order1 = new Orders($pdo);

// Добавляем заказы (названия подтягиваются автоматически!)
$order1->insert(['created_at', 'id_shop', 'id_client'], ['25-01-2025 07:30:23', 2, 1]);
$order1->insert(['created_at', 'id_shop', 'id_client'], ['26-01-2025 08:40:33', 2, 1]);
$order1->insert(['created_at', 'id_shop', 'id_client'], ['26-01-2025 10:20:55', 3, 2]);
$order1->insert(['created_at', 'id_shop', 'id_client'], ['26-01-2025 15:30:11', 1, 4]);
$order1->insert(['created_at', 'id_shop', 'id_client'], ['27-01-2025 08:45:59', 5, 4]);



/*

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

*/
