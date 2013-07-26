<?php
//$this->breadcrumbs=array(
//	'Specialitysubjects'=>array('index'),
//	'Manage',
//);

$this->menu=array(
	array('label'=>'Перелік предметів напрямів','url'=>array('admin'), 'icon'=>"icon-plus"),
	array('label'=>'Додати предмет напрямкку','url'=>array('create'), 'icon'=>"icon-plus"),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('specialitysubjects-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управління предметами напрямків</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
<!--
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div> search-form -->


<?php

    $data = $model->search();
    $Specialities = new Specialities();
    $d = $Specialities->getSpecialityFullNames();
    $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'specialitysubjects-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$data,
	'filter'=>$model,
	'columns'=>array(
                array('name'=>'id', "htmlOptions"=>array("style"=>"width: 50px")),
                array('name'=>'SpecialityID', 'value' => 
                    '$data->speciality->SpecialityDirectionName." ".$data->speciality->SpecialitySpecializationName." (".
                    (($data->speciality->PersonEducationFormID==1)?("денна"):(($data->speciality->PersonEducationFormID==2)?("заочна"):("екстернат"))).")"',
                        'filter'=>$d ),
                array('name'=>'SubjectID', 'value' => '$data->subject->SubjectName',
                        'filter'=>CHtml::listData(Subjects::model()->findAll(), "idSubjects", "SubjectName") ),
                array('name'=>'LevelID',  'filter'=>array("1"=>"1","2"=>"2","3"=>"3"), "htmlOptions"=>array("style"=>"width: 100px") ),
                
                array('name'=>'isProfile', 'filter'=>array('1'=>'так','0'=>'ні'),"htmlOptions"=>array("style"=>"width: 100px"), 
                    'value'=>'($data->isProfile)? "так":"ні"' ),
  
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
