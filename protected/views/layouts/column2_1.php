<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
     <div class="span12">
        
            <div class="well" style="padding: 8px 0; position: fixed; width: 270px;">
                
           <?php
            foreach ($this->menu as $obj) {
//               $this->widget('bootstrap.widgets.TbButton', array(
//                   'label'=>1,//$obj["label"],
//                   'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
////                   'size'=>'large', // null, 'large', 'small' or 'mini'
////                   'url'=>$obj["url"], 
////                   'icon'=>$obj['icon'],
//                   
//               )); 
                
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