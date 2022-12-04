<?php

use yii\db\Migration;

/**
 * Class m221130_170157_add_is_admin_to_user
 */
class m221130_170157_add_is_admin_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'is_admin', $this->boolean()->defaultValue(false)->notNull()->comment('Администратор'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'is_admin');
    }    
}
