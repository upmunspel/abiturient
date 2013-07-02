<?php
$this->menu=array(
	array('label'=>'Перелік абітурієнтів','url'=>Yii::app()->createUrl('personview'),'icon'=>"icon-list-alt"),
        array('label'=>'Параметри вступу','url'=>Yii::app()->createUrl("person/view", array("id"=>$model->idPerson)),'icon'=>"icon-list-alt"),
    
	array('label'=>'Додати  абітурієнта','url'=>Yii::app()->createUrl('person/create'),'icon'=>"icon-plus"),
	
);
?>

<h1>Оновлення інформації про абітурієнта (<?php echo $model->idPerson; ?>)</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>