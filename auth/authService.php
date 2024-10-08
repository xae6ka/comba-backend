<?php
require_once ('./api/db.php');
class authService
{
    protected $connection;
    function __construct($connection)
    {
        $this->connection = $connection;
    }
    // Получить все
    public function register($login, $name, $email, $phone, $password)
    {
        // ошибку пишем в формате ['error' => 'текст ошибки'];
        // Проверить логин есть ли такой уже в бд?
        $query = "
        SELECT *
        FROM `users`
        WHERE users.login = $login
        ";

        $res = mysqli_query($this->connection, $query);
        if ($res->num_rows > 0) {
            return [
                'error' => "Ошибка! Пользователь с таким логином уже существует!" 
            ];
        }

        // Проверить почту есть ли такой уже в бд?
        $query = "
        SELECT *
        FROM `users`
        WHERE users.email = $email
        ";

        $res = mysqli_query($this->connection, $query);
        if ($res->num_rows > 0) {
            return [
                'error' => "Ошибка! Пользователь с таким email уже существует!" 
            ];
        }
        // Проверить телефон есть ли такой уже в бд?
        $query = "
        SELECT *
        FROM `users`
        WHERE users.phone = $phone
        ";

        $res = mysqli_query($this->connection, $query);
        if ($res->num_rows > 0) {
            return [
                'error' => "Ошибка! Пользователь с таким телефоном уже существует!" 
            ];
        }

        // Добавить пользователя в базу данных
        $query = "
        INSERT INTO `users`(`login`, `pass`, `name`, `phone`, `email`) 
        VALUES ('$login','$password','$name','$phone','$email')
        ";
        $res = mysqli_query($this->connection, $query);

        // Получить данные пользователя
        $query = "
        SELECT 
        FROM `users` AS u, `busket` AS b, `favorite` AS f
        WHERE 
        u.login = $login AND
        u.pass = $password AND
        u.login = $login AND
        u.login = $login AND
        u.login = $login AND
        ";
        $res = mysqli_query($this->connection, $query);
        // возвращение пользователя
        // записываем в session: 
        // login, name, isAuth, phone, email, role, basketId, favoriteId 
    }
    // Получить один
    public function login($login, $password)
    {
        
    }
}

$authService = new authService($connection);