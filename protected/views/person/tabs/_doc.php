<div class="form well">
    <div class="row-fluid" >
        <div class="span3">
                <?php
                    $url = Yii::app()->createUrl("documents/create",array('personid'=>$personid));
                    $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Додати документ',
                    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => null, // null, 'large', 'small' or 'mini'
                    'loadingText'=>'Зачекайте...',
                    'htmlOptions'=>array('id'=>'addDoc',
                        'onclick'=>"PSN.addDoc(this,'$url');",
                        ),
                )); ?>
        </div>
    </div>
    <hr>
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
    array('name'=>'DateGet', 'header'=>'Дата отримання', 'value' => '($data->DateGet!="01.01.1970") ? $data->DateGet :"";'  ),
    array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{trash}',
            'buttons'=>array
            (
                
                'update' => array(
                    'label'=>'Редагувати',
                    'icon'=>'pencil',
                    'url'=>'Yii::app()->createUrl("documents/update", array("id"=>$data->idDocuments))',
                    'options'=>array(
                        'class'=>'btn',
                        'onclick'=>"PSN.editDoc(this); return false;",
                    ),
                 ),
               'trash' => array(
                    'label'=>'Видалити',
                    'icon'=>'trash',
                    'url'=>'Yii::app()->createUrl("documents/delete", array("id"=>$data->idDocuments))',
                    'options'=>array(
                        'class'=>'btn',
                        'onclick'=>"PSN.delDoc(this); return false;",
                    ),
                ),
            ),
            'htmlOptions'=>array(
                'style'=>'width: 90px;',
            ),
        )
    ),
)); 
?>   
</div>