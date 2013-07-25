<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$dataProvider=new CActiveDataProvider('Prices');?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
'id'=>'prices-grid',
'type'=>'striped bordered condensed',
'dataProvider'=>$dataProvider,

//'filter'=>$model,
'columns'=>array(
		'idPrice',
                'SpecialityID',
                array('name'=>'SpecialityID', 'header'=>'Код спеціальності', 'value' => '$data->sepciality->SpecialityClasifierCode'),     
                'PriceYearInNumbers',
		'PriceSemesterInNumbers',
		'PriceYearInWords',
/*array(
'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{view}',
            'buttons'=>array
            (           
                'update' => array(
                    'label'=>'Редагувати',
                    'icon'=>'pencil',
                    'url'=>'Yii::app()->createUrl("prices/update", array("id"=>$data->idPrice))',
                    'options'=>array(
                        'class'=>'btn',
                        //'onclick'=>"PSN.editDoc(this); return false;",
                    ),
                 ),
               'view' => array(
                    'label'=>'Переглянути',
                    'icon'=>'icon-eye-open',
                    'url'=>'Yii::app()->createUrl("prices/view", array("id"=>$data->idPrice))',
                    'options'=>array(
                        'class'=>'btn',                    
                    ),
                ),
            ),
            'htmlOptions'=>array(
                'style'=>'width: 90px;',
            ), 
),*/
),
));?>