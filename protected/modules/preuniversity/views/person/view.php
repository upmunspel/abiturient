<?php 
$this->beginWidget('ext.prettyPhoto.PrettyPhoto', array(
        'id'=>'pretty_photo',
        // prettyPhoto options
        'options'=>array(
          'opacity'=>0.60,
          'modal'=>true,

        ),
      ));
$this->endWidget('ext.prettyPhoto.PrettyPhoto'); ?>


<?php
$burl = Yii::app()->baseUrl;
Yii::app()->getClientScript()->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile($burl."/js/bootstrap-datepicker.js");
Yii::app()->clientScript->registerScriptFile($burl."/js/person.js");
Yii::app()->clientScript->registerPackage('select2');


$this->menu=array(
	array('label'=>'Перелік абітурієнтів','url'=>Yii::app()->createUrl('preuniversity/person'),'icon'=>"icon-list-alt"),
	array('label'=>'Додати  абітурієнта','url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Редагувати абітурієнта','url'=>array('update','id'=>$model->idPerson),'icon'=>" icon-pencil" ),
    
        //array('label'=>'Синхронізувати персону','url'=>array('view','id'=>$model->idPerson,'opt'=>'edboadd'),'icon'=>" icon-pencil",  "htmlOptions"=>array("onclick"=>"blockUI();") ),
	//array('label'=>'Видалити абітурієнта','url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idPerson),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Person','url'=>array('admin')),
);
?>



<?php if (Yii::app()->user->hasFlash("message")): ?>
        <?php $str= Yii::app()->user->getFlash("message");  ?>
        <div class="row-fluid" ><h3 style="color: red;"><?php echo  $str; ?></h3></div>
<?php endif; ?>
         <h2>Загальна інформація про абітурієнта (<?php echo $model->idPerson; ?>)</h2>
<div class="row-fluid">
    <div class="span8">
       
<?php 
//$model->FIO = $model->LastName." ".$model->FirstName." ".$model->MiddleName;
$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
        'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idPerson',
                "FIO",
//                 'LastName',
//		'FirstName',
//		'MiddleName',
                "Birthday",
                 "codeU",
                 "edboID",
                 "operatorInfo",
	),
)); ?>
    </div>
    
    <div class="span4" id="person-photo">
        <?php $this->renderPartial("_photo",array('model'=>$model)); ?>
    </div>
</div>
<h3>Параметри вступу абітурієнта</h3> 
<div  style="   background-color: #fff;
                border: 1px solid #ddd;
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                border-radius: 4px;
                padding:10px;">
   
    <!--Вкладки-->
    <div id="tab-holder">
       <?php $this->renderPartial("tabs/_tabs",  array('model'=>$model)); ?>
    </div>
    <!--/Вкладки-->
    <hr>
<!--    <p>Правила заповнення</p>-->
       <?php /*$this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'button',
                'type'=>'primary',
                'label'=>'Зберегти всі зміни',
                'size'=>"large",
                'loadingText'=>'Збереження...',
                'htmlOptions'=>array('id'=>'personSave'),
                )); */
            ?>
    
</div>

<div id="new-zno"></div>
<div id="spec-modal-holder"></div>
<div id="spec-modal-holder-error"></div>
<div id="spec_electron-modal-holder"></div>
<div id="doc-modal-holder"></div>
<div id="benefit-modal-holder"></div>
