<?php
/*$this BenefitController 
$model = new PersonBenefits();*/
//$form = new CActiveForm();
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'znos-form',
	'enableAjaxValidation'=>false,
)); ?>
    <div class="well">
         <?php if (Yii::app()->user->hasFlash("error")){
            echo "<script> alert('".Yii::app()->user->getFlash("error")."')</script>";
         };
        ?>
    <div class="row-fluid">
        <div class="span2">
               <?php 
                $url = Yii::app()->createUrl("documents/newzno",array('personid'=>$personid));
                    $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Додати сертифікат',
                    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => null, // null, 'large', 'small' or 'mini'
                    'loadingText'=>'Зачекайте...',
                    'htmlOptions'=>array('id'=>'addZno',
                        'onclick'=>"PSN.addZno(this,'$url');",
                        ),
                )); ?>
        </div>
       
            <div class="span2">
                    <?php

                        $url = Yii::app()->createUrl("documents/edboupdate",array('personid'=>$personid));
                        $this->widget('bootstrap.widgets.TbButton', array(
                        'label'=>'Синхронізувати',
                        'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        'size' => null, // null, 'large', 'small' or 'mini'
                        'loadingText'=>'Зачекайте...',
                        'htmlOptions'=>array('onclick'=>"PSN.edboZnoUpdate(this,'$url');",),
                    )); ?>
            </div>
            <div class="span8">    
                <p> Синхронізація виконуэ перевірку та додання всіх документів до бази ЄДБО. Завантажує або перевіряє предмети ЗНО згідно даних з ЄДБО.</p>
            </div>
       
    </div>
    <hr>  
    
    <?php if (Yii::app()->user->hasFlash("message")): ?>
    <div class="row-fluid" ><h3 style="color: red;"><?php echo  Yii::app()->user->getFlash("message"); ?></h3></div>
    <?php endif; ?>
    
    <?php  /* PRINT ZNOS LIST */ ?>
    <?php if (!empty($models)): ?>   
        <?php  foreach($models as $i=>$model): ?>   
            <div class="row-fluid">
                <div class ="span1">
                        <div class="row-fluid">
                             <div class="span12"></div>
                        </div>   
                        <div class="row-fluid" style="text-align: right;">
                             <div class="span12"><b><?php echo ($i+1)."."; ?></b></div>
                        </div>    
                </div>   
                <div class ="span5">
                    <?php echo $form->labelEx($model,"[$i]Numbers"); ?>
                    <?php echo $form->textField($model,"[$i]Numbers",array('class'=>'span12','disabled'=>"disabled",  "style"=>!empty($model->edboID)? "color: green;":"" )); ?>
                </div>    
                <div class ="span2">
                    <?php echo $form->labelEx($model,"[$i]ZNOPin"); ?>
                    <?php echo $form->textField($model,"[$i]ZNOPin",array('class'=>'span12', 'disabled'=>"disabled",  "style"=>!empty($model->edboID)? "color: green;":"" )); ?>
                </div>
                 <div class ="span2">
                    <?php echo $form->labelEx($model,"[$i]DateGet"); ?>
                    <?php echo $form->textField($model,"[$i]DateGet",array('class'=>'span12', 'disabled'=>"disabled",  "style"=>!empty($model->edboID)? "color: green;":"" )); ?>
                </div>    
                
                 
                <div class ="span1">
                    <span >&nbsp;</span>
                   <?php 
                    $url = Yii::app()->createUrl("documents/delzno",array('documentid'=>$model->idDocuments));
                    
                    //if (empty($model->edboID) || Yii::app()->user->checkAccess("updateAllPost")  ){
                    $this->widget("bootstrap.widgets.TbButton", array(
                                'type'=>'danger',
                                'label'=>'',
                                'size' => null,
                                'icon'=>"icon-trash",

                                'htmlOptions'=>array(
                                        "style"=>"margin-top: 2px;",
                                        'title'=>"Видалити сертифікат",
                                        'class'=>"span12",
                                        'onclick'=>"PSN.deleteZno(this,'$url');"), 
                                )); 
                    //}
                     ?>
                </div>
                <div class ="span1">
                    <span >&nbsp;</span>
                   <?php 
                    $url = Yii::app()->createUrl("documents/editzno",array('documentid'=>$model->idDocuments));
                    //if (empty($model->edboID) || Yii::app()->user->checkAccess("updateAllPost")  ){
                    $this->widget("bootstrap.widgets.TbButton", array(
			//'type'=>'primary',
                        'label'=>'',
                        'size' => null,
                        'icon'=>"icon-edit",
                        'htmlOptions'=>array(
                                "style"=>"margin-top: 2px;",
                                'title'=>"Редагувати сертифікат",
                                'class'=>"span12",
                                'onclick'=>"PSN.editZno(this,'$url');"), 
                        )); 
                    //}
             ?>
                </div>    
            </div>
            
            <?php 
            //debug(print_r($model->subjects));
            if (!empty($model->subjects)): ?>
                    
                <?php foreach($model->subjects as $j=>$subject): ?>
                    <div class="row-fluid">
                     <div class="span2" align="center">
                       <!-- <?php echo  ($j==0) ? "<div class='span12' style='text-align: right;'><b>№</b></div>":"";?>
                        <div class="span12" align="right"><b><?php echo ($j+1)."."; ?></b></div>-->
                     </div>
                     <div class ="span4">
                                <?php //echo $form->hiddenField($model,"[$i]idDocuments"); ?>
                                <?php echo  ($j==0) ? $form->labelEx($subject,"[$j]SubjectID"):""; ?>
                                <?php echo $form->dropDownList($subject,"[$j]SubjectID", Subjects::DropDown(), array("class"=>"span12",'disabled'=>"disabled",  "style"=>!empty($model->edboID)? "color: green;":"" )); ?>
                     </div>    
<!--                     <div class ="span2">
                                <?php //echo ($j==0) ? $form->labelEx($subject,"[$j]DateGet"):""; ?>
                                <?php //echo $form->textField($subject,"[$j]DateGet",array("class"=>"span12 datepicker","maxlength"=>10,'disabled'=>"disabled" )); ?>
                     </div>    -->
                     <div class ="span2">
                                <?php echo ($j==0) ? $form->labelEx($subject,"[$j]SubjectValue"):""; ?>
                                <?php echo $form->textField($subject,"[$j]SubjectValue",array("class"=>"span12","maxlength"=>15, 'disabled'=>"disabled",  "style"=>!empty($model->edboID)? "color: green;":"" )); ?>
                     </div>    
                   </div>
                <?php endforeach; ?>
           <?php endif; ?> 
       <?php endforeach;  ?>

    <?php endif;?>   
    
    
    
    
    <?php  /* END PRINT ZNOS LIST */ ?>
    
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->
