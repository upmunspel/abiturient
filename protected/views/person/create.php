<?php
$this->breadcrumbs=array(
	'people'=>array('index'),
	'Create',
);

$this->menu=array(
    
        array('label'=>'Перелік абітурієнтів','url'=>array('index'),'icon'=>"icon-list-alt"),
	
);
?>

<h3>Абітуріент</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>