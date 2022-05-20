<?php

use yii\db\Migration;

/**
 * Class m220510_235944_seeder
 */
class m220510_235944_seeder extends Migration
{
    /**
     * {@inheritdoc}
     */
    /*public function safeUp()
    {

    }*/

    /**
     * {@inheritdoc}
     */
    /*public function safeDown()
    {
        echo "m220510_235944_seeder cannot be reverted.\n";

        return false;
    }

    */
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $faker = Faker\Factory::create("es_MX");
        $this->insert("user", [
            'username' => 'administrador',
            'password_hash' => Yii::$app->security->generatePasswordHash("admin"),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'email' => 'administrador@mail.com',
            'status' => 10,
            'created_at' => 1,
            'updated_at' => 1
        ]);
        
        for ($i = 0; $i < 50; $i++)
        {
            $this->insert("pais", [
                "pais" => $faker->country,
                "slug" => $faker->slug,
                "created_by" => 3,
                "created_at" => new \yii\db\Expression("NOW()"),
                "updated_by" => 3,
                "updated_at" => new \yii\db\Expression("NOW()")
            ]);
        }
    }

    public function down()
    {
        echo "m220510_235944_seeder cannot be reverted.\n";

        return false;
    }
    
}
