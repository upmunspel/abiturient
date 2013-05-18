<?php
/* @var $this Sitecontroller */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';

?>
<?php
/* @var $this Sitecontroller */

$this->pageTitle=Yii::app()->name;
?>

<div class="hero-unit">
<div class="row">
<div style="border:none; margin:5px;">
    <div style="border:none; margin:5px;">Контактна особа <b>Іваненко Станіслав Валентинович.</b></div>    <div style="border:none; margin:5px;">Міський телефон<b>+38(061)764-67-53,+38(061)764-18-75</b> </div>        <div style="border:none; margin:5px;">Внутрішній телефон<b>12-68 </b> </div>    <div style="border:none; margin:5px;">Адреса <b>Корпус 2, #115 </b></div>            </div>
</div>
<br/>
<div class="row">
  
      <?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Детальніше',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    )); ?>
  

</div>

</div>
