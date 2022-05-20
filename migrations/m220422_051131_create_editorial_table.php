<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%editorial}}`.
 */
class m220422_051131_create_editorial_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = null;
        if($this->db->driverName == 'mysql'){
            $options = 'CHARACTER SET utf8 COLLATE utf8_spanish_ci ENGINE=innodb';
        }
        $this->createTable('{{%editorial}}', [
            'id' => $this->primaryKey(),
            'editorial' => $this->string(155)->notNull(),
            'slug' => $this->string(155)->notNull(),
            'created_by' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->dateTime()
        ], $options);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%editorial}}');
    }
}
