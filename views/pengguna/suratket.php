<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Surat Keterangan';
?>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <iframe src="<?php echo Url::base(true);
                                ?>/suratket/<?php echo $file
                                                ?>" frameBorder="0" scrolling="auto" width="100%" height="800px"></iframe>
            </div>
        </div>
    </div>
</div>