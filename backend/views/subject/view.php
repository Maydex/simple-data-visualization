<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Subject $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subjects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'slug',
            [
                'name' => 'presentationType',
                'label' => Yii::t('app', 'Presentation type'),
                'value' => \common\models\SubjectPresentationType::getTypesWithTranslations()[$model->presentationType],
            ],
            'description:ntext',
            'unit',
            'minValue',
            'maxValue',
            [
                'label' => Yii::t('app', 'Number of measurements'),
                'value' => $model->getMeasurements()->count()
            ],
            [
                'label' => Yii::t('app', 'Average measurement'),
                'value' => $model->getMeasurements()->average('value'),
            ]
        ],
    ]) ?>

    <?=
        \yii\grid\GridView::widget([
            'dataProvider' => $measurements,
            'columns' => [
                'id',
                'dateTime',
                'value'
            ],
        ]);
    ?>

</div>
