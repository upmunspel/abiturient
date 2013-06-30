<?php
/* @var $this Specialitiescontroller */
/* @var $model Specialities */

$this->breadcrumbs=array(
	'Specialities'=>array('index'),
	'Довідник ',
);

$this->menu=array(
/*array('label'=>'List Specialities', 'url'=>array('index')),*/
array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
);

/*Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('specialities-grid', {
data: $(this).serialize()
});
return false;
});
");*/
?>

<h1>Довідник "Спеціальності"</h1>

<p>
    Можна додати оператор порівняння (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) перед значенням пошуку
</p>
<?php //echo CHtml::link('Розширений пошук','#',array('class'=>'search-button btn btn-primary')); ?>
<!--<div class="search-form" style="display:none; margin-top: 20px;">
    <?php /*$this->renderPartial('_search',array(
	'model'=>$model,
));*/ ?>
</div>-->
<!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
'id'=>'specialities-grid',
'type'=>'striped bordered condensed',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'idSpeciality',
		'SpecialityName',
		'SpecialityKode',
		'FacultetID',  
		//'SpecialityClasifierCode',
		//'SpecialityBudgetCount',
	//	'SpecialityContractCount',
        array('name'=>'isZaoch',
                    'header'=>'isZaoch',
                    'filter'=>array('1'=>'так','0'=>'ні'),
                    'value'=>'($data->isZaoch=="1")?("так"):("ні")'),
        array('name'=>'isPublishIn',
                    'header'=>'isPublishIn',
                    'filter'=>array('1'=>'так','0'=>'ні'),
                    'value'=>'($data->isPublishIn=="1")?("так"):("ні")'),		
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
    'htmlOptions'=>array('style'=>'width: 68px',
        'data-toggle'=>'modal',
        'data-target'=>'#myModal',
        ),
    'template' => '{view} {update} {delete}', // {Print}',
        'buttons' => array(
//            'Print' => array(
//                'label' => 'Друк документів',
//                'url' => 'modal',
//                'icon'=>"icon-print", 
//                     ),
    ),
    ),
    ),
));
 ?>
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Друк документів</h4>
</div>
 
<div class="modal-body">
<form action="checkbox-form.php" method="post">
 <br />
<input type="checkbox" name="formDoor[]" value="A" />1<br />

<input type="checkbox" name="formDoor[]" value="B" />Brown Hall<br />
<input type="checkbox" name="formDoor[]" value="C" />Carnegie Complex<br />

<input type="checkbox" name="formDoor[]" value="D" />Drake Commons<br />
<input type="checkbox" name="formDoor[]" value="E" />Elliot House

</form> 
        <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'ОКDA',
        'url'=>'#',
    )); ?>
</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>