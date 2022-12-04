<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dep}}`.
 */
class m221127_101149_create_dep_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dep}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('Наименование')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dep}}');
    }
}
