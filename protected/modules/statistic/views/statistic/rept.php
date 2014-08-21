
<?php
/* @var $data CArrayDataProvider */
/* @var $columns array */
$this->widget('bootstrap.widgets.TbGridView',array(/*Group*/
    'id' => 'rept-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $data,
    //'mergeColumns' => $merge_columns,
    'columns' => $columns,
));

