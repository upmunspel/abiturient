<?php
/* @var $this EdbodataController */
/* @var $model EdboData */

$this->menu=array(
  array('label'=>'Додати новий запис', 'url'=>array('create')),
);


?>

<h1>Edbo Datas</h1>


<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
  'id' => 'edbo-data-grid',
  'dataProvider'=>$model->search(),
  'filter'=>$model,
  'columns'=>array(
    'ID',
    'PIB',
    'EZ',
    'Status',
    'Created',
    'PersonCase',

    'Course',
    'EduForm',
    'EduQualification',
    'B',
    'K',
    'RatingPoints',
    'SpecCode',
    'Direction',
    'SpecialCode',
    'Speciality',
    'Specialization',
    'StructBranch',
    'Changed',
    'DetailPoints',
    'DocType',
    'DocSeria',
    'DocNumber',
    'DocPoint',
    'DocDate',
    'Honours',
    'EntranceType',
    'EntranceReason',
    'Benefit',
    'PriorityEntry',
    'Quota',
    'Language',
    'OI',
    'Category',
    'Gender',
    'Citizen',
    'Country',
    'TH',
    'Tel',
    'MobTel',
    'OD',
    'NeedHostel',
    'EntranceCodes',
    array(
      'class'=>'bootstrap.widgets.TbButtonColumn',
    ),
  ),
)); ?>
