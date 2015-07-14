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
$controller = $this;
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'specialities-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array('name' => 'SPEC',
            'header' => 'Назва спеціальності',
            'value' => '$data->SPEC',
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
           'headerHtmlOptions' => array('title' => 'Квота для тих, хто поступає поза конкурсом'),
           'htmlOptions' => array('class' => 'span1'),
        ),
        array(
          'header' => 'ЦН',
          'value' => function ($data) use ($controller) {
            /* @var $data Specialities */
            $types = array('info','warning','success','important','inverse');
            $i = 0;
            foreach ($data->specquotes as $squota){
              echo '<a href="'
               .Yii::app()->CreateUrl('specialityquotes/update',array('id' => $squota->idSpecialityQuotes))
               .'" target="_blank" >';
              $controller->widget('bootstrap.widgets.TbLabel', array(
                'type'=> $types[$i],
                'label'=>$squota->BudgetPlaces,
                'htmlOptions' => array(
                  'title' => $squota->quota->QuotaName,
                  'style' => 'font-size: 12pt !important; width: 21px; text-align: center; font-family: Verdana;',
                )
              )); 
              echo "</a> &nbsp;";
              $i++;
            }
          },
          'headerHtmlOptions' => array('title' => 'Квота для тих, хто поступає за цільовим направленням'),
          'htmlOptions' => array('class' => 'span1'),
        ),
        array(
            'name' => 'ZnoKoef1',
            'header' => 'Коефіцієнт',
            'value' => '$data->ZnoKoef1',
            'htmlOptions' => array('class' => 'span1'),
        ),  
        array(
            'name' => 'ZnoKoef2',
            'header' => 'Коефіцієнт',
            'value' => '$data->ZnoKoef2',
            'htmlOptions' => array('class' => 'span1'),
        ),
        array(
            'name' => 'ZnoKoef3',
            'header' => 'Коефіцієнт',
            'value' => '$data->ZnoKoef3',
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