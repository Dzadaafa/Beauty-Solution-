<?php

namespace app\controllers;

use app\models\TransaksiPembelian;
use app\models\DetailPembelian;
use app\models\TransaksiPembelianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * TransaksiPembelianController implements the CRUD actions for TransaksiPembelian model.
 */
class TransaksiPembelianController extends Controller
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
                            'actions' => ['update', 'create' ],
                            'allow' => true,
                            'matchCallback' => function ($rule, $action) {
                                return Yii::$app->user->identity->role == 'user';
                            },
                        ],
                        [
                            'actions' => ['view', 'index'],
                            'allow' => true,
                            'roles' => ['@']
                        ],
                        [
                            'actions' => ['delete'],
                            'allow' => false
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
     * Lists all TransaksiPembelian models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TransaksiPembelianSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TransaksiPembelian model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $data = Yii::$app->db->createCommand('SELECT * FROM detail_pembelian where id_pembelian = :id')
        ->bindValue(':id', (int) $id)
        ->queryAll();
        return $this->render('view', [
            'model' => $this->findModel($id), // Main model data
            'data' => $data,                 // Additional detail_pembelian data
        ]);
    }

    /**
     * Creates a new TransaksiPembelian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    // public function actionCreate()
    // {
    //     $model = new TransaksiPembelian();

    //     if ($this->request->isPost) {
    //         if ($model->load($this->request->post()) && $model->save()) {
    //             return $this->redirect(['view', 'id' => $model->id]);
    //         }
    //     } else {
    //         $model->loadDefaultValues();
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionCreate()
    {
        $model = new TransaksiPembelian();

        if ($this->request->isPost) {
            $postData = $this->request->post('TransaksiPembelian');
            
            // Retrieve the jumlah_barang_masuk from POST data
            $jumlahBarangMasuk = $this->request->post('jumlah_barang_masuk');
            $idBarang = $this->request->post('id_barang');

            // Prepare data for the main table (TransaksiPembelian)
            $mainTableData = [
                'id' => $postData['id'],
                'id_owner' => $postData['id_owner'],
                'id_distributor' => $postData['id_distributor'],
                'jumlah_bayar' => $postData['jumlah_bayar'],
                'tanggal' => date('Y-m-d H:i:s'),
            ];

            // Prepare data for the second table (DetailPembelian), including jumlah_barang_masuk
            $detailTableData = [
                'id_barang' => $idBarang,
                'jumlah_barang_masuk' => $jumlahBarangMasuk,
            ];

            // Start a database transaction
            $transaction = Yii::$app->db->beginTransaction();
            try {
                // Assign data to the TransaksiPembelian model and validate
                $model->attributes = $mainTableData;

                if ($model->validate() && $model->save()) {
                    // Insert data into the second table (DetailPembelian) using Query Builder
                    Yii::$app->db->createCommand()->insert('detail_pembelian', [
                        // 'id_pembelian' => $mainTableData['id'], 
                        'id_barang' => $detailTableData['id_barang'],
                        'jumlah_barang_masuk' => $detailTableData['jumlah_barang_masuk'],
                        'harga_beli' => (int) $mainTableData['jumlah_bayar'] / (int) $detailTableData['jumlah_barang_masuk'],
                    ])->execute();

                    // Commit the transaction if both operations succeed
                    $transaction->commit();

                    Yii::$app->session->setFlash('success', 'Data transaksi berhasil disimpan.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    // Rollback if validation fails or saving the main model fails
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', 'Gagal menyimpan data. Periksa kembali input Anda.');
                }
            } catch (\Exception $e) {
                // Rollback the transaction in case of an exception
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Terjadi kesalahan: ' . $e->getMessage());
                throw $e;
            }
        } else {
            // Load default values if no POST data
            $model->loadDefaultValues();
        }

        // Render the view and pass the main model
        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing TransaksiPembelian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
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
     * Deletes an existing TransaksiPembelian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TransaksiPembelian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return TransaksiPembelian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransaksiPembelian::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
