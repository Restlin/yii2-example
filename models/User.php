<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name Наименование
 * @property string $email Email
 * @property int $dep_id Подразделение
 * @property string $password_hash
 * @property boolean $is_admin;
 *
 * @property Dep $dep
 */
class User extends \yii\db\ActiveRecord
{
    const TYPE_ADMIN = 1;
    const TYPE_TEACHER = 2;
    const TYPE_STUDENT = 3;
    
    public $password;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }
    
    public function beforeValidate() {
        if($this->password) {
            $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);            
        }
        return parent::beforeValidate();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'dep_id', 'is_admin'], 'required'],
            [['dep_id'], 'integer'],
            [['password'], 'string', 'max' => 20],
            [['name', 'email', 'password_hash'], 'string', 'max' => 100],            
            [['email'], 'unique'],
            [['is_admin'], 'boolean'],
            [['dep_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dep::class, 'targetAttribute' => ['dep_id' => 'id']],
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
            'email' => 'Email',
            'dep_id' => 'Подразделение',
            'password' => 'Пароль',
            'password_hash' => 'Хеш пароля',
            'is_admin' => 'Администратор',
        ];
    }

    /**
     * Gets query for [[Dep]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDep()
    {
        return $this->hasOne(Dep::class, ['id' => 'dep_id']);
    }
}
