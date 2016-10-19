<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 19.10.2016
 * Time: 10:52
 */

namespace api\controllers;


use yii\rest\ActiveController;

class GroupController extends ActiveController
{
    public $modelClass = 'app\models\Group';
}