 <div class="form">
<?php 
  $model = new PersonSpecialityView();
  $form=$this->beginWidget('CActiveForm', array(
	'id'=>'zno-form-modal',
	'enableAjaxValidation'=>false,
        'method'=>"GET",
        'action'=>Yii::app()->createUrl("statistic/util"),
)); ?>
<div class="row-fluid">
    
<!--    <div class="span2">
	<?php echo $form->labelEx($model,'QualificationID'); ?>
	<?php echo $form->dropDownList($model,'QualificationID', CHtml::listData(Qualifications::model()->findAll(), 'idQualification', 'QualificationName'), array('empty'=>'', 'class'=>"span12",)); ?>
    </div>-->
    <div class="span3">
	<?php echo $form->labelEx($model,'SepcialityID'); ?>
	<?php echo $form->dropDownList($model,'SepcialityID', Specialities::DropDown(0),
                        array(  'empty'=>'',  'class'=>"span12") ); ?>
        <?php echo CHtml::checkBox("renum", false); ?>
    </div>
<!--    <div class="span1">
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
    </div>-->
    
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