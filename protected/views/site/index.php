<?php
/* @var $this Sitecontroller */
$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>'Вітаємо в системі "'.CHtml::encode(Yii::app()->name).'"',
)); ?>

<p>Запорізький національний університет</p>
<br/>

  <div class="span2">
      <?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Абітурієнти',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
     'url'=>Yii::app()->createUrl("person"),
    )); ?>
  </div>
  <div class="span2">
      <?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Довідники',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'url'=>Yii::app()->createUrl("directory"),
    )); ?>
  </div>
    <div class="span3" style="">
      <?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Статистика вступу',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    )); ?>
    </div>
      <div class="span2">
  <?php
 $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Тестовий друк',
    'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini' 
     'url'=>("http://10.1.103.26:8080/request_report-1.0/?iframe=true&width=1024&height=450&PersonID=33"),
    
    )); //<a href="http://10.1.103.26:8080/JasperReports/?iframe=true&width=1024&height=450" title="Тестовий друк">Тестовий друк</a>
      //'<a href="http://10.1.103.26:8080/JasperReports/?iframe=true&width=1024&height=450">Link to myFunction</a>';
    ?>
    </div>
<a href="http://10.1.103.26:8080/request_report-1.0/?PersonID=33&iframe=true&width=1024&height=500" title="Тестовий друк" rel="prettyPhoto[]">Тестовий друк</a>
    </div>
<div class="row">
<?php 
    $this->beginWidget('ext.prettyPhoto.PrettyPhoto', array(
        'id'=>'pretty_photo',
        // prettyPhoto options
        'options'=>array(
          'opacity'=>0.60,
          'modal'=>true,

        ),
      ));
    ?>
     <a href="http://10.1.103.26:8080/request_report-1.0/?iframe=true&width=1024&height=450&PersonID=33" title="Тестовий друк">Тестовий друк</a>
   <?php // $this->widget('bootstrap.widgets.TbButton', array(
//    'label'=>'Тестовий друк',
//    'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
//    'size'=>'large', // null, 'large', 'small' or 'mini' 
//     'url'=>("http://10.1.103.26:8080/request_report-1.0/?iframe=true&width=1024&height=450&PersonID=33"),
//    
    //)); //<a href="http://10.1.103.26:8080/request_report-1.0/?iframe=true&width=1024&height=450&PersonID=33" rel = "" title="Тестовий друк">Тестовий друк</a>
      //'<a href="http://10.1.103.26:8080/JasperReports/?iframe=true&width=1024&height=450">Link to myFunction</a>';
    ?>
    <a href="http://10.1.103.26:8080/request_report-1.0/?PersonID=33&iframe=true&width=1024&height=450" title="Тестовий друк">Тестовий друк</a>
 
<?php  $this->endWidget('ext.prettyPhoto.PrettyPhoto'); ?>
</div>



<?php $this->endWidget(); ?>
