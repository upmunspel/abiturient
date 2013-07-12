<?php
/* @var $this AllcountsController */
/* @var $model AllCounts */

?>
<?php Yii::app()->bootstrap->register(); ?>
<center><h2>Статистика вступу абітуріентів Запорізького національного університету <?php echo date("Y"); ?></h2></center>    
<?php 

$data = $model->search();



$this->widget('bootstrap.widgets.TbGroupGridView', array(
'id'=>'person-speciality-view-grid',
    'type'=>'striped bordered condensed',
'dataProvider'=>$data,
//'rowCssClassExpression'=>'empty($data->SpecEdboID) && empty($data->PersonEdboID) ?"row-red":"row-green"',
'filter'=>$model,
'mergeColumns' => array('Fakultet'),
'columns'=>array(
    //array('name'=>'ID', 'htmlOptions'=>array('style'=>'width: 50px'),),
    array('name'=>'Fakultet'),
    array('name'=>'Specialnost'),
    array('name'=>'dnevn'),
    array('name'=>'dnevn_budget'),
    array('name'=>'dnevn_contract'),
    array('name'=>'dnevn_pv'),
    array('name'=>'dnevn_pzk'),
    array('name'=>'dnevn_electro'),
    array('name'=>'zaoch'),
    array('name'=>'zaoch_budget'),
    array('name'=>'zaoch_contract'),
    array('name'=>'zaoch_pv'),
    array('name'=>'zaoch_pzk'),
    array('name'=>'zaoch_electro'),
    array('name'=>'medals'),
),
)); ?>







