<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\bootstrap4\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Pengguna */

$this->title = 'Detail Pengguna';
\yii\web\YiiAsset::register($this);
?>
<style>
    .custom-modal-class {
        z-index: 9999;
    }
</style>
<div class="wrapper">
    <p>
        <?php if (Yii::$app->user->identity->level == 0 && !Yii::$app->request->isAjax) : ?>
            <?=
            Html::a('Aktifkan/Non Aktifkan', ['delete', 'id' => $model->username], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => 'Anda yakin ingin mengaktifkan/menonaktifkan pengguna ini?<br/><strong>' . $model->nama . '</strong>',
                    'method' => 'post',
                ],
            ])
            ?>
            <?= Html::a('Update', ['update', 'id' => $model->username], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
        <?= Html::a('Ganti Password', ['ubahpassword', 'id' => $model->username], ['class' => 'btn btn-info']) ?>
    </p>

    <?php Pjax::begin(['id' => 'some_pjax_id_2']); ?>
    <?=
    DetailView::widget([
        'model' => $model,
        'condensed' => false,
        'striped' => false,
        'bordered' => false,
        'hover' => true,
        // 'mode' => DetailView::MODE_VIEW,
        // 'panel' => [
        //     'heading' => 'Pengguna # ' . $model->nama,
        //     'type' => DetailView::TYPE_DEFAULT,
        // ],
        'hAlign' => 'left',
        'buttons1' => '',
        'attributes' => [
            [
                'attribute' => 'nama',
                // 'value' => $model->gelar_depan . ' ' . $model->nama . ', ' . $model->gelar_belakang
            ],
            [
                'attribute' => 'hape',
                // 'value' => konversi_nip($model->nip)
            ],
            'username',
            [
                'attribute' => 'password',
                'value' => '******',
            ],
            'email',
            [
                'attribute' => 'level',
                'value' => (($model->level == 0) ?
                    '<button type="button" class="btn btn-dark btn-sm"><i class="bi bi-folder"></i> admin</button>'
                    : (($model->level == 1) ?
                        '<button type="button" class="btn btn-success btn-sm"><i class="bi bi-check-circle"></i> aktif</button>'
                        : (($model->level == 3) ? '<button type="button" class="btn btn-warning btn-sm"><i class="bi bi-envelope-fill"></i> belum aktivasi</button>' : '<button type="button" class="btn btn-danger btn-sm"><i class="bi bi-exclamation-octagon"></i> dihapus</button>'))),
                'format' => 'raw'
            ],
            [
                'attribute' => 'tgl_daftar',
                'value' => \Yii::$app->formatter->asDatetime(strtotime($model->tgl_daftar), "d MMMM y 'pada' H:mm a"),
            ],
            [
                'attribute' => 'tgl_update',
                'value' => \Yii::$app->formatter->asDatetime(strtotime($model->tgl_update), "d MMMM y 'pada' H:mm a"),
            ],
            // [
            //     'attribute' => 'theme',
            //     'value' => (($model->theme == 0) ? '<button type="button" class="btn btn-light btn-sm"><i class="bi bi-sun"></i> light</button>' : '<button type="button" class="btn btn-dark btn-sm"><i class="bi bi-moon-fill"></i> dark</button>'),
            //     'format' => 'raw'
            // ],
        ],
    ])
    ?>
    <?php Pjax::end() ?>
</div>
<?php
Modal::begin([
    'title' => 'Surat Keterangan Pengguna',
    'id' => 'modal',
    'size' => 'modal-lg',
    'options' => [
        'class' => 'custom-modal-class' // Add a custom CSS class here
    ]
]);


echo '<div id="modalContent"></div>';

Modal::end();
?>
<script>
    $(function() {
        // changed id to class
        $('.modalButton').click(function() {
            $.get($(this).attr('href'), function(data) {
                $('#modal').modal('show').find('#modalContent').html(data)
            });
            return false;
        });
    });
</script>