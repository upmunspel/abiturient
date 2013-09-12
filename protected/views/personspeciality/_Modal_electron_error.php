<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
            'id'=>'spec_electronModal',
            'htmlOptions'=>array('style'=>'width: 1200px; margin-left: -600px;'),
            )
        ); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4><?php echo "Error"?> <IMG alt="Помилка 403" src="..//images/error403.jpg" width="25" title="403"></h4>
</div>
 
<div class="modal-body" id="spec-modal-body">
    <div align="center" style="color: red"><h1>Помилка 403, доступ заборонений!</h1>	
        <H1><IMG alt="Помилка 403" src="..//images/error_403.jpg" width="25%" title="403"></H1>
	</DIV>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Okay',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div> 
<?php $this->endWidget(); ?>