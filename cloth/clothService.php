<?php
require_once ('./db.php');
class clothService
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
        SELECT * FROM `cloth`
        ";

        $res = mysqli_query($this->connection, $query);

        $cloth = [];

        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                array_push($cloth, $row);
                // print_r($row);
                // echo "<br>";
            }
        }

        return $cloth;
    }
    // Получить один
    public function getOne($clothId)
    {
        $query = "
        SELECT * FROM `cloth` WHERE id=$clothId;
        ";

        $res = mysqli_query($this->connection, $query);

        $cloth = [];

        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                array_push($cloth, $row);
                // print_r($row);
                // echo "<br>";
            }
        }
        return $cloth;
    }
    // Добавить один
    public function addOne($header, $cost, $imgSrc)
    {
        $query = "
        INSERT INTO `cloth`(`header`, `cost`, `imgSrc`) 
        VALUES ('$header', '$cost', '$imgSrc');
        ";

        $res = mysqli_query($this->connection, $query);
        print_r($res);

        // делаем запрос на получение той строки, которую мы ТОЛЬКО ЧТО добавили
        if ($res == 1) {
            $query = "
            SELECT * 
            FROM `cloth`
            WHERE 
            `header` = $header AND
            `cost` = $cost";

            $res = mysqli_query($this->connection, $query);

            return $res;
        }
    }
    // Обновить один
    public function updateOne($clothId, $type, $size, $color, $brand, $header, $description, $cost)
    {
        $query = "
        UPDATE `cloth` 
        SET 
        `type`= $type, 
        `size`= $size, 
        `color`= $color, 
        `brand`= $brand, 
        `header`= $header, 
        `cost`= $cost,
        WHERE id= $clothId;
        ";

        $res = mysqli_query($this->connection, $query);
        // print_r($res);

        // Проверка, что запрос выполнился, и строка с новыми параметрами существует
        $query = "
        SELECT *
        FROM `cloth`
        WHERE 
        `id` = `$clothId` AND 
        `type`= $type AND
        `size`= $size AND 
        `color`= $color AND
        `brand`= $brand AND
        `header`= $header AND
        `cost`= $cost
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
    public function deleteOne($clothId)
    {
        // Удаляем строку
        $query = "
        DELETE FROM `cloth` 
        WHERE id= $clothId;
        ";

        $res = mysqli_query($this->connection, $query);

        return 'ok';
    }
}

$clothService = new clothService($connection);