<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
     <div class="span12">
        
            <div class="well" style='padding: 0px;'>
                
           <?php
            foreach ($this->menu as $obj) {
               $this->widget('bootstrap.widgets.TbButton', array(
                   'label'=>$obj["label"],
                   'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                   'size'=>'large', // null, 'large', 'small' or 'mini'
                   'url'=>$obj["url"], 
                   'icon'=>$obj['icon'],
                   'htmlOptions'=>array('style'=>'margin: 5px;'),
                   
                   
               )); 
                
            }       

	
           
            ?>
            </div>
      
    </div>
    <div class="span12">
        <div id="content">
     
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
   
</div>
<?php $this->endContent(); ?>