<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UserRight $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $types */
/** @var array $courses */

$this->title = $model->isNewRecord ? 'Создание прав' : 'Изменение прав';
$this->params['breadcrumbs'][] = ['label' => $model->user->email, 'url' => ['user/view', 'id' => $model->user->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-right-create">

    <h1><?= Html::encode($this->title) ?></h1>    

    <div class="user-right-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'type')->dropDownList($types) ?>

        <?= $form->field($model, 'course_id')->dropDownList($courses) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
