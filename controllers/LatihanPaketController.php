<?php

namespace app\controllers;

use app\models\LatihanPaket;
use app\models\LatihanPaketSearch;
use app\models\LatihanSoal;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LatihanPaketController implements the CRUD actions for LatihanPaket model.
 */
class LatihanPaketController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        /* Untuk guests */
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        /* Untuk user yang login. */
                        'actions' => ['view',  'findModel', 'index', 'preview'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        /* Untuk pj fungsi dan superadmin. */
                        'actions' => ['create', 'delete', 'update',],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return !\Yii::$app->user->isGuest && (\Yii::$app->user->identity->level === 0);
                        },
                    ],
                ],
            ],
        ];
    }


    /**
     * Lists all LatihanPaket models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LatihanPaketSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LatihanPaket model.
     * @param int $id_latihan_paket Id Latihan Paket
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_latihan_paket)
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $this->findModel($id_latihan_paket),
            ]);
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id_latihan_paket),
            ]);
        }
    }

    /**
     * Creates a new LatihanPaket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new LatihanPaket();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_latihan_paket' => $model->id_latihan_paket]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LatihanPaket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_latihan_paket Id Latihan Paket
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_latihan_paket)
    {
        $model = $this->findModel($id_latihan_paket);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_latihan_paket' => $model->id_latihan_paket]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LatihanPaket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_latihan_paket Id Latihan Paket
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_latihan_paket)
    {
        $this->findModel($id_latihan_paket)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LatihanPaket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_latihan_paket Id Latihan Paket
     * @return LatihanPaket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_latihan_paket)
    {
        if (($model = LatihanPaket::findOne(['id_latihan_paket' => $id_latihan_paket])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPreview($id)
    {
        $model = $this->findModel($id);
        $jumlahsoal = LatihanSoal::find('*')->where('induk_latihan = ' . $id)->count();
        $title = LatihanPaket::findOne(['id_latihan_paket' => $id]);
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('preview', [
                'jumlahsoal' => $jumlahsoal,
                'model' => $model,
                'time' => $title->waktu_menit
            ]);
        } else {
            return $this->render('preview', [
                'jumlahsoal' => $jumlahsoal,
                'model' => $model,
                'time' => $title->waktu_menit
            ]);
        }
    }
}
