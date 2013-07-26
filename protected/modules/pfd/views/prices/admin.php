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
                    "htmlOptions"=>array("style"=>"width: 250px;")
        //            'afterAjaxUpdate' => 'js:function(tr,rowid,data){
        //                bootbox.alert("I have afterAjax events too!
        //                This will only happen once for row with id: "+rowid);
        //                    }'
                     )
                )),
));

?>
