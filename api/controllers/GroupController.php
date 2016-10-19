<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 19.10.2016
 * Time: 10:52
 */

namespace api\controllers;


use yii\rest\ActiveController;
use app\models\Group;
use app\models\User;

class GroupController extends ActiveController
{
    public $modelClass = 'app\models\Group';

    public function actionCreate_group()
    {

        if(!isset($_POST['name']) || !isset($_POST['token']) || $_POST['token'] != '$2y$13$j.XiqtNHgPkAurlyh6sjpONNJq5ufgKL7eA9ErY./C.B54wHnuo6q')
        {
            print  403;
        }else
        {
            $user = new Group();
            $user->name = $_POST['name'];
            $user->save();

            return $user->id;
        }
    }
    public function actionAdd_user()
    {
        if( !isset($_POST['id_user']) || !isset($_POST['id_group']) || !isset($_POST['token']) || $_POST['token'] != '$2y$13$j.XiqtNHgPkAurlyh6sjpONNJq5ufgKL7eA9ErY./C.B54wHnuo6q')
        {
            print  403;
        }else
        {
            $user = User::findOne($_POST['id_user']);
            if(!$user)
            {
                echo "User not found";
                die;
            }else if($user->id_group != 0)
            {
                echo "User already in group";
                die;
            }

            $group = Group::findOne($_POST['id_group']);
            if(!$group)
            {
                echo "Group not found";
                die;
            }

            $user->id_group = $group->id;
            $user->save();

            return "OK";
        }
    }
    public function actionDelete_user()
    {
        if( !isset($_POST['id_user']) || !isset($_POST['id_group']) || !isset($_POST['token']) || $_POST['token'] != '$2y$13$j.XiqtNHgPkAurlyh6sjpONNJq5ufgKL7eA9ErY./C.B54wHnuo6q')
        {
            print  403;
            die;
        }

        $user = User::findOne($_POST['id_user']);
        if(!$user)
        {
            echo "User not found";
            die;
        }

        $group = Group::findOne($_POST['id_group']);
        if(!$group)
        {
            echo "Group not found";
            die;
        }

        if($user->id_group != $group->id)
        {
            echo "User is not in this group";
            die;
        }

        $user->id_group = 0;
        $user->save();

        return "OK";
    }
    public function actionDelete_group()
    {
        if( !isset($_POST['id_group']) || !isset($_POST['token']) || $_POST['token'] != '$2y$13$j.XiqtNHgPkAurlyh6sjpONNJq5ufgKL7eA9ErY./C.B54wHnuo6q')
        {
            print  403;
        }else
        {
            $group = Group::findOne($_POST['id_group']);
            if(!$group)
            {
                echo "Group not found";
                die;
            }

            $users = User::find()->where(['id_group' => $_POST['id_group']])->all();

            if(count($users))
            {
                echo "In this group are users";
                die;
            }else
            {
                $group->delete();
                return "OK";
            }
        }
    }
    public function actionUpdate_group()
    {
        if(!isset($_POST['name_group']) || !isset($_POST['id_group']) || !isset($_POST['token']) || $_POST['token'] != '$2y$13$j.XiqtNHgPkAurlyh6sjpONNJq5ufgKL7eA9ErY./C.B54wHnuo6q')
        {
            print  403;
        }else
        {
            $group = Group::findOne($_POST['id_group']);
            if(!$group)
            {
                echo "Group not found";
                die;
            }

            $group->name = $_POST['name_group'];
            $group->save();
            print "OK";
        }
    }
}