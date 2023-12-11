<?php

use yii\helpers\Html;
use yii\bootstrap4\Modal;
use yii\widgets\Pjax;

$this->title = 'Data Pengguna Eduprime Course';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <h1><?= $this->title ?></h1>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="p-2">

                        </div>
                        <div class="p-2">

                        </div>
                        <div class="p-2">
                            <?= Html::a('<i class="bi bi-bag-plus-fill"></i> Tambah User', ['create'], ['class' => 'btn btn-outline-danger']) ?>
                        </div>
                    </div>

                    <?php Pjax::begin(['id' => 'some_pjax_id']); ?>
                    <?= yii\grid\GridView::widget([
                        'dataProvider' => $dataProvider,
                        'tableOptions' => ['class' => 'table table-hover'],
                        'options' => ['class' => 'table-responsive'],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            [
                                'attribute' => 'nama',
                                'enableSorting' => false,
                            ],
                            [
                                'attribute' => 'username',
                                'enableSorting' => false,
                            ],
                            [
                                'attribute' => 'hape',
                                'value' => function ($model) {
                                    $phone = $model->hape;
                                    return substr($phone, 0, 3) . '-' . substr($phone, 3, 4) . '-' . substr($phone, 7);
                                },
                                'enableSorting' => false,
                            ],
                            [
                                'attribute' => 'email',
                                'enableSorting' => false,
                            ],
                            [
                                'attribute' => 'level',
                                'value' => function ($model) {
                                    if ($model->level == 0)
                                        return  '<button type="button" class="btn btn-dark btn-sm"><i class="bi bi-folder"></i> admin</button>';
                                    elseif ($model->level == 1)
                                        return '<button type="button" class="btn btn-success btn-sm"><i class="bi bi-check-circle"></i> aktif</button>';
                                    elseif ($model->level == 3)
                                        return '<button type="button" class="btn btn-warning btn-sm"><i class="bi bi-envelope-fill"></i> belum aktivasi</button>';
                                    else
                                        return '<button type="button" class="btn btn-danger btn-sm"><i class="bi bi-exclamation-octagon"></i> dihapus</button>';
                                },
                                'format' => 'raw',
                                'enableSorting' => false,
                                'headerOptions' => [
                                    // this should be on a CSS file as class instead of a inline style attribute...
                                    'style' => 'text-align: center !important;vertical-align: middle !important'
                                ],
                                'contentOptions' => [
                                    // this should be on a CSS file as class instead of a inline style attribute...
                                    'style' => 'text-align: center !important;vertical-align: middle !important'
                                ]
                            ],
                            [
                                'attribute' => 'tgl_daftar',
                                'value' => function ($model) {
                                    $formatter = Yii::$app->formatter;
                                    $formatter->locale = 'id-ID';
                                    return $formatter->asDatetime($model->tgl_daftar, 'd MMMM yyyy, hh:mm a');
                                },
                                'enableSorting' => false,
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Aksi',
                                'template' => '{view} {update} {delete} {aktifkanlagi} {approverevokelevel}',
                                'visibleButtons' => [
                                    'delete' => function ($model, $key, $index) {
                                        if (Yii::$app->user->identity->level === 0) {
                                            return (Yii::$app->user->identity->username === $model['username'] //datanya sendiri
                                                || $model->level == 2
                                            ) ? false : true;
                                        } else
                                            return false;
                                    },
                                    'aktifkanlagi' => function ($model, $key, $index) {
                                        return ($model->level == 2) ? true : false;
                                    },
                                    'approverevokelevel' => function ($model, $key, $index) {
                                        if (Yii::$app->user->identity->level === 0) {
                                            return (Yii::$app->user->identity->username === $model['username'] //datanya sendiri
                                                || $model->level == 2 //pengguna tidak aktif tidak bisa jadi admin
                                            ) ? false : true;
                                        } else
                                            return false;
                                    },
                                ],
                                'buttons' => [
                                    'view' => function ($key, $client, $index) {
                                        $url = '/_jariyah-fi/sk-eduprime-course/pengguna/view?id=' . $index;
                                        return Html::a('<i class="bi bi-eye-fill"></i>', $url, ['title' => 'Lihat rincian pengguna ini', 'class' => 'modalButton', 'data-pjax' => '0']);
                                        //return Html::a('<button class="btn btn-sm tombol-biru"><i class="fa text-info">&#xf06e;</i></button>', $key, ['title' => 'Lihat rincian logbook ini', ]);
                                    },
                                    'delete' => function ($url, $model, $key) {
                                        return Html::a('<i class="fas text-danger fa-trash-alt"></i> ', $url, [
                                            'title' => 'Nonaktifkan pengguna ini',
                                            'data-method' => 'post',
                                            'data-pjax' => 0,
                                            'data-confirm' => 'Anda yakin ingin menonaktifkan pengguna ini? <br/><strong>' . $model['nama'] . '</strong>'
                                        ]);
                                    },
                                    'aktifkanlagi' => function ($url, $model, $key) {
                                        return Html::a('<i class="fas text-danger fa-recycle"></i>', $url, [
                                            'title' => 'Aktifkan pengguna ini',
                                            'data-method' => 'post',
                                            'data-pjax' => 0,
                                            'data-confirm' => 'Anda yakin ingin mengaktifkan kembali pengguna ini? <br/><strong>' . $model['nama'] . '</strong>'
                                        ]);
                                    },
                                    'approverevokelevel' => function ($url, $model, $key) {
                                        return Html::a('<i class="fa text-success">&#xf21b;</i> ', 'approverevokelevel?id=' . $key, [
                                            'title' => 'Jadikan admin',
                                            'data-method' => 'post',
                                            'data-pjax' => 0,
                                            'data-confirm' => 'Anda yakin ingin me-revoke/approve level pegawai ini? <br/><strong>'
                                                . $model->nama . '</strong> sebagai <strong>Admin</strong>'
                                        ]);
                                    },
                                ],
                            ],
                        ],
                    ]); ?>
                    <?php Pjax::end() ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
Modal::begin([
    'title' => 'Rincian Pengguna',
    'id' => 'modal',
    'size' => 'modal-lg'
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