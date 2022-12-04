<?php

use app\models\Dep;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\DepSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Подразделения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dep-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'header' => 'Действия',
                'class' => ActionColumn::class,
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
