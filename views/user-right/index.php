<?php

use app\models\UserRight;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\UserRightSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var array $types */
/** @var array $courses */

?>
<div class="user-right-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить права', ['user-right/create', 'userId' => $searchModel->user_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'type',
                'value' => function(UserRight $model) use($types) {
                    return $types[$model->type];
                },
                'filter' => $types,
            ],            
            [
                'attribute' => 'course_id',
                'value' => 'course.name',
                'filter' => $courses,
            ],            
            [
                'class' => ActionColumn::class,
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, UserRight $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
