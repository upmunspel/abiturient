<?php
$burl = Yii::app()->baseUrl;
Yii::app()->getClientScript()->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile($burl."/js/bootstrap-datepicker.js");
Yii::app()->clientScript->registerScriptFile($burl."/js/person.js");

$this->menu=array(
	array('label'=>'Перелік абітурієнтів','url'=>array('index'),'icon'=>"icon-list-alt"),
	array('label'=>'Додати  абітурієнта','url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Редагувати абітурієнта','url'=>array('update','id'=>$model->idPerson),'icon'=>" icon-pencil"),
	array('label'=>'Видалити абітурієнта','url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idPerson),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Person','url'=>array('admin')),
);
?>

<h2>Загальна інформація про абітурієнта (<?php echo $model->idPerson; ?>)</h2>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
        'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idPerson',
		'FirstName',
		'LastName',
                'MiddleName',
                "Birthday"
	),
)); ?>
<h3>Параметри вступу та пільги що маэ абітуріент</h3> 
<div  style="   background-color: #fff;
                border: 1px solid #ddd;
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                border-radius: 4px;
                padding:10px;">
    <div style="margin-bottom: 10px;">
        
    <?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
        'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'buttons'=>array(
            array('label'=>'Додати спеціальність', 'items'=>array(
                array('label'=>'Прикладна математика', 'url'=>'#'),
                array('label'=>'Філосовія', 'url'=>'#'),
                array('label'=>'Програмна інженерія', 'url'=>'#'),
                array('label'=>'...', 'url'=>'#'),
            )),
        ),
    )); ?>  
    </div>
    
    <?php $this->widget('bootstrap.widgets.TbTabs', array(
        'type'=>'tabs', // 'tabs' or 'pills'

        'tabs'=>array(
            array('label'=>'Пільги', 'content'=>$this->renderPartial("_benefits",array("models"=>$model->benefits, 'personid'=>$model->idPerson),true), 'active'=>true, 'id'=>"benefits"),
        ),
    )); ?>
    <hr>
       <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'button',
                'type'=>'primary',
                'label'=>'Зберегти всі зміни',
                'size'=>"large",
                'loadingText'=>'Збереження...',
                'htmlOptions'=>array('id'=>'personSave'),
                )); 
            ?>
    
</div>
<?php $this->renderPartial("_benefitModal",array());?>
