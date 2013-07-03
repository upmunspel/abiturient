<div class="form">
    <div class="row-fluid" >
        <div class="span2">
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
      
        <div class="span2">
                <?php
                    $url = Yii::app()->createUrl("documents/edboupdate",array('personid'=>$personid));
                    $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Синхронізувати',
                    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => null, // null, 'large', 'small' or 'mini'
                    'loadingText'=>'Зачекайте...',
                    'htmlOptions'=>array('onclick'=>"PSN.edboDocUpdate(this,'$url');",),
                )); ?>
        </div>
         <div class="span8">    
            <p> Синхронізація виконуэ перевірку та додання всіх документів до бази ЄДБО. Завантажує або перевіряє предмети ЗНО згідно даних з ЄДБО.</p>
        </div>
        
    </div>
    <hr>
    <?php if (Yii::app()->user->hasFlash("message")): ?>
    <div class="row-fluid" ><h3 style="color: red;"><?php echo  Yii::app()->user->getFlash("message"); ?></h3></div>
    <?php endif; ?>
    
<?php  /* END PRINT ZNOS LIST */ 
$dataProvider=new CActiveDataProvider('Documents', array('criteria'=>array(
    'condition'=>"PersonID=$personid",
    //'order'=>'create_time DESC',
    'with'=>array('type'),
    ),
    'sort' =>array(
             'attributes' =>array("",
//                    'type'=>array(
//                                    'asc'=>'type.PersonDocumentTypesName',
//                                    'desc'=>'type.PersonDocumentTypesName DESC',
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
'rowCssClassExpression'=>'empty($data->edboID)?"row-red":"row-green"',
'columns'=>array(
    //array('name'=>'idDocuments', 'header'=>'ID', "htmlOptions"=>array("style"=>"width: 50px"), 'type' => 'raw'),
    //array('name'=>'typename', 'header'=>'typename',  ),
    array('name'=>'type', 'header'=>'Тип документа', 'value' => '$data->type->PersonDocumentTypesName' ),
    array('name'=>'Series', 'header'=>'Серия',  ),
    array('name'=>'Numbers', 'header'=>'Номер',  ),
    "ZNOPin",
    array('name'=>'DateGet', 'header'=>'Дата отримання', 'value' => '($data->DateGet!="01.01.1970") ? $data->DateGet :"";'  ),
    
    array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{trash}{sinchr}',
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
                  'sinchr' => array(
                        'label'=>'Синхронізувати',
                        'icon'=>'icon-refresh',
                        'url'=> 'Yii::app()->createUrl("documents/edboupdate",array("docid"=>$data->idDocuments))',
                        'options'=>array(
                            'class'=>'btn',
                            'onclick'=>"PSN.edboAnDocUpdate(this); return false;",
                            //'rel'=>"prettyPhoto",
                            'title'=>"Оновити в ЭДБО",
                        ),
                    ),
            ),
            'htmlOptions'=>array(
                'style'=>'width: 120px;',
            ),
        ),
   
    ),
)); 
?>   
</div>