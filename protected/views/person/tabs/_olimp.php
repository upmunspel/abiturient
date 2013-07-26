<div class="form">
   
    <?php if (Yii::app()->user->hasFlash("message")): ?>
    <div class="row-fluid" ><h3 style="color: red;"><?php echo  Yii::app()->user->getFlash("message"); ?></h3></div>
    <?php endif; ?>
    
<?php  /* END PRINT ZNOS LIST */ 
$dataProvider=new CActiveDataProvider("Personolympiad", array('criteria'=>array(
    'condition'=>"PersonID=$personid",
    //'order'=>'create_time DESC',
    'with'=>array('olympiadAwar'),
    ),
    'sort' =>array(
             'attributes' =>array("",),
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
       array('name'=>'olympiadAwar', 'header'=>'Олипміада', 'value' => '$data->olympiadAwar->OlympiadAwardName' ),
    ),
)); 
?>   
</div>