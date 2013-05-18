<?php
$this->breadcrumbs=array(
	'Directories'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'Перелі Directories','url'=>array('index')),
	array('label'=>'Створити','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('directories-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управління Довідниками</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<!--<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
	//'model'=>$model,
//)); ?>
</div> search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'directories-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
	'filter'=>$model,
	'columns'=>array(
		//'idDirecrtory',
		'DirectoryName',
		'DirectoryInfo',
		//'DirectoryLink',
		
		array( 'name'=>'Visible', 'filter'=>array(1=>"Так", 0=>"Ні"),'value'=>'($data->Visible) ? "Так":"Ні"', 'htmlOptions'=>array("width"=>"100")),
              ///Access
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
