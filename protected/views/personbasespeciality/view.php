<?php
/* @var $this PersonbasespecialityController */
/* @var $model Personbasespeciality */

$this->breadcrumbs = array(
    'Personbasespecialities' => array('index'),
    $model->idPersonBaseSpeciality,
);

$this->menu = array(
    array('label' => 'Перелік записів', 'url' => array('admin')),
    array('label' => 'Створити', 'url' => array('create')),
    array('label' => 'Редагувати', 'url' => array('update', 'id' => $model->idPersonBaseSpeciality)),
    array('label' => 'Видалити', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->idPersonBaseSpeciality), 'confirm' => 'Are you sure you want to delete this item?')),
    //array('label' => 'Управління', 'url' => array('admin')),
);
?>

<h1>Базовий напрямок  #<?php echo $model->idPersonBaseSpeciality; ?></h1>
<br/>
<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'type' => array('bordered', 'condensed', 'striped'),
    'data' => $model,
    'attributes' => array(
        'idPersonBaseSpeciality',
        'PersonBaseSpecialityName',
        'PersonBaseSpecialityClasifierCode',
    ),
));
?>
