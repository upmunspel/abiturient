<?php
/* @var $this PersonviewController */
/* @var $model PersonSpecialityView */

?>
<?php Yii::app()->bootstrap->register(); ?>
<?php $this->widget('bootstrap.widgets.TbGroupGridView', array(
'id'=>'person-speciality-view-grid',
    'type'=>'striped bordered condensed',
'dataProvider'=>$model->searchBig(),
 'rowCssClassExpression'=>'empty($data->SpecEdboID) && empty($data->PersonEdboID) ?"row-red":"row-green"',
'filter'=>$model,
    'mergeColumns' => array('FIO', 'Birthday',"PersonRequestNumber", 'idPerson'),
'columns'=>array(
               
                array('name'=>'idPerson', 'htmlOptions'=>array('style'=>'width: 50px'),),
                array('name'=>'QualificationID', 'htmlOptions'=>array('style'=>'width: 150px'), "value"=>'!empty($data->QualificationID) ? $data->qualification->QualificationName: "немаэ"', 'filter'=>  CHtml::listData(Qualifications::model()->findAll(), "idQualification", "QualificationName") ), 
                          

                array('name'=>'PersonRequestNumber', 'value'=>'$data->RequestPrefix.str_pad($data->PersonRequestNumber, 5, "0", STR_PAD_LEFT)', 'htmlOptions'=>array('style'=>'width: 100px'),), 
                array('name'=>'RequestNumber', 'value'=>'str_pad($data->RequestNumber, 5, "0", STR_PAD_LEFT)', 'htmlOptions'=>array('style'=>'width: 50px'),), 
                
                array('name'=>'FIO', 'htmlOptions'=>array('style'=>'width: 250px'),),   
                //array('name'=>'Birthday', 'htmlOptions'=>array('style'=>'width: 100px'),), 
                'SpecCodeName',
		//'CreateDate',
		//'idPerson',
                array('name'=>'isCopyEntrantDoc', 'htmlOptions'=>array('style'=>'width: 70px'), 'filter'=>array('1'=>'так','0'=>'ні'), 'value'=>'($data->isCopyEntrantDoc=="1")?("так"):("ні")'), 
		
                //array('name'=>'isContract', 'htmlOptions'=>array('style'=>'width: 70px'), 'filter'=>array('1'=>'так','0'=>'ні'), 'value'=>'($data->isContract=="1")?("так"):("ні")'), 
		//array('name'=>'isBudget', 'htmlOptions'=>array('style'=>'width: 70px'), 'filter'=>array('1'=>'так','0'=>'ні'), 'value'=>'($data->isBudget=="1")?("так"):("ні")'), 
		array('name'=>'DocumentSubject1Value', 'htmlOptions'=>array('style'=>'width: 50px'),),   
                array('name'=>'DocumentSubject2Value', 'htmlOptions'=>array('style'=>'width: 50px'),),   
                array('name'=>'DocumentSubject3Value', 'htmlOptions'=>array('style'=>'width: 50px'),),   
    
                array('name'=>'AtestatValue', 'htmlOptions'=>array('style'=>'width: 50px'),),   
		array('name'=>'CoursedpID', 'htmlOptions'=>array('style'=>'width: 150px'), "value"=>'!empty($data->CoursedpID) ? $data->coursedp->CourseDPName: "немає"', 'filter'=>  CHtml::listData(Coursedp::model()->findAll(), "idCourseDP", "CourseDPName") ), 
		
                array('name'=>'OlympiadID', 'htmlOptions'=>array('style'=>'width: 150px'), "value"=>'!empty($data->OlympiadID) ? $data->olympiad->OlympiadAwardName: "немає"', 'filter'=>  CHtml::listData(Olympiadsawards::model()->findAll(), "OlympiadAwardID", "OlympiadAwardName") ), 
                'CreateDate',    
    /*
		'isBudget',
		'SpecCodeName',
		'QualificationID',
		'CourseID',
		'RequestNumber',
		'PersonRequestNumber',
		*/
//array(
//            'class'=>'bootstrap.widgets.TbButtonColumn',
//            'template'=>'{update}{view}',
//            'buttons'=>array
//            (
//                
//                'update' => array(
//                    'label'=>'Редагувати',
//                    'icon'=>'pencil',
//                    'url'=>'Yii::app()->createUrl("person/update", array("id"=>$data->idPerson))',
//                    'options'=>array(
//                        'class'=>'btn',
//                        //'onclick'=>"PSN.editDoc(this); return false;",
//                    ),
//                 ),
//               'view' => array(
//                    'label'=>'Параметри вступу',
//                    'icon'=>'icon-th-list',
//                    'url'=>'Yii::app()->createUrl("person/view", array("id"=>$data->idPerson))',
//                    'options'=>array(
//                        'class'=>'btn',
//                        
//                    ),
//                ),
//            ),
//            'htmlOptions'=>array(
//                'style'=>'width: 90px;',
//            ),
//          ),
),
)); ?>
