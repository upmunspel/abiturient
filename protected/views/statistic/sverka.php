<?php
/* @var $this PersonviewController */
/* @var $model PersonSpecialityView */
?>
<?php Yii::app()->bootstrap->register(); ?>
<center><h2>Статистика вступу абітуріентів Запорізького національного університету <?php echo date("Y"); ?></h2></center>    
<?php 

$data = $model->searchBig();

$cdpfilter = array(">1"=>"будь-яка", "<1"=>"немає");
foreach (CHtml::listData(Coursedp::model()->findAll(), "idCourseDP", "CourseDPName") as $key=>$val){
    $cdpfilter[$key] = $val;
}
$olympfilter = array(">1"=>"будь-яка", "<1"=>"немає");
foreach (CHtml::listData(Olympiadsawards::model()->findAll(), "OlympiadAwardID", "OlympiadAwardName") as $key=>$val){
    $olympfilter[$key] = $val;
}


$this->widget('bootstrap.widgets.TbGroupGridView', array(
'id'=>'person-speciality-view-grid',
    'type'=>'striped bordered condensed',
'dataProvider'=>$data,
//'rowCssClassExpression'=>'empty($data->SpecEdboID) && empty($data->PersonEdboID) ?"row-red":"row-green"',
'filter'=>$model,
    'mergeColumns' => array('FIO', 'Birthday',"PersonRequestNumber", 'idPerson',"QualificationID", 'isCopyEntrantDoc', 'CoursedpID','OlympiadID', 'CreateDate', "RequestFromEB"),
'columns'=>array(
               
                array('name'=>'idPerson', 'htmlOptions'=>array('style'=>'width: 50px'),),
                array('name'=>'QualificationID', 'htmlOptions'=>array('style'=>'width: 100px'), "value"=>'!empty($data->QualificationID) ? $data->qualification->QualificationName: "немаэ"', 'filter'=>  CHtml::listData(Qualifications::model()->findAll(), "idQualification", "QualificationName") ), 
                          

                array('name'=>'PersonRequestNumber', 'value'=>'$data->RequestPrefix.str_pad($data->PersonRequestNumber, 5, "0", STR_PAD_LEFT)', 'htmlOptions'=>array('style'=>'width: 120px'),), 
                array('name'=>'RequestNumber', 'value'=>'str_pad($data->RequestNumber, 5, "0", STR_PAD_LEFT)', 'htmlOptions'=>array('style'=>'width: 70px'),), 
                array('name'=>'RequestFromEB', 'htmlOptions'=>array('style'=>'width: 70px'), 'filter'=>array('1'=>'так','0'=>'ні'), 'value'=>'($data->RequestFromEB == "1")?("так"):("ні")'), 
		
                array('name'=>'FIO', 'htmlOptions'=>array('style'=>'width: 250px'),),   
                //array('name'=>'Birthday', 'htmlOptions'=>array('style'=>'width: 100px'),), 
    		//'idPerson',
                array('name'=>'EducationFormID', 'htmlOptions'=>array('style'=>'width: 70px'), 'filter'=>array('1'=>'Денна','2'=>'Заочна'), 'value'=>'($data->EducationFormID=="1")?("Денна"):("Заочна")'), 
		
                array('name'=>'SpecCodeName'), 
		
                array('name'=>'isCopyEntrantDoc', 'htmlOptions'=>array('style'=>'width: 70px'), 'filter'=>array('1'=>'так','0'=>'ні'), 'value'=>'($data->isCopyEntrantDoc=="1")?("так"):("ні")'), 
		
                //array('name'=>'isContract', 'htmlOptions'=>array('style'=>'width: 70px'), 'filter'=>array('1'=>'так','0'=>'ні'), 'value'=>'($data->isContract=="1")?("так"):("ні")'), 
		//array('name'=>'isBudget', 'htmlOptions'=>array('style'=>'width: 70px'), 'filter'=>array('1'=>'так','0'=>'ні'), 'value'=>'($data->isBudget=="1")?("так"):("ні")'), 
		array('name'=>'DocumentSubject1Value', 'htmlOptions'=>array('style'=>'width: 60px'),),   
                array('name'=>'DocumentSubject2Value', 'htmlOptions'=>array('style'=>'width: 60px'),),   
                array('name'=>'DocumentSubject3Value', 'htmlOptions'=>array('style'=>'width: 60px'),),   
    
                array('name'=>'AtestatValue', 'htmlOptions'=>array('style'=>'width: 50px'),),
    
		array('name'=>'CoursedpID', 'htmlOptions'=>array('style'=>'width: 150px'), "value"=>'!empty($data->CoursedpID) ? $data->coursedp->CourseDPName: "немає"', 'filter'=> $cdpfilter ), 
		
                array('name'=>'OlympiadID', 'htmlOptions'=>array('style'=>'width: 150px'), "value"=>'!empty($data->OlympiadID) ? $data->olympiad->OlympiadAwardName: "немає"', 'filter'=>$olympfilter  ), 
                array('name'=>'CreateDate', "value"=>'date("d.m.Y", strtotime($data->CreateDate))',  'htmlOptions'=>array('class'=>'datepicker', 'style'=>'width: 130px')), 
                
               
    /*
		'isBudget',
		'SpecCodeName',
		'QualificationID',
		'CourseID',
		'RequestNumber',
		'PersonRequestNumber',
		*/

),
)); ?>







