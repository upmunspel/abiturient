<?php
/* @var $this AllcountsController */
?>
 <br/>
 
<div class="form">
    <h3>Статистика заявок абітурієнтів</h3>
<?php 
  $model = Yii::app()->user->getUserModel();
  if (empty($model->syspk) || empty($model->syspk->printIP) ) throw new Exception ("Необхідно визначити адресу серверу друку документів!");
  $ip = $model->syspk->printIP;  
  $act = Yii::app()->createUrl("allcounts/view");
  $form=$this->beginWidget('CActiveForm', array(
	'id'=>'zno-form-modal',
	'enableAjaxValidation'=>false,
        'method'=>"GET",
        'action'=>$act,
)); ?>
<div class="row-fluid">
    <div class="span3">
		<?php echo Chtml::label("Освітньо кваліфікаційний рівень",'okr'); ?>
		<?php echo CHtml::dropDownList('okr', "", array("6"=>"Бакалавр","7"=>"Спеціаліст","8"=>"Магістр"),array('empty'=>'', 'class'=>"span12")); ?>
		
    </div>
    
    <div class="span3">
		<?php echo Chtml::label("Показати",'mode'); ?>
		<?php echo CHtml::dropDownList('mode', "", 
                        array("0"=>"Усі дані",
                            "1"=>"По формам навчання",
                            "2"=>"Бюджет/контракт по формам навчання",
                            "3"=>"Заявки з позачерговим і позаконкурсним вступом по формам навчання",
                            "4"=>"Електронні заявки",
                            "5"=>"Медалісти (тільки для бакалаврів)",
                            "6"=>"Подання оригіналів"),
                        array('empty'=>'', 'class'=>"span12")); ?>
		
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
<?php $this->endWidget();
?>
</div>