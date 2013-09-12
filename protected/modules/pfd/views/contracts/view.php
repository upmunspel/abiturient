<?php
/* @var $this ContractsController */
/* @var $model Contracts */

$this->breadcrumbs=array(
	'Contracts'=>array('index'),
	$model->idContract,
);

$this->menu=array(
	//array('label'=>'List Contracts', 'url'=>array('admin'), "icon"=>""),
	//array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idContract),'icon'=>" icon-pencil"),
	array('label'=>'Видалити запис', 'url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idContract),'confirm'=>'Ви впевнені, що хочете видалити цей елемент?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
    

);
?>

<h2>Контракт №<?php echo $model->ContractNumber; ?> від <?php echo $model->ContractDate; ?></h2>
<?php
$specmodel = new PersonSpecialityView();
if ($model->isNewRecord){
    $specmodel=PersonSpecialityView::model()->find("idPersonSpeciality = $specid");
} else {
    $specmodel=PersonSpecialityView::model()->find("idPersonSpeciality = ".$model->PersonSpecialityID);
}

$specid=$model->PersonSpecialityID;
$url='http://10.1.11.57:8080/request_report-1.0/price.jsp?idPersonSpeciality='.$specid.'&iframe=true&width=1024&height=600';

$model->PersonSpecialityID = $specmodel->SpecCodeName;

?>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
        'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idContract',
		'PersonSpecialityID',
		//'ContractNumber',
		'ContractDate',
		'CustomerName',
		'CustomerDoc',
		'CustomerAddress',
		'CustomerPaymentDetails',
		'PaymentDate',
		'Comment',
	),
)); ?>
<hr>
<?php


 $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Друкувати',
    'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini' 
    'url'=>$url,
    'htmlOptions'=>array(
                            //'onclick'=>'PSN.printSpec(this); return true;',
                            'rel'=>"prettyPhoto",
                            'title'=>"Контракт",
        ),
    
    ));?>

<?php 
  $this->beginWidget('ext.prettyPhoto.PrettyPhoto', array(
  'id'=>'pretty_photo',
  // prettyPhoto options
  'options'=>array(
  'opacity'=>0.60,
  'modal'=>true,
    
  ),
));?>
<?php $this->endWidget('ext.prettyPhoto.PrettyPhoto'); ?>
