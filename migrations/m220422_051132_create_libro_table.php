<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%libro}}`.
 */
class m220422_051132_create_libro_table extends Migration
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
        $this->createTable('{{%libro}}', [
            'id' => $this->primaryKey(),
            'titulo' => $this->string(155)->notNull(),
            'slug' => $this->string(155)->notNull(),
            'autor_id' => $this->integer(),
            'editorial_id' => $this->integer(),
            'publicado_en' => $this->date(),
            'created_by' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->dateTime()
        ], $options);
        
        $this->addForeignKey('autor_libro', 'libro', 'autor_id', 'autor', 'id', 'no action', 'no action');
        $this->addForeignKey('editorial_libro', 'libro', 'editorial_id', 'editorial', 'id', 'no action', 'no action');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%libro}}');
    }
}
