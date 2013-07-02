<?php
$this->breadcrumbs=array(
	'people'=>array('index'),
	'Create',
);

$this->menu=array(
    
        array('label'=>'Перелік абітурієнтів','url'=>Yii::app()->createUrl('personview'), 'icon'=>"icon-list-alt"),
	
);
?>

<?php echo $this->renderPartial('_edboSearch', array('model'=>$model,"searchres"=>$searchres)); ?>

<h3>Абітурієнт</h3> 
<?php if (Yii::app()->user->hasFlash("message")){
            echo "<p>".Yii::app()->user->getFlash("message")."</p>";
      }
      ?>
<h5><a href="javascript:void(0);" onclick="$('#search-form').toggle();" >Пошук абітуріента за документом</a></h5>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>