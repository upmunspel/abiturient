<?php
/* @var $this PricesController */
/* @var $model Prices */

//$this->breadcrumbs=array(
//	'Prices'=>array('index'),
//	'Довідник ',
//);

$this->menu=array(
//array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
array('label'=>'Головна ','url'=>Yii::app()->createUrl('pfd/prices/admin'),'icon'=>"icon-home"),

);

$this->beginWidget('ext.prettyPhoto.PrettyPhoto', array(
        'id'=>'pretty_photo',
        // prettyPhoto options
        'options'=>array(
          'opacity'=>0.60,
          'modal'=>true,

        ),
      ));
$this->endWidget('ext.prettyPhoto.PrettyPhoto'); 
?>
<h1>Довідник цін на навчання</h1>

<?php 
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    //'filter'=>$model,
    'type'=>'striped bordered',
    'dataProvider' => $model->search(),
    'template' => "{items}",
    'columns' => //array("FacultetFullName"),
    
    array_merge( array(array("name"=>"FacultetFullName","header"=>"Назва факультету")), 
            array(
                array(
                    'class'=>'bootstrap.widgets.TbRelationalColumn',
                    'name' => 'idFacultet',
                    'header'=>"Деталі",
                    'url' => $this->createUrl('prices/specialitys'),
                    'value'=> '"Показати спеціальності"',
                    'afterAjaxUpdate' => "js:function(tr,rowid,data){
                            $('.prettyPhoto').prettyPhoto();
                        }",
                    "htmlOptions"=>array("style"=>"width: 250px;")
       
                     )
                )),
));

?>
<hr>
<?php
$url='http://10.1.11.57:8080/request_report-1.0/price_sort_all.jsp&iframe=true&width=1024&height=600';

 $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Всі спеціальності',
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