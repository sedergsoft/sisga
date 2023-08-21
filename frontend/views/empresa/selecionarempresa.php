<?php

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EmpresaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Selecione la empresa a consultar');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>

<div class="empresa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->widget(Select2::classname(), [
    'data' =>ArrayHelper::map(frontend\models\Empresa::find()/*->where([])*/->orderBy('id')->asArray()->all(), 'id', 'nombre'),
    'options' => ['placeholder' => 'Seleciona la empresa a mostrar ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);/*?>

    <?= $form->field($model, 'tegnologia_logisticaid')->textInput() */?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Mostrar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



    

