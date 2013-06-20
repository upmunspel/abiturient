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

?>
<div class="form">
    <?php if (count($dataProvider->data)<3): ?>
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
    <?php endif; ?>
<?php  
 $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'template'=>"{items}",
    'columns'=>array(
        array('name'=>'PersonRequestNumber', "htmlOptions"=>array("style"=>"width: 150px"),  'value' => '$data->RequestPrefix.str_pad($data->PersonRequestNumber, 5, "0", STR_PAD_LEFT)'),
        array('name'=>'RequestNumber', "htmlOptions"=>array("style"=>"width: 150px"),  'value' => 'str_pad($data->RequestNumber, 5, "0", STR_PAD_LEFT)'),
        //array('name'=>'typename', 'header'=>'typename',  ),
        array('name'=>'sepcialityCode', 'header'=>'Код спеціальності', 'value' => '$data->sepciality->SpecialityClasifierCode' ),
        array('name'=>'sepciality', 'header'=>'Спеціальність', 'value' => '!empty($data->sepciality->SpecialityName) ? $data->sepciality->SpecialityName : $data->sepciality->SpecialityDirectionName' ),
        array('name'=>'educationForm', 'header'=>'Форма навчання', 'value' => '$data->educationForm->PersonEducationFormName '  ),
        array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{update} {trash} {print} {printa}',
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
                    'print' => array(
                        'label'=>'Друкувати',
                        'icon'=>'print',
                        'url'=>  'Yii::app()->user->getPrintUrl($data->PersonID, $data->idPersonSpeciality)',
                        'options'=>array(
                            'class'=>'btn',
                            //'onclick'=>'PSN.printSpec(this); return true;',
                            'rel'=>"prettyPhoto",
                            'title'=>"Друкувати заявку",
                        ),
                    ),
                    'printa' => array(
                        'label'=>'Друкувати',
                        'icon'=>'icon-check',
                        'url'=>  'Yii::app()->user->getPrintUrl($data->PersonID, $data->idPersonSpeciality)',
                        'options'=>array(
                            'class'=>'btn',
                            //'onclick'=>'PSN.printSpec(this); return true;',
                            'rel'=>"prettyPhoto",
                            'title'=>"Друкувати аркуш вступних випробувань",
                        ),
                    ),
                    
                    
                ),
                'htmlOptions'=>array(
                    'style'=>'width: 175px;',
                ),
            )
        ),
    )
); 
?>   

</div><!-- form -->
<script type="text/javascript">
/*<![CDATA[*/
jQuery('#pretty_photo a').attr('rel','prettyPhoto');
jQuery('a[rel^="prettyPhoto"]').prettyPhoto({'opacity':0.6,'modal':true,'theme':'facebook'});
/*]]>*/
</script>
