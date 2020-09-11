<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HasilKonsultasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hasil-konsultasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_konsultasi')->textInput() ?>

    <?= $form->field($model, 'id_aturan')->textInput() ?>

    <?= $form->field($model, 'jawaban')->checkbox() ?>

    <?php echo $form->field($model, 'cf_user')->dropDownList(
        [
            '0' => 'PilihSalahSatu'
            '0.50' => 'Kurang_Yakin',
            '0.80' => 'Yakin',
		]
    ); ?>





    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
