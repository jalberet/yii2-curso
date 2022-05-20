<?php
namespace app\models;
use app\models\Editorial;
use yii\db\ActiveRecord;

class Libro extends ActiveRecord{
    
    public static function tableName() {
        return "libro";
    }
    
    public static function primaryKey() {
        return ["id"];
    }
    
    //HACER UNA RELACION DE UNO A UNO
    public function getEditorial() {
        return $this->hasOne(Editorial::className(), ['id' => 'editorial_id']);
    }
    
    public function getTituloPersonalizado(){
        return "El titulo del libro es: $this->titulo";
    }
}