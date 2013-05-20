<?php
$this->breadcrumbs=array(
	'people'=>array('index'),
	'Create',
);

$this->menu=array(
    
        array('label'=>'Перелік абітурієнтів','url'=>array('index'),'icon'=>"icon-list-alt"),
	
);
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
        'htmlOptions'=>array('style'=>"display: none;",'id'=>'search-form'),
)); ?>

<h1>Person search sample</h1>

	<?php echo CHtml::textField("search[attestatSeries]","АР");?>
        <?php echo CHtml::textField("search[attestatNumber]","43042636");?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Поиск',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<h3>Абітуріент</h3> 
<a href="javascript:void(0);" onclick="$('#search-form').show();" >Поиск</a>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>