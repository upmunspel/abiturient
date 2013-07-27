<?php
/* @var $this ContractsController */
/* @var $model Contracts */


$this->menu=array(
array('label'=>'Додати запис', 'url'=>array('create'), 'icon'=>"icon-plus"),
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
		'idContract',
		'PersonSpecialityID',
		'ContractNumber',
		'ContractDate',
		'CustomerName',
		'CustomerDoc',
                'PaymentDate',
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
