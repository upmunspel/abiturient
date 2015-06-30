<?php
/* @var $this PersondocumenttypesController */
/* @var $model PersonDocumentTypes */

$this->breadcrumbs = array(
    'Типи документів' => array('index'),
    'Довідник ',
);

$this->menu = array(
    array('label' => 'Додати запис', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('person-document-types-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Довідник Типи документів</h1>


<?php //echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
<!--<div class="search-form" style="display:none">
<?php
/*$this->renderPartial('_search', array(
    'model' => $model,
));*/
?>
</div>-->
<!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'person-document-types-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
         array('name'=>'idPersonDocumentTypes', 'htmlOptions'=>array('style'=>'width: 50px')),
        'PersonDocumentTypesName',
       //'IsEntrantDocument',
       // 'display',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
