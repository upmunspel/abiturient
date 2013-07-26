<?php
/* @var $this PersonviewController */
/* @var $model PersonSpecialityView */

$this->menu=array(
    array('label'=>'Додати ','url'=>Yii::app()->createUrl('person/create'),'icon'=>"icon-plus"),
     array('label'=>'Повний перелік абітуріентів ','url'=>Yii::app()->createUrl('person'),'icon'=>"icon-star-empty"),
    
);
//
//Yii::app()->clientScript->registerScript('search', "
//$('.search-button').click(function(){
//$('.search-form').toggle();
//return false;
//});
//$('.search-form form').submit(function(){
//$.fn.yiiGridView.update('person-speciality-view-grid', {
//data: $(this).serialize()
//});
//return false;
//});
//");
//?>


<h1>Перелік абітурієнтів</h1>

<p>Ви можете використовувати операції порівняння (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
або <b>=</b>) на початку кожного з параметрі що необхідно знайти.
</p>


<?php // echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
    <?php /*$this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
</div><!-- search-form -->

<?php 

$edt = CHtml::listData(Personeducationforms::model()->findAll(), 'idPersonEducationForm','PersonEducationFormName');
$this->widget('bootstrap.widgets.TbGroupGridView', array(
'id'=>'person-speciality-view-grid',
    'type'=>'striped bordered condensed',
'dataProvider'=>$model->search(),
 'rowCssClassExpression'=>'empty($data->SpecEdboID) && empty($data->PersonEdboID) ?"row-red":"row-green"',
'filter'=>$model,
    'mergeColumns' => array('FIO', 'Birthday',"PersonRequestNumber", 'idPerson'),
'columns'=>array(
                array('name'=>'idPerson', 'htmlOptions'=>array('style'=>'width: 50px'),),
                array('name'=>'PersonRequestNumber', 'value'=>'$data->RequestPrefix.str_pad($data->PersonRequestNumber, 5, "0", STR_PAD_LEFT)', 'htmlOptions'=>array('style'=>'width: 100px'),), 
                array('name'=>'RequestNumber', 'value'=>'str_pad($data->RequestNumber, 5, "0", STR_PAD_LEFT)', 'htmlOptions'=>array('style'=>'width: 50px'),), 
                
                array('name'=>'FIO', 'htmlOptions'=>array('style'=>'width: 250px'),),   
                //array('name'=>'Birthday', 'htmlOptions'=>array('style'=>'width: 100px'),), 
                'SpecCodeName',
    array('name'=>'EducationFormID', 'htmlOptions'=>array('style'=>'width: 70px'), 'filter'=>$edt, 'value'=>'$data->educationform->PersonEducationFormName'), 
		
		//'CreateDate',
		//'idPerson',
    
                array('name'=>'isCopyEntrantDoc', 'htmlOptions'=>array('style'=>'width: 70px'), 'filter'=>array('1'=>'так','0'=>'ні'), 'value'=>'($data->isCopyEntrantDoc=="1")?("так"):("ні")'), 
		
                //array('name'=>'isContract', 'htmlOptions'=>array('style'=>'width: 70px'), 'filter'=>array('1'=>'так','0'=>'ні'), 'value'=>'($data->isContract=="1")?("так"):("ні")'), 
		//array('name'=>'isBudget', 'htmlOptions'=>array('style'=>'width: 70px'), 'filter'=>array('1'=>'так','0'=>'ні'), 'value'=>'($data->isBudget=="1")?("так"):("ні")'), 
		array('name'=>'DocumentSubject1Value', 'htmlOptions'=>array('style'=>'width: 50px'),),   
                array('name'=>'DocumentSubject2Value', 'htmlOptions'=>array('style'=>'width: 50px'),),   
                array('name'=>'DocumentSubject3Value', 'htmlOptions'=>array('style'=>'width: 50px'),),   
    
              array('name'=>'AtestatValue', 'htmlOptions'=>array('style'=>'width: 50px'),),   
		
		/*
		'isBudget',
		'SpecCodeName',
		'QualificationID',
		'CourseID',
		'RequestNumber',
		'PersonRequestNumber',
		*/
array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{view}',
            'buttons'=>array
            (
                
                'update' => array(
                    'label'=>'Редагувати',
                    'icon'=>'pencil',
                    'url'=>'Yii::app()->createUrl("person/update", array("id"=>$data->idPerson))',
                    'options'=>array(
                        'class'=>'btn',
                        //'onclick'=>"PSN.editDoc(this); return false;",
                    ),
                 ),
               'view' => array(
                    'label'=>'Параметри вступу',
                    'icon'=>'icon-th-list',
                    'url'=>'Yii::app()->createUrl("person/view", array("id"=>$data->idPerson))',
                    'options'=>array(
                        'class'=>'btn',
                        
                    ),
                ),
            ),
            'htmlOptions'=>array(
                'style'=>'width: 90px;',
            ),
          ),
),
)); ?>
