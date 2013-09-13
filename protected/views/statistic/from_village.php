<?php
/* @var $this PersonviewController */
/* @var $model PersonSpecialityView */
?>
<?php Yii::app()->bootstrap->register(); ?>
<center><h2>Статистика вступу абітурієнтів із сільської місцевості <?php echo date("Y"); ?></h2></center>    
<?php 

$data = $model->search();



$this->widget('bootstrap.widgets.TbGroupGridView', array(
'id'=>'person-speciality-view-grid',
    'type'=>'striped bordered condensed',
'dataProvider'=>$data,
'filter'=>$model,  
'columns'=>array(
                array('name'=>'region', 'htmlOptions'=>array('style'=>'width: 150px'),),
                array('name'=>'cityVillage', 'htmlOptions'=>array('style'=>'width: 200px'),),
                array('name'=>'city', 'htmlOptions'=>array('style'=>'width: 150px'),),
                array('name'=>'edbo', 'htmlOptions'=>array('style'=>'width: 50px'),),
                array('name'=>'surname', 'htmlOptions'=>array('style'=>'width: 100px'),),
                array('name'=>'name', 'htmlOptions'=>array('style'=>'width: 80px'),),
                array('name'=>'fartherName', 'htmlOptions'=>array('style'=>'width: 100px'),),
                array('name'=>'spec', 'htmlOptions'=>array('style'=>'width: 90px'),),
                array('name'=>'edu_form', 'htmlOptions'=>array('style'=>'width: 70px'),
                    'filter'=>array(
                        'Денна'=>'Денна',
                        'Заочна'=>'Заочна',
                        'Екстернат'=>'Екстернат',
                )),
                array('name'=>'status', 'htmlOptions'=>array('style'=>'width: 70px'),
                    'filter'=>array(
                        'До наказу'=>'До наказу',
                        'Відхилено'=>'Відхилено',
                        'Допущена'=>'Допущена',
                        'Нова заява'=>'Нова заява',
                )),

),
)); ?>







