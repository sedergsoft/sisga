<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Directivo */

$this->title = Yii::t('app', 'Create Directivo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Directivos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="directivo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
