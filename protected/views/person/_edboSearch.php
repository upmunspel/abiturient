<?php $form=$this->beginWidget('CActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
        'htmlOptions'=>array('style'=>"display: none;",'id'=>'search-form',"class"=>"well"),
)); 
?>

<h4>Пошук абітурієнта у базі ЕДБО за серією та номером документа</h4>
<hr>
<div class="row-fluid form">
    <div class="span1">
        <?php echo CHtml::label("Серія:","search[series]");?>
	<?php echo CHtml::textField("search[series]","",array("class"=>"span12"));?>
    </div>
    <div class="span2">
        <?php echo CHtml::label("Номер:","search[number]"); ?>
        <?php echo CHtml::textField("search[number]","",array("class"=>"span12"));?>
    </div>
    <div class="span9">
        <p>Для пошуку абітуріента зберігайте наступну послідовність документів:</p>
        <ul>
            <li>Атестат про повну середню освіту</li>
            <li>Паспорт</li>
            <li>Інший документ</li>
        </ul>
    </div>
</div>
<hr>
<div class="row-fluid form">
    <div class="span2">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Пошук',
                        'htmlOptions'=>array("onclick"=>"blockUI(); return true;"),
		)); ?>
    </div>
</div>
<?php $this->endWidget(); ?>

<?php if (!empty($searchres)): ?>
 <h4>Результати пошуку у базі ЄДБО за серією та номером документа</h4>   
    
<?php $data = new CArrayDataProvider($searchres);
$data->keyField = "idPerson";
    $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'person-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$data,
        'htmlOptions'=>array('style'=>"padding-top: 0px;"),
	//'filter'=>$model,
	'columns'=>array(
        array('name'=>'LastName', 'header'=>'Прізвище'),
        array('name'=>'FirstName', 'header'=>"Ім'я"),
        array('name'=>'MiddleName', 'header'=>'По батькові'),
        array('name'=>'Birthday', 'header'=>'Дата народження', 'htmlOptions'=>array('style'=>'width: 150px')),   
	array('name'=>'codeU', 'header'=>'UKODE', 'htmlOptions'=>array('style'=>'width: 300px')),   
	array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view}',
            'buttons'=>array
            (
                
                    'view' => array(
                    'label'=>'Обрати',
                    'icon'=>'icon-check',
                    'url'=>'Yii::app()->createUrl("person/create", array("personCodeU"=>$data->codeU))',
                    'options'=>array(
                        'class'=>'btn',
                        "onclick"=>"blockUI()",
                    ),
                ),
            ),
            'htmlOptions'=>array(
                'style'=>'width: 50px;',
            ),
          )
	),
)); 
//print_r($data);
?>


<?php endif; ?>
