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
            echo "<h4 style='color: red;'>".Yii::app()->user->getFlash("message")."</h4>";
      }
      ?>
<h5><a href="javascript:void(0);" onclick="$('#search-form').toggle();" >Пошук абітурієнта за документом</a></h5>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>