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


}
