<?php

namespace app\models;

use Yii;
use app\models\Group;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property integer $id_group
 * @property string $date
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id_group'], 'integer'],
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'id_group' => 'Группа',
            'date' => 'Дата создания',
        ];
    }
    public function getGroup()
    {
        if($this->id_group != 0)
        {
            $group = Group::findOne($this->id_group);
            return $group->name;
        }else
        {
            return "Пользователь не состоит в группах";
        }
    }
    public function getDate()
    {
        return date('  H:i:s d-m-Y', strtotime($this->date));
    }
}
