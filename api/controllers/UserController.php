<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 19.10.2016
 * Time: 10:42
 */

namespace api\controllers;


use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';
}