<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!--http://10.1.11.57:8080/request_report-1.0/journal?SpecialityID=  idOKR=  eduFormID=  date=-->
<!--http://10.1.11.57:8080/request_report-1.0/bachelor.jsp?PersonID=1&PersonSpecialityID=1&iframe=true&width=1024&height=600-->
<h3>Звіт "Журнал реєстрації осіб"</h3>
<hr>
<div class="form">
<?php 
  $model = Yii::app()->user->getUserModel();
  if (empty($model->syspk) || empty($model->syspk->printIP) ) throw new Exception ("Необхідно визначити адресу серверу друку документів!");
  $ip = $model->syspk->printIP;  
  $act = "http://$ip".":8080/request_report-1.0/journal.jsp?";
  $form=$this->beginWidget('CActiveForm', array(
	'id'=>'zno-form-modal',
	'enableAjaxValidation'=>false,
        'method'=>"GET",
        'action'=>$act,
)); ?>
    Параметри звіту:
<div class="row-fluid">
    <div class ="span6">
         <?php  echo CHtml::label("Спеціальність",'SpecialityID'); ?>
         <?php echo CHtml::dropDownList( 'SpecialityID', "", Specialities::DropDown(0), array(  'empty'=>'','class'=>"span12") ); ?>
    </div>    
    <div class ="span2">
         <?php  echo CHtml::label("Форма обучения",'eduFormID'); ?>
         <?php echo CHtml::dropDownList( 'eduFormID', "", CHtml::listData(Personeducationforms::model()->findAll(), 'idPersonEducationForm', 'PersonEducationFormName'), array(  'empty'=>'','class'=>"span12") ); ?>
    </div>    
    <div class="span2">
		<?php echo Chtml::label("Окр",'idOKR'); ?>
		<?php echo CHtml::dropDownList('idOKR',"",CHtml::listData(Qualifications::model()->findAll(), 'idQualification', 'QualificationName'),array('empty'=>'', 'class'=>"span12")); ?>
		
    </div>
    <div class ="span2">
                    <?php echo CHtml::label("Дата",'Date'); ?>
                    <?php echo CHtml::textField('Date', "", array('class'=>'span12 datepicker')); ?>
                    
    </div>
    
</div>
    <div class="row-fluid">
     <?php $this->widget("bootstrap.widgets.TbButton", array(
			'buttonType'=>'submit',
			'type'=>'primary',
                         "size"=>"large",
			'label'=>'Друкувати',
                        )); 
               
     ?>
    </div>
<?php $this->endWidget(); ?>
</div>



<h3>Звіт "Журнал"</h3>
<hr>
<div class="form">
<?php 
  $model = Yii::app()->user->getUserModel();
  if (empty($model->syspk) || empty($model->syspk->printIP) ) throw new Exception ("Необхідно визначити адресу серверу друку документів!");
  $ip = $model->syspk->printIP;  
  $act = "http://$ip".Yii::app()->params['printUrl'];
  $form=$this->beginWidget('CActiveForm', array(
	'id'=>'zno-form-modal',
	'enableAjaxValidation'=>false,
        'method'=>"GET",
        'action'=>$act,
)); ?>

<div class="row-fluid">
    
    <div class ="span2">
                    <?php echo CHtml::label("Дата",'curr_data'); ?>
                    <?php echo CHtml::textField('Date', "", array('class'=>'span12 datepicker')); ?>
                    
    </div>
    
</div>
    <div class="row-fluid">
     <?php $this->widget("bootstrap.widgets.TbButton", array(
			'buttonType'=>'submit',
			'type'=>'primary',
                         "size"=>"large",
			'label'=>'Друкувати',
                        )); 
               
     ?>
    </div>
<?php $this->endWidget(); ?>
</div>
<script>
    $(document).ready(function(){
       //$(".datepicker").datepicker({'format':"dd.mm.yyyy"});
    });
</script>
