<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Materi Eduprime Course';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($model->jenis == 0) : ?>
    <div id="pdf-container">
        <center>
            <h1><?= $this->title ?></h1>
        </center>
        <iframe id="pdf-iframe" src="<?= Yii::getAlias('@web') ?>/pdf/materi/<?php echo $model->id_materi ?>.pdf" width="100%"></iframe>
    </div>
<?php elseif ($model->jenis == 1) : ?>
    <div id="youtube-container" style="height: 500px">
        <center>
            <h1><?= $this->title ?></h1>
        </center>
        <?php
        $remove = strstr($model->filename_link, 'watch');
        $hasil = str_replace("watch?v=", "", $remove) ?>
        <iframe id="youtube-iframe" src="http://www.youtube.com/embed/<?php echo $hasil  ?>" width="100%" height="100%"></iframe>
    </div>

<?php endif; ?>

<script>
    function resizePdfIframe() {
        var windowHeight = $(window).height();
        var pdfIframeOffset = $('#pdf-container').offset().top;
        var pdfIframeHeight = windowHeight - pdfIframeOffset - 20; // subtract 20 for margin
        $('#pdf-iframe').height(pdfIframeHeight);
    }

    $(window).resize(function() {
        resizePdfIframe();
    });

    $(document).ready(function() {
        resizePdfIframe();
    });

    function resizeYouTubeIframe() {
        var windowHeight = $(window).height();
        var YouTubeIframeOffset = $('#youtube-container').offset().top;
        var YouTubeIframeHeight = windowHeight - YouTubeIframeOffset - 500; // subtract 20 for margin
        $('#youtube-iframe').height(YouTubeIframeHeight);
    }

    $(window).resize(function() {
        resizeYouTubeIframe();
    });

    $(document).ready(function() {
        resizeYouTubeIframe();
    });
</script>