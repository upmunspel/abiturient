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
                <div class="span10">
                  <?php echo $model->sepciality->facultet->FacultetFullName." ".$model->sepciality->SpecialityName; 
                 ?>
                </div>
                <div class="span1"> 
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
                  <?  $url = Yii::app()->createUrl("personspeciality/update",array("id"=>$model->idPersonSpeciality));
                        $this->widget("bootstrap.widgets.TbButton", array(
			'type'=>'danger',
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