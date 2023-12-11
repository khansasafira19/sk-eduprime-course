<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\assets\NiceAdminAsset;
use app\models\LatihanSiswa;
use app\models\Materi;
use app\models\MateriSearch;
use app\models\Pengguna;
use app\models\Ranking;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'index'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['contact', 'about', 'logout', 'theme'], // add all actions to take guest to login page
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
                // 'layout'=>'../layouts/main-error'
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
    // public function actionIndex()
    // {
    //     return $this->render('index');
    // }

    public function actionIndex()
    {
        // NiceAdminAsset::register($this->view);
        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-guest';
            return $this->render('index-guest');
        }

        $materipdf = Materi::find()->select('*')->where('jenis = 0')->andWhere('deleted = 0')->count();
        $materiyt = Materi::find()->select('*')->where('jenis = 1')->andWhere('deleted = 0')->count();
        $users = Pengguna::find()->select('*')->where('level = 1')->count();

        $dataProvider = new ActiveDataProvider([
            'query' => Ranking::find()
                ->select(['*', new Expression('(SELECT COUNT(*) + 1 FROM ranking AS r WHERE r.latihan = ranking.latihan AND r.skor > ranking.skor) AS ranking')])
                ->orderBy(['latihan' => SORT_ASC, 'ranking' => SORT_ASC])
        ]);

        $searchModel = new MateriSearch();
        $dataProviderMateri = $searchModel->search($this->request->queryParams);

        return $this->render(
            'index',
            [
                'materipdf' => $materipdf,
                'materiyt' => $materiyt,
                'users' => $users,
                'dataProvider' => $dataProvider,
                'dataProviderMateri' => $dataProviderMateri,
            ]
        );
    }
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'main-login';
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
        return $this->render('about');
    }
}
