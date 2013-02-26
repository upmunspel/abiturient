<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs', // 'tabs' or 'pills'

    'tabs'=>array(
                array(  'label'=>'Пільги', 
                        'content'=>$this->renderPartial("tabs/_benefits",array("models"=>$model->benefits, 'personid'=>$model->idPerson),true), 
                        'active'=>true, 
                        'id'=>"benefits"),
                array(  'label'=>'Сертифікати ЗНО', 
                        'content'=>$this->renderPartial("tabs/_zno",array("models"=>null, 'personid'=>$model->idPerson),true), 
                        'active'=>false, 
                        'id'=>"znos"),
    ),
)); ?>