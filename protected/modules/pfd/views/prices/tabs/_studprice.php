<?php //$this->renderPartial("//prices/_search_stud");?>
<p>Перелік студентів за контрактною формою навчання.</p>

<?php $this->widget('bootstrap.widgets.TbGroupGridView', array(
'id'=>'person-speciality-view-grid',
'type'=>'striped bordered condensed',
'dataProvider'=>$model->searchPrice(),
'filter'=>$model,
'mergeColumns' => array('FIO', 'Birthday',"PersonRequestNumber", 'idPerson'),
'columns'=>array(
                array('name'=>'idPerson', 'htmlOptions'=>array('style'=>'width: 50px'),),
                array('name'=>'FIO', 'htmlOptions'=>array('style'=>'width: 250px'),),   
                'SpecCodeName',
                array('name'=>'Birthday', 'htmlOptions'=>array('style'=>'width: 100px'),), 
		
array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{print}',
            'buttons'=>array
            (
                
                'update' => array(
                    'label'=>'Редагувати',
                    'icon'=>'pencil',
                    'url'=>'Yii::app()->createUrl("Personspeciality/studupdate",array("id"=>$data->idPersonSpeciality))',
                    'options'=>array(
                        'class'=>'btn',
                        'onclick'=>"PRC.editStudprice(this); return false;",
                    ),
                 ),
              
                    'print' => array(
                        'label'=>'Друкувати',
                        'icon'=>'print',
                        'url'=>'Yii::app()->user->getPrintPriceUrl($data->idPersonSpeciality)',
                        'options'=>array(
                            'class'=>'btn',
                            //'onclick'=>'PRC.printSpec(this); return true;',
                            'rel'=>"prettyPhoto",
                            'title'=>"Друкувати заявку",
                        ),),                
            ),
            'htmlOptions'=>array(
                'style'=>'width: 90px;',
            ),
          ),
),
)); ?>
<script type="text/javascript">
/*<![CDATA[*/
jQuery('#pretty_photo a').attr('rel','prettyPhoto');
jQuery('a[rel^="prettyPhoto"]').prettyPhoto({'opacity':0.6,'modal':true,'theme':'facebook'});
/*]]>*/
</script>
<script>
    $('#person-form.datepicker').datepicker({'format':'dd.mm.yyyy'});
    $('.datepicker').css("z-index","9999");
    $("#person-form.switch").bootstrapSwitch();
</script>