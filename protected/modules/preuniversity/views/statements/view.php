<?php
/* @var $this StatementsController */
/* @var $model Statements */

$this->breadcrumbs=array(
	'Statements'=>array('index'),
	$model->idStatement,
);
$url = "http://skif.znu.edu.ua:8080/request_report-1.0-1.0-SNAPSHOT/statement.jsp?filter=".$model->number."&format=6";
$this->menu=array(
	//array('label'=>'List Statements', 'url'=>array('index'),'icon'=>" icon-pencil" ),
	array('label'=>'Створити', 'url'=>array('create') ,'icon'=>"icon-plus-sign"  ),
	array('label'=>'Змінити', 'url'=>array('update', 'id'=>$model->idStatement) ,'icon'=>" icon-pencil" ),
	//array('label'=>'Видалити','icon'=>" icon-trash",'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idStatement),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Перелік відомостей', 'url'=>array('admin'),'icon'=>"icon-list-alt" ),
        array('label'=>'Перелік слухачів', 'url'=>array('/preuniversity/person'),'icon'=>" icon-user" ),
       array('label'=>'Друкувати', 'url'=>$url,'icon'=>"icon-print"),
    
);
?>

<h1>Відомість № <?php echo $model->number; ?></h1>

<?php
        if (isset($model->Subjects1ID))
            $model->Subjects1ID = $model->subj1->SubjectName;
        if (isset($model->Subjects2ID))
            $model->Subjects2ID = $model->subj2->SubjectName;
        if (isset($model->Subjects3ID))
            $model->Subjects3ID = $model->subj3->SubjectName;
$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
        'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		//'idStatement',
		'number',
		'created',
		//'updated',
		//'uid',
		'specFullName',
               
		'Subjects1ID',
		'Subjects2ID',
		'Subjects3ID',
		'SubjectsDate1',
		'SubjectsDate2',
		'SubjectsDate3',
	),
)); ?>
<?php

$data = new CActiveDataProvider('Statementpersons');
$data->setData($itemsmodel);

$this->widget('bootstrap.widgets.TbGridView', array(
    //'filter'=>$model,
    'type'=>'striped bordered',
    'id' => 'speciality-price-grid',
    'dataProvider' => $data,
    'template' => "{items}",
    'columns' => array(
            
                array("name"=>"Fio", 
                    "header"=>"ФИО"
                    ),
             array("name"=>"Hash", 
                    "header"=>"Hash"
                    ),
            array(
                'class' => 'bootstrap.widgets.TbEditableColumn',
                'name' => 'Subject1Val',
                'editable' => array(
                  'url' => $this->createUrl('statements/editfield',array('field' => 'Subject1Val')),
                  'mode' => 'inline',
                  'inputclass' => 'span1',
                  'type'=>'text',
                  
                  'title' => 'Введіть оцінку',
                  //  'htmlOptions' => array('data-pk' => "$data->PersonID")
                )
              ),
        array(
                'class' => 'bootstrap.widgets.TbEditableColumn',
                'name' => 'Subject2Val',
                'editable' => array(
                  'url' => $this->createUrl('statements/editfield'),
                  'mode' => 'inline',
                  'inputclass' => 'span1',
                  'type'=>'text',
                  'title' => 'Введіть оцінку',
                )
              ),
        array(
                'class' => 'bootstrap.widgets.TbEditableColumn',
                'name' => 'Subject3Val',
                'editable' => array(
                  'url' => $this->createUrl('statements/editfield'),
                  'mode' => 'inline',
                  'inputclass' => 'span1',
                  'type'=>'text',
                  'title' => 'Введіть оцінку',
                )
              )
           
     ), 
));

?>
