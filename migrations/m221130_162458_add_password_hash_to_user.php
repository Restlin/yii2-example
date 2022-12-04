<?php

use yii\db\Migration;

/**
 * Class m221130_162458_add_password_hash_to_user
 */
class m221130_162458_add_password_hash_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'password_hash', $this->string(100)->null()->comment('Хэш пароля'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'password_hash');
    }
}
