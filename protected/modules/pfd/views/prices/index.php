<?php
/* @var $this PricesController */
/* @var $dataProvider CActiveDataProvider */?>
<?php 
$this->beginWidget('ext.prettyPhoto.PrettyPhoto', array(
        'id'=>'pretty_photo',
        // prettyPhoto options
        'options'=>array(
          'opacity'=>0.60,
          'modal'=>true,

        ),
      ));
$this->endWidget('ext.prettyPhoto.PrettyPhoto'); 


$this->menu=array(
	array('label'=>'Manage Prices', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>
<?php
$burl = Yii::app()->baseUrl;
Yii::app()->getClientScript()->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile($burl."/js/bootstrap-datepicker.js");
Yii::app()->clientScript->registerScriptFile($burl."/js/prices.js");
?>
<h1>Довідник Prices</h1>
<br>
    <!--Вкладки-->
   <div id="tab-holder">
       <?php $this->renderPartial("tabs/_tabs",  array('model'=>$model)); ?>
    </div>
    <!--/Вкладки-->
<div id="studprice-modal-holder"></div>