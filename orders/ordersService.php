<?php
require_once ('./db.php');
require_once ('./orders/Order.php');
require_once ('./cloth/Cloth.php');
class ordersService
{
    protected $connection;
    function __construct($connection)
    {
        $this->connection = $connection;
    }
    // Получить все
    public function getAll()
    {
        // username, вся инфа о штанах или о другой одежде которая ему принадлежит
        // vasya футболка л заголовок хедер
        // vasya штаны с загловок хедер
        // петя футболка л заголовок хедер
        $query = "
        SELECT o.id, o.adress, o.payOffline, o.completed, u.name, c.id as articul, c.type, c.size, c.color, c.brand, c.header, c.description, c.cost, otc.count 
        FROM `users` as u, `orders` as o, `ordersToCloth` as otc, `cloth` as c
        WHERE u.id = o.userId AND otc.clothId = c.id AND otc.orderId = o.id
        ORDER BY o.id ASC
        ";

        $res = mysqli_query($this->connection, $query);
        /// создаём новый заказ туда всё добавляем
        // Создаём новую одежду, добавляем в заказ
        // Создать новую одежду, добавляем в заказ
        // создаём новый заказ туда всё добавляем
        // Создаём новую одежду, добавляем в заказ
        // создаём новый заказ туда всё добавляем
        // Создаём новую одежду, добавляем в заказ
        $orders = [];
        if ($res->num_rows > 0) {
            $newOrder = new Order(-1, "", "", "", "", []);
            while ($row = mysqli_fetch_assoc($res)) {
                // Проверка на то, что заказ с таким номером уже сущестует
                if ($newOrder->id !== $row['id']) {
                    // Добавляем сформированный заказ
                    if ($newOrder->id != -1) {
                        array_push($orders, $newOrder);
                    }
                    // Формирую новый заказ без продуктов
                    $newOrder = new Order($row['id'], $row['name'], $row['adress'], $row['payOffline'], $row['completed'], []);
                }
                // Cформировать продукт и добавить в новый заказ
                $newCloth = new Cloth($row['articul'], $row['type'], $row['size'], $row['color'], $row['brand'], $row['header'], $row['description'], $row['cost']);
                
                array_push($newOrder->products, $newCloth);
            }
        }

        return $orders;
    }
    // Получить один
    public function getOne($userId)
    {
        $query = "
        SELECT u.name, c.type, c.size, c.color, c.brand, c.header, c.description, c.cost 
        FROM `users` as u, `favorite` as f, `favoriteToCloth` as ftc, `cloth` as c 
        WHERE u.id = f.userId AND f.id = ftc.favoriteId AND ftc.clothId = c.id AND u.id = $userId;
        ";

        $res = mysqli_query($this->connection, $query);

        $userFavorite = [];

        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                array_push($userFavorite, $row);
                // print_r($row);
                // echo "<br>";
            }
        }
        return $userFavorite;
    }
    // Добавить один
    public function addOne($favoriteId, $clothId)
    {
        // Проверяем, есть ли уже такая запись
        $query = "
            SELECT * 
            FROM `favoriteToCloth`
            WHERE 
            `favoriteId` = $favoriteId AND
            `clothId` = $clothId";

        $res = mysqli_query($this->connection, $query);

        if ($res->num_rows > 0) {
            return ['error' => "Ошибка! Товар уже был добавлен в избранное!"];
        }

        // Добавляем продукт в избраное
        $query = "
        INSERT INTO `favoriteToCloth`(`favoriteId`, `clothId`) 
        VALUES ($favoriteId, $clothId)
        ";

        $res = mysqli_query($this->connection, $query);

        // делаем запрос на получение той строки, которую мы ТОЛЬКО ЧТО добавили
        if ($res == 1) {
            $query = "
            SELECT * 
            FROM `favoriteToCloth`
            WHERE 
            `favoriteId` = $favoriteId AND
            `clothId` = $clothId;";

            $res = mysqli_query($this->connection, $query);

            $row = [];
            if ($res->num_rows > 0) {
                $row = mysqli_fetch_assoc($res);
            }
            return $row;
        }
    }
    // Обновить один
    // public function updateOne($busketToClothId, $newCount)
    // {
    //     $query = "
    //     UPDATE `busketToCloth` 
    //     SET `count`= $newCount
    //     WHERE id= $busketToClothId;
    //     ";

    //     $res = mysqli_query($this->connection, $query);
    //     // print_r($res);

    //     // Проверка, что запрос выполнился, и строка с новыми параметрами существует
    //     $query = "
    //     SELECT *
    //     FROM `busketToCloth`
    //     WHERE id = $busketToClothId AND `count`= $newCount
    //     ";
    //     $res = mysqli_query($this->connection, $query);

    //     if ($res->num_rows > 0) {
    //         $row = mysqli_fetch_assoc($res);
    //         return $row;
    //     } else {
    //         return [
    //             'error' => "Ошибка при обновлении данных!"
    //         ];
    //     }
    // }
    // Удалить один
    public function deleteOne($userId, $clothId)
    {
        // Получаем одежду которую удаляем и id записи в busketToCloth (BTCid)
        $query = "
        SELECT ftc.id as FTCid, ftc.favoriteId, ftc.clothId FROM `users` as u, `favorite` as f, `favoriteToCloth` as ftc, `cloth` as c WHERE ftc.clothId = c.id AND ftc.favoriteId = f.id AND u.id = f.userId AND u.id = $userId AND c.id = $clothId;
        ";

        $res = mysqli_query($this->connection, $query);

        $row = [];
        if ($res->num_rows > 0) {
            $row = mysqli_fetch_assoc($res);
        } else {
            return [
                'error' => "Ошибка! Запись не найдена"
            ];
        }
        // Удаляем строку
        $favoriteToClothId = $row['FTCid'];
        $query = "
        DELETE FROM `favoriteToCloth` 
        WHERE id= $favoriteToClothId;
        ";

        $res = mysqli_query($this->connection, $query);

        return $row;
    }
}

$usersService = new ordersService($connection);