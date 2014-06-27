<div class="form">
    <?php
    $burl = Yii::app()->baseUrl;
    Yii::app()->getClientScript()->registerCoreScript('jquery');
    Yii::app()->clientScript->registerScriptFile($burl . "/js/bootstrap-datepicker.js");
    Yii::app()->clientScript->registerScriptFile($burl . "/js/person.js");
    Yii::app()->clientScript->registerPackage('select2');

    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'person-form',
        'action' => $model->isNewRecord ? Yii::app()->createUrl("person/create") : "",
        //'type'=>'horizontal',
        'enableAjaxValidation' => false,
        'htmlOptions' => array("class" => "well"),
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
                    <?php echo $form->hiddenField($model, 'codeU'); ?>
                    <?php echo $form->hiddenField($model, 'edboID'); ?>    

                    <?php echo $form->labelEx($model, 'LastName'); //,array('class'=>'span3'));?>
                    <?php echo $form->textField($model, 'LastName', array('id' => "LastName", 'class' => 'span12', 'maxlength' => 50, 'readonly' => !empty($model->codeU))); ?>
                    <?php //echo $form->error($model,'LastName'); ?>        
                </div>
                <div class ="span4">
                    <?php echo $form->labelEx($model, 'FirstName'); //,array('class'=>'span3'));?>
                    <?php echo $form->textField($model, 'FirstName', array('id' => "FirstName", 'class' => 'span12', 'maxlength' => 50, 'readonly' => !empty($model->codeU))); ?>
                    <?php //echo $form->error($model,'FirstName'); ?>    
                </div>

                <div class ="span4">
                    <?php echo $form->labelEx($model, 'MiddleName'); //,array('class'=>'span3'));?>
                    <?php echo $form->textField($model, 'MiddleName', array('id' => "MiddleName", 'class' => 'span12', 'maxlength' => 50, 'readonly' => !empty($model->codeU))); ?>
                    <?php //echo $form->error($model,'MiddleName'); ?>    
                </div>
            </div>
            <div class="row-fluid">
                <?php $access = Yii::app()->user->checkAccess("editFioEn") ? "":"disabled"; ?>
                
                <div class ="span4">
                    <?php //echo $form->labelEx($model, 'LastNameEn'); //,array('class'=>'span3'));?>
                    <?php echo $form->textField($model, 'LastNameEn', array('id' => "LastNameEn", 'disabled'=>$access,  'class' => 'span12', 'maxlength' => 50)); ?>
                </div>

                <div class ="span4">
                    <?php //echo $form->labelEx($model, 'FirstNameEn'); //,array('class'=>'span3'));?>
                    <?php echo $form->textField($model, 'FirstNameEn', array('id' => "FirstNameEn", 'disabled'=>$access, 'class' => 'span12', 'maxlength' => 50)); ?>
                </div>

                <div class ="span4">
                    <?php //echo $form->labelEx($model, 'MiddleNameEn'); //,array('class'=>'span3'));?>
                    <?php echo $form->textField($model, 'MiddleNameEn', array('id' => "MiddleNameEn", 'disabled'=>$access, 'class' => 'span12', 'maxlength' => 50)); ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class ="span4">
                    <?php echo $form->labelEx($model, 'LastNameR'); //,array('class'=>'span3'));?>
                    <?php echo $form->textField($model, 'LastNameR', array('id' => "LastNameR", 'class' => 'span12', 'maxlength' => 50)); ?>
                </div>

                <div class ="span4">
                    <?php echo $form->labelEx($model, 'FirstNameR'); //,array('class'=>'span3'));?>
                    <?php echo $form->textField($model, 'FirstNameR', array('id' => "FirstNameR", 'class' => 'span12', 'maxlength' => 50)); ?>
                </div>

                <div class ="span4">
                    <?php echo $form->labelEx($model, 'MiddleNameR'); //,array('class'=>'span3'));?>
                    <?php echo $form->textField($model, 'MiddleNameR', array('id' => "MiddleNameR", 'class' => 'span12', 'maxlength' => 50)); ?>
                </div>
            </div>
            
            <div class="row-fluid">
                <div class ="span4">
                    <?php echo $form->labelEx($model, 'Birthday'); ?>
                    <?php echo $form->textField($model, 'Birthday', array('class' => 'span12 datepicker')); ?>

                </div>
                <div class ="span4">
                    <?php echo $form->labelEx($model, 'PersonSexID'); ?>

                    <?php echo $form->dropDownList($model, 'PersonSexID', Personsextypes::DropDown(), array('class' => 'span12')); ?>

                </div>
                <?php if (Yii::app()->user->checkAccess("editResident")): ?>
                <div class ="span4">
                    <?php echo $form->labelEx($model, 'IsResident'); ?>
                    <?php $access = Yii::app()->user->checkAccess("editResident") ? "":"disabled"; ?>
                   
                    <div class="switch" data-on-label="Так" data-off-label="Ні">
                        <?php echo $form->checkBox($model, 'IsResident', array('disabled'=>$access)); ?>
                    </div>
                   

                </div>
                <?php endif; ?>
            </div>

            <div class="row-fluid">
                <div class ="span4">
                    <?php echo $form->labelEx($model, "CountryID"); ?>
                    <?php echo $form->dropDownList($model, 'CountryID', Country::DropDown(), array('class' => 'span12')); ?>
                </div>
                <div class ="span4">
                    <?php echo $form->labelEx($model, 'LanguageID'); ?>
                    <?php echo $form->dropDownList($model, 'LanguageID', Languages::DropDown(), array("empty" => "", 'class' => 'span12')); ?>
                </div>
                <div class ="span4">
                    <?php echo $form->labelEx($model, 'BirthPlace'); ?>
                    <?php echo $form->textField($model, 'BirthPlace', array('class' => 'span12')); ?>
                </div>
            </div>

        </div>    

        <div class="span3" >
            <a href="#" style="width: 180px;" class="thumbnail" rel="tooltip" data-title="Фото абітурієнта">
                <?php
                $path = Yii::app()->baseUrl . Yii::app()->params['photosBigPath'] . $model->PhotoName;

                if (!file_exists(Yii::app()->basePath . "/../.." . $path)) {
                    $path = Yii::app()->baseUrl . Yii::app()->params['photosBigPath'] . Yii::app()->params['defaultPersonPhoto'];
                }

                echo CHtml::image($path, 'Фото абітурієнта');
                ?>
            </a>
        </div>
    </div>
    <p class="help-block"><strong>Адреса</strong></p>
    <hr>

    <div class="row-fluid">

        <?php echo $form->hiddenField($model, 'koatu', array('class' => "span12")); ?>

    </div>


    <div class="row-fluid" style="margin-top: 10px;">
        <div class ="span1">
            <?php echo $form->labelEx($model, 'PostIndex'); //,array('class'=>'span3')); ?>
            <?php echo $form->textField($model, 'PostIndex', array('class' => 'span12', 'maxlength' => 50)); ?>
        </div>
        <div class ="span2">
            <?php echo $form->labelEx($model, 'StreetTypeID'); ?>
            <?php echo $form->dropDownList($model, 'StreetTypeID', StreetTypes::DropDown(), array('class' => 'span12')); ?>
        </div>
        <div class ="span4">
            <?php echo $form->labelEx($model, 'Address'); //,array('class'=>'span3')); ?>
            <?php echo $form->textField($model, 'Address', array('class' => 'span12', 'maxlength' => 50)); ?>
        </div>
        <div class ="span2">
            <?php echo $form->labelEx($model, 'HomeNumber'); //,array('class'=>'span3')); ?>
            <?php echo $form->textField($model, 'HomeNumber', array('class' => 'span12', 'maxlength' => 50)); ?>
        </div>
        
    
        <div class ="span2">
            <?php echo $form->labelEx($model, 'Apartment'); //,array('class'=>'span3')); ?>
            <?php echo $form->textField($model, 'Apartment', array('class' => 'span12', 'maxlength' => 50)); ?>
        </div>
        <div class ="span1">
            <?php echo $form->labelEx($model, 'Housing'); //,array('class'=>'span3')); ?>
            <?php echo $form->textField($model, 'Housing', array('class' => 'span12', 'maxlength' => 50)); ?>
        </div>
        
        
    </div>


    <?php $user = Yii::app()->user->getUserModel();
    if (!($user->syspk->QualificationID == 2 || $user->syspk->QualificationID == 3)):
        ?>
        <p class="help-block"><strong>Школа</strong></p>
        <hr>
        
      
        <div class="row-fluid" style="margin-bottom: 10px;">
            <div class ="span12 school">
            <?php //echo $form->labelEx($model, 'SchoolID'); ?>

            <?php echo $form->hiddenField($model, 'SchoolID',array('class' => "span12"));             ?>
               
            </div>
        </div>
 <?php endif; ?>    

<?php if (Yii::app()->user->checkAccess("showPersonEntrantDocForm")): ?>
    <p class="help-block" ><strong>Документ про освіту, на основі якого здійснюється вступ</strong></p>
    <hr>
    <?php echo $this->renderPartial("_entrantdocform", array('model' => $model->entrantdoc, 'form' => $form)); ?>

<?php endif; ?>  
    
    <p class="help-block"><strong>Документ, який посвідчує особу</strong></p>
    <hr>

<?php echo $this->renderPartial("_persondocform", array('model' => $model->persondoc, 'form' => $form)); ?>




    <p class="help-block"><strong>Інші документи</strong></p>
    <hr>
    <div class="row-fluid" >
        <div class ="span4"  >
<?php echo $this->renderPartial("_inndocumentform", array('model' => $model->inndoc, 'form' => $form)); ?>
        </div>
        <div class ="span4"  >
<?php echo $this->renderPartial("_hospdocumentform", array('model' => $model->hospdoc, 'form' => $form)); ?>
        </div>
    </div>


    <p class="help-block"><strong>Контактна інформація</strong></p>
    <hr>
    <div class="row-fluid" >
        <div class ="span4"  >
<?php echo $this->renderPartial("_contacts", array('model' => $model->homephone, 'form' => $form)); ?>
        </div>
        <div class ="span4"  >
<?php echo $this->renderPartial("_contacts", array('model' => $model->mobphone, 'form' => $form)); ?>
        </div>
    </div>
    <p class="help-block">Поля позначені <span class="required">*</span> заповняти обов'язково.</p>
<?php echo $form->errorSummary($model); ?>
    <div class="form-actions">


<?php
//if ($model->isNewRecord || empty($model->codeU) || Yii::app()->user->checkAccess("updateAllPost")) {
$this->widget("bootstrap.widgets.TbButton", array(
    'buttonType' => 'submit',
    'type' => 'primary',
    "size" => "large",
    'label' => $model->isNewRecord ? 'Створити' : 'Зберегти',
));
//}
?>
        <?php /* $this->widget('bootstrap.widgets.TbButton', array(
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
//            PSN.KOATUUCode = "<?php echo $js_code = KoatuuLevel2::getKoatuuLevel2Code($model->KOATUUCodeL2ID); ?>";
//            PSN.KOATUUSchoolCode = "<?php echo $js_code; ?>";
    </script>
    <script type="text/javascript">
        $("#<?php echo CHtml::activeId($model, "koatu") ?>").select2({
            placeholder: "Введіть назву міста",
            minimumInputLength: 5,
            allowClear: true,
            ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
                url: "<?php echo Yii::app()->createUrl("directory/koatu"); ?>",
                dataType: 'json',
                data: function(term, page) {
                    return {
                        q: term, // search term
                        page_limit: 10,
                        page: page,
                    };
                },
                results: function(data, page) {
                  
                    return data;
                }
            },
            initSelection: function(element, callback) {
                var id = $(element).val();
                if (id !== "") {
                    $.ajax("<?php echo Yii::app()->createUrl("directory/koatur"); ?>", {
                        data: {
                            id: '<?php echo $model->koatu; ?>'
                        },
                        dataType: "json"
                    }).done(function(data) {
                        callback(data);
                    });
                }
            },
            
            escapeMarkup: function(m) {
                return m;
            } 
        });

    </script>
    
    <script type="text/javascript">
        $("#<?php echo CHtml::activeId($model, "SchoolID") ?>").select2({
            placeholder: "Введіть назву школи",
            minimumInputLength: 2,
            allowClear: true,
            ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
                url: "<?php echo Yii::app()->createUrl("directory/school"); ?>",
                dataType: 'json',
                data: function(term, page) {
                    return {
                        q: term, // search term
                        page_limit: 10,
                        page: page,
                        area: $("#<?php echo CHtml::activeId($model, "koatu");?>").val()
                    };
                },
                results: function(data, page) {
                  
                    return data;
                }
            },
            initSelection: function(element, callback) {
                var id = $(element).val();
                if (id !== "") {
                    $.ajax("<?php echo Yii::app()->createUrl("directory/schoolr"); ?>", {
                        data: {
                            id: '<?php echo $model->SchoolID; ?>'
                        },
                        dataType: "json"
                    }).done(function(data) {
                        callback(data);
                    });
                }
            },
            
            escapeMarkup: function(m) {
                return m;
            } 
        });

    </script>
<?php $this->endWidget(); ?>
</div>