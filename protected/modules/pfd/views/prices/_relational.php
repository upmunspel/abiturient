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
  'id'=>'specialities-grid-'.$id,
  'type'=>'striped bordered condensed',
  'dataProvider'=>$model->searchSpec($id),
  'template'=>"{items}",
  'columns'=>array(
    //'idSpeciality',
    array(
      'class' => 'bootstrap.widgets.TbEditableColumn',
      'name' => 'SpecialityLicenseName',
      'editable' => array(
        'url' => Yii::app()->CreateUrl('specialities/xedit'),
        'placement' => 'right',
        'inputclass' => 'span3',
        'type'=>'textarea',
        'title' => 'Введіть назву спеціальності згідно ліцензії'
      ),
    ),
    array('name'=>'PersonEducationFormID',
                'filter'=>array('1'=>'так','0'=>'ні'),
                'value'=>'($data->PersonEducationFormID == "1")?
                  ("денна"):(($data->PersonEducationFormID == "2")?("заочна"):"екстернат")',
                'htmlOptions'=>array( 'style'=>'width: 70px;') 
    ),
    array(
      'class' => 'bootstrap.widgets.TbEditableColumn',
      'name' => 'YearPrice',
      'editable' => array(
        'url' => Yii::app()->CreateUrl('specialities/xedit',array('field' => 'YearPrice')),
        'placement' => 'right',
        'inputclass' => 'span3',
        'type'=>'text',
        'title' => 'Введіть загальну вартість навчання',
        'success'   => 'js: function(data) {
            $.fn.yiiGridView.update("specialities-grid-'.$id.'");  
        }'
      ),
      'htmlOptions'=>array(
        'style'=>'width: 70px;',
      ),
    ),
    array(
      'class' => 'bootstrap.widgets.TbEditableColumn',
      'name' => 'SemPrice',
      'editable' => array(
        'url' => $this->createUrl('prices/editprice'),
        'placement' => 'right',
        'inputclass' => 'span3',
        'title' => 'Введіть вартість навчання протягом 1 семестру'
      ),
      'htmlOptions'=>array(
        'style'=>'width: 70px;',
      ),
    ),    
    array(
      'class' => 'bootstrap.widgets.TbEditableColumn',
      'name' => 'WordPrice',
      'editable' => array(
        'url' => $this->createUrl('prices/editprice'),
        'mode' => 'inline',
        'inputclass' => 'span3',
        'type'=>'textarea',
        'title' => 'Введіть загальну вартість прописом'
      )
    ),    
    array(
      'class' => 'bootstrap.widgets.TbEditableColumn',
      'name' => 'StudyPeriodID',
      'editable' => array(
        'url' => $this->createUrl('prices/editprice'),
        'placement' => 'left',
        'inputclass' => 'span3',
        'type'      => 'select',
        'source'    => CHtml::listData(Studyperiods::model()->findAll(), 
          "idStudyPeriod", "StudyPeriodName"),
        'title' => 'Оберіть період навчання'
      ),
      'htmlOptions'=>array(
        'style'=>'width: 170px;',
      ),
    ),
  ),
));
 ?>
<script type="text/javascript">
/*<![CDATA[*/
//jQuery('#pretty_photo a').attr('rel','prettyPhoto');
//jQuery('a[rel^="prettyPhoto"]').prettyPhoto({'opacity':0.6,'modal':true,'theme':'facebook'});
/*]]>*/
</script>