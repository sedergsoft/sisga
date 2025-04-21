<?php

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EmpresaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Selecione el cuadro ');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>

<div class="empresa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->widget(Select2::classname(), [
    'data' =>Yii::$app->user->identity->rolid==2?ArrayHelper::map(frontend\models\Cuadro::find()/*->where([])*/->orderBy('id')->asArray()->all(), 'id', 'personaCI'):ArrayHelper::map(frontend\models\Cuadro::find()->andFilterWhere(['entidadid'=>Yii::$app->user->identity->direccionid])->orderBy('id')->asArray()->all(), 'id', 'personaCI'),
    'options' => ['placeholder' => 'Selecione el cuadro a mostrar ...'],
     
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('N.I.');?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Mostrar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



    

