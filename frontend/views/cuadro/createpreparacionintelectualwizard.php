<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Comedor */

$this->title = Yii::t('app', 'Preparacion Intelectual');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="comedor-create">

    <?= $this->render('_formPreparacionintelectual', [
           'model' => $model,
                    'modelPreIntel'=>$modelPreIntel,
                    'modelMiliatanciaPolitica'=>$modelMiliatanciaPolitica,
                     'modelsIdiomas'=>(empty($modelsIdiomas))?[new PreparacionIntelectualIdiomas()]:$modelsIdiomas,     
       
    ]) ?>

</div>
