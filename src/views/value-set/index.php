<?php

use umbalaconmeogia\keyvaluedata\models\KeyValueData;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var umbalaconmeogia\keyvaluedata\models\KeyValueDataSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Category list');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="key-value-data-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Category'), ['create-category'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'value',
                'header' => Yii::t('keyvaluedata', 'Category'),
            ],
            [
                'attribute' => 'count',
                'header' => Yii::t('keyvaluedata', 'Number of items'),
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update}',
                'urlCreator' => function ($action, KeyValueData $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
