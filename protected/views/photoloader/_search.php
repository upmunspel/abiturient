<h1>Знайти абітуріента за кодом</h1>
<p>
    Введіть код який абітуріента отримав при реестрації у поле пошуку.
</p>
<br>
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'searchForm',
    'type' => 'search',
    'action' => Yii::app()->createUrl("photoloader/update"),
    'method' => "get",
        ));
?>
<div class="input-prepend"><span class="add-on"><i class="icon-search"></i></span>
        <?php
        echo Chtml::textField("id", "", array('class' => 'span2'));
        ?>
</div>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Знайти', 'htmlOptions'=>array('name'=>'','value'=>''))); ?>
<?php $this->endWidget(); ?> 