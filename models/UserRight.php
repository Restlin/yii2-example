<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_right".
 *
 * @property int $id
 * @property int $user_id Пользователь
 * @property int $type Тип
 * @property int $course_id Курс
 *
 * @property Course $course
 * @property User $user
 */
class UserRight extends \yii\db\ActiveRecord
{
    /**
     * Преподаватель
     */
    const TYPE_TEACHER = 1;
    /**
     * Студент
     */
    const TYPE_STUDENT = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_right';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $rights = self::getTypeList();
        return [
            [['user_id', 'type', 'course_id'], 'required'],
            [['user_id', 'type', 'course_id'], 'default', 'value' => null],
            [['user_id', 'type', 'course_id'], 'integer'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::class, 'targetAttribute' => ['course_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['type'], 'in', 'range' => array_keys($rights)],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'type' => 'Тип',
            'course_id' => 'Курс',
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::class, ['id' => 'course_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    
    public static function getTypeList(): array {
        return [
            self::TYPE_TEACHER => 'Преподаватель',
            self::TYPE_STUDENT => 'Студент',
        ];
    }
}
