<?php
/* @var $this ContractsController */
/* @var $model Contracts */

$this->menu=array(
//array('label'=>'Додати запис', 'url'=>array('create'), 'icon'=>"icon-plus"),
array('label'=>'Пошук Абітурієнтів', 'url'=>array('index'), 'icon'=>"icon-search"), 
);

?>
<h1>Контракти</h1>


<?php
//$edt = CHtml::listData(Personeducationforms::model()->findAll(), 'idPersonEducationForm','PersonEducationFormName');
$this->widget('bootstrap.widgets.TbGridView', array(
     'id'=>'contracts-grid',
     'type'=>'striped bordered condensed',
'dataProvider'=>$model->search(),
'filter'=>$model,
//'template'=>"{items}",
'columns'=>array(
		array("name"=>'idContract', "header"=>"Код", 'htmlOptions'=>array("style"=>"width: 50px;")),
                //array("name"=>'ContractNumber', 'htmlOptions'=>array("style"=>"width: 150px;")),
                //'PersonSpecialityID',
	        array("name"=>'ContractDate', 'htmlOptions'=>array("style"=>"width: 150px;")),
	        array("name"=>'PersonSpecialityID', 'htmlOptions'=>array("style"=>"width: 250px;"),"value"=>'$data->speciality->SpecCodeName'),
                array("name"=>'educationFormID',"header"=>"Форма" , 'htmlOptions'=>array("style"=>"width: 50px;"),"value"=>'($data->speciality->EducationFormID=="1")?("Денна"):("Заочна")','filter'=>array('1'=>'Денна','2'=>'Заочна')),
		array("name"=>'speciality','header'=>"ФІО", 'htmlOptions'=>array("style"=>"width: 250px;"), "value"=>'$data->speciality->FIO'),
                // 'CustomerName',
		//'CustomerDoc',
                array("name"=>'PaymentDate', 'htmlOptions'=>array("style"=>"width:120px;")),
             
		/*
		'CustomerAddress',
		'CustomerPaymentDetails',
		'PaymentDate',
		'Comment',
		*/
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
