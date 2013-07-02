<div class="form">
<?php 
$burl = Yii::app()->baseUrl;
Yii::app()->getClientScript()->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile($burl."/js/bootstrap-datepicker.js");
Yii::app()->clientScript->registerScriptFile($burl."/js/person.js");

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'person-form',
        'action'=>$model->isNewRecord ? Yii::app()->createUrl("person/create"):"",
    //'type'=>'horizontal',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array("class"=>"well"),
));
?>

<p class="help-block"><strong>Особисті дані</strong></p>
        <hr>
        <div class="row-fluid">
<!--            <div class ="span12">-->
                <?php echo $form->errorSummary($model) ?>
                <?php echo $form->errorSummary($model->inndoc) ?>
                <?php echo $form->errorSummary($model->hospdoc) ?>
                <?php echo $form->errorSummary($model->entrantdoc) ?>
                <?php echo $form->errorSummary($model->persondoc) ?>
                <?php echo $form->errorSummary($model->homephone) ?>
                <?php echo $form->errorSummary($model->mobphone) ?>
<!--            </div>-->
        </div>
            
        <div class="row-fluid">
            <div class ="span9">
            <div class="row-fluid">
                <div class ="span4">
                 <?php echo $form->hiddenField($model,'codeU'); ?>
                  <?php echo $form->hiddenField($model,'edboID'); ?>    
                    
                <?php echo $form->labelEx($model,'LastName');//,array('class'=>'span3'));?>
                <?php echo $form->textField($model,'LastName',array('id'=>"LastName",'class'=>'span12','maxlength'=>50, 'readonly'=>!empty($model->codeU) )); ?>
                <?php //echo $form->error($model,'LastName'); ?>        
                </div>
                <div class ="span4">
                <?php echo $form->labelEx($model,'FirstName');//,array('class'=>'span3'));?>
                <?php echo $form->textField($model,'FirstName',array('id'=>"FirstName",'class'=>'span12','maxlength'=>50, 'readonly'=>!empty($model->codeU))); ?>
                <?php //echo $form->error($model,'FirstName'); ?>    
                </div>
              
                <div class ="span4">
                <?php echo $form->labelEx($model,'MiddleName');//,array('class'=>'span3'));?>
                <?php echo $form->textField($model,'MiddleName',array('id'=>"MiddleName", 'class'=>'span12','maxlength'=>50, 'readonly'=>!empty($model->codeU))); ?>
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
                <div class ="span4">
                    <?php echo $form->labelEx($model,'LanguageID'); ?>
                    <?php echo $form->dropDownList($model,'LanguageID', Languages::DropDown(), array("empty"=>"",'class'=>'span12')); ?>
                </div>
                <div class ="span4">
                    <?php echo $form->labelEx($model,'BirthPlace'); ?>
                    <?php echo $form->textField($model,'BirthPlace', array('class'=>'span12')); ?>
                </div>
           </div>
        
            </div>    
            
            <div class="span3" >
                <a href="#" style="width: 180px;" class="thumbnail" rel="tooltip" data-title="Фото абітурієнта">
                   <?php 
                   
                   $path = Yii::app()->baseUrl.Yii::app()->params['photosBigPath'].$model->PhotoName;
                   
                   if (!file_exists(Yii::app()->basePath."/../..".$path)) { 
                       $path = Yii::app()->baseUrl.Yii::app()->params['photosBigPath'].Yii::app()->params['defaultPersonPhoto'];
                       
                   }
                   
                    echo CHtml::image($path, 'Фото абітурієнта'); ?>
                </a>
            </div>
        </div>
        <p class="help-block"><strong>Адреса</strong></p>
        <hr>
        <div class="row-fluid">
            <div class ="span12">
            <?php echo CHtml::label("Область / місто","KOATUUCodeL2ID");//,array('class'=>'span3'));?>
            <?php echo CHtml::activeDropDownList($model, "KOATUUCodeL1ID", KoatuuLevel1::DropDown(), 
                    array('empty'=>"", 'class'=>'span12', 
                            'onchange'=>"PSN.KOATUUChange(this,1)"));
                     ?>
            </div>
        </div>
        <div class="row-fluid" <?php echo empty($model->KOATUUCodeL2ID) ? "style='display:none;'":""; ?>>
            <div class ="span12"  > 
            <?php echo CHtml::label("Район / місто / район міста","KOATUUCodeL2ID");?>
            <?php echo CHtml::activeDropDownList($model, "KOATUUCodeL2ID",  KoatuuLevel2::DropDown($model->KOATUUCodeL1ID), 
                    array('empty'=>"", 'class'=>'span12', 
                            'onchange'=>"PSN.KOATUUChange(this,2)"));
                     ?>
            </div>
            
        </div>
        <div class="row-fluid" <?php  echo empty($model->KOATUUCodeL3ID) ? "style='display:none;'":""; ?> >
           
            <div class ="span12" >
            <?php echo CHtml::label("Місто / район міста / СМТ / село","KOATUUCodeL3ID");//,array('class'=>'span3'));?>
            <?php echo CHtml::activeDropDownList($model, "KOATUUCodeL3ID",  KoatuuLevel3::DropDown($model->KOATUUCodeL2ID), 
                    array('empty'=>"", 'class'=>'span12', 'onchange'=>"PSN.KOATUUChange(this,3)"));
                     ?>
            </div>
            
        </div>
       
        <div class="row-fluid">
           <div class ="span2">
            <?php echo $form->labelEx($model,'PostIndex');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'PostIndex',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
            <div class ="span2">
            <?php echo $form->labelEx($model,'StreetTypeID'); ?>
            <?php echo $form->dropDownList($model,'StreetTypeID', StreetTypes::DropDown(), array('class'=>'span12')); ?>
            </div>
            <div class ="span6">
            <?php echo $form->labelEx($model,'Address');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'Address',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
             <div class ="span2">
            <?php echo $form->labelEx($model,'HomeNumber');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'HomeNumber',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
        </div>
         
        
       <?php $user = Yii::app()->user->getUserModel();
       if (!($user->syspk->QualificationID == 2 || $user->syspk->QualificationID == 3) ):?>
                <p class="help-block"><strong>Школа</strong></p>
                <hr>
                <div class="row-fluid">
                    <div class ="span5">
                        <?php echo Chtml::label("Закінчив школу за місцем проживання", "sameschooladdr") ?>
                    </div>
                    <div class ="span1">


                            <div id ="toggle_sameschool" class="switch" data-on-label="Так" data-off-label="Ні">
                                <?php echo $form->checkBox($model,'isSamaSchoolAddr');//, array("Ні", "Так"), array('class'=>'span12')); ?>
                            </div>

                     </div>
                </div>
                <div id="scholladdr" <?php echo $model->isSamaSchoolAddr ? "style='display:none;'":"";?> >
                    <p class="help-block"><strong>Адреса школи</strong></p>
                <hr>
                <div class="row-fluid">

                <div class="row-fluid">
                    <div class ="span12">
                    <?php echo CHtml::label("Область або велике місто","KOATUUCodeL2ID");//,array('class'=>'span3'));?>
                    <?php echo CHtml::dropDownList("KOATUU1", $model->KOATUUCodeL1ID, KoatuuLevel1::DropDown(), 
                            array('class'=>'span12', 
                                    'onchange'=>"PSN.KOATUUSchoolChange(this,1,2)"));
                             ?>
                    </div>
                </div>

                <?php 

                if (false): ?>     
                <div class="row-fluid" <?php echo empty($model->KOATUUCodeL2ID) ? "style='display:none;'":""; ?>>
                    <div class ="span12"  > 
                    <?php echo CHtml::label("Район / місто / район міста","KOATUUCodeL2ID");?>
                    <?php echo CHtml::dropDownList("KOATUU2", $model->KOATUUCodeL2ID, KoatuuLevel2::DropDown($model->KOATUUCodeL1ID), 
                            array('class'=>'span12', 
                                    'onchange'=>"PSN.KOATUUSchoolChange(this,2)"));
                             ?>
                    </div>

                </div>
                <div class="row-fluid" <?php echo empty($model->KOATUUCodeL3ID) ? "style='display:none;'":""; ?> >

                    <div class ="span12" >
                    <?php echo CHtml::label("Місто / район міста / СМТ / село","KOATUUCodeL3ID");//,array('class'=>'span3'));?>
                    <?php echo CHtml::dropDownList("KOATUU3", $model->KOATUUCodeL3ID,  KoatuuLevel3::DropDown($model->KOATUUCodeL2ID), 
                            array('class'=>'span12', 'onchange'=>"PSN.KOATUUSchoolChange(this,3)"));
                             ?>
                    </div>
                </div>
                <?php endif;?>    

                </div>
                </div>
                <style>
                    .mywidth {
                        width: 1085px;
                    }
                </style>
                <div class="row-fluid">
                    <div class ="span12 school">
                        <?php echo $form->labelEx($model,'SchoolID'); ?>

                        <?php echo $form->dropDownList($model,'SchoolID', Schools::DropDown(KoatuuLevel2::getKoatuuLevel2Code($model->KOATUUCodeL2ID),2), 
                                array('empty'=>"", 'class'=>"mywidth",'id'=>"SchoolID")); ?>
                        <script type="text/javascript"> 
                             $("#SchoolID").click(function(){alert("asdas");});
                             $("#SchoolID").combobox();
                         </script>
                    </div>
                </div>
        <?php endif; ?>    
        <p class="help-block"><strong>Документ про освіту, на основі якого здійснюється вступ</strong></p>
        <hr>
        
        <?php echo $this->renderPartial("_entrantdocform", array('model'=>$model->entrantdoc,'form'=>$form)); ?>
        
        <p class="help-block"><strong>Документ, який посвідчує особу</strong></p>
        <hr>
        
        <?php echo $this->renderPartial("_persondocform", array('model'=>$model->persondoc,'form'=>$form)); ?>
        
     
        
        
        <p class="help-block"><strong>Інші документи</strong></p>
        <hr>
        <div class="row-fluid" >
            <div class ="span4"  >
            <?php echo $this->renderPartial("_inndocumentform", array('model'=>$model->inndoc,'form'=>$form)); ?>
            </div>
            <div class ="span4"  >
            <?php echo $this->renderPartial("_hospdocumentform", array('model'=>$model->hospdoc,'form'=>$form)); ?>
            </div>
        </div>
        
        
        <p class="help-block"><strong>Контактна інформація</strong></p>
        <hr>
         <div class="row-fluid" >
            <div class ="span4"  >
                <?php echo $this->renderPartial("_contacts", array('model'=>$model->homephone,'form'=>$form)); ?>
            </div>
            <div class ="span4"  >
                <?php echo $this->renderPartial("_contacts", array('model'=>$model->mobphone,'form'=>$form)); ?>
            </div>
        </div>
        <p class="help-block">Поля позначені <span class="required">*</span> заповняти обов'язково.</p>
         <?php echo $form->errorSummary($model); ?>
	<div class="form-actions">
		
             
               <?php 
               //if ($model->isNewRecord || empty($model->codeU) || Yii::app()->user->checkAccess("updateAllPost")) {
               $this->widget("bootstrap.widgets.TbButton", array(
			'buttonType'=>'submit',
			'type'=>'primary',
                         "size"=>"large",
			'label'=>$model->isNewRecord ? 'Створити' : 'Зберегти',
                        )); 
               //}
               ?>
            <?php /*$this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'button',
                'type'=>'primary',
                'label'=>$model->isNewRecord ? 'Створити' : 'Зберегти',
                'loadingText'=>'Збереження...',
                'htmlOptions'=>array('id'=>'personSave'),
                )); */
            ?>
            
	</div>
         <script type="text/javascript">
            var PSN = PSN || {};
            PSN.schoolLink = "<?php echo CController::createUrl('directory/Schools'); ?>";
            PSN.koatuuLink = "<?php echo CController::createUrl('directory/koatuu'); ?>";
//            PSN.KOATUUCode = "<?php echo $js_code =  KoatuuLevel2::getKoatuuLevel2Code($model->KOATUUCodeL2ID);?>";
//            PSN.KOATUUSchoolCode = "<?php echo $js_code; ?>";
         </script>
<?php $this->endWidget(); ?>
</div>