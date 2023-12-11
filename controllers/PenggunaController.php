<?php

namespace app\controllers;

use Yii;
use app\models\Pengguna;
use app\models\PenggunaCari;
use app\models\ResetPasswordForm;
use app\models\ResetPasswordProceedForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\UploadedFile;
use Exception;

/**
 * PenggunaController implements the CRUD actions for Pengguna model.
 */
// Yii::$app->params['uploadPath'] = Yii::getAlias("@app") . '/suratket';

class PenggunaController extends Controller
{

    /**
     * {@inheritdoc}
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
                        'actions' => ['error', 'create', 'resetpassword', 'resetpasswordproceed', 'confirmemail'],
                        'allow' => true,
                    ],
                    [
                        /* Untuk user yang login. */
                        'actions' => ['ubahpassword', 'view',  'findModel', ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        /* Untuk pj fungsi dan superadmin. */
                        'actions' => ['index', 'delete', 'update', 'aktifkanlagi', 'approverevokelevel'],
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
     * Lists all Pengguna models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenggunaCari();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pengguna model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /* public function actionView($id) {
      return $this->render('view', [
      'model' => $this->findModel($id),
      ]);
      } */

    /**
     * Creates a new Pengguna model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        $this->layout = 'main-login';
        $model = new Pengguna();

        if ($model->load(Yii::$app->request->post())) {
            $model->nama = ucwords($_POST['Pengguna']['nama']);
            $model->level = 3;
            $model->tgl_daftar = date('Y-m-d H:i:s');

            if (!Yii::$app->user->isGuest) {
                // User is logged in, skip confirmation
                $model->level = 1;
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', "Data berhasil direkam.<br/> Terima kasih..");
                    return $this->redirect(['site/index']);
                }
            } else {
                // User is not logged in, generate confirmation token and send email
                $model->email_confirm_token = Yii::$app->security->generateRandomString();

                if ($model->save()) {
                    Yii::$app->mailer->compose('confirmEmail', ['token' => $model->email_confirm_token,  'email' => $model->email])
                        ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name . ' -noreply'])
                        ->setTo($model->email)
                        ->setSubject('Aktivasi Akun Eduprime Course')
                        ->send();

                    Yii::$app->session->setFlash('success', "Silahkan akses email Anda untuk aktivasi akun.<br/> Terima kasih..");
                    return $this->redirect(['site/login']);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionConfirmemail($token)
    {
        $model = Pengguna::findOne(['email_confirm_token' => $token]);
        if ($model !== null) {
            Yii::$app->db->createCommand()
                ->update('pengguna', [
                    'level' => 1,
                    'email_confirm_token' => NULL,
                ], 'username = "' . $model->username . '"')
                ->execute();
            $model->save(false);
            Yii::$app->session->setFlash('success', 'Aktivasi akun berhasil. Silahkan login.');
        } else {
            Yii::$app->session->setFlash('error', 'Token aktivasi sudah invalid.');
        }
        return $this->redirect(['site/login']);
    }


    /**
     * Updates an existing Pengguna model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $affected_rows = Pengguna::updateAll(['tgl_update' => date('Y-m-d H:i:s')], 'username = "' . $id . '"');
            if ($model->save() && $affected_rows != 0) {
                Yii::$app->session->setFlash('success', "Data berhasil diupdate.<br/> Terima kasih..");
                return $this->redirect(['view', 'id' => $model->username]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pengguna model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->level == 1)
            $affected_rows = Pengguna::updateAll(['level' => 2, 'tgl_update' => date('Y-m-d H:i:s')], 'username = "' . $id . '"');
        else
            $affected_rows = Pengguna::updateAll(['level' => 1, 'tgl_update' => date('Y-m-d H:i:s')], 'username = "' . $id . '"');
        if ($affected_rows == 0) {
            Yii::$app->session->setFlash('success', "Gagal.");
            return $this->redirect('view', [
                'id' => $id,
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('success', "Pengguna berhasil di-nonaktifkan atau diaktifkan kembali. Terima kasih.");
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Pengguna model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Pengguna the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pengguna::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->username != Yii::$app->user->identity->username && Yii::$app->user->identity->level != 0) {
            Yii::$app->session->setFlash('warning', "Maaf, Anda tidak diperbolehkan melihat profil pengguna lain.");
            return $this->redirect(['site/index']);
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $model,
            ]);
        } else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }

    public function actionUbahpassword($id)
    {
        $model = new \app\models\UbahPasswordForm();
        $pengguna = Pengguna::findOne($id);

        if ($id != Yii::$app->user->identity->username && Yii::$app->user->identity->level != 0) {
            Yii::$app->session->setFlash('warning', "Maaf, Anda tidak diperbolehkan mengubah password pengguna lain.");
            return $this->redirect(['site/index']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->attributes = $_POST['UbahPasswordForm'];

            Yii::$app->db->createCommand()
                ->update('pengguna', ['password' => md5($_POST['UbahPasswordForm']['password_baru'])], 'username = "' . $id . '"')
                ->execute();
            Yii::$app->session->setFlash('success', "Password berhasil diubah. Terima kasih.");
            return $this->redirect([
                'view', 'id' => $id
            ]);
        }

        return $this->render('ubahpassword', [
            'model' => $model,
        ]);
    }

    public function actionResetpassword()
    {
        $this->layout = 'main-login';
        $model = new ResetPasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // generate a unique password reset token
            $token = Yii::$app->security->generateRandomString();

            // save the password reset token to the database
            $user = Pengguna::findOne(['email' => $model->email]);

            if ($user !== null) {
                // the email exists in the database
                $user->password_reset_token = $token;
                $user->password_reset_timestamp = date('Y-m-d H:i:s');
                $user->save(false);

                // send an email to the user with a link to reset the password
                Yii::$app->mailer->compose('resetpasswordtoken', ['token' => $token, 'email' => $model->email])
                    ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name . ' -noreply'])
                    ->setTo($model->email)
                    ->setSubject('Reset Password Eduprime Course')
                    ->send();

                Yii::$app->session->setFlash('success', 'Link reset password telah dikirim ke email Anda.');

                return $this->redirect(['/site/login']);
            } else {
                // the email does not exist in the database
                Yii::$app->session->setFlash('danger', 'Maaf. Email tersebut tidak ada.');
                // return $this->goHome();
                return $this->redirect(['/site/login']);
            }
        }

        return $this->render('resetpassword', [
            'model' => $model,
        ]);
    }

    public function actionResetpasswordproceed($token)
    {
        $this->layout = 'main-login';
        $user = Pengguna::findOne(['password_reset_token' => $token]);

        if (!$user) {
            Yii::$app->session->setFlash('error', 'Token untuk reset sudah invalid.');
            return $this->redirect(['site/login']);
        }
        // Check if the password reset token has expired
        $now = date('Y-m-d H:i:s');
        $timestamp = $user->password_reset_timestamp;
        $diff = (strtotime($now) - strtotime($timestamp)) / 60;
        if ($diff > 10) {
            Yii::$app->session->setFlash('error', 'Token untuk reset sudah kedaluwarsa.');
            return $this->redirect(['site/login']);
        }


        $model = new ResetPasswordProceedForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->db->createCommand()
                ->update('pengguna', [
                    'password' => md5($_POST['ResetPasswordProceedForm']['password_baru']),
                    'password_reset_token' => NULL,
                    'password_reset_timestamp' => date('Y-m-d H:i:s')
                ], 'username = "' . $user->username . '"')
                ->execute();
            $user->save(false);

            Yii::$app->session->setFlash('success', 'Password berhasil direset. Silahkan login.');
            return $this->redirect(['site/login']);
        }

        return $this->render('resetpasswordproceed', [
            'model' => $model,
        ]);
    }

    public function actionAktifkanlagi($id)
    {
        $model = $this->findModel($id);
        $affected_rows = Pengguna::updateAll(['level' => 1, 'tgl_update' => date('Y-m-d H:i:s')], 'username = "' . $id . '"');
        if ($affected_rows == 0) {
            Yii::$app->session->setFlash('warning', "Gagal. Mohon hubungi Admin.");
            return $this->redirect('view', [
                'id' => $id,
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('success', "Pengguna berhasil diaktifkan kembali. Terima kasih.");
            return $this->redirect(['index']);
        }
    }

    public function actionApproverevokelevel($id)
    {
        //$model = $this->findModel($id);
        $model = Pengguna::findOne($id);
        if ($model->level == 1) {
            $affected_rows = Pengguna::updateAll(['level' => 0, 'tgl_update' => date('Y-m-d H:i:s')], ['username' => $id]);
        } else
            $affected_rows = Pengguna::updateAll(['level' => 1, 'tgl_update' => date('Y-m-d H:i:s')], ['username' => $id]);
        if ($affected_rows === 0) {
            Yii::$app->session->setFlash('warning', "Gagal. Mohon hubungi Admin.");
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('success', "Status Admin pengguna berhasil di-approve/revoke. Terima kasih.");
            return $this->redirect(['index']);
        }
    }
}
