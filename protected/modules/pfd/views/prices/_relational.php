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
//Yii::app()->clientScript->registerScript('script', "", CClientScript::POS_READY);

$this->widget('bootstrap.widgets.TbGridView', array(
'id'=>'specialities-grid',
'type'=>'striped bordered condensed',
'dataProvider'=>$model->searchSpec($id),
'template'=>"{items}",
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
                    'value'=>'($data->PersonEducationFormID == "1")?("денна"):(($data->PersonEducationFormID == "2")?("заочна"):"екстернат")',
                    'htmlOptions'=>array( 'style'=>'width: 70px;') ),
    
        array(
            'class' => 'bootstrap.widgets.TbEditableColumn',
	    'name' => 'YearPrice',
	    //'sortable'=>false,
            'editable' => array(
				'url' => $this->createUrl('prices/editprice'),
				'placement' => 'right',
				'inputclass' => 'span3',
                                'type'=>'text'
            ),
             'htmlOptions'=>array(
                    'style'=>'width: 70px;',
              ),
        ),
        array(
            'class' => 'bootstrap.widgets.TbEditableColumn',
			'name' => 'SemPrice',
			//'sortable'=>false,
                        'editable' => array(
				'url' => $this->createUrl('prices/editprice'),
				'placement' => 'right',
				'inputclass' => 'span3'
			),
             'htmlOptions'=>array(
                    'style'=>'width: 70px;',
              ),
            
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
			),
             'htmlOptions'=>array(
                    'style'=>'width: 170px;',
              ),
            
        ),    
        
        array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{print}',
                 "header"=>"Ст-ка",
                'buttons'=>array
                (

                    'print' => array(
                        'label'=>'Друкувати перелік осіб, що оформили контакт',
                        'icon'=>'print',
                        'url'=>'"http://10.1.11.57:8080/request_report-1.0/price_sort.jsp?idSpeciality=".$data->idSpeciality."&iframe=true&width=1024&height=600"',
                        'options'=>array(
                            'class'=>'btn prettyPhoto',
                            //'onclick'=>'Yii::app()->user->getPrintSortUrl($data->idSpeciality)',
                            //'rel'=>"prettyPhoto",
                            'title'=>"Перелік осіб, що оформили контакт",
                        ),
                    ),
                   
                ),
                'htmlOptions'=>array(
                    'style'=>'width: 30px;',
                ),
            )
//        array('name'=>'isPublishIn',
//                    'header'=>'isPublishIn',
//                    'filter'=>array('1'=>'так','0'=>'ні'),
//                    'value'=>'($data->isPublishIn=="1")?("так"):("ні")'),
    ),     
));
 ?>
<script type="text/javascript">
/*<![CDATA[*/
//jQuery('#pretty_photo a').attr('rel','prettyPhoto');
//jQuery('a[rel^="prettyPhoto"]').prettyPhoto({'opacity':0.6,'modal':true,'theme':'facebook'});
/*]]>*/
</script>