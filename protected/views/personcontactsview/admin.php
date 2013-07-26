<?php
/* @var $this PersoncontactsviewController */
/* @var $model PersonContactsView */
?>

<h1>Контакти абітуріентів</h1>

<p>
    Можна додати оператор порівняння (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) перед значенням пошуку
</p>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'person-contacts-view-grid',
    'type'=>'striped bordered condensed',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
'columns'=>array(
		'FIO',
		//'SepcialityID',
		//'EducationFormID',
		//'isBudget',
		//'isContract',
		'SpecName',
		
		'Contacts',
		
array(
    'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
