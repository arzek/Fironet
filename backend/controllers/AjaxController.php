<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 18.10.2016
 * Time: 22:15
 */

namespace backend\controllers;


use app\models\Group;
use yii\web\Controller;
use app\models\User;

class AjaxController extends Controller
{
    public function actionFree_user()
    {
        $free_users = User::find()->where(['id_group' => 0])->all();

        $str = '';

        if($free_users)
        {
            foreach ($free_users as $user) {
                $str .= "<option value='$user->id'>$user->name</option>";
            }

            echo json_encode([1,$str]);
        }else
        {
            $str .= "<option value='0'>Свободных пользователей не найдено</option>";
            echo json_encode([0,$str]);
        }



    }

    public function actionAdd_user_for_group()
    {
        $user = User::findOne($_POST['id_user']);
        $user->id_group = $_POST['id_group'];
        $user->save();

        echo json_encode(['id' => $user->id, 'name' => $user->name]);
    }

    public function actionDelete_user_for_group()
    {
        $user = User::findOne($_POST['id_user']);
        $user->id_group = 0;
        $user->save();


        print $user->id;
    }

    public function actionDelete_group()
    {
        $users = User::find()->where(['id_group' => $_POST['id_group']])->all();
        if(!$users)
        {
            $group = Group::findOne($_POST['id_group']);
            $group-> delete();
            print 1;
        }else
        {
            print 0;
        }

    }
}