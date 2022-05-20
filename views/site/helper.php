<?php
use app\components\SaludoWidget;
use app\components\FooterWidget;
?>

<?= SaludoWidget::widget() ?>
<br>

<?= SaludoWidget::widget(
        ['mensaje' => 'Hola desde mi primer widget']
) ?>

<?php 
FooterWidget::begin();
FooterWidget::end();
?>