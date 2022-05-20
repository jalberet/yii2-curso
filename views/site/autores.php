<?php
use yii\bootstrap4\LinkPager;
?>
<h1>Listado de autores</h1>
<?php
foreach ($autores as $key => $value)
{
    echo $value->nombres."<br>";
}

echo LinkPager::widget([
    'pagination' => $pagination
])
?>