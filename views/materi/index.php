<?php

use yii\helpers\Html;
use yii\bootstrap4\Modal;
use yii\widgets\Pjax;

$this->title = 'Bank Materi Eduprime Course';
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
                            <?php if (Yii::$app->user->identity->level === 0) : ?>
                                <?= Html::a('<i class="bi bi-bag-plus-fill"></i> Tambah Materi', ['create'], ['class' => 'btn btn-outline-danger']) ?>
                            <?php endif; ?>
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
                                'attribute' => 'jenis',
                                'enableSorting' => false,
                                'value' => function ($model) {
                                    if ($model->jenis == 0)
                                        return  '<span class="text-dark"><i class="bi bi-file-earmark-pdf-fill"></i> File PDF</span>';
                                    elseif ($model->jenis == 1)
                                        return '<span class="text-dark"><i class="bi bi-camera-video-fill"></i> YouTube Video</span>';
                                    else
                                        return '';
                                },
                                'format' => 'html'
                            ],
                            [
                                'attribute' => 'judul',
                                'enableSorting' => false,
                            ],
                            [
                                'attribute' => 'filename_link',
                                'enableSorting' => false,
                                'value' => function ($model) {
                                    return ($model->filename_link == null ? Html::a('<center><i class="bi bi-file-earmark-pdf-fill text-danger"></i></center>', '/_jariyah-fi/sk-eduprime-course/materi/viewpdf?id_materi=' . $model->id_materi, [
                                        'title' => 'Lihat pdf ini', 'class' => 'modalButton', 'data-pjax' => '0'
                                    ]) : Html::a('<center><i class="bi bi-camera-video-fill text-danger"></i></center>', '/_jariyah-fi/sk-eduprime-course/materi/viewpdf?id_materi=' . $model->id_materi, [
                                        'title' => 'Lihat soal-soal ini', 'class' => 'modalButton', 'data-pjax' => '0'
                                    ]));
                                },
                                'header' => '<center>File/Video</center>',
                                'format' => 'html'
                            ],

                            [
                                'attribute' => 'owner',
                                'visible' => Yii::$app->user->identity->level == 0 ? true : false,
                                'value' => 'ownere.nama',
                                'enableSorting' => false,
                            ],
                            [
                                'attribute' => 'deleted',
                                'enableSorting' => false,
                                'value' => function ($model) {
                                    if ($model->deleted == 0)
                                        return  '';
                                    else
                                        return '<i>telah dihapus dari view siswa</i>';;
                                },
                                'format' => 'html',
                                'visible' => Yii::$app->user->identity->level == 0 ? true : false,
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Aksi',
                                'template' => '{view} {update} {delete} {aktifkanlagi}',
                                'visible' => Yii::$app->user->identity->level == 0 ? true : false,
                                'visibleButtons' => [
                                    'aktifkanlagi' => function ($model, $key, $index) {
                                        if (Yii::$app->user->identity->level === 0) {
                                            return (Yii::$app->user->identity->username === $model['owner'] //datanya sendiri
                                                && $model->deleted == 1
                                            ) ? true : false;
                                        } else
                                            return false;
                                    },
                                    'delete' => function ($model, $key, $index) {
                                        if (Yii::$app->user->identity->level === 0) {
                                            return (Yii::$app->user->identity->username === $model['owner'] //datanya sendiri
                                                && $model->deleted == 0
                                            ) ? true : false;
                                        } else
                                            return false;
                                    },
                                    'update' => function ($model, $key, $index) {
                                        if (Yii::$app->user->identity->level === 0) {
                                            return (Yii::$app->user->identity->username === $model['owner'] //datanya sendiri
                                                && $model->deleted == 0
                                            ) ? true : false;
                                        } else
                                            return false;
                                    },
                                ],
                                'buttons' => [
                                    'view' => function ($key, $client, $index) {
                                        $url = '/_jariyah-fi/sk-eduprime-course/materi/view?id_materi=' . $index;
                                        return Html::a('<i class="bi bi-eye-fill text-dark"></i>', $url, ['title' => 'Lihat rincian materi ini', 'class' => 'modalButton', 'data-pjax' => '0']);
                                        //return Html::a('<button class="btn btn-sm tombol-biru"><i class="fa text-info">&#xf06e;</i></button>', $key, ['title' => 'Lihat rincian logbook ini', ]);
                                    },
                                    'update' => function ($key, $client, $index) {
                                        $url = '/_jariyah-fi/sk-eduprime-course/materi/update?id_materi=' . $index;
                                        return Html::a('<i class="bi bi-pencil-fill"></i>', $url, ['title' => 'Update rincian materi ini']);
                                        //return Html::a('<button class="btn btn-sm tombol-biru"><i class="fa text-info">&#xf06e;</i></button>', $key, ['title' => 'Lihat rincian logbook ini', ]);
                                    },
                                    'delete' => function ($url, $model, $key) {
                                        return Html::a('<i class="fas text-danger fa-trash-alt"></i> ', $url, [
                                            'title' => 'Nonaktifkan materi ini',
                                            'data-method' => 'post',
                                            'data-pjax' => 0,
                                            'data-confirm' => 'Anda yakin ingin menonaktifkan materi ini? <br/><strong>' . $model['judul'] . '</strong>'
                                        ]);
                                    },
                                    'aktifkanlagi' => function ($url, $model, $key) {
                                        return Html::a('<i class="fas text-danger fa-recycle"></i>', $url, [
                                            'title' => 'Aktifkan materi ini',
                                            'data-method' => 'post',
                                            'data-pjax' => 0,
                                            'data-confirm' => 'Anda yakin ingin mengaktifkan kembali materi ini? <br/><strong>' . $model['judul'] . '</strong>'
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
    'title' => 'Rincian Materi',
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