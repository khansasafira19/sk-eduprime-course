<?php

namespace app\controllers;

use app\models\LatihanSoal;
use app\models\LatihanSoalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * LatihanSoalController implements the CRUD actions for LatihanSoal model.
 */
class LatihanSoalController extends Controller
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
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        /* Untuk pj fungsi dan superadmin. */
                        'actions' => ['create', 'view',  'findModel', 'update', 'index', 'delete'],
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
     * Lists all LatihanSoal models.
     *
     * @return string
     */
    public function actionIndex($id)
    {
        $searchModel = new LatihanSoalSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->where('induk_latihan = ' . $id);


        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single LatihanSoal model.
     * @param int $id_latihan_soal Id Latihan Soal
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_latihan_soal)
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $this->findModel($id_latihan_soal),
            ]);
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id_latihan_soal),
            ]);
        }
    }

    /**
     * Creates a new LatihanSoal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new LatihanSoal();

        if ($this->request->isPost) {
            // if ($model->load($this->request->post()) && $model->save()) {
            //     return $this->redirect(['view', 'id_latihan_soal' => $model->id_latihan_soal]);
            // }
            if ($model->load($this->request->post())){
                $model->owner = Yii::$app->user->identity->username;
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', "Soal berhasil ditambahkan.<br/> Terima kasih..");
                    return $this->redirect(['view', 'id_latihan_soal' => $model->id_latihan_soal]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LatihanSoal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_latihan_soal Id Latihan Soal
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_latihan_soal)
    {
        $model = $this->findModel($id_latihan_soal);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $affected_rows = LatihanSoal::updateAll(['timestamp_soal' => date('Y-m-d H:i:s'), 'owner' => Yii::$app->user->identity->username], 'id_latihan_soal = "' . $id_latihan_soal . '"');
            if ($model->save() && $affected_rows != 0) {
                Yii::$app->session->setFlash('success', "Soal berhasil diupdate.<br/> Terima kasih..");
                return $this->redirect(['view', 'id_latihan_soal' => $model->id_latihan_soal]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LatihanSoal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_latihan_soal Id Latihan Soal
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_latihan_soal)
    {
        $this->findModel($id_latihan_soal)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LatihanSoal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_latihan_soal Id Latihan Soal
     * @return LatihanSoal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_latihan_soal)
    {
        if (($model = LatihanSoal::findOne(['id_latihan_soal' => $id_latihan_soal])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
