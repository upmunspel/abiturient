<?php
/* @var $this PersonviewController */
/* @var $model PersonSpecialityView */
?>
<?php Yii::app()->bootstrap->register(); ?>
<center><h2>Абітуріенти контрактної форми навчання</h2></center>    
<?php 

$data = $model->searchPrice();

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
    'filter'=>$model,
    'mergeColumns' => array('FIO', 'Birthday',"PersonRequestNumber", 'idPerson',"QualificationID", 'isCopyEntrantDoc', 'CoursedpID','OlympiadID', 'CreateDate', "RequestFromEB"),
'columns'=>array(
               
                array('name'=>'idPerson', 'htmlOptions'=>array('style'=>'width: 50px'),),
                array('name'=>'QualificationID', 'htmlOptions'=>array('style'=>'width: 100px'), "value"=>'!empty($data->QualificationID) ? $data->qualification->QualificationName: "немаэ"', 'filter'=>  CHtml::listData(Qualifications::model()->findAll(), "idQualification", "QualificationName") ), 
                          

//                array('name'=>'PersonRequestNumber', 'value'=>'$data->RequestPrefix.str_pad($data->PersonRequestNumber, 5, "0", STR_PAD_LEFT)', 'htmlOptions'=>array('style'=>'width: 120px'),), 
//                array('name'=>'RequestNumber', 'value'=>'str_pad($data->RequestNumber, 5, "0", STR_PAD_LEFT)', 'htmlOptions'=>array('style'=>'width: 70px'),), 
//                array('name'=>'RequestFromEB', 'htmlOptions'=>array('style'=>'width: 70px'), 'filter'=>array('1'=>'так','0'=>'ні'), 'value'=>'($data->RequestFromEB == "1")?("так"):("ні")'), 
		
                array('name'=>'FIO', 'htmlOptions'=>array('style'=>'width: 250px'),),   
                array('name'=>'Birthday', 'htmlOptions'=>array('style'=>'width: 100px'),), 
    		//'idPerson',
                array('name'=>'EducationFormID', 'htmlOptions'=>array('style'=>'width: 70px'), 'filter'=>array('1'=>'Денна','2'=>'Заочна'), 'value'=>'($data->EducationFormID=="1")?("Денна"):("Заочна")'), 
		
                array('name'=>'SpecCodeName'), 
                 //"isContract",
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
                        'template'=>'{sign}',
                        'buttons'=>array
                         (

                            'sign' => array(
                                'label'=>'Підписати контракт',
                                'icon'=>'pencil',
                                'url'=>'Yii::app()->createUrl("pfd/contracts/create",array("specid"=>$data->idPersonSpeciality))',
                                'options'=>array(
                                    'class'=>'btn',
                                    'onclick'=>"PSN.editSpec(this); return false;",
                                    'target'=>"_blank",
                                ),
                             ),
                          )
                    )

),
)); ?>







