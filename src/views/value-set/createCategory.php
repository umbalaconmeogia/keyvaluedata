<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var umbalaconmeogia\keyvaluedata\models\KeyValueData $model */

$this->title = Yii::t('app', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Key Value Data'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="key-value-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
