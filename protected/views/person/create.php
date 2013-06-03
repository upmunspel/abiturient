<?php
$this->breadcrumbs=array(
	'people'=>array('index'),
	'Create',
);

$this->menu=array(
    
        array('label'=>'Перелік абітурієнтів','url'=>array('index'),'icon'=>"icon-list-alt"),
	
);
?>

<?php $form=$this->beginWidget('CActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
        'htmlOptions'=>array('style'=>"display: none;",'id'=>'search-form',"class"=>"well"),
)); 
?>

<h3>Пошук абітурієнта за серією та номером документу</h3>
<div class="row-fluid form">
    <div class="span1">
        <?php echo CHtml::label("Серія:","search[attestatSeries]");?>
	<?php echo CHtml::textField("search[attestatSeries]","АР",array("class"=>"span12"));?>
    </div>
     <div class="span2">
        <?php echo CHtml::label("Номер:","search[attestatNumber]"); ?>
        <?php echo CHtml::textField("search[attestatNumber]","43042636",array("class"=>"span12"));?>
     </div>
</div>
 <div class="row-fluid form">
  
    <div class="span2">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Поиск',
		)); ?>
    </div>
</div>
<?php $this->endWidget(); ?>

<h3>Абітурієнт</h3> 
<?php if (Yii::app()->user->hasFlash("message")){
            echo "<p>".Yii::app()->user->getFlash("message")."</p>";
      }
      ?>
<a href="javascript:void(0);" onclick="$('#search-form').toggle();" >Пошук абітуріента за документом</a>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>