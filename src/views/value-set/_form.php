<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var umbalaconmeogia\keyvaluedata\models\KeyValueData $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="key-value-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true])->label(Yii::t('keyvaluedata', 'Category code')) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true])->label(Yii::t('keyvaluedata', 'Category name')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('keyvaluedata', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
