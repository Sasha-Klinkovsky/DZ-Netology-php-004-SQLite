<?php

require_once __DIR__ . '/DatabaseWrapper/DatabaseWrapper.php';


/**
 * Класс Магазины
 */

 class Shop implements DatabaseWrapper
 {
    private $pdo; // Свойство для хранения подключения

    public function __construct(PDO $pdo)
    {
        // Подключаемся к базе
        $this->pdo= $pdo;


      // Создаём таблицу shop
      $sql = "CREATE TABLE IF NOT EXISTS shop (
      id INTEGER PRIMARY KEY AUTOINCREMENT, 
      name_shop TEXT, 
      address_shop TEXT
      )";

      // Выполняем SQL-запрос
      $this->pdo->exec($sql);

      echo "Таблица 'shop' успешно создана!<br>";      
    }

    // вставляет новую запись в таблицу, возвращает полученный объект как массив
    public function insert(array $tableColumns, array $values): array
    {
      // Создаём SQL-запрос
      $sql = "INSERT INTO shop (name_shop, address_shop) VALUES ('$values[0]', '$values[1]')";
        
      // Выполняем SQL-запрос
      $this->pdo->exec($sql);

      // Возвращаем добавленные данные (ID база создаст сама)
      return ["name_shop" => $values[0], "address_shop" => $values[1]];
    }


    // редактирует строку под конкретным id, возвращает результат после изменения. Изменяем запись о магазине
    public function update(int $id, array $values): array
    {
        // Выполняем SQL-запрос для обновления названия и адреса магазина
        $sql = "UPDATE shop SET name_shop = :name, address_shop = :address WHERE id = :id";
        
        // Подготовка и выполнение запроса
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $values[0],   // Название магазина
            ':address' => $values[1], // Адрес магазина
            ':id' => $id             // id магазина, который нужно обновить
        ]);
    
        // Возвращаем обновленные данные
        return [
            'id' => $id,
            'name_shop' => $values[0],
            'address_shop' => $values[1]
        ];
    }

    // поиск по id
    public function find(int $idShop): array
    {
      $stmt = $this->pdo->query("SELECT * FROM shop WHERE id = $idShop");
      $infoShop = $stmt->fetch(PDO::FETCH_ASSOC);
      return $infoShop ?: []; // если магазина с таким id нет вернем пустой массив
    }


    // удаление по id
    public function delete(int $idShop): bool
    {
      $stmt = $this->pdo->exec("DELETE FROM shop WHERE id = $idShop");
      
      if ($stmt) {
        echo "Магазин с ID $idShop удалён" . '<br>';
        return true;
    } else {
        echo "Ошибка удаления магазина с ID $idShop" . "<br>";
        return false;
    }
    }
    
}
 

// Подключаем базу данных
$pdo = new PDO("sqlite:database.db");

// Создаем таблицу магазинов

$shop1 = new Shop($pdo);

$shop1->insert(['name_shop', 'address_shop'], ['Магазин-1', 'Красноармейская 17']);
$shop1->insert(['name_shop', 'address_shop'], ['Магазин-2', 'Садовая 7']);
$shop1->insert(['name_shop', 'address_shop'], ['Магазин-3', 'Платова 6А']);
$shop1->insert(['name_shop', 'address_shop'], ['Магазин-4', 'Ленина 55']);
$shop1->insert(['name_shop', 'address_shop'], ['Магазин-5', 'Рябышева 17']);

// Обновляем магазин с id = 1
$shop1->update(1, ['Магазин Березка', 'ул. Поленова 17']);



/*
// Выводим информацию о магазине с id = 1
$infoShop = $shop1->find(1);
print_r ($infoShop);

// Удаляем магазин с id = 2
$shop1->delete(2);
*/




