<?php 
$burl = Yii::app()->baseUrl;
Yii::app()->getClientScript()->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile($burl."/js/bootstrap-datepicker.js");
Yii::app()->clientScript->registerScriptFile($burl."/js/person.js");

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'person-form',
    //'type'=>'horizontal',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array("class"=>"well form"),
));
$form = new TbActiveForm();
?>
      


<p class="help-block"><strong>Особисті дані</strong></p>
        <hr>
<!--        <div class="row-fluid">
            <div class ="span12">
                <?php //echo $form->errorSummary($model) ?>
            </div>
        </div>-->
            
        <div class="row-fluid">
            <div class ="span9">
            <div class="row-fluid">
                <div class ="span4">
                <?php echo $form->labelEx($model,'LastName');//,array('class'=>'span3'));?>
                <?php echo $form->textField($model,'LastName',array('id'=>"LastName",'class'=>'span12','maxlength'=>50)); ?>
                <?php //echo $form->error($model,'LastName'); ?>        
                </div>
                <div class ="span4">
                <?php echo $form->labelEx($model,'FirstName');//,array('class'=>'span3'));?>
                <?php echo $form->textField($model,'FirstName',array('id'=>"FirstName",'class'=>'span12','maxlength'=>50)); ?>
                <?php //echo $form->error($model,'FirstName'); ?>    
                </div>
              
                <div class ="span4">
                <?php echo $form->labelEx($model,'MiddleName');//,array('class'=>'span3'));?>
                <?php echo $form->textField($model,'MiddleName',array('id'=>"MiddleName", 'class'=>'span12','maxlength'=>50)); ?>
                <?php //echo $form->error($model,'MiddleName'); ?>    
                </div>
            </div>
            <div class="row-fluid">
                 <div class ="span4">
                <?php echo $form->labelEx($model,'LastNameR');//,array('class'=>'span3'));?>
                <?php echo $form->textField($model,'LastNameR',array('id'=>"LastNameR",'class'=>'span12','maxlength'=>50)); ?>
                </div>
                
                <div class ="span4">
                <?php echo $form->labelEx($model,'FirstNameR');//,array('class'=>'span3'));?>
                <?php echo $form->textField($model,'FirstNameR',array('id'=>"FirstNameR",'class'=>'span12','maxlength'=>50)); ?>
                </div>
               
                <div class ="span4">
                <?php echo $form->labelEx($model,'MiddleNameR');//,array('class'=>'span3'));?>
                <?php echo $form->textField($model,'MiddleNameR',array('id'=>"MiddleNameR",'class'=>'span12','maxlength'=>50)); ?>
                </div>
            </div>
                 
            <div class="row-fluid">
                <div class ="span4">
                    <?php echo $form->labelEx($model,'Birthday'); ?>
                    <?php echo $form->textField($model,'Birthday', array('class'=>'span12 datepicker')); ?>
                    
                </div>
                <div class ="span4">
                    <?php echo $form->labelEx($model,'PersonSexID'); ?>

                    <?php echo $form->dropDownList($model,'PersonSexID', Personsextypes::DropDown(), array('class'=>'span12')); ?>
                 
                </div>

                <div class ="span4">
                    <?php echo $form->labelEx($model,'IsResident'); ?>
                    <div class="switch" data-on-label="Так" data-off-label="Ні">
                        <?php echo $form->checkBox($model,'IsResident');//, array("Ні", "Так"), array('class'=>'span12')); ?>
                    </div>
                   
                </div>
            </div>
        
            <div class="row-fluid">
                 <div class ="span4">
                    <?php echo $form->labelEx($model,"CountryID"); ?>
                    <?php echo $form->dropDownList($model,'CountryID', Country::DropDown(), array('class'=>'span12')); ?>
                </div>
<!--                <div class ="span4">
                    <?php //echo $form->labelEx($model,'PersonEducationTypeID'); ?>
                    <?php //echo $form->dropDownList($model,'PersonEducationTypeID', PersonEducationTypes::DropDown(), array('class'=>'span12')); ?>
                </div>-->

                <div class ="span4">
                    <?php echo $form->labelEx($model,'LanguageID'); ?>
                    <?php echo $form->dropDownList($model,'LanguageID', Languages::DropDown(), array('class'=>'span12')); ?>
                </div>
            </div>
        
            </div>    
            
            <div class="span3">
                <a href="#" class="thumbnail" style="width: 180px;" rel="tooltip" data-title="Фото абітурієнта">
                    <?php  $path = Yii::app()->baseUrl.Yii::app()->params['photosBigPath'].$model->PhotoName;
                    echo CHtml::image($path, 'Фото абітурієнта'); ?>
                    
                </a>
            </div>
        </div>
       
        <p class="help-block"><strong>Документ, який посвідчує особу</strong></p>
        <hr>
        
        <?php echo $this->renderPartial("_persondocform", array('model'=>$model->persondoc,'form'=>$form)); ?>
        
        <p class="help-block"><strong>Документ про освіту, на основі якого здійснюється вступ</strong></p>
        <hr>
        
        <?php echo $this->renderPartial("_entrantdocform", array('model'=>$model->entrantdoc,'form'=>$form)); ?>
        
        
        
       
<?php $this->endWidget(); ?>
        <script type="text/javascript" >
            $("#person-form input, #person-form select").attr("disabled",'disabled');
        </script>