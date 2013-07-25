<p>
    Введіть код який абітурієнта отримав при реестрації у поле пошуку.
</p>
<?php
    if (Yii::app()->user->hasFlash("message")) {
        echo "<span style='color: red;'>".Yii::app()->user->getFlash("message")."</span><br>";
    }
 ?>
 <br>
<?php 
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'searchForm',
    'type' => 'search',
    'action' => Yii::app()->createUrl("Personspeciality/studupdate"),
    'method' => "get",
        ));
?>
<div class="input-prepend"><span class="add-on"><i class="icon-search"></i></span>
        <?php
        echo Chtml::textField("id", "", array('class' => 'span2'));
        ?>
</div>
<?php               $url = "'Personspeciality/studupdate/' +$('#id').val() ";
                    $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Редагувати',
                    'buttonType'=>'submit', 
                    'icon'=>'pencil',
                    //'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => null, // null, 'large', 'small' or 'mini'
                    'loadingText'=>'Зачекайте...',
                    'htmlOptions'=>array(
                                "style"=>"margin-top: 2px;",
                                //'class'=>"span12",
                                'onclick'=>"PSN.editStudpric(this,$url);"), 
                )); ?>
 <?php $this->endWidget(); ?> 

    <hr>  
    <div id="spec-modal-holder"></div>
