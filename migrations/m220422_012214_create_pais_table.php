<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pais}}`.
 */
class m220422_012214_create_pais_table extends Migration
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
        $this->createTable('{{%pais}}', [
            'id' => $this->primaryKey(),
            'pais' => $this->string(155)->notNull(),
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
        $this->dropTable('{{%pais}}');
    }
}
