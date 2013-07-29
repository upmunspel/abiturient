<?php
/* @var $this ContractsController */
/* @var $model Contracts */

$this->menu=array(
//array('label'=>'Додати запис', 'url'=>array('create'), 'icon'=>"icon-plus"),
array('label'=>'Пошук Абітурієнтів', 'url'=>array('index'), 'icon'=>"icon-search"), 
);

?>
<h1>Контракти</h1>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
     'id'=>'contracts-grid',
     'type'=>'striped bordered condensed',
'dataProvider'=>$model->search(),
'filter'=>$model,
//'template'=>"{items}",
'columns'=>array(
		array("name"=>'idContract', "header"=>"Код", 'htmlOptions'=>array("style"=>"width: 50px;")),
                array("name"=>'ContractNumber', 'htmlOptions'=>array("style"=>"width: 150px;")),
              //'PersonSpecialityID',
	        array("name"=>'ContractDate', 'htmlOptions'=>array("style"=>"width: 150px;")),
	        array("name"=>'ContractNumber', 'htmlOptions'=>array("style"=>"width: 250px;"),"value"=>'$data->speciality->SpecCodeName'),
		
                'CustomerName',
		//'CustomerDoc',
                array("name"=>'PaymentDate', 'htmlOptions'=>array("style"=>"width:150px;")),
             
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
