<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property int $id
 * @property string $name Наименование
 *
 * @property UserRight[] $userRights
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код',
            'name' => 'Наименование',
        ];
    }

    /**
     * Gets query for [[UserRights]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserRights()
    {
        return $this->hasMany(UserRight::class, ['course_id' => 'id']);
    }
    
    public static function getList():array {
        $models = self::find()->orderBy('name')->all();
        $list = [];
        foreach($models as $model) {
            $list[$model->id] = $model->name;
        }
        return $list;
    }
}
