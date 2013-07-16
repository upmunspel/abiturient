<?php
/* @var $this PersonviewController */
/* @var $model PersonSpecialityView */
?>
<?php Yii::app()->bootstrap->register(); ?>
<center><h2>Статистика вступу абітурієнтів із сільської місцевості <?php echo date("Y"); ?></h2></center>    
<?php 

$model = VillageList::model();

$data = $model->search();



$this->widget('bootstrap.widgets.TbGroupGridView', array(
'id'=>'person-speciality-view-grid',
    'type'=>'striped bordered condensed',
'dataProvider'=>$data,
'filter'=>$model,
'columns'=>array(
                array('name'=>'edbo', 'htmlOptions'=>array('style'=>'width: 50px'),),
                array('name'=>'surname', 'htmlOptions'=>array('style'=>'width: 250px'),),
                array('name'=>'name', 'htmlOptions'=>array('style'=>'width: 150px'),),
                array('name'=>'fartherName', 'htmlOptions'=>array('style'=>'width: 250px'),),
                array('name'=>'region', 'htmlOptions'=>array('style'=>'width: 250px'),),
                array('name'=>'city', 'htmlOptions'=>array('style'=>'width: 100px'),),
                array('name'=>'cityVillage', 'htmlOptions'=>array('style'=>'width: 200px'),),

),
)); ?>







