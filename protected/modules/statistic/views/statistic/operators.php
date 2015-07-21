<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);
?>

<h1>Статистика роботи користувачів</h1>

<p>
    Фільтр поля "Прийнято заяв" відображає значення менші введеного 
</p>



<?php 
$pk = Chtml::listData(SysPk::model()->findAll(), "idPk", "PkName");

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array("header"=>"Код", 'name'=>'id','htmlOptions'=>array("style"=>"width: 50px;")),
		'username',
                array("header"=>"ПІБ оператора", 'name'=>'info'),
               
                //"syspk.PkName", 
                array("header"=>"Приймальна коміссія", "name"=>'pkname', 'filter'=>$pk),
                //array("header"=>"Прийнято заяв", "name"=>'my_count'),
                array("header"=>"Прийнято заяв", 'name'=>'speccount'),
		//'email',
		//,
		/*array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
