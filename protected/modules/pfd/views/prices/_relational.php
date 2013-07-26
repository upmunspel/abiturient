<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style>
    .summary {
        display: none;
    }
    .grid-view {
        padding-top: 10px;
    }
</style>    
<?php

$this->widget('bootstrap.widgets.TbGridView', array(
'id'=>'specialities-grid',
'type'=>'striped bordered condensed',
'dataProvider'=>$model->searchSpec($id),
'columns'=>array(
		//'idSpeciality',
		
                array("name"=>'SpecialityName',"value"=>'$data->SpecialityClasifierCode." : ".$data->SpecialityDirectionName.$data->SpecialityName.(!empty($data->SpecialitySpecializationName) ? " : ".$data->SpecialitySpecializationName :"") ' ),
		//'SpecialityKode',
		//'FacultetID',
               
		
		//'SpecialityBudgetCount',
	//	'SpecialityContractCount',
        array('name'=>'PersonEducationFormID',
                    //'header'=>'isZaoch',
                    'filter'=>array('1'=>'так','0'=>'ні'),
                    'value'=>'($data->PersonEducationFormID == "1")?("денна"):(($data->PersonEducationFormID == "2")?("заочна"):"екстернат")'),
    
        array(
            'class' => 'bootstrap.widgets.TbEditableColumn',
	    'name' => 'YearPrice',
	    //'sortable'=>false,
            'editable' => array(
				'url' => $this->createUrl('prices/editprice'),
				'placement' => 'right',
				'inputclass' => 'span3',
                                'type'=>'text'
            )
        ),
        array(
            'class' => 'bootstrap.widgets.TbEditableColumn',
			'name' => 'SemPrice',
			//'sortable'=>false,
                        'editable' => array(
				'url' => $this->createUrl('prices/editprice'),
				'placement' => 'right',
				'inputclass' => 'span3'
			)
            
        ),    
       array(
            'class' => 'bootstrap.widgets.TbEditableColumn',
			'name' => 'WordPrice',
			//'sortable'=>false,
                        'editable' => array(
				'url' => $this->createUrl('prices/editprice'),
				'placement' => 'right',
				'inputclass' => 'span3',
                                'type'=>'textarea'
			)
            
        ),    
        array(
            'class' => 'bootstrap.widgets.TbEditableColumn',
			'name' => 'StudyPeriodID',
			//'sortable'=>false,
                        'editable' => array(
				'url' => $this->createUrl('prices/editprice'),
				'placement' => 'left',
				'inputclass' => 'span3',
                                'type'      => 'select',
                                'source'    => CHtml::listData(Studyperiods::model()->findAll(), "idStudyPeriod", "StudyPeriodName"),
			)
            
        ),    
        
//        array('name'=>'isPublishIn',
//                    'header'=>'isPublishIn',
//                    'filter'=>array('1'=>'так','0'=>'ні'),
//                    'value'=>'($data->isPublishIn=="1")?("так"):("ні")'),
    ),
));
 ?>