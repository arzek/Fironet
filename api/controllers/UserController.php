<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 19.10.2016
 * Time: 10:42
 */

namespace api\controllers;


use yii\rest\ActiveController;
use app\models\User;


class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function actionCreate_user()
    {
        if(!isset($_POST['name']) || !isset($_POST['token']) || $_POST['token'] != '$2y$13$j.XiqtNHgPkAurlyh6sjpONNJq5ufgKL7eA9ErY./C.B54wHnuo6q')
        {
            print  403;
        }else
        {
            $user = new User();
            $user->name = $_POST['name'];
            $user->save();

            return $user;
        }
    }
    public function actionDelete_user()
    {
        if(!isset($_POST['id']) || !isset($_POST['token']) || $_POST['token'] != '$2y$13$j.XiqtNHgPkAurlyh6sjpONNJq5ufgKL7eA9ErY./C.B54wHnuo6q')
        {
            print  403;
        }else
        {
            $user = User::findOne($_POST['id']);
            $user->delete();

            return "Ok";
        }
    }
}