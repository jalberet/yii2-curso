<?php
echo "Hola $nombre";

foreach ($numeros as $numero){
    echo '<br>'.$numero;
}
?>
<br>
<?= $this->render("_footer"); ?>