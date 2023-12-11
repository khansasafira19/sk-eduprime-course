<?php

use yii\helpers\Html;

$this->title = 'Tes Selesai';
?>

<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/result.jpg" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h1 class="card-title"><?= Html::encode($this->title) ?></h1>
                <p class="card-text">Terima kasih telah mengerjakan soal latihan ini.</p>
                <div class="badge bg-light fade show text-dark" role="alert">
                    <h1 class="alert-heading">Skor Anda adalah: </h1>
                    <br />
                    <h1><span class="badge bg-primary"> <?= $score ?> </span> </h1>
                    <br />
                    <h4 class="alert-heading">dari sebanyak <span class="badge bg-secondary"><?= $totalQuestions ?> </span> soal.</h4>
                </div>
                <hr/>
                <?= Html::a('<i class="bi bi-book-fill"></i> Kerjakan Soal Lainnya', ['latihanpaket/index'], ['class' => 'btn btn-outline-primary']) ?>
            </div>
        </div>
    </div>
</div>