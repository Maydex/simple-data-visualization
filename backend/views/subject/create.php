<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Subject $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'Subject',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subjects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
