<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MiitanciaPoliticCuadro */

$this->title = Yii::t('app', 'Update Miitancia Politic Cuadro: {name}', [
    'name' => $model->miitancia_politicid,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Miitancia Politic Cuadros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->miitancia_politicid, 'url' => ['view', 'miitancia_politicid' => $model->miitancia_politicid, 'cuadroid' => $model->cuadroid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="miitancia-politic-cuadro-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
