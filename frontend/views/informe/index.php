<?php

$this->title = Yii::t('app', 'Generar Informe');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>

<div class="objetivo-create">

  

    <?= $this->render('_generar', [
        'model' => $model,
    ]) ?>

</div>

