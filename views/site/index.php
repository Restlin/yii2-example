<?php
use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var bool $isGuest */

$this->title = 'Система';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Система!</h1>        

        <?php
        if($isGuest) {
            echo Html::a('Вход', ['site/login'], ['class' => 'btn btn-success']);
        } else { ?>
        <p>
            <?= Html::a('Курсы', ['course/index'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Подразделения', ['dep/index'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Пользователи', ['user/index'], ['class' => 'btn btn-success']) ?>
        </p>
        <?php } ?>
    </div>    
</div>
