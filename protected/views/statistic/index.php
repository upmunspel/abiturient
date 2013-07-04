<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!--http://10.1.11.57:8080/request_report-1.0/journal?SpecialityID=  idOKR=  eduFormID=  date=-->
<!--http://10.1.11.57:8080/request_report-1.0/bachelor.jsp?PersonID=1&PersonSpecialityID=1&iframe=true&width=1024&height=600-->
<h3>Щоденна статистика заяв абітуріентів за напрямками</h3>

<div class="form">
<?php 
  $model = Yii::app()->user->getUserModel();
  if (empty($model->syspk) || empty($model->syspk->printIP) ) throw new Exception ("Необхідно визначити адресу серверу друку документів!");
  $ip = $model->syspk->printIP;  
  $act = Yii::app()->createUrl("statistic/view");
  $form=$this->beginWidget('CActiveForm', array(
	'id'=>'zno-form-modal',
	'enableAjaxValidation'=>false,
        'method'=>"GET",
        'action'=>$act,
)); ?>
<div class="row-fluid">
    <div class="span6">
		<?php echo Chtml::label("Освітньо кваліфікаційний рівень",'okr'); ?>
		<?php echo CHtml::dropDownList('okr', "", array("6"=>"Бакалавр","7"=>"Специалист","8"=>"Магистр"),array('empty'=>'', 'class'=>"span12")); ?>
		
    </div>
    <div class ="span2">
                    <?php echo CHtml::label("Дата",'date'); ?>
                    <?php echo CHtml::textField('date', "", array('class'=>'span12 datepicker')); ?>
                    
    </div>
    <div class="span4">
		<?php echo Chtml::label("Секретар",'secname'); ?>
		<?php echo CHtml::dropDownList('secname', "С.В. Іваненко", array("С.В. Іваненко"=>"С.В. Іваненко", "О.М. Олійник"=>"О.М. Олійник"),array('empty'=>'', 'class'=>"span12")); ?>
		
    </div>
    
</div>
    <hr>
    <div class="row-fluid">
     <?php $this->widget("bootstrap.widgets.TbButton", array(
			'buttonType'=>'submit',
			'type'=>'primary',
                         "size"=>"large",
			'label'=>'Показати',
                        )); 
               
     ?>
    </div>
<?php $this->endWidget(); ?>
</div>


<h3>Звіт для загальної перевірки</h3>

 <?php $this->widget("bootstrap.widgets.TbButton", array(
			'url'=>Yii::app()->createUrl("statistic/sverka"),
			'type'=>'primary',
                         "size"=>"large",
			'label'=>'Показати',
                        )); 
               
     ?>








<script>
    $(document).ready(function(){
       $(".datepicker").datepicker({'format':"dd.mm.yyyy"});
    });
</script>
