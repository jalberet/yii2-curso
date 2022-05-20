<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace app\models;
use app\models\Libro;
use yii\db\ActiveRecord;

/**
 * Description of Editorial
 *
 * @author MMG120
 */
class Editorial extends ActiveRecord{
    
    public static function tableName() {
        return "editorial";
    }
    
    public static function primaryKey() {
        return ['id'];
    }
    
    //RELACION UNO A MUCHOS
    public function getLibros(){
        return $this->hasMany(Libro::className(), ['editorial_id' => 'id']);
    }
}
