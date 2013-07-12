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

<br/>
<h3>Cтатистика заяв абітуріентів за напрямками (обраний інтервал)</h3>
<div class="form">
<?php 
  $model = Yii::app()->user->getUserModel();
  if (empty($model->syspk) || empty($model->syspk->printIP) ) throw new Exception ("Необхідно визначити адресу серверу друку документів!");
  $ip = $model->syspk->printIP;  
  $form=$this->beginWidget('CActiveForm', array(
	'id'=>'zno-form-modal',
	'enableAjaxValidation'=>false,
        'method'=>"GET",
        'action'=>Yii::app()->createUrl("statistic/viewex"),
)); ?>
<div class="row-fluid">
    <div class="span4">
		<?php echo Chtml::label("Освітньо кваліфікаційний рівень",'okr'); ?>
		<?php echo CHtml::dropDownList('okr', "", array("6"=>"Бакалавр","7"=>"Специалист","8"=>"Магистр"),array('empty'=>'', 'class'=>"span12")); ?>
		
    </div>
    <div class ="span2">
                    <?php echo CHtml::label("Початкова дата інтервалу",'date_from',array('style'=>'font-size:8pt;')); ?>
                    <?php echo CHtml::textField('date_from', "", array('class'=>'span12 datepicker')); ?>
                    
    </div>
    <div class ="span2">
                    <?php echo CHtml::label("Кінцева дата інтервалу",'date_to',array('style'=>'font-size:8pt;')); ?>
                    <?php echo CHtml::textField('date_to', "", array('class'=>'span12 datepicker')); ?>
                    
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
 <br/>


<h3>Звіт для загальної перевірки</h3>
 <label for ="forprint" > 
    <?php echo Chtml::checkBox("forprint", false, array("id"=>"forprint", "onchange"=>"$('.forsceen').toggle(); $('.forprint').toggle();")); ?>
     Формувати звіт для друку
 </label> 
<br>

<div class="forsceen">
 <?php $this->widget("bootstrap.widgets.TbButton", array(
			'url'=>Yii::app()->createUrl("statistic/sverka"),
			'type'=>'primary',
                         "size"=>"large",
			'label'=>'Показати',
                        )); 
               
     ?>
</div>

 <div class="form forprint" style="display: none;">
<?php 
  $model = new PersonSpecialityView();
  $form=$this->beginWidget('CActiveForm', array(
	'id'=>'zno-form-modal',
	'enableAjaxValidation'=>false,
        'method'=>"POST",
        'action'=>Yii::app()->createUrl("statistic/sverka"),
)); ?>
<div class="row-fluid">
    
    <div class="span2">
	<?php echo $form->labelEx($model,'QualificationID'); ?>
	<?php echo $form->dropDownList($model,'QualificationID', CHtml::listData(Qualifications::model()->findAll(), 'idQualification', 'QualificationName'), array('empty'=>'', 'class'=>"span12",)); ?>
    </div>
    <div class="span3">
	<?php echo $form->labelEx($model,'SepcialityID'); ?>
	<?php echo $form->dropDownList($model,'SepcialityID', Specialities::DropDown(0),
                        array(  'empty'=>'',  'class'=>"span12") ); ?>
    </div>
    <div class="span1">
        <?php echo $form->labelEx($model,'isCopyEntrantDoc'); ?>
	<?php echo $form->dropDownList($model,'isCopyEntrantDoc',array(0=>"ні", 1=>"так"), array('empty'=>'', 'class'=>"span12",)); ?>
    </div>
    <div class ="span2">
         <?php   
            $cdpfilter = array(">1"=>"будь-яка", "<1"=>"немає");
            foreach (CHtml::listData(Coursedp::model()->findAll(), "idCourseDP", "CourseDPName") as $key=>$val){
                $cdpfilter[$key] = $val;
            }
            $olympfilter = array(">1"=>"будь-яка", "<1"=>"немає");
            foreach (CHtml::listData(Olympiadsawards::model()->findAll(), "OlympiadAwardID", "OlympiadAwardName") as $key=>$val){
                $olympfilter[$key] = $val;
            }
         echo $form->labelEx($model,'CoursedpID'); ?>
         <?php   echo $form->dropDownList($model,'CoursedpID',$cdpfilter, array('empty'=>'', 'class'=>"span12",)); ?>
    </div>
    <div class ="span2">
         <?php   echo $form->labelEx($model,'OlympiadID'); ?>
         <?php   echo $form->dropDownList($model,'OlympiadID',$olympfilter,  array('empty'=>'', 'class'=>"span12",)); ?>
    </div>
    
    <div class="span2">
        <?php echo $form->labelEx($model,'CreateDate'); ?>
        
       <?php /*$this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>'CreateDate',
            // additional javascript options for the date picker plugin
            'options'=>array(
                'showAnim'=>'fold',
            ),
            'htmlOptions'=>array(
                'style'=>'height:20px;'
            ),
        )); */?>
	<?php echo $form->textField($model,'CreateDate',array("class"=>"span12 datepicker")); ?>
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
 
 <br/>

<?php
//------------------------------------------------------------------------------
?>
<div class="form">
    <h3>Статистика заявок з першочерговим та позаконкурсним вступом</h3>
<?php 
  $model = Yii::app()->user->getUserModel();
  if (empty($model->syspk) || empty($model->syspk->printIP) ) throw new Exception ("Необхідно визначити адресу серверу друку документів!");
  $ip = $model->syspk->printIP;  
  $form=$this->beginWidget('CActiveForm', array(
	'id'=>'stat-pilgi',
	'enableAjaxValidation'=>false,
        'method'=>"GET",
        'action'=>Yii::app()->createUrl("statistic/viewy"),
)); ?>
<div class="row-fluid">
    <div class="span4">
		<?php echo Chtml::label("Освітньо кваліфікаційний рівень",'okr'); ?>
		<?php echo CHtml::dropDownList('okr', "", array("6"=>"Бакалавр","7"=>"Специалист","8"=>"Магистр"),array('empty'=>'', 'class'=>"span12")); ?>
		
    </div>
    <div class ="span2">
                    <?php echo CHtml::label("Початкова дата інтервалу",'date_from',array('style'=>'font-size:8pt;')); ?>
                    <?php echo CHtml::textField('date_from', "", array('class'=>'span12 datepicker')); ?>
                    
    </div>
    <div class ="span2">
                    <?php echo CHtml::label("Кінцева дата інтервалу",'date_to',array('style'=>'font-size:8pt;')); ?>
                    <?php echo CHtml::textField('date_to', "", array('class'=>'span12 datepicker')); ?>
                    
    </div>
    <div class="span4">
		<?php echo Chtml::label("Секретар",'secname'); ?>
		<?php echo CHtml::dropDownList('secname', "С.В. Іваненко", array("С.В. Іваненко"=>"С.В. Іваненко", "О.М. Олійник"=>"О.М. Олійник"),array('empty'=>'', 'class'=>"span12")); ?>
		
    </div>
    
</div>
    <hr>

    <div class="row-fluid">
    <label for ="days" > 
       <?php echo Chtml::checkBox("days", false); ?>
        По дням
    </label> 
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

<?php
//------------------------------------------------------------------------------
?>

 <br/>
 
<div clas="form">
    <h3>Графік прийому документів</h3>
    <a class="btn btn-primary btn-large" href='<?php echo Yii::app()->createUrl('personspeccounts'); ?>'>Показати</a>
</div>

<?php
//------------------------------------------------------------------------------
?>
 <br/>
 <div class="form">
     <h3>Статистика заявок з поданням оригіналів</h3>
<?php 
  $model = Yii::app()->user->getUserModel();
  if (empty($model->syspk) || empty($model->syspk->printIP) ) throw new Exception ("Необхідно визначити адресу серверу друку документів!");
  $ip = $model->syspk->printIP;  
  $act = Yii::app()->createUrl("statistic/originals");
  $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rept-originals',
	'enableAjaxValidation'=>false,
        'method'=>"GET",
        'action'=>$act,
)); ?>
<div class="row-fluid">
    <div class="span6">
		<?php echo Chtml::label("Освітньо кваліфікаційний рівень",'okr'); ?>
		<?php echo CHtml::dropDownList('okr', "", array("6"=>"Бакалавр","7"=>"Специалист","8"=>"Магистр"),array('empty'=>'', 'class'=>"span12")); ?>
		
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
 
 
 
<?php
//------------------------------------------------------------------------------
?>
 <br/>
 <div class="form">
     <h3>Статистика заявок абітурієнтів (бюджет / контракт) </h3>
<?php 
  $model = Yii::app()->user->getUserModel();
  if (empty($model->syspk) || empty($model->syspk->printIP) ) throw new Exception ("Необхідно визначити адресу серверу друку документів!");
  $ip = $model->syspk->printIP;  
  $act = Yii::app()->createUrl("statistic/viewbc");
  $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rept-originals',
	'enableAjaxValidation'=>false,
        'method'=>"GET",
        'action'=>$act,
)); ?>
<div class="row-fluid">
    <div class="span4">
		<?php echo Chtml::label("Освітньо кваліфікаційний рівень",'okr'); ?>
		<?php echo CHtml::dropDownList('okr', "", array("6"=>"Бакалавр","7"=>"Специалист","8"=>"Магистр"),array('empty'=>'', 'class'=>"span12")); ?>
		
    </div>
    <div class ="span2">
                    <?php echo CHtml::label("Початкова дата інтервалу",'date_from',array('style'=>'font-size:8pt;')); ?>
                    <?php echo CHtml::textField('date_from', "", array('class'=>'span12 datepicker')); ?>
                    
    </div>
    <div class ="span2">
                    <?php echo CHtml::label("Кінцева дата інтервалу",'date_to',array('style'=>'font-size:8pt;')); ?>
                    <?php echo CHtml::textField('date_to', "", array('class'=>'span12 datepicker')); ?>
                    
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
 
 

 
<?php
//------------------------------------------------------------------------------
?>
 <br/>
 <div class="form">
     <h3>Статистика заявок абітурієнтів (електронні заявки) </h3>
<?php 
  $model = Yii::app()->user->getUserModel();
  if (empty($model->syspk) || empty($model->syspk->printIP) ) throw new Exception ("Необхідно визначити адресу серверу друку документів!");
  $ip = $model->syspk->printIP;  
  $act = Yii::app()->createUrl("statistic/stateb");
  $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rept-originals',
	'enableAjaxValidation'=>false,
        'method'=>"GET",
        'action'=>$act,
)); ?>
<div class="row-fluid">
    <div class="span6">
		<?php echo Chtml::label("Освітньо кваліфікаційний рівень",'okr'); ?>
		<?php echo CHtml::dropDownList('okr', "", array("6"=>"Бакалавр","7"=>"Специалист","8"=>"Магистр"),array('empty'=>'', 'class'=>"span12")); ?>
		
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
 
 

 
<div class="form" style="display: none;">
    <h3>Телефони абітуріентів</h3>
<?php 
  $model = new PersonContactsView();
  $form=$this->beginWidget('CActiveForm', array(
	
	'enableAjaxValidation'=>false,
        'method'=>"get",
        'action'=>Yii::app()->createUrl("personcontactsview"),
)); ?>
<div class="row-fluid">
    
    <div class="span6">
	<?php echo $form->labelEx($model,'SepcialityID'); ?>
	<?php echo $form->dropDownList($model,'SepcialityID', Specialities::DropDown(0),
                        array(  'empty'=>'',  'class'=>"span12") ); ?>
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

<script>
    $(document).ready(function(){
        
       $(".datepicker").datepicker({'format':"dd.mm.yyyy"});
     
     
       if ($("#forprint").prop("checked")) {
           $('.forprint').show();
           $('.forsceen').hide();
       } else {
           $('.forprint').hide();
           $('.forsceen').show();
       }
    });
</script>