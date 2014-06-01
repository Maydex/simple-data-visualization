<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\SubjectPresentationType;

/**
 * @var yii\web\View $this
 * @var common\models\Subject $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="subject-form">

    <?php $form = ActiveForm::begin();
        $form->enableAjaxValidation = true;
        $form->enableClientValidation = true;
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'presentationType')->dropDownList(SubjectPresentationType::getTypesWithTranslations()) ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'minValue')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'maxValue')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
