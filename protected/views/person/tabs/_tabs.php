<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs', // 'tabs' or 'pills'

    'tabs'=>array(
               
                array(  'label'=>'Сертифікати ЗНО', 
                        'content'=>$this->renderPartial("tabs/_zno",array("models"=>$model->znos, 'personid'=>$model->idPerson),true), 
                        'active'=>true, 
                        'id'=>"znos"),
                array(  'label'=>'Спеціальності', 
                        'content'=>$this->renderPartial("tabs/_spec",array("models"=>$model->specs, 'personid'=>$model->idPerson),true), 
                        'active'=>false, 
                        'id'=>"specs"),
                array(  'label'=>'Пільги', 
                        'content'=>$this->renderPartial("tabs/_benefits",array("models"=>$model->benefits, 'personid'=>$model->idPerson),true), 
                        'active'=>false, 
                        'id'=>"benefits"),
                array(  'label'=>'Документи', 
                        'content'=>$this->renderPartial("tabs/_doc",array("models"=>$model->docs, 'personid'=>$model->idPerson),true), 
                        'active'=>false, 
                        'id'=>"docs"),
    ),
)); ?>