<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $deps */

$this->title = $model->isNewRecord ? 'Создать пользователя' : 'Изменить пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => 100]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => 100]) ?>

        <?= $form->field($model, 'dep_id')->dropDownList($deps) ?>
        
        <?= $form->field($model, 'password')->passwordInput() ?>
        
        <?= $form->field($model, 'is_admin')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
