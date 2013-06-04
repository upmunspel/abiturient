<?php
/*$this BenefitController 
$model = new PersonBenefits();*/
//$form = new CActiveForm();
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'specs-form',
	'enableAjaxValidation'=>false,
)); ?>
    <div class="well">
    <div class="row-fluid">
        <div class="span3">
                <?php
                    $url = Yii::app()->createUrl("personspeciality/create",array('personid'=>$personid));
                    $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Додати спеціальність',
                    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => null, // null, 'large', 'small' or 'mini'
                    'loadingText'=>'Зачекайте...',
                    'htmlOptions'=>array('id'=>'addSpec',
                        'onclick'=>"PSN.addSpec(this,'$url');",
                        ),
                )); ?>
        </div>
    </div>
    <hr>  
    <?php  /* PRINT ZNOS LIST */ ?>
    <?php if (!empty($models)): ?>   
        <?php foreach($models as $i=>$model): ?>   
            <div class="row-fluid">
               <div class="span3">
                    <?php $idFacultet= $model->sepciality->FacultetID;
                          echo CHtml::label("Факультет", "idFacultet")?>
                    <?php echo CHtml::dropDownList('idFacultet', $idFacultet , CHtml::listData(Facultets::model()->findAll(array('order'=>'FacultetFullName')),'idFacultet','FacultetFullName'),
                            array("disabled"=>"disabled", "id"=>"idFacultet",
                            'class'=>"span12")
                          );
                    ?>
                </div>
                <div class="span3">
                    <?php $url = Yii::app()->createUrl("personspeciality/znosubjects",array("personid"=>$personid,"specid"=>intval($model->idPersonSpeciality)));
                          echo $form->label($model,'SepcialityID'); ?>
                    <?php echo $form->dropDownList($model,'SepcialityID',  
                            CHtml::listData(Specialities::model()->findAll(), 'idSpeciality', 'SpecialityDirectionName'),
                            array('class'=>"span12",  "disabled"=>"disabled", "id"=>"SepcialityID" )); ?>

                </div>
                <div class="span2">
                    <?php echo $form->label($model,'PaymentTypeID'); ?>
                    <?php echo $form->dropDownList($model,'PaymentTypeID', CHtml::listData(Personeducationpaymenttypes::model()->findAll(), 'idEducationPaymentTypes', 'EducationPaymentTypesName'),
                                    array( "disabled"=>"disabled",'class'=>"span12", "id"=>"PaymentTypeID")); ?>
                </div>
                <div class="span2">
                    <?php echo $form->label($model,'EducationFormID'); ?>
                    <?php echo $form->dropDownList($model,'EducationFormID',CHtml::listData(Personeducationforms::model()->findAll(), 'idPersonEducationForm', 'PersonEducationFormName'),
                            array("disabled"=>"disabled", "id"=>"EducationFormID",'class'=>"span12")); ?>
                </div>
                  
                <div class="span1"> 
                    <span>&nbsp;</span>
                  <?  $url = Yii::app()->createUrl("personspeciality/delete",array("id"=>$model->idPersonSpeciality));
                        $this->widget("bootstrap.widgets.TbButton", array(
			'type'=>'danger',
                        'label'=>'',
                        'size' => null,
                        'icon'=>"icon-trash",
                        'htmlOptions'=>array(
                                "style"=>"margin-top: 2px;",
                                'title'=>"Видалити спеціальність",
                                'class'=>"span12",
                                'onclick'=>"PSN.delSpec(this,'$url');"), 
                        )); 
             ?>
                </div>
                 <div class="span1"> 
                     <span>&nbsp;</span>
                  <?  $url = Yii::app()->createUrl("personspeciality/update",array("id"=>$model->idPersonSpeciality));
                        $this->widget("bootstrap.widgets.TbButton", array(
			//'type'=>'danger',
                        'label'=>'',
                        'size' => null,
                        'icon'=>"icon-edit",
                        'htmlOptions'=>array(
                                "style"=>"margin-top: 2px;",
                                'title'=>"Видалити спеціальність",
                                'class'=>"span12",
                                'onclick'=>"PSN.editSpec(this,'$url');"), 
                        )); 
                 ?>
                </div>
            </div>  
           
       <?php endforeach; ?>

    <?php endif;?>   
    
    
    
    
    <?php  /* END PRINT ZNOS LIST */ ?>
    
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->
