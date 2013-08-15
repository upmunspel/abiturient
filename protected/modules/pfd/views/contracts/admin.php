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
&nbsp;
<?php
$url='http://10.1.11.57:8080/request_report-1.0/price_sort_same.jsp&iframe=true&width=1024&height=600';

 $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Контракти більше 1',
    //'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini' 
    'url'=>$url,
    'htmlOptions'=>array(
                            //'onclick'=>'PSN.printSpec(this); return true;',
                            'rel'=>"prettyPhoto",
                            'title'=>"Контракти >1",
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
<script type="text/javascript">
/*<![CDATA[*/
jQuery('#pretty_photo a').attr('rel','prettyPhoto');
jQuery('a[rel^="prettyPhoto"]').prettyPhoto({'opacity':0.6,'modal':true,'theme':'facebook'});
/*]]>*/
</script>