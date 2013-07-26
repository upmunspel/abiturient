    <?php
/* @var $this AllcountsController */
/* @var $model AllCounts */

    function get_SepcialityID($sid, $form){
        $ids = explode(",",$sid);
        foreach ($ids as $val){
            $var = explode('_',$val);
            $_id = $var[0];
            $_form = 1;
            if (count($var)>1){
                $_form = $var[1];
            }
            if ($form == $_form){
                return $_id;
            }
        }
        return 0;
    }
    
    function get_QualificationID($okr){
        switch ($okr){
            case '6':
                return 1;
            case '7':
                return 3;
            case '8':
                return 2;
        }
        return 0;
    }
    
?>
<?php Yii::app()->bootstrap->register(); ?>
<center><h2>Статистика вступу абітуріентів Запорізького національного університету <?php echo date("Y"); ?></h2></center>    
<?php 



if (!isset($_GET['okr']) || !is_numeric($_GET['okr'])){
    $data = $model->search();
    array_push($columns,array('name'=>'medals'));
}


if (isset($_GET['okr']) && $_GET['okr']==6){
    $data = $model->searchBachelors();
}

if (isset($_GET['okr']) && $_GET['okr']==7){
    $data = $model->searchSpecialists();
}

if (isset($_GET['okr']) && $_GET['okr']==8){
    $data = $model->searchMagisters();
}

$mode = $_GET['mode'];
if (!$mode){
    $mode = 0;
}
switch ($mode){
    case 0:
    $columns = array(
        array('name'=>'Fakultet', 'htmlOptions'=>array('style'=>"width:150px;")),
        array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:250px;")),
        array('name'=>'dnevn', 'htmlOptions'=>array('style'=>"width:100px;"),
              'value'=>'$data->dnevn'),
        array('name'=>'dnevn_budget', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'dnevn_contract', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'dnevn_pv', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'dnevn_pzk', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'dnevn_originals', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'dnevn_electro', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'zaoch', 'htmlOptions'=>array('style'=>"width:100px;border-left:4px solid green;")),
        array('name'=>'zaoch_budget', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'zaoch_contract', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'zaoch_pv', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'zaoch_pzk', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'zaoch_originals', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'zaoch_electro', 'htmlOptions'=>array('style'=>"width:100px;")),
    ); break;
    case 1:
    $columns = array(
        array('name'=>'Fakultet', 'htmlOptions'=>array('style'=>"width:150px;")),
        array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:250px;")),
        array('name'=>'dnevn', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'zaoch', 'htmlOptions'=>array('style'=>"width:100px;border-left:4px solid green;")),
    ); break;
    case 2:    
    $columns = array(
        array('name'=>'Fakultet', 'htmlOptions'=>array('style'=>"width:150px;")),
        array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:250px;")),
        array('name'=>'dnevn', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'dnevn_budget', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'dnevn_contract', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'zaoch', 'htmlOptions'=>array('style'=>"width:100px;border-left:4px solid green;")),
        array('name'=>'zaoch_budget', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'zaoch_contract', 'htmlOptions'=>array('style'=>"width:100px;")),
    ); break;
    case 3:
    $columns = array(
        array('name'=>'Fakultet', 'htmlOptions'=>array('style'=>"width:150px;")),
        array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:250px;")),
        array('name'=>'dnevn', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'dnevn_pv', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'dnevn_pzk', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'zaoch', 'htmlOptions'=>array('style'=>"width:100px;border-left:4px solid green;")),
        array('name'=>'zaoch_pv', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'zaoch_pzk', 'htmlOptions'=>array('style'=>"width:100px;")),
    ); break;
    case 4:
    $columns = array(
        array('name'=>'Fakultet', 'htmlOptions'=>array('style'=>"width:150px;")),
        array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:250px;")),
        array('name'=>'dnevn', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'dnevn_electro', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'zaoch', 'htmlOptions'=>array('style'=>"width:100px;border-left:4px solid green;")),
        array('name'=>'zaoch_electro', 'htmlOptions'=>array('style'=>"width:100px;")),
    ); break;
    case 5:
    $columns = array(
        array('name'=>'Fakultet', 'htmlOptions'=>array('style'=>"width:150px;")),
        array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:250px;")),
        array('name'=>'medals', 'htmlOptions'=>array('style'=>"width:100px;"))
    ); break;
    case 6:
    $columns = array(
        array('name'=>'Fakultet', 'htmlOptions'=>array('style'=>"width:150px;")),
        array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:250px;")),
        array('name'=>'dnevn', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'dnevn_originals', 'htmlOptions'=>array('style'=>"width:100px;")),
        array('name'=>'zaoch', 'htmlOptions'=>array('style'=>"width:100px;border-left:4px solid green;")),
        array('name'=>'zaoch_originals', 'htmlOptions'=>array('style'=>"width:100px;")),
    ); break;
        
}

$this->widget('bootstrap.widgets.TbGroupGridView', array(
'id'=>'all-counts-view-grid',
    'type'=>'striped bordered condensed',
'dataProvider'=>$data,
//'rowCssClassExpression'=>'empty($data->SpecEdboID) && empty($data->PersonEdboID) ?"row-red":"row-green"',
//'filter'=>$model,
'mergeColumns' => array('Fakultet'),
'columns'=>$columns,

)); ?>







