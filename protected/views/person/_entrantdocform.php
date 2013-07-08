<?php 
 $user = Yii::app()->user->getUserModel();
// $form = new CActiveForm();
// $form->
?>

<div class="row-fluid">
<!--            <div class ="span12">-->
                <?php echo $form->errorSummary($model) ?>
<!--            </div>-->
</div>
<div class="row-fluid">
    <div class ="span5">
        <?php echo $form->hiddenField($model,'[entrantdoc]edboID'); ?>
        <?php echo $form->hiddenField($model,'[entrantdoc]TypeID'); ?>
        <?php echo $form->labelEx($model,'[entrantdoc]TypeID'); ?>
        <?php echo $form->dropDownList($model,'[entrantdoc]TypeID',  PersonDocumentTypes::DropDown(1), array('class'=>'span12', 'disabled'=>!empty($model->edboID))); ?>
    </div>    
    <div class ="span1">
        <?php echo $form->labelEx($model,'[entrantdoc]Series'); ?>
        <?php echo $form->textField($model,'[entrantdoc]Series',array('class'=>'span12 series','maxlength'=>10)); ?>
    </div>    
    <div class ="span2">
        <?php echo $form->labelEx($model,'[entrantdoc]Numbers'); ?>
        <?php echo $form->textField($model,'[entrantdoc]Numbers',array('class'=>'span12','maxlength'=>15)); ?>
    </div>    
    <div class ="span2">
        <?php echo $form->labelEx($model,'[entrantdoc]DateGet'); ?>
        <?php echo $form->textField($model,'[entrantdoc]DateGet', array('class'=>'span12 datepicker')); ?>
        <?php //echo $form->textFieldRow($model,'ZNOPin',array('class'=>'span5')); ?>
        <?php //echo $form->textFieldRow($model,'AtestatValue',array('class'=>'span5','maxlength'=>10)); ?>
    </div> 
    <div class ="span2">
        <?php echo $form->labelEx($model,'[entrantdoc]AtestatValue'); ?>
        <?php echo $form->textField($model,'[entrantdoc]AtestatValue', array('class'=>'span12')); ?>
        <?php //echo $form->textFieldRow($model,'ZNOPin',array('class'=>'span5')); ?>
        <?php //echo $form->textFieldRow($model,'AtestatValue',array('class'=>'span5','maxlength'=>10)); ?>
    </div> 
</div>
<div class="row-fluid">
    
    <?php if (!($user->syspk->QualificationID == 2 || $user->syspk->QualificationID == 3) ) :?>
        <div class ="span11">
            <?php echo $form->labelEx($model,'[entrantdoc]Issued'); ?>
            <?php echo $form->textField($model,'[entrantdoc]Issued',array('class'=>'span12 entrantissued','maxlength'=>250)); ?>
        </div> 
    <?php else: ?>
        <div class ="span12">
        <?php 
        if ($model->isNewRecord){
            $model->Issued = "Державний вищий навчальний заклад 'Запорізький національний університет'";
        }
        //debug($model->Issued );
        echo $form->labelEx($model,'[entrantdoc]Issued'); 
        echo $form->textField($model,'[entrantdoc]Issued',array('class'=>'span12 entrantissued','maxlength'=>250)); ?>
        <?php  /*$this->widget('bootstrap.widgets.TbTypeahead', array(
                    'name'=>  CHtml::activeName($model,'[entrantdoc]Issued'),
                    'htmlOptions'=>array("class"=>"span12"),
                    'options'=>array(
                        'source'=>array("Державний вищий навчальний заклад 'Запорізький національний університет'", "Запорізький національний технічний університет",),
                        'items'=>4,
                        'matcher'=>"js:function(item) {
                            return ~item.toLowerCase().indexOf(this.query.toLowerCase());
                        }",
                    ),
                ));*/ ?>
      </div> 
    <?php endif; ?>
    
   
    <?php if (!($user->syspk->QualificationID == 2 || $user->syspk->QualificationID == 3) ):?>
    <div class ="span1">
        <?php echo CHtml::label("Оновити",""); ?>
        <?php $this->widget("bootstrap.widgets.TbButton", array(
			'type'=>'primary',
                        'label'=>'',
                        //'size' => null,
                        'icon'=>"icon-magnet",
                        'htmlOptions'=>array(
                             
                                'title'=>"Оновити",
                                'class'=>"span12",
                                'onclick'=>"PSN.copySchool();"), 
                        )); 
                ?>
    </div>
    <?php endif;?>
</div>
<div class="row-fluid">
     <div class="span3">
          <?php echo $form->labelEx($model,'[entrantdoc]PersonDocumentsAwardsTypesID'); ?>
          <?php $c = new CDbCriteria();
            if (!($user->syspk->QualificationID == 2 || $user->syspk->QualificationID == 3) ) {
                $c->compare("idPersonDocumentsAwardsTypes", "<3");
            } else {
                $c->compare("idPersonDocumentsAwardsTypes", "3");
            } ?>
          <?php echo $form->dropDownList($model,'[entrantdoc]PersonDocumentsAwardsTypesID', CHtml::listData(Persondocumentsawardstypes::model()->findAll($c), 'idPersonDocumentsAwardsTypes', 'PersonDocumentsAwardsTypesName'),array('empty'=>'','class'=>'span12')); ?>
    </div>
    <div class ="span2">
        <?php  echo $form->labelEx($model,'[entrantdoc]isForeinghEntrantDocument'); ?>
        <div class="switch" data-on-label="Так" data-off-label="Ні">
            <?php echo $form->checkBox($model,'[entrantdoc]isForeinghEntrantDocument'); ?>
        </div>
    </div>
    <div class ="span2">
       <?php  echo $form->labelEx($model,'[entrantdoc]isNotCheckAttestat'); ?>
        <div class="switch" data-on-label="Так" data-off-label="Ні">
            <?php echo $form->checkBox($model,'[entrantdoc]isNotCheckAttestat'); ?>
        </div>
    </div>
    
    
    <?php 
    // Не отображать ели магистр или специалист
    //if (($user->syspk->QualificationID == 2 || $user->syspk->QualificationID == 3) ):?>
    <div class ="span5">
        <?php echo $form->labelEx($model,'[entrantdoc]PersonBaseSpecealityID'); ?>
        <?php echo $form->dropDownList($model, '[entrantdoc]PersonBaseSpecealityID', Personbasespeciality::DropDown(),array('empty'=>"", 'class'=>'span12')); ?>
    </div> 
    <?php //endif; ?>
    
</div>

