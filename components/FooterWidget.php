<?php
namespace app\components;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * Description of FooterWidget
 *
 * @author MMG120
 */
class FooterWidget extends Widget{
    
    public $mensaje;


    public function init() {
        parent::init();
    }
    
    public function run(){
        return $this->render("footer");
    }
}
