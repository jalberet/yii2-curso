<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'email:email',
            //'verification_token',
            'status',
            //'created_at',
            //'updated_at',
//            [
//                'class' => ActionColumn::className(),
//                'urlCreator' => function ($action, User $model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'id' => $model->id]);
//                 }
//            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {estado}',
                'buttons' => [
                    'view' => function($url, $model){
                        return Html::a(
                            '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAZCAYAAADE6YVjAAAABmJLR0QA/wD/AP+gvaeTAAADk0lEQVRIie2UXWyTVRzGf+d9+7WWrdvYF1tbam3Z3BLAidOQqVSiEBKDcxgJH1dEvTBTshsx8aIXGBI1wC40zkQvYISgbsQLLhADqBEl4uISF7d2G9tK6VjHvrq2a9e+x4ulBUbmiLfwXJ1/zpPnOef/BY/wUEKsRPD5fErxuvXPaRrbgbVAmZCMSSGvK3CuZe9rV4UQ8n+ZtLe36+OW0rcEHAJsyypIBqUiDs8Eek74fD7tgU2OneysF0KcAmoA9DpVlhRaxwqtq+IFZrM2E4srk9OzqyZnomXpTCar0a0q2t6WPbv6VjQ5fursATT5GQKjXqdqdW7nYOPGOue1mbj+u1CEm4kUDrOR3fYyai3G+UvXekKBkZArnc4IkDHgwMF9zWeWNTnW0XlQII4CoqTIOtG8tTHPYDBYWv4a4POhm/c8RhHwQbWDw3VOovH4VNePvyrT0TkroAkpWt/b39SW5arZQ1tH1yEQnwDCWVUx8vpLz1fqdKrhY3+QI/3Bu2qggRBI4JeJGRxmI8+WFuVtWOcyBm9FwtFYogDBtm3Nu8fPd525lvvJ8Y7ON0CcBoRnbdXgjsaGxwEWNEn5ud+YSqUhlYQ/LsH0BJRUwKYtoOp4zGJiaHtD7g1nL165MRq+ZQMyCmLHu/uaflCOnvzeDeJLQDgqyoJZA4D+ufiiAcBwH0xFQEqIhGF0AIDrsXnC86mcSdOLm22VpavDgKohT7ed+Maha92/c+BKMFhhiiWvFlsLbgP2XGbu7n65dBTudOvSm/paj98TqxqaDge3eL3etAKw2W5P6BTt1anZ2SdCkduXs+TqfDOFet1i4KwBa/HiuagU7G4AHGYja0yGnMFoePznaCzuXMiou7xebzpXkyy6A4FakREXSgqtAVt5yQsAH/WN8mHv8B1SegF0+lz4xZMe3natWcxoaOzy9FzMLjVla32tayTLuW9O/uwdcCsqF8x5xqDbXrUJRN6b3X6+Hh67hyeAVo+NT9e7yGha1D9y4+9kcsEqlMzLG6urQ0u596G3N1icUpNfCSGeqixdHSotsjb8FJlRvg1FGJtPYcszssdextPF+Znxyanfxyam3FKT5w1a8p26urq5pXr/uSB7/gm8oiniCJKifIs5YDGZVINBZ0qmFhKxxLyMJRI1UjKqwPsbatwXl9NZcQsD9Pj9z2hS3YnEI5HlAsIC+jWhdNZXu3oeROMRHkL8CzeEXsl6UVRBAAAAAElFTkSuQmCC"/>',
                            $url,
                            [
                                'title' => 'Ver',
                            ]
                        );
                    },
                    'update' => function($url, $model){
                        return Html::a(
                            '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAZCAYAAADE6YVjAAAABmJLR0QA/wD/AP+gvaeTAAACF0lEQVRIie2UTUhUURTH/+fNc95kzVeCEDU00iAqJKOY6KJApGJ2FRHiMqFRxI+du5RaKLbQVjF9L9qUoBREIoLQog+GyCYoqykVRXQYUAYdZpr37mnjkxnGqJl5Cxf+V/fce+7/d7/OJRio0OCgsyQafUnApyNWaycNDAgAkI0CTMzMOH6xeTI+H064voTaV2IxFUAXAEhGADgAu+/HxXGZtw6ulnlOL1VVv2Yiuz5eMIQDsIMxpYiNpnM/L7tkLf5t1e2JHC0vbzMEwo/gAGMaQD0AFImYrXm+5cOaXWklvz+l51GhO9AB2xoHoYX8SKXn5gXJBZAFGQkmfJKgqyBy/A1wQI3Kl74315Ykvtr0vmVrU+S558VnjRQG8waIH/TUWyazICNvk5VkQgj/eNZnI35ULT/eicOOC3hV9gSCitLTVJOEk111yhzSDSUTNTBYBjBLRHd2A9hS4eJK67Nbm6WuxUORpRPrloqP08cf3mPJrOmrZeYOAF4hqBFAJoT1NmGh55T57m6Q4b6am2Olx+QrdYs2xKUh59bc9Y7Gwxl3MBpM+sDwcpp3ThVvVji0tmlpxZnkUyKI/52XE6T3xuwYAHT35zLLoG9lT0B2josAlQGA4b4d/H0tX0Nmdut+WRCh8TsyQQXgZeZAvpBtpZjEGz3IqPjR94nzkKiNmJz5ujPxuqTx/e4Gy1Qhq9zXvvaQ/gDlyr0Ln/sFXwAAAABJRU5ErkJggg=="/>',
                            $url,
                            [
                                'title' => 'Actualizar',
                            ]
                        );
                    },
                    'delete' => function($url, $model){
                        return Html::a(
                            '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAZCAYAAADE6YVjAAAABmJLR0QA/wD/AP+gvaeTAAACfklEQVRIidWUS0jUURSHv3Nn/qP4QMlnVBCRi9BWCW3yMUQLi6CgokVBimjYJggXBcEU7VrUplWDqzBqpRBhJOhGCArygRkmSFpBGmkiOK//PS10xBlnJifdeHb39zv3fvecw72wW6K8tb+Ctg9OOt/sBMQaU1uuy33F1waKU/myncPLOgYKNGbaUW0WqAYmjMqZn8GG6R2BlLYONIrIM2BfkjXnqh77HfR/iwvebQD6gJwkywUebARAhkoCV4fKbdRtNyLvA8/r+uJ6WcdAAVGZBkqBL6I8BQpVuInK5flgw+vks9IOXsNuJ8p9a7UlQY9KG1AqSvf8YlnNXLDxocX2irF1qQCQoV1qOIVCbp5n9FXX5KG4fndk7oKrMnGrZs+9Eq9nP02TAAsAHF/Ni2Gi51oOz8b3pGzX7fP9JY7PNweYoyfKyM3LcnTC4NmWKn98mbJdOTk+P2CcHI/NGgCI5ePG9SbI4zvvKrw+z3WAwiInlDUBsGSAvAyM+5yIM+W6ehLAl+9NeFRbDY/HDKeF/FoO17uqBW7MAlBQ5PT8ByNcEVn4nBZijW2KrLirhldiJZV5L7IlKIzVttdG00JEpS4aXoU4jpnK+zozAWQ1F0maxyaIqvRHQjbuvPUH/DHgU1YQ+Qdk6U/ojRuzCOAzbnDtasPJmzKF6ub8BMjKUqwKwOOYUGewfnRt20gWDLsSioxlhBjED2A8ZmJds1lVMnnpRvVyBoiKqvrX1O64KrkyDOhWCIJsmkcCJHBx6ADCXsCNLYSDcf30laol2GI1wmAqef1jGufH9yNa+Qj0YKDHv5iYZpsF80ThCJLiU1UJAb35M7NdW7rMro2/Livhs6NiAFYAAAAASUVORK5CYII="/>',
                            $url,
                            [
                                'title' => 'Eliminar'
                            ]
                        );
                    },
                    'estado' => function($url, $model){
                        if ($model->status == 10) {
                        return Html::a(
                                '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAZCAYAAADE6YVjAAAABmJLR0QA/wD/AP+gvaeTAAACmUlEQVRIid3Vv09TURTA8e+5fdZCrYlEQKHCbhwkEBgcIILO4J+gQe2ggcCgJkTERGICkQQDRv0fxMmkBAILGoriYJxVKJDWHwsUbPvecWgshb4WApOe8dxz7+f+OHkP/peQvQo22+pr0mraBbkEWgtyAvQXyFcVwh6jE6XhyNKBkPXWpkpFHwhcA6wia6REeelYVn8gPBfbN7LR1lCnal4DZ4rtcGfoilHtKJ1emN8TSVxsaHTEzAAl+we2p4uh2T85v1AQWW9tqgRdBE4fAPgbUfWm6gJvFuN/EyZ3VHEGDgkAVJuktz83kUU22+prBLm6e4YEAhzte4SUV+zMl1dk8oFAnqJoZ6KlKZiH2I51BZcu8nbdxWpuxTc8noWkvALf8DhWcyverrtupzliW9qRhyDa5ladfDaCE13GVAUpGXmBOXsO39A4piqIrq2SfDHqNg1RLuUjaI1bscZjbPWGcKLLSOUpSp48x1RngM3eELq26ooA2fVyECkrVK3xGL8f9UE6DR4P2DZbj+8XAwBOuiD8KFQt5RUcvfcQLAvsDOS7M4CcKtqIri38rRDgGxrfvqLuG9tXN/ysIKSi2fWyiKKTbsXem12Y6iDOyjKb3ddxPn/KvNFKBvJ23nI/h5pwHuLx8ApI7a5NjgySnp1iqyeExjPfP43H2OoJkZ6dIjky6EakPGomsreRO7JxsXFMhZD71vYfooz6p+dv550EwLGsfiB6SGPJduyB3MQOJBCeiwnaASQOCCRETfvxmfffCyIA/qlIBKMXKNBtRSIqaIt/+t2H3QN5CMCxychH9aYaBBnDpRl2RUqEp45tn/dPRSJuBXv+4xMtTUHbaLsIl4FaoAz4qaJfUBP2qJkonX572Hf8R+IPBavzcAE1LhcAAAAASUVORK5CYII="/>',
                                $url,
                                [
                                    'title' => 'Desactivar',
                                ]
                            );
                        }else{
                            return Html::a(
                                '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAZCAYAAADE6YVjAAAABmJLR0QA/wD/AP+gvaeTAAACr0lEQVRIid2VTU8TURSGnzv9klIW8qEUSkncWHZicAo0URfiGtwABdy4cuNvQP6ChpVLgRASxC1uXJFiG3UlEGP4bPlQNIHYYmd6rwtonTKlBZa+q5l7zj3Pec+9k4H/RaJSQiKVCBrIXpTqEUK0groK4pdSah2YdyDm9GZ981KQ2G7sOjnxHHgCOMvUMAS8MjVzNNIY2Ts3ZCEZb9eEfAu0lOuwuJJISURft//Oh4qQhe24rin5Hqg6N+Cf0gLuhZvCiTMhJyP6BPgvAcgrmRWu9rv+29/zC1pROKeNXQaQMTOkjXT+tdkts6PWeMFJIpUImuS+Uf6QbTrKHTGxNEVWGgyHotS4fQAGUt3oDHRuFTkxMR9dFJAxM7z+Msn27x2yuT9kZTYfcikh+vIvlnGJBxd1MLk8zU56l2pXNUOhQequ1BbimkZP/tnSuQiCKiqUUzmUUji1YoMZM8PE0hQ76V1q3D6GQ1HqquqKcpQiWMKJqrUm5aRk9uscU8vT1jHYHERDAzbAiertEMG+NWP/aJ/VgzXWDzeYWZnFlKblDLbxuat53DZEQ1VDKQCA/QoryYY145q3gejNftwON6sHq0yvzBRG5HNXMxIaOsvBSdOiUM/iRLw7nReoCRANDeBxeFg9WGMnvYvX5T0+5HIAAOS8DeJQvAEMG8jXzGCoH4/Dg9flZaQtWm5EeRnSlHOF/q2RxdTiuIKnpXYlD1N4nB7qKzoAIXgR9oef2ZwAmJo5CiRLbWyuaToXANh0KMeYdaEIEmmM7GnHX2qayymtkL0dTR0/zoQA6H49rkkRURTftnMoqQlxv6up6+PpgA0CoAf0z4ZwdaDUOCUuwykZSvDSieOW7tfjpRIq/uNjW7GAEKIXjYcKWlHUIvgJYg3kvDTlXHdLd8lz/P/0FwqoAohUH1w5AAAAAElFTkSuQmCC"/>',
                                $url,
                                [
                                    'title' => 'Activar',
                                ]
                            );
                        }
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if($action == "estado") {
                        return Url::to(['user/estado', 'id' => $key]);
                    }elseif($action == "update") {
                        return Url::to(['user/update', 'id' => $key]);
                    }elseif($action == "view") {
                        return Url::to(['user/view', 'id' => $key]);
                    }elseif($action == "delete") {
                        return Url::to(['user/delete', 'id' => $key]);
                    }
                }
            ]
        ],
    ]); ?>


</div>
