<?php
/* @var $this PhotoloaderController */
$this->renderPartial("_search");
?>
<p>Перелік абітуріентів без фотографій.</p>
<?php 


$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'person-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$model->PhotoSearch(),
	'filter'=>$model,
	'columns'=>array(
        array('name'=>'idPerson', 'header'=>'Код', 'htmlOptions'=>array('style'=>'width: 50px')),
        array('name'=>'LastName', 'header'=>"Прізвище"),
        array('name'=>'FirstName', 'header'=>"Ім'я"),
       
        array('name'=>'MiddleName', 'header'=>'По батькові'),
        array('name'=>'Birthday', 'header'=>'Дата народження', 'htmlOptions'=>array('style'=>'width: 150px')),   
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
            'template'=>'{update}',
            'buttons'=>array
            (
                
                'update' => array(
                    'label'=>'Змінити фото абітуріента',
                    'icon'=>'pencil',
                    'url'=>'Yii::app()->createUrl("photoloader/update", array("id"=>$data->idPerson))',
                    'options'=>array(
                        'class'=>'btn',
                        //'onclick'=>"PSN.editDoc(this); return false;",
                    ),
                 ),
              
            ),
            'htmlOptions'=>array(
                'style'=>'width: 45px;',
            ),
          )
	),
)); ?>


