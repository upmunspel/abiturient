<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs', // 'tabs' or 'pills'

    'tabs'=>array(
               
                array(  'label'=>'Сертифікати ЗНО', 
                        'content'=>$this->renderPartial("tabs/_zno",array("models"=>$model->znos, 'personid'=>$model->idPerson),true), 
                        'active'=>true, 
                        'id'=>"znos"),
                array(  'label'=>'Пільги', 
                        'content'=>$this->renderPartial("tabs/_benefits",array("models"=>$model->benefits, 'personid'=>$model->idPerson),true), 
                        'active'=>false, 
                        'id'=>"benefits"),
                array(  'label'=>'Спеціальності', 
                        'content'=>$this->renderPartial("tabs/_spec",array("models"=>$model->specs, 'personid'=>$model->idPerson),true), 
                        'active'=>false, 
                        'id'=>"specs"),
             
                array(  'label'=>'Документи', 
                        'content'=>$this->renderPartial("tabs/_doc",array('personid'=>$model->idPerson),true), 
                        'active'=>false, 
                        'id'=>"docs"),
    ),
)); ?>

<script type="text/javascript">
    function refreshDocuments(){
         $.ajax({
            'url': '<?php echo Yii::app()->createUrl("documents/refresh",array("id"=>$model->idPerson)); ?>',
            'async': false,
            'type':'POST',
            success: function (data) { $("#docs").html(data); }
            });
    }    
    function refreshZnos(){
      $.ajax({
            'url': '<?php echo Yii::app()->createUrl("documents/refreshzno",array("id"=>$model->idPerson)); ?>',
            'async': false,
            'type':'POST',
            success: function (data) { $("#znos").html(data); }
            });
       
    }
    function refreshBenefits(){
      $.ajax({
            'url': '<?php echo Yii::app()->createUrl("personbenefits/refresh",array("id"=>$model->idPerson)); ?>',
            'async': false,
            'type':'POST',
            success: function (data) { $("#benefits").html(data); }
            });
       
    }
    
</script>
