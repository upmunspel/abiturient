<?php
/* @var $this PhotoloaderController */
$this->renderPartial("_search");
?>
<p>Перелік абітуріентів без фотографій.</p>
<?php 
$dataProvider=new CActiveDataProvider('Person', array('criteria'=>array(
    'condition'=>"PhotoName = '".Yii::app()->params['defaultPersonPhoto']."'",
    //'order'=>'create_time DESC',
//    'with'=>array('type'),
    ),
//    'sort' =>array(
//            'attributes' =>array(
//                    'type'=>array(
//                                    'asc'=>'type.PersonDocumentTypesName',
//                                    'desc'=>'type.PersonDocumentTypesName DESC',
//                            ),
//                    '*',
//            ),
//        ),
//    'pagination'=>array(
//        'pageSize'=>10,
//    )
));

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'person-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$dataProvider,
	//'filter'=>$dataProvider,
	'columns'=>array(
        array('name'=>'idPerson', 'header'=>'Код', 'htmlOptions'=>array('style'=>'width: 50px')),
        array('name'=>'FirstName', 'header'=>'Прізвище'),
        array('name'=>'LastName', 'header'=>"Ім'я"),
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


