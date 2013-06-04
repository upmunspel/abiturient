<div class="form">
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
<?php  /* END PRINT SPEC LIST */ 
$dataProvider=new CActiveDataProvider("Personspeciality", array('criteria'=>array(
    'condition'=>"PersonID=$personid",
    //'order'=>'RequestNumber DESC',
    'with'=>array('sepciality',"educationForm"),
    ),
    'sort' =>array(
            'attributes' =>array( "",
//                    'sepciality'=>array(
//                                    'asc'=>'sepciality.SpecialityDirectionName',
//                                    'desc'=>'sepciality.SpecialityDirectionName DESC',
//                            ),
//                    '*',
            ),
        ),
    'pagination'=>array(
        'pageSize'=>10,
    )
));
 $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'template'=>"{items}",
    'columns'=>array(
        array('name'=>'RequestNumber', "htmlOptions"=>array("style"=>"width: 150px"),  'value' => 'str_pad($data->RequestNumber, 5, "0", STR_PAD_LEFT)'),
        //array('name'=>'typename', 'header'=>'typename',  ),
        array('name'=>'sepciality', 'header'=>'Спеціальність', 'value' => '$data->sepciality->SpecialityDirectionName' ),
        array('name'=>'educationForm', 'header'=>'Форма навчання', 'value' => '$data->educationForm->PersonEducationFormName '  ),

        array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{update} {trash}',
                'buttons'=>array
                (

                    'update' => array(
                        'label'=>'Редагувати',
                        'icon'=>'pencil',
                        'url'=>'Yii::app()->createUrl("personspeciality/update",array("id"=>$data->idPersonSpeciality))',
                        'options'=>array(
                            'class'=>'btn',
                            'onclick'=>"PSN.editSpec(this); return false;",
                        ),
                     ),
                   'trash' => array(
                        'label'=>'Видалити',
                        'icon'=>'trash',
                        'url'=>'Yii::app()->createUrl("personspeciality/delete",array("id"=>$data->idPersonSpeciality))',
                        'options'=>array(
                            'class'=>'btn',
                            'onclick'=>"PSN.delSpec(this); return false;",
                        ),
                    ),
                ),
                'htmlOptions'=>array(
                    'style'=>'width: 90px;',
                ),
            )
        ),
    )
); 
?>   

</div><!-- form -->
