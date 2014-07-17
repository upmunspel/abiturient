<?php
/* @var $this Specialitiescontroller */
/* @var $model Specialities */

$this->breadcrumbs = array(
    'Specialities' => array('index'),
    'Довідник ',
);

$this->menu = array(
    /* array('label'=>'List Specialities', 'url'=>array('index')), */
    array('label' => 'Додати запис', 'url' => array('create'), 'icon' => "icon-plus"),
);

?>

<h1>Довідник "Спеціальності"</h1>


<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'specialities-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array('name' => 'SpecialityName',
            'header' => 'Назва спеціальності',
            'value' => '$data->SpecialityFullName',
            'htmlOptions' => array('class' => 'span6'),
        ),
        array('name' => 'FacultetID',
            'header' => 'Факультет',
            'filter' => CHtml::listData(Facultets::model()->findAll(), "idFacultet", "FacultetFullName"),
            'value' => '$data->facultet->FacultetFullName',
            'htmlOptions' => array('class' => 'span2'),
        ),
        array('name' => 'PersonEducationFormID',
            'header' => 'Форма',
            'filter' => CHtml::listData(Personeducationforms::model()->findAll(), 
              "idPersonEducationForm", "PersonEducationFormName"),
            'value' => '$data->eduform->PersonEducationFormName',
            'htmlOptions' => array('class' => 'span1'),
        ),
        array(
           'class' => 'bootstrap.widgets.TbEditableColumn',
           'name' => 'SpecialityBudgetCount',
           'header' => 'Б',
           'editable' => array(
                  'url'        => $this->createUrl('specialities/xedit'),
                  'placement'  => 'right',
                  'inputclass' => 'span3',
              ),
           'headerHtmlOptions' => array('title' => 'Кількість бюджетних місць'),
           'htmlOptions' => array('class' => 'span1'),
        ),
        array(
           'class' => 'bootstrap.widgets.TbEditableColumn',
           'name' => 'SpecialityContractCount',
           'header' => 'К',
           'editable' => array(
                  'url'        => $this->createUrl('specialities/xedit'),
                  'placement'  => 'right',
                  'inputclass' => 'span3',
              ),
           'headerHtmlOptions' => array('title' => 'Кількість контракних місць'),
           'htmlOptions' => array('class' => 'span1'),
        ),
        array(
           'class' => 'bootstrap.widgets.TbEditableColumn',
           'name' => 'Quota1',
           'header' => 'ПК',
           'editable' => array(
                  'url'        => $this->createUrl('specialities/xedit'),
                  'placement'  => 'right',
                  'inputclass' => 'span3',
              ),
           'headerHtmlOptions' => array('title' => 'Квота для тих, хто поступає за цільовим направленням'),
           'htmlOptions' => array('class' => 'span1'),
        ),
        array(
          'class' => 'bootstrap.widgets.TbEditableColumn',
          'name' => 'Quota2',
          'header' => 'СМ',
          'editable' => array(
            'url'        => $this->createUrl('specialities/xedit'),
            'placement'  => 'right',
            'inputclass' => 'span3',
          ),
          'headerHtmlOptions' => array('title' => 'Квота для тих, хто поступає із сільської місцевості'),
          'htmlOptions' => array('class' => 'span1'),
        ),
        array(
          'class' => 'bootstrap.widgets.TbButtonColumn',
          'template' => '{view} {update} {delete}',
          'buttons' => array(
          ),
          'htmlOptions' => array('class' => 'span1'),
        ),
    ),
));
?>