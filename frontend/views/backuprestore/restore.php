<?php
use yii\helpers\Html;


$this->params ['breadcrumbs'] [] = [ 
		'label' => 'Administracion',
		'url' => array (
				'index' 
		) 
];
$this->params['breadcrumbs'][]= [
'label'	=> 'Restaurar',
'url'	=> array('restore'),
];
$this->params['tittle'][]= $this->title;
?>


<?php
//$this->widget('bootstrap.widgets.TbButtonGroup', array(
		//'buttons'=>$this->actions,
		//'type'=>'success',
		//'size'=>'mini',
		//'htmlOptions'=>array('class'=>'pull-right')
//));
?>
<h1>
	<?php //echo  $this->action->id; ?>
</h1>

<p>
	<?php if(isset($error)) echo $error; else echo 'Done';?>
</p>
<p>
    
       <?= Html::a('View site', ['index'], ['class' => 'btn btn-warning']) ?>        
    
    
	<?php //echo Html::link('View Site',Yii::app()->HomeUrl)?>
</p>
