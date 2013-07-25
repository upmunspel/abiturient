<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs', // 'tabs' or 'pills'
    'tabs'=>array(
               
                array(  'label'=>'Cтуденти - контрактники', 
                        'content'=>$this->renderPartial("tabs/_studprice",array('model'=>$model),true), 
                        'active'=>true 
                        ),
                array(  'label'=>'Ціни на навчання', 
                        'content'=>$this->renderPartial("tabs/_price",array('model'),true), 
                        'active'=>false 
                        ),
    ),
)); ?>
