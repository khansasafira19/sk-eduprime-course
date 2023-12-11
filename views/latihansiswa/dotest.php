<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\HtmlPurifier;

$this->title = 'Pengerjaan Soal';
?>
<style>
    label:hover {
        background-color: #cfe2ff !important;
        transition: 0.5s;
    }

    label {
        display: block;
        width: 100%;
        margin-bottom: 10px;
        /* adjust as needed */
    }

    .buttons-container {
        display: flex;
        flex-wrap: wrap;
    }

    .buttons-container button {
        width: calc(20% - 10px);
        /* 5 buttons in a row */
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .bg-success {
        background-color: #28a745 !important;
    }

    .nav-link:not(:last-child) {
        margin-right: 10px;
    }

    .nav-button {
        margin-bottom: 10px;
    }

    .nav-link {
        width: 16% !important;
        margin-right: 2%;
       
    }
    .nav-pills .nav-link .active{
        background-color: #444444!important;
    }
    
</style>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <h1><?php echo $title ?></h1>            
            <div class="card">
                <div class="card-body">
                    <div class="justify-content-center">
                    <br/>
                        <div class="d-flex flex-wrap justify-content-center">
                            
                            <h5 class="card-title bg-danger" id="timer" style="color:#fff!important; padding:10px 10px; border-radius:5px"></h5>
                        </div>
                    </div>

                    <?php $form = ActiveForm::begin([
                        'id' => 'formsoal',
                        'options' => ['name' => "Form"]
                    ]); ?>
                    <!-- Vertical Pills Tabs -->
                    <div class="d-flex align-items-start row">
                        <div class="nav flex-column nav-pills me-3 col-lg-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <h5 class="card-title text-center alert bg-light">NOMOR SOAL</h5>
                            <div class="d-flex flex-wrap alert bg-light justify-content-center">
                                <?php foreach ($questions as $i => $question) : ?>
                                    <button class="nav-link<?= $i === 0 ? ' active' : '' ?> change-color-btn" id="v-pills-question-<?= $i ?>" data-bs-toggle="pill" data-bs-target="#v-pills-answer-<?= $i ?>" type="button" role="tab" aria-controls="v-pills-answer-<?= $i ?>" aria-selected="<?= $i === 0 ? 'true' : 'false' ?>" tabindex="-1" style="width: 20%;">
                                        <?= Html::encode("" . ($i + 1)) ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                            <?php // Html::submitButton('SELESAI MENGERJAKAN', ['class' => 'btn btn-danger btn-block', 'id' => 'selesai']) 
                            ?>
                            <?= Html::submitButton('SELESAI MENGERJAKAN', [
                                'class' => 'btn btn-danger btn-block',
                                'id' => 'selesai',
                                'name' => 'user_pilih_selesai'
                            ]) ?>

                        </div>

                        <div class="tab-content col-lg-8" id="v-pills-tabContent">
                            <?php foreach ($questions as $i => $question) : ?>
                                <div class="tab-pane fade<?= $i === 0 ? ' show active' : '' ?>" id="v-pills-answer-<?= $i ?>" role="tabpanel" aria-labelledby="v-pills-question-<?= $i ?>">
                                    <div class="panel panel-default">
                                        <p class="text-danger">Soal Nomor <?= $i + 1 ?></p>
                                        <hr />
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><?= Html::decode(Html::encode($question->soal)) ?></h3>
                                        </div>
                                        <div class="panel-body ">
                                            <?php // $form->field($answers, "answer[{$question->id_latihan_soal}]")->radioList([
                                            //     1 => Html::encode(" A. " . $question->choice_a),
                                            //     2 => Html::encode(" B. " . $question->choice_b),
                                            //     3 => Html::encode(" C. " . $question->choice_c),
                                            //     4 => Html::encode(" D. " . $question->choice_d),
                                            //     5 => Html::encode(" E. " . $question->choice_e),
                                            // ], [
                                            //     'itemOptions' => [
                                            //         'labelOptions' => [
                                            //             'class' => 'alert bg-light hover'
                                            //         ],
                                            //         'class' => 'form-check-input'
                                            //     ]
                                            // ])->label(false) 
                                            ?>
                                            <?= $form->field($answers, "answer[{$question->id_latihan_soal}]")->radioList([
                                                1 => Html::decode(" A. " . strip_tags($question->choice_a)),
                                                2 => Html::decode(" B. " . strip_tags($question->choice_b)),
                                                3 => Html::decode(" C. " . strip_tags($question->choice_c)),
                                                4 => Html::decode(" D. " . strip_tags($question->choice_d)),
                                                5 => Html::decode(" E. " . strip_tags($question->choice_e)),
                                            ], [
                                                'itemOptions' => [
                                                    'labelOptions' => [
                                                        'class' => 'alert bg-light hover'
                                                    ],
                                                    'class' => 'form-check-input'
                                                ]
                                            ])->label(false) ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- End Vertical Pills Tabs -->
                    <div class="form-group">

                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        // Add a click listener to all radio buttons
        $('input[type=radio]').click(function() {
            // Get the parent container of the clicked radio button
            var container = $(this).closest('.tab-pane');
            // Check if the radio button is checked
            if ($(this).is(':checked')) {
                // Get the corresponding button and add a class to change the color
                var btn = $('.change-color-btn[data-bs-target="#' + container.attr('id') + '"]');
                btn.addClass('bg-success text-white');
            } else {
                // If the radio button is unchecked, remove the class
                var btn = $('.change-color-btn[data-bs-target="#' + container.attr('id') + '"]');
                btn.removeClass('bg-success text-white');
            }
        });

        // Add a click listener to all question buttons
        $('.change-color-btn').click(function() {
            // Remove the active class from all question buttons
            $('.change-color-btn').removeClass('active');
            // Add the active class to the clicked question button
            $(this).addClass('active');
        });

        // Add a click listener to all previous/next buttons, does not work yet
        $('.change-question-btn').click(function(event) {
            event.preventDefault(); // prevent form submission
            // Get the target question button
            var target = $(this).data('bs-target');
            // Trigger a click on the target question button to show the corresponding question
            // console.log(target);
            $(target).click();
        });

    });
</script>
<script type="text/javascript">
    $('#selesai').click(function(event) {
        event.preventDefault(); // prevent form submission
        swal({
            title: 'Anda yakin?',
            text: "Mohon pastikan tidak ada soal yang tertinggal.",
            icon: 'warning',
            buttons: {
                cancel: true,
                confirm: true,
            },
        }).then(function(isConfirm) {
            if (isConfirm) {
                $('#formsoal').submit(); // submit the form if the user clicks "Yes"
            }
        });
    });
</script>
<script>
    // Set the timer duration in minutes
    var duration = <?php echo $time?>;

    // Calculate the end time of the timer
    var endTime = new Date();
    endTime.setMinutes(endTime.getMinutes() + duration);

    // Update the timer every second
    var timer = setInterval(function() {
        // Calculate the remaining time
        var now = new Date();
        var remainingSeconds = Math.round((endTime - now) / 1000);

        // Check if the timer has expired
        if (remainingSeconds <= 0) {
            clearInterval(timer);
            $('#timer').html('Time is up!');
            // Submit the form
            $('form').submit();
        } else {
            // Update the timer display
            var minutes = Math.floor(remainingSeconds / 60);
            var seconds = remainingSeconds % 60;
            $('#timer').html('<i class="fas fa-stopwatch"></i> ' + minutes + ' menit ' + seconds + ' detik');

        }
    }, 1000);
</script>