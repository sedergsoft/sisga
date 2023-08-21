<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MiitanciaPoliticCuadro */

$this->title = Yii::t('app', 'Create Miitancia Politic Cuadro');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Miitancia Politic Cuadros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="miitancia-politic-cuadro-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
