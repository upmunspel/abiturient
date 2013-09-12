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
<h1>Статистика</h1>
<?php
$url='http://10.1.11.57:8080/request_report-1.0/price_sort_all.jsp&iframe=true&width=1024&height=600';

 $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Всі спеціальності',
    //'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini' 
    'url'=>$url,
    'htmlOptions'=>array(
                            //'onclick'=>'PSN.printSpec(this); return true;',
                            'rel'=>"prettyPhoto",
                            'title'=>"Контракт",
        ),
    
    ));?>
&nbsp;
<?php
$url='http://10.1.11.57:8080/request_report-1.0/price_sort_all_nomoney.jsp&iframe=true&width=1024&height=600';

 $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Не оплатили',
    //'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini' 
    'url'=>$url,
    'htmlOptions'=>array(
                            //'onclick'=>'PSN.printSpec(this); return true;',
                            'rel'=>"prettyPhoto",
                            'title'=>"Контракт",
        ),
    
    ));?>
&nbsp;
<?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
        //'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large',
        'htmlOptions'=>array(
                            'target'=>"_blank",
        ),
        'buttons'=>array(
            array('label'=>'Звіт', 'items'=>array(
                array('label'=>'Денна', 'items'=>array(
                    array('label'=>'Бакалавр', 'url'=>Yii::app()->user->getPrintUrlstatFORM(1,1)),
                    array('label'=>'Спеціаліст', 'url'=>Yii::app()->user->getPrintUrlstatFORM(1,3)),
                    array( 'label'=>'Магістр', 'url'=>Yii::app()->user->getPrintUrlstatFORM(1,2)),
                    array( 'label'=>'Усі рівні кваліфікації', 'url'=>Yii::app()->user->getPrintUrlstatFORM(1,0))),
                    ),
                array('label'=>'Заочна','items'=>array(
                    array('label'=>'Бакалавр', 'url'=>Yii::app()->user->getPrintUrlstatFORM(1,2)),
                    array('label'=>'Спеціаліст', 'url'=>Yii::app()->user->getPrintUrlstatFORM(3,2)),
                    array( 'label'=>'Магістр', 'url'=>Yii::app()->user->getPrintUrlstatFORM(2,2)),
                    array( 'label'=>'Усі рівні кваліфікації', 'url'=>Yii::app()->user->getPrintUrlstatFORM(0,2))),
                    ),
                array('label'=>'Денна та заочна','items'=>array(
                    array('label'=>'Бакалавр', 'url'=>Yii::app()->user->getPrintUrlstat(1)),
                    array('label'=>'Спеціаліст', 'url'=>Yii::app()->user->getPrintUrlstat(3)),
                    array('label'=>'Магістр', 'url'=>Yii::app()->user->getPrintUrlstat(2)),
                    array( 'label'=>'Усі рівні кваліфікації', 'url'=>Yii::app()->user->getPrintUrlstat(0)),         
                )),
                )),
        ),
    )); ?>
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
                    'url' => $this->createUrl('prices/specialitys_stat'),
                    'value'=> '"Показати спеціальності"',
                    'afterAjaxUpdate' => "js:function(tr,rowid,data){
                            $('.prettyPhoto').prettyPhoto();
                        }",
                    "htmlOptions"=>array("style"=>"width: 250px;")
       
                     ),
                        array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{print}',
                 "header"=>"Ст-ка",
                'buttons'=>array
                (

                    'print' => array(
                        'label'=>'Друкувати перелік осіб, що оформили контакт',
                        'icon'=>'print',
                        'url'=>'"http://10.1.11.57:8080/request_report-1.0/price_sort_facultet.jsp?idFacultet=".$data->idFacultet."&iframe=true&width=1024&height=600"',
                        'options'=>array(
                            'class'=>'btn prettyPhoto',
                            //'onclick'=>'Yii::app()->user->getPrintSortUrl($data->idSpeciality)',
                            'rel'=>"prettyPhoto",
                            'title'=>"Перелік осіб, що оформили контакт",
                        ),
                    ),
                   
                ),
                'htmlOptions'=>array(
                    'style'=>'width: 30px;',
                ),
            )
                )),
    
));

?>
<hr>
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
   