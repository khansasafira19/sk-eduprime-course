<?php

namespace app\controllers;

use app\models\LatihanPaket;
use app\models\LatihanSiswa;
use app\models\LatihanSiswaRinci;
use app\models\LatihanSiswaRinciSearch;
use app\models\LatihanSiswaSearch;
use app\models\LatihanSoal;
use app\models\Ranking;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LatihanSiswaController implements the CRUD actions for LatihanSiswa model.
 */
class LatihanSiswaController extends Controller
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
                        'actions' => ['findModel', 'index', 'dotest', 'rank', 'detail', 'detailrinci'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        /* Untuk pj fungsi dan superadmin. */
                        'actions' => ['delete'],
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
     * Lists all LatihanSiswa models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LatihanSiswaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LatihanSiswa model.
     * @param int $id_latihan_siswa Id Latihan Siswa
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_latihan_siswa)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_latihan_siswa),
        ]);
    }

    /**
     * Creates a new LatihanSiswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new LatihanSiswa();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_latihan_siswa' => $model->id_latihan_siswa]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LatihanSiswa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_latihan_siswa Id Latihan Siswa
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_latihan_siswa)
    {
        $model = $this->findModel($id_latihan_siswa);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_latihan_siswa' => $model->id_latihan_siswa]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LatihanSiswa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_latihan_siswa Id Latihan Siswa
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionDelete($id_latihan_siswa)
    // {
    //     $this->findModel($id_latihan_siswa)->delete();

    //     return $this->redirect(['index']);
    // }

    public function actionDelete($id_latihan_siswa)
    {
        $model = $this->findModel($id_latihan_siswa);
        $affected_rows = LatihanSiswa::updateAll(['deleted' => 1, 'timestamp_deleted' => date('Y-m-d H:i:s')], 'id_latihan_siswa = "' . $id_latihan_siswa . '"');
        if ($affected_rows == 0) {
            Yii::$app->session->setFlash('warning', "Gagal. Mohon hubungi Admin.");
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('success', "Latihan tersebut berhasil dihapus. Terima kasih.");
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the LatihanSiswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_latihan_siswa Id Latihan Siswa
     * @return LatihanSiswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_latihan_siswa)
    {
        if (($model = LatihanSiswa::findOne(['id_latihan_siswa' => $id_latihan_siswa])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDotest($id)
    {
        $this->layout = 'main-dotest';
        $questions = LatihanSoal::find()->where('induk_latihan = ' . $id)->all();

        if (empty($questions))
            throw new NotFoundHttpException('The requested page does not exist.');

        $answers = new LatihanSiswa();

        $title = LatihanPaket::findOne(['id_latihan_paket' => $id]);
        if ($answers->load(Yii::$app->request->post()) && $answers->validate()) {
            // Calculate the score based on the user's answers
            $score = 0;
            if (!empty($answers->answer)) {
                foreach ($questions as $question) {
                    $questionId = $question->id_latihan_soal;
                    $studentsanswers = new LatihanSiswaRinci();
                    // $studentsanswers->latihan_siswa = 1;
                    // Get the latest ID of the LatihanSiswa table
                    $latestId = Yii::$app->db->createCommand('SELECT MAX(id_latihan_siswa) FROM latihan_siswa')->queryScalar();

                    // Set the latihan_siswa property of the $studentsanswers object
                    $studentsanswers->latihan_siswa = $latestId + 1;

                    $studentsanswers->latihan_soal = $questionId;
                    if (isset($answers->answer[$questionId])) {
                        // user has answered the question
                        $studentsanswers->user_choice = $answers->answer[$questionId];
                    } else {
                        // user has not answered the question
                        $studentsanswers->user_choice = 0; // or any other default value you want to use
                    }
                    $studentsanswers->save();

                    if (isset($answers->answer[$questionId]) && $answers->answer[$questionId] == $question->correct_choice) {
                        $score++;
                    }
                }
            }
            $jumlah = count($questions);
            $penimbang = 100 / $jumlah;
            $score = $score * $penimbang; // dikali penimbang soal.

            // Save the user's name, timestamp, and score to the database
            $answers->latihan = $id;
            $answers->siswa = Yii::$app->user->identity->username;
            $answers->timestamp_siswa = date('Y-m-d H:i:s');
            $answers->skor = $score;
            // Check if the button was clicked
            if (isset($_POST['user_pilih_selesai'])) {
                $answers->selesai = 1;
            } else {
                $answers->selesai = 0;
            }
            $answers->save();

            return $this->render('result', [
                'score' => $score,
                'totalQuestions' => count($questions),
            ]);
        }

        return $this->render('dotest', [
            'questions' => $questions,
            'answers' => $answers,
            'title' => $title->judul,
            'time' => $title->waktu_menit,
        ]);
    }

    public function actionRank()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Ranking::find()
                ->select(['*', new Expression('(SELECT COUNT(*) + 1 FROM ranking AS r WHERE r.latihan = ranking.latihan AND r.skor > ranking.skor) AS ranking')])
                ->orderBy(['latihan' => SORT_ASC, 'ranking' => SORT_ASC])
        ]);

        return $this->render('rank', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDetail($id_latihan_siswa)
    {
        $searchModel = new LatihanSiswaRinciSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->where('latihan_siswa = ' . $id_latihan_siswa);

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('detail', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->render('detail', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionDetailrinci($id_latihan_siswa_rinci)
    {
        $model = LatihanSiswaRinci::findOne(['id_latihan_siswa_rinci' => $id_latihan_siswa_rinci]);
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('detailrinci', [
                'model' => $model,
            ]);
        } else {
            return $this->render('detailrinci', [
                'model' => $model,
            ]);
        }
    }
}
