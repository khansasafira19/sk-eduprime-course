<?php

use yii\helpers\Html;
?>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <h1><?= $this->title ?></h1>
            <div class="card card-primary">
                <div class="card-header bg-danger text-center">
                    <h5 class="text-light" style="margin-top: 0.5rem">SOAL BIMBEL | <?php echo $model->judul ?></h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th scope="row"><i class="bi bi-file-earmark-excel"></i> Jumlah Soal</th>
                                <td>:</td>
                                <td><?php echo $jumlahsoal ?> Soal</td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="bi bi-hourglass-split"></i> Waktu</th>
                                <td>:</td>
                                <td><?php echo $time ?> Menit</td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="bi bi-joystick"></i> Ranking</th>
                                <td>:</td>
                                <td><?= Html::a('<i class="bi bi-eye"></i> Lihat', ['latihansiswa/rank'], ['class' => 'text-center text-danger', 'style' => 'text-decoration: none']) ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <i>
                        <h6 class="card-text text-center">Ranking hanya dihitung pada saat kamu pertama kali mengerjakan soal ini, harap kerjakan dengan teliti.</h6>
                    </i>
                    <br />
                    <div class="text-center">

                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <?= Html::a('Kerjakan Sekarang', ['latihansiswa/dotest?id=' . $model->id_latihan_paket], ['class' => 'btn btn-danger']) ?>
                        <?php // Html::a('Hasil Saya', ['latihansiswa/index'], ['class' => 'btn btn-outline-danger']) ?>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>

        </div>
</section>