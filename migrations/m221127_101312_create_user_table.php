<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m221127_101312_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('Наименование'),
            'email' => $this->string(100)->notNull()->unique()->comment('Email'),
            'dep_id' => $this->integer()->notNull()->comment('Подразделение'),
        ]);
        
        $this->addForeignKey('fk_user_dep_id', 'user', 'dep_id', 'dep', 'id', 'CASCADE', 'CASCADE');
        
        $this->createIndex('idx_user_dep_id', 'user', 'dep_id');
        $this->createIndex('idx_user_email', 'user', 'email', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
