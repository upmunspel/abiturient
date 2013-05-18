<?php
/* $this BenefitController */
$model = new Documents();
$form = new CActiveForm();
?>
<div class="form">
    
 <?php  /* END PRINT ZNOS LIST */ 
        
$dataProvider=new CActiveDataProvider('Documents', array('criteria'=>array(
    'condition'=>"PersonID=$personid",
    //'order'=>'create_time DESC',
    'with'=>array('type'),
    ),
    'sort' =>array(
            'attributes' =>array(
                    'type'=>array(
                                    'asc'=>'type.PersonDocumentTypesName',
                                    'desc'=>'type.PersonDocumentTypesName DESC',
                            ),
                    '*',
            ),
        ),
    'pagination'=>array(
        'pageSize'=>10,
    )
));

 $this->widget('bootstrap.widgets.TbGridView', array(
'type'=>'striped bordered condensed',
'dataProvider'=>$dataProvider,
//'template'=>"{items}",
'columns'=>array(
    //array('name'=>'idDocuments', 'header'=>'ID', "htmlOptions"=>array("style"=>"width: 50px"), 'type' => 'raw'),
    //array('name'=>'typename', 'header'=>'typename',  ),
    array('name'=>'type', 'header'=>'Тип документа', 'value' => '$data->type->PersonDocumentTypesName' ),
    array('name'=>'Series', 'header'=>'Серия',  ),
    array('name'=>'Numbers', 'header'=>'Номер',  ),
    //array('name'=>'DateGet', 'header'=>'Дата получения',  ),
    array(
        'class'=>'bootstrap.widgets.TbButtonColumn',
        'htmlOptions'=>array('style'=>'width: 50px'),
    ),
),
)); 
?>   
    
  

</div><!-- form -->