<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Libro;
use app\models\Pais;
use app\models\SignupForm;
use app\models\Autor;

class SiteController extends Controller
{
    
    //public $layout = "azul/main";
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        /*$model = new Pais();
        $model->pais = "Colombia";
        $model->slug = "colombia";
        $model->created_by = 1;
        $model->created_at = date('Y-m-d H:i:s');
        $model->updated_by = 1;
        $model->updated_at = date('Y-m-d H:i:s');
        $model->save();*/
        //$model->insert();
        
        /**
         * insert inserta siempre un registro
         * save valida si el registro existe lo actualiza, sino lo guarda
         * save llama al metodo validate de ActiveRecord
         */
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash(
                'success', 
                'Thank you for registration. Please check your inbox for verification email.'
            );
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        //$this->layout = "azul/main";
        return $this->render('about');
    }
    
    public function actionLibros(){
        $editorial = \app\models\Editorial::findOne(1);
        
        return $this->render('libros',[
            'editorial' => $editorial
        ]);
    }
    
    public function actionSaludo()
    {
        return "Hola mundo";
    }
    
    public function actionSumar($num1 = null, $num2 = null)
    {
        return $num1 + $num2;
    }
    
    public function actionSaludar($nombre)
    {
        $numeros = [1,2,3,4,5,6];
        return $this->render('saludar',[
            'nombre' => $nombre,
            'numeros' => $numeros
        ]);
    }
    
    public function actionMysql()
    {
        $libros = Libro::find()->all();
        return $this->render('mysql',
            [
                'libros' => $libros
            ]
        );
    }
    
    public function actionRbac()
    {
        $auth = \Yii::$app->authManager;
        $auth->removeAll();
        
        $crearPais = $auth->createPermission('pais-crear');
        $crearPais->description = "Permite insertar el registro de un país";
        $auth->add($crearPais);
        
        $actualizarPais = $auth->createPermission('pais-actualizar');
        $actualizarPais->description = "Permite actualizar el registro de un país";
        $auth->add($actualizarPais);
        
        $listarPais = $auth->createPermission('pais-listar');
        $listarPais->description = "Permite listar el registro de un país";
        $auth->add($listarPais);
        
        $eliminarPais = $auth->createPermission('pais-eliminar');
        $eliminarPais->description = "Permite eliminar el registro de un país";
        $auth->add($eliminarPais);
        
        $rolAdminPais = $auth->createRole("pais-admin");
        $auth->add($rolAdminPais);
        
        $auth->addChild($rolAdminPais, $crearPais);
        $auth->addChild($rolAdminPais, $actualizarPais);
        $auth->addChild($rolAdminPais, $listarPais);
        $auth->addChild($rolAdminPais, $eliminarPais);
        
        $auth->assign($rolAdminPais, 3);
        
        echo "Ook";
    }
    
    public function actionAutores()
    {
        $query = Autor::find();
        $pagination = new \yii\data\Pagination([
            'defaultPageSize' => 15,
            'totalCount' => $query->count()
        ]);
        $autores = $query->orderBy("id DESC")
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        
        return $this->render("autores", [
            "autores" => $autores,
            "pagination" => $pagination
        ]);
    }
    
    public function actionHelper() {
        return $this->render("helper");
    }
}
