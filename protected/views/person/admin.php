<?php

$this->menu=array(
    array('label'=>'Додати ','url'=>Yii::app()->createUrl('person/create'),'icon'=>"icon-plus"),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('person-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Перелік абітурієнтів</h1>

<p>Ви можете використовувати операції порівняння (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
або <b>=</b>) на початку кожного з параметрі що необхідно знайти.
</p>


<?php
// if (true || Yii::app()->user->hasFlash("error")) {
//     echo  "<p> wwewewew".Yii::app()->user->getFlash("error")."</p>";
// }

// echo CHtml::link('Розширений пошук','#',array('class'=>'search-button btn')); ?>
<!--<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
//	'model'=>$model,
//)); ?>
</div> search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'person-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'rowCssClassExpression'=>'empty($data->edboID)?"row-red":"row-green"',
	'columns'=>array(
        array('name'=>'idPerson', 'header'=>'Код', 'htmlOptions'=>array('style'=>'width: 50px')),
        array('name'=>'LastName', 'header'=>'Прізвище'),
        array('name'=>'FirstName', 'header'=>"Ім'я"),
        array('name'=>'MiddleName', 'header'=>'По батькові'),
            
        array('name'=>'Birthday', 'header'=>'Дата народження', 'htmlOptions'=>array('style'=>'width: 150px')),   
        array('name'=>'CreateDate', 'htmlOptions'=>array('style'=>'width: 150px')),   
		/*'idPerson',
		'FirstName',
		'MiddleName',
		'LastName',
                'Birthday',
		/*
                 * 'Birthday',
		'IsResident',
		'KOATUUCode',
		'PersonEducationTypeID',
		'StreetTypeID',
		'Address',
		'HomeNumber',
		'PostIndex',
		*/
	array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{view}',
            'buttons'=>array
            (
                
                'update' => array(
                    'label'=>'Редагувати',
                    'icon'=>'pencil',
                    'url'=>'Yii::app()->createUrl("person/update", array("id"=>$data->idPerson))',
                    'options'=>array(
                        'class'=>'btn',
                        //'onclick'=>"PSN.editDoc(this); return false;",
                    ),
                 ),
               'view' => array(
                    'label'=>'Параметри вступу',
                    'icon'=>'icon-th-list',
                    'url'=>'Yii::app()->createUrl("person/view", array("id"=>$data->idPerson))',
                    'options'=>array(
                        'class'=>'btn',
                        
                    ),
                ),
            ),
            'htmlOptions'=>array(
                'style'=>'width: 90px;',
            ),
          )
	),
)); ?>
