<?php

namespace app\controllers;
use yii\web\Controller;
use app\models\Autor;
use app\models\User;
use app\models\Pais;
use yii\db\Expression;

/**
 * Description of SeederController
 *
 * @author MMG120
 */
class SeederController extends Controller{
    
    public function actionAutor() {
        $faker = \Faker\Factory::create("es_MX");
        for ($i = 0; $i < 50; $i++)
        {
            $user = User::find()->orderBy("rand()")->one();
            $pais = Pais::find()->orderBy("rand()")->one();
            
            $autor = new Autor;
            $autor->nombres = $faker->name;
            $autor->apellidos = $faker->lastName;
            $autor->slug = $faker->slug;
            $autor->pais_id = $pais->id;
            $autor->created_by = $user->id;
            $autor->created_at = new Expression("NOW()");
            $autor->updated_by = $user->id;
            $autor->updated_at = new Expression("NOW()");
            $autor->insert();
            echo "Autor $autor->nombres creado <br>";
        }
    }
}
