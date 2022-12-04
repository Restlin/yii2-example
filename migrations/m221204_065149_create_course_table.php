<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%course}}`.
 */
class m221204_065149_create_course_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%course}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text(100)->notNull()->comment('Наименование'),            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%course}}');
    }
}
