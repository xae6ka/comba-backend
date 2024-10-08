<?php
require_once ('./db.php');
class usersService
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
        SELECT * FROM `users`
        ";

        $res = mysqli_query($this->connection, $query);

        $users = [];

        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                array_push($users, $row);
                // print_r($row);
                // echo "<br>";
            }
        }

        return $users;
    }
    // Получить один
    public function getOne($userId)
    {
        $query = "
        SELECT * FROM `users` WHERE id=$userId;
        ";

        $res = mysqli_query($this->connection, $query);

        $user = [];

        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                array_push($user, $row);
                // print_r($row);
                // echo "<br>";
            }
        }
        return $user;
    }

    // Get One By Login
    public function getOneByLogin($userlogin)
    {
        $query = "
        SELECT * FROM `users` WHERE login='$userlogin';
        ";

        $res = mysqli_query($this->connection, $query);

        $user = [];

        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                array_push($user, $row);
                // print_r($row);
                // echo "<br>";
            }
        }
        return $user;
    }
    // Добавить один
    public function addOne($login, $pass, $email)
    {
        // Добавляем пользователя
        $query = "
        INSERT INTO `users`(`login`, `pass`, `email`) 
        VALUES ('$login', '$pass', '$email');
        ";

        $res = mysqli_query($this->connection, $query);

        return 'ok!';
    }
    // Обновить один
    public function updateOne($userId, $login, $pass, $email)
    {
        $query = "
        UPDATE `users` 
        SET 
        `login`= $login, 
        `pass`= $pass, 
        `email`= $email
        WHERE id= $userId;
        ";

        $res = mysqli_query($this->connection, $query);
        // print_r($res);

        // Проверка, что запрос выполнился, и строка с новыми параметрами существует
        $query = "
        SELECT *
        FROM `users`
        WHERE id = $userId AND 
        `login`= $login AND 
        `pass`= $pass AND
        `email`= $email;
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
    public function deleteOne($userId)
    {
        // Получаем строку для возврата
        $query = "
        SELECT * 
        FROM `users` 
        WHERE id= $userId;
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
        $query = "
        DELETE FROM `users` 
        WHERE id= $userId;
        ";

        $res = mysqli_query($this->connection, $query);
        
        return $row;
    }
}

$usersService = new usersService($connection);