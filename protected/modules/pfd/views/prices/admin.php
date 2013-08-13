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
    'columns' =>    
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
       
                     ),
                )),
    
));

?>
<hr>
<?php
$url=Yii::app()->createUrl('pfd/prices/stat');
 $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Статистика',
    'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini' 
    'url'=>$url,
    'htmlOptions'=>array(
                            //'onclick'=>'PSN.printSpec(this); return true;',
                            //'rel'=>"prettyPhoto",
                            'title'=>"Статистика",
        ),
    
    ));?>
&nbsp;
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
   