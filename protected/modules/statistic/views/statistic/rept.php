<?php
/* @var $data CArrayDataProvider */
/* @var $columns array */

$this->widget('bootstrap.widgets.TbGroupGridView',array(
    'id' => 'rept-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $data,
    'mergeColumns' => array('NAME'),
    'columns' => $columns,
));

