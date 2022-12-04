<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dep".
 *
 * @property int $id
 * @property string $name Наименование
 *
 * @property User[] $users
 */
class Dep extends \yii\db\ActiveRecord
{
    /**
     * Рабочий
     */
    const TYPE_WORK = 1;
    /**
     * Выходной
     */
    const TYPE_WEEKEND = 2;
    /**
     * Праздник, только из календаря, руками вводим! @todo увижу - коммит будете переделывать
     */
    const TYPE_HOLYDAY = 3;
    /**
     * Предпраздник
     */
    const TYPE_BEFORE_HOLYDAY = 4;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dep';
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
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['dep_id' => 'id']);
    }
    
    public static function getList(): array {
        $models = self::find()->orderBy('name')->all();
        $list = [];
        foreach($models as $model) {
            $list[$model->id] = $model->name;
        }
        return $list;
    }
    
    /*public static function getTypeList(bool $withCalendarType = true): array {
        $types = [
            self::TYPE_WORK => 'рабочий',
            self::TYPE_WEEKEND => 'выходной',
            self::TYPE_HOLYDAY => 'праздник',
            self::TYPE_BEFORE_HOLYDAY => 'предпраздник',
        ];
        if(!$withCalendarType) {
            unset($types[self::TYPE_HOLYDAY]);
            unset($types[self::TYPE_BEFORE_HOLYDAY]);
        }
        return $types;
    }*/
}
