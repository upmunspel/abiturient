<?php
/* @var $this PersonspeccountsController */
?>
<?php Yii::app()->bootstrap->register(); ?>
<center><h2>Статистика заяв абітурієнтів Запорізького національного університету <?php echo date("Y"); ?></h2></center>    
<?php 

$data = $model->search();
//$data=new CActiveDataProvider();
if ($data->getItemCount() == 0) {
    $model= new PersonspecCounts();  
    $model->unsetAttributes();
    $model->idPersonSpeciality = 1;
    $data = $model->search();
}

        $this->widget('bootstrap.widgets.TbExtendedGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$data,
        'filter'=>$model,
        'columns'=>array(

                        array('name'=>'idPersonSpeciality', 'htmlOptions'=>array('style'=>'width: 50px'), /*'value'=>'date("d", strtotime($data->_date_))'*/),
                        array('name'=>'_date_', "value"=>'date("d.m.Y", strtotime($data->_date_))' ), 
                        array('name'=>'_count_', ), 

        ),
            'chartOptions' => array(
                'data' => array(
                    'series' => array(
                        array(
                                'name' => 'кількість',
                                'attribute' => '_count_'
                        ),
                    )
                ),
                'config' => array(
                    'title'=>array('text'=>'Кількість заявок абітурієнтів'),
                    'chart'=>array(
                        'width'=>800,

                    )
                )
            ),
        )); 

?>







