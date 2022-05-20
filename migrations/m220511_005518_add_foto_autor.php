<?php

use yii\db\Migration;

/**
 * Class m220511_005518_add_foto_autor
 */
class m220511_005518_add_foto_autor extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("autor", "foto", "string(100)");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("autor", "foto");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220511_005518_add_foto_autor cannot be reverted.\n";

        return false;
    }
    */
}
