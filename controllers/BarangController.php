<?php

namespace app\controllers;

use app\models\barang;
use app\models\barangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * BarangController implements the CRUD actions for barang model.
 */
class BarangController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => \yii\filters\AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['view', 'index','update', 'delete', 'create' ],
                            'allow' => true,
                            'matchCallback' => function ($rule, $action) {
                                return Yii::$app->user->identity->role == 'admin';
                            },
                        ],
                    ],
                ],
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
     * Lists all barang models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new barangSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single barang model.
     * @param int $id_barang Id Barang
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_barang)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_barang),
        ]);
    }

    /**
     * Creates a new barang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new barang();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_barang' => $model->id_barang]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing barang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_barang Id Barang
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_barang)
    {
        $model = $this->findModel($id_barang);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_barang' => $model->id_barang]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing barang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_barang Id Barang
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_barang)
    {
        $this->findModel($id_barang)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the barang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_barang Id Barang
     * @return barang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_barang)
    {
        if (($model = barang::findOne(['id_barang' => $id_barang])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
