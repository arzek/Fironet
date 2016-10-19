<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property integer $id
 * @property string $name
 * @property string $date
 *
 * @property User[] $users
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }


    public function fields()
    {
        return [

            'id',

            'name',


            'date' => function(){
                return $this->getDate();
            }
        ];
    }

    public function getDate()
    {
        return date('  H:i:s d-m-Y', strtotime($this->date));
    }
}
