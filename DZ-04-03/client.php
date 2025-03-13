<?php

require_once __DIR__ . '/DatabaseWrapper/DatabaseWrapper.php';

/**
 * Класс клиенты
 */

 class Client implements DatabaseWrapper
 {
    private $pdo; // Свойство для хранения подключения таблицы

    public function __construct(PDO $pdo)
    {
        // Подключаемся к базе
        $this->pdo= $pdo;

        //Создаем таблицу client
        $sql = "CREATE TABLE IF NOT EXISTS client (
            id INTEGER PRIMARY KEY AUTOINCREMENT, 
            name_client TEXT, 
            phone_client TEXT
        )";
       
       // Выполняем SQL-запрос
       $this->pdo->exec($sql);

       echo "Таблица 'client' успешно создана!" . '<br>';
    }

    // Добовляет новую запись о клиенте в таблицу и возвращает как массив
    public function insert(array $tableColumns, array $values): array
    {
      // Создаем SQL запрос
      $sql = "INSERT INTO client (name_client, phone_client) VALUES ('$values[0]', '$values[1]')";

      // Выполняем SQL запрос
      $this->pdo->exec($sql);

      // Возвращаем добавленные данные о клиенте
      return ['name_client' => $values[0], 'phone_client' =>$values[1]];
    }


    // Метод редактирует строку под конкретным ID. Изменяем запись о клиенте
    public function update(int $id, array $values): array
    {
        // Создаем SQL запрос
        $sql = "UPDATE client SET name_client = :name, phone_client = :phone WHERE id = :id";

        // Подготовка и выполнение запроса
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $values[0],   // Имя клиента
            ':phone' => $values[1],  // Номер телефона
            ':id' => $id             // id Клиента у которого нужно обновить данные
        ]);

        // Возвращаем обновленные данные о клиенте
        return [
            'id' => $id,
            'name_client' => $values[0],
            'phone_client' => $values[1]
        ];
    }

    // Метод поиска клиента по его ID
    public function find(int $idClient): array
    {
        $stmt = $this->pdo->query("SELECT * FROM client WHERE id = $idClient");
        $infoClient = $stmt->fetch(PDO::FETCH_ASSOC);
        return $infoClient ?: []; // если у клиента нет id вернет пустой массив
    }


    // Удаление клиента по id
    public function delete(int $idClient): bool
    {
        $stmt = $this->pdo->exec("DELETE FROM client WHERE id = $idClient");

        if ($stmt) {
            echo "Клиент с ID $idClient удален" . '<br>';
            return true;
        } else {
            echo "Ошибка! Клиент с ID $idClient не найден" . '<br>';
            return false;
        }
    }

 }




// Подключаем базу данных
$pdo = new PDO("sqlite:database.db");

// Создаем объект Client и передаем подключение PDO
$client1 = new Client($pdo);



 // Создаем таблицу клиентов

$client1->insert(['name_client', 'phone_client'], ['Миша', '+7(900)-000-00-00']);
$client1->insert(['name_client', 'phone_client'], ['Саша', '+7(938)-155-15-33']);
$client1->insert(['name_client', 'phone_client'], ['Артем', '+7(900)-200-10-10']);
$client1->insert(['name_client', 'phone_client'], ['Тома', '+7(800)-300-20-10']);


