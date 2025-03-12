<?php

use frontend\models\Entidad;
use frontend\models\Provincia;
use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Entidad */

$this->title = $model->nombre_corto;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Entidad'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="entidad-view">

 
    <?= DetailView::widget([
          'model'=>$model,
          'condensed'=>true,
          'hover'=>true,
          'hideIfEmpty'=>TRUE,
          'mode'=>DetailView::MODE_VIEW,
          'panel'=>[
              'heading'=> $model->nombre,
              'type'=>DetailView::TYPE_INFO,
          ],
        'attributes' => [
           // 'id',
           [
            'attribute'=>'nombre',
           ],
           [
            'attribute'=>'nombre_corto',
           ],
           [
            'attribute'=>'provincia_id',
            'value'=> $model->provincia->provincia,
              'type'=> DetailView::INPUT_SELECT2, 
                 'widgetOptions'=>[
                               'data'=> ArrayHelper::map(Provincia::find()-> all(), 'id', 'provincia'),
                              
                               ],
           ],
           [
            'attribute'=>'superiorid',
            'value'=> $model->superiorid?$model->entidad->nombre_corto:"",
              'type'=> DetailView::INPUT_SELECT2, 
                 'widgetOptions'=>[
                               'data'=> ArrayHelper::map(Entidad::find()->andFilterWhere(['not',['id'=>$model->id]])-> all(), 'id', 'nombre_corto'),
                              
                               ],
           ],
           
          //  'status',
        ],
                //  'enableEditMode'=>FALSE,
         'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
    ]) ?>

</div>
