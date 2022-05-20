<?php

namespace app\controllers;

use app\models\Pais;
use app\models\PaisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * PaisController implements the CRUD actions for Pais model.
 */
class PaisController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Pais models.
     *
     * @return string
     */
    public function actionIndex()
    {
        var_dump("Hola");
        if (!Yii::$app->user->can('pais-listar')) {
            throw new ForbiddenHttpException("No tiene los permisos necesarios");
        }
        $searchModel = new PaisSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pais model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pais model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Pais();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->save()) {
                    \Yii::$app->session->setFlash("success", "Registro guardado");
                }else{
                    \Yii::$app->session->setFlash("Error", "Registro no guardado");
                }
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pais model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pais model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pais model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Pais the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pais::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    //FUNCIONES UTILES :: CURSO
    
    public function actionListar()
    {
        $model = Pais::find()->all();
        
        return $this->render('listar',[
            'model' => $model
        ]);
    }
    
    public function actionActualizar($id)
    {
        $model = $this->getPais($id);
        $model->pais = "Ciudad de México";
        $model->update();
        
        return $this->redirect('listar');
    }
    
    public function actionEliminar($id)
    {
        $model = $this->getPais($id);
        $model->delete();
        return $this->redirect('listar');
    }
    
    public function getPais($id)
    {
        $model = Pais::findOne($id);
        return $model;
    }
    
    public function actionConsultas()
    {
        $connection = Yii::$app->db;
        $query = $connection->createCommand('select * from pais');
        //$rows = $query->queryAll();
        //$rows = $query->queryOne();
        $rows = $query->queryColumn();


        
        echo '<pre>';
        print_r($rows);
    }
}
