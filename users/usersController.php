<?php
require_once ('usersService.php');
class usersController
{
    protected $usersService;
    function __construct($usersService)
    {
        $this->usersService = $usersService;
    }
    // Получить все
    public function getAll()
    {
        $response = $this->usersService->getAll();
        return $response;
    }
    // Получить один
    public function getOne($userId)
    {
        $response = $this->usersService->getOne($userId);
        return $response;
    }
    // Получить один
    public function getOneByLogin($userlogin)
    {
        $response = $this->usersService->getOneByLogin($userlogin);
        return $response;
    }
    // Добавить один
    public function addOne($login, $pass, $email)
    {

        $response = $this->usersService->addOne($login, $pass, $email);
        return $response;
    }
    // Обновить один
    public function updateOne($userId, $login, $pass, $email)
    {
        $response = $this->usersService->updateOne($userId, $login, $pass, $email);
        return $response;
    }
    // Удалить один
    public function deleteOne($id)
    {
        $response = $this->usersService->deleteOne($id);
        return $response;
    }
}

$usersController = new usersController($usersService);