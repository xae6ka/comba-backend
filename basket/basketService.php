<?php
require_once ('./db.php');
class basketService
{
    protected $connection;
    function __construct($connection)
    {
        $this->connection = $connection;
    }
    // Получить все
    public function getAll()
    {
        $query = "
        SELECT C.id AS articul, BTC.busketId AS busketId, C.header, C.cost, C.promo, C.promoTitle, BTC.count FROM `cloth` AS C, `busketToCloth` AS BTC WHERE BTC.clothId = C.id;
        ";

        $res = mysqli_query($this->connection, $query);

        $baskets = [];

        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                array_push($baskets, $row);
                // print_r($row);
                // echo "<br>";
            }
        }

        return $baskets;
    }
    // Получить один
    public function getOne($userId)
    {
        $query = "
        SELECT C.id AS articul, BTC.busketId AS busketId, C.header, C.cost, C.promo, C.promoTitle, BTC.count FROM `cloth` AS C, `busketToCloth` AS BTC WHERE BTC.clothId = C.id AND BTC.busketId = $userId;
        ";

        $res = mysqli_query($this->connection, $query);

        $userBasket = [];

        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                array_push($userBasket, $row);
                // print_r($row);
                // echo "<br>";
            }
        }
        return $userBasket;
    }
    // Добавить один
    public function addOne($basketId, $clothId, $count)
    {
        // Проверяем, есть ли уже такая запись
        $query = "
            INSERT INTO `busket`(`id`, `userId`) VALUES ($basketId, $basketId);
        ";

        $res = mysqli_query($this->connection, $query);

        $query = "
            SELECT * 
            FROM `busketToCloth`
            WHERE 
            `busketId` = $basketId AND
            `clothId` = $clothId";

        $res = mysqli_query($this->connection, $query);

        if ($res->num_rows > 0) {
            return ['error' => "Ошибка! Товар уже был добавлен в корзину!"];
        }

        // Добавляем продукт в корзину
        $query = "
        INSERT INTO `busketToCloth`(`busketId`, `clothId`, `count`) 
        VALUES ($basketId, $clothId, $count)
        ";

        $res = mysqli_query($this->connection, $query);

        // делаем запрос на получение той строки, которую мы ТОЛЬКО ЧТО добавили
        if ($res == 1) {
            $query = "
            SELECT * 
            FROM `busketToCloth`
            WHERE 
            `busketId` = $basketId AND
            `clothId` = $clothId AND
            `count` = $count";

            $res = mysqli_query($this->connection, $query);

            $row = [];
            if ($res->num_rows > 0) {
                $row = mysqli_fetch_assoc($res);
            }
            return $row;
        }
    }
    // Обновить один
    public function updateOne($busketToClothId, $newCount)
    {
        $query = "
        UPDATE `busketToCloth` 
        SET `count`= $newCount
        WHERE id= $busketToClothId;
        ";

        $res = mysqli_query($this->connection, $query);
        // print_r($res);

        // Проверка, что запрос выполнился, и строка с новыми параметрами существует
        $query = "
        SELECT *
        FROM `busketToCloth`
        WHERE id = $busketToClothId AND `count`= $newCount
        ";
        $res = mysqli_query($this->connection, $query);

        if ($res->num_rows > 0) {
            $row = mysqli_fetch_assoc($res);
            return $row;
        } else {
            return [
                'error' => "Ошибка при обновлении данных!"
            ];
        }
    }
    // Удалить один
    public function deleteOne($busketid, $clothid)
    {
        $query = "
        DELETE FROM `busketToCloth` WHERE busketId=$busketid AND clothId=$clothid;
        ";

        return mysqli_query($this->connection, $query);
    }
}

$basketService = new basketService($connection);