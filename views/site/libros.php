<?php
//echo "<pre>";
foreach ($editorial->libros as $key => $value)
{
    echo $value->titulo . ' - '. $value->editorial->editorial .  '<br>';
    echo $value->tituloPersonalizado.'<br>';
}