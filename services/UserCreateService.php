<?php
namespace app\services;

use yii;
use app\models\Users;

class UserCreateService
{
    private $path = 'uploads/avatar';
    /** Метод сохраняет файл аватара на сервере и возвращает массив с файлом
     * @param object $file
     * @return array
     */
    private function serviceUploadFile($file): array
    {
        $fileName = $file->name;
        $fileServerName = uniqid($file->baseName). '.' . $file->extension;
        if (!is_dir($this->path)) {
            mkdir($this->path,0777,true);
        }
        $file->saveAs($this->path . '/' . $fileServerName);
        $uploadFile = ['name' => $fileName, 'path' =>  $fileServerName];
        return $uploadFile;
    }

    /**метод
     * Метод перенаправляет файл в приватный метод
     * @param array $file
     * @return array
     */
    public function saveUploadFile($file): array
    {
        return $this->serviceUploadFile($file);
    }

    /**
     * Метод создает пользователя
     * @param object $registerForm
     * @param array $avatarPath
     * @return bool
     */
    public function create($registerForm, $avatarPath): bool
    {
        $user = new Users;
        $user->creation_time = date('Y-m-d G:i:s');
        $user->name = $registerForm->name;
        $user->email = $registerForm->email;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($registerForm->password);
        $user->avatar = '/uploads/avatar/' . $avatarPath['path'];
        return $user->save();
    }

    /**
     * Метод создает пользователя с вк
     * @param array $userAttributes
     * @return Users
     */
    public function createVk($userAttributes) :Users
    {
        $newUser = new Users();
        $newUser->creation_time = date("Y-m-d H:i:s");
        $newUser->name = $userAttributes["first_name"] . ' ' . $userAttributes["last_name"];
        $newUser->email = $userAttributes["email"];
        $newUser->password = Yii::$app->getSecurity()->generatePasswordHash('asdfgh');
        $newUser->vk_id = $userAttributes["user_id"];
        $newUser->save();
        return $newUser;
    }
}