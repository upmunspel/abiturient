<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
            'id'=>'docModal',
            'htmlOptions'=>array('style'=>'width: 1000px; margin-left: -500px;'),
            )
        ); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4><?php echo $model->isNewRecord ? "Новий документ":"Редагування документу"; ?></h4>
    Поля з <span class ="required">*</span> необхідно заповнити.
</div>
 
<div class="modal-body" id="doc-modal-body">
    <?php $this->renderPartial("_formfull",array('model'=>$model)); ?>
</div>
 
<div class="modal-footer">
       
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
