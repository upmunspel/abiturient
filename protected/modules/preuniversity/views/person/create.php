<?php
$this->breadcrumbs = array(
    'people' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'Перелік абітурієнтів', 'url' => Yii::app()->createUrl('preuniversity/person'), 'icon' => "icon-list-alt"),
);
?>

<?php //echo $this->renderPartial('_edboSearch', array('model' => $model, "searchres" => $searchres)); ?>

<h3>Абітурієнт</h3> 
<?php
if (Yii::app()->user->hasFlash("message")) {
    echo "<h4 style='color: red;'>" . Yii::app()->user->getFlash("message") . "</h4>";
}
if (Yii::app()->user->checkAccess("asEDBOReqOperator")) {
    echo $this->renderPartial('_formedbo', array('model' => $model));
} else {
    echo $this->renderPartial('_form', array('model' => $model));
}
?>
