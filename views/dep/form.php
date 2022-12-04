<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Dep $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = $model->isNewRecord ? 'Создать подразделение' : 'Изменить подразделение';
$this->params['breadcrumbs'][] = ['label' => 'Подразделения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dep-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="dep-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
