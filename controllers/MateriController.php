<?php

namespace app\controllers;

use app\models\Materi;
use app\models\MateriSearch;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MateriController implements the CRUD actions for Materi model.
 */
class MateriController extends Controller
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
                        'actions' => ['index', 'viewpdf'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        /* Untuk pj fungsi dan superadmin. */
                        'actions' => ['create',  'findModel', 'update', 'delete', 'aktifkanlagi','view', ],
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
     * Lists all Materi models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MateriSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Materi model.
     * @param int $id_materi Id Materi
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_materi)
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $this->findModel($id_materi),
            ]);
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id_materi),
            ]);
        }
    }

    public function actionViewpdf($id_materi)
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('viewpdf', [
                'model' => $this->findModel($id_materi),
            ]);
        } else {
            return $this->render('viewpdf', [
                'model' => $this->findModel($id_materi),
            ]);
        }
    }

    /**
     * Creates a new Materi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Materi();

        Yii::$app->params['uploadPath'] = Yii::getAlias("@app") . '/pdf/materi';

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->owner = Yii::$app->user->identity->username;
            if ($model->jenis == 0) {
                $query = new Query();
                $query->select('id_materi')->from('materi')->orderBy(['id_materi' => SORT_DESC])->limit(1);
                $latestId = $query->scalar();
                $path = Yii::$app->params['uploadPath'] . '/' . ($latestId + 1) . '.' . UploadedFile::getInstance($model, 'filepdf')->extension;
                $model->filename_link = null;
            }

            if ($model->save()) {
                if ($model->jenis == 0)
                    UploadedFile::getInstance($model, 'filepdf')->saveAs($path);
                return $this->redirect(['view', 'id_materi' => $model->id_materi]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Materi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_materi Id Materi
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_materi)
    {
        $model = $this->findModel($id_materi);

        if (Yii::$app->user->identity->username != $model->owner) {
            Yii::$app->session->setFlash('warning', "Hanya yang menginput materi yang dapat mengupdatenya. Terima kasih.");
            return $this->redirect(['index']);
        }
        Yii::$app->params['uploadPath'] = Yii::getAlias("@app") . '/pdf/materi';

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->jenis == 0) {
                $path = Yii::$app->params['uploadPath'] . '/' . ($model->id_materi) . '.' . UploadedFile::getInstance($model, 'filepdf')->extension;
                $model->filename_link = null;
            }
            if ($model->save()) {
                if ($model->jenis == 0)
                    UploadedFile::getInstance($model, 'filepdf')->saveAs($path);
                elseif ($model->jenis == 1 && file_exists(Yii::getAlias('@webroot/pdf/materi/' . $model->id_materi . '.pdf')))
                    unlink(Yii::$app->params['uploadPath'] . '/' . ($model->id_materi) . '.pdf');
                return $this->redirect(['view', 'id_materi' => $model->id_materi]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Materi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_materi Id Materi
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionDelete($id_materi)
    // {
    //     $this->findModel($id_materi)->delete();

    //     return $this->redirect(['index']);
    // }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->user->identity->username != $model->owner) {
            Yii::$app->session->setFlash('warning', "Hanya yang menginput materi yang dapat menghapusnya. Terima kasih.");
            return $this->redirect(['index']);
        }
        $affected_rows = Materi::updateAll(['deleted' => 1, 'timestamp_lastupdate' => date('Y-m-d H:i:s')], 'id_materi = "' . $id . '"');

        if ($affected_rows == 0) {
            Yii::$app->session->setFlash('success', "Gagal.");
            return $this->redirect('view', [
                'id' => $id,
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('success', "Materi berhasil di-nonaktifkan. Terima kasih.");
            return $this->redirect(['index']);
        }
    }

    public function actionAktifkanlagi($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->user->identity->username != $model->owner) {
            Yii::$app->session->setFlash('warning', "Hanya yang menginput materi yang dapat mengaktifkan kembali. Terima kasih.");
            return $this->redirect(['index']);
        }
        $affected_rows = Materi::updateAll(['deleted' => 0, 'timestamp_lastupdate' => date('Y-m-d H:i:s')], 'id_materi = "' . $id . '"');

        if ($affected_rows == 0) {
            Yii::$app->session->setFlash('success', "Gagal.");
            return $this->redirect('view', [
                'id' => $id,
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('success', "Materi berhasil diaktifkan kembali. Terima kasih.");
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Materi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_materi Id Materi
     * @return Materi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_materi)
    {
        if (($model = Materi::findOne(['id_materi' => $id_materi])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
