<?php


?>
<!--http://10.1.11.57:8080/request_report-1.0/journal?SpecialityID=  idOKR=  eduFormID=  date=-->
<!--http://10.1.11.57:8080/request_report-1.0/bachelor.jsp?PersonID=1&PersonSpecialityID=1&iframe=true&width=1024&height=600-->


<!-- Щоденна статистика заяв абітурієнтів за напрямками -->
<h3>Щоденна статистика заяв абітурієнтів за напрямками</h3>

<div class="form">
  <?php
  $model = Yii::app()->user->getUserModel();
  if (empty($model->syspk) || empty($model->syspk->printIP)) {
    throw new Exception("Необхідно визначити адресу серверу друку документів!");
  }
  $ip = $model->syspk->printIP;
  $act = Yii::app()->createUrl("statistic/stat/view");
  $form = $this->beginWidget('CActiveForm', array(
      'id' => 'zno-form-modal',
      'enableAjaxValidation' => false,
      'method' => "GET",
      'action' => $act,
  ));
  ?>
  <div class="row-fluid">
    <div class="span3">
      <?php echo Chtml::label("Освітньо-кваліфікаційний рівень", 'QualificationID'); ?>
      <?php
      echo CHtml::dropDownList(
              'QualificationID', 
              "", 
              array("1" => "Бакалавр", "3" => "Спеціаліст", "2" => "Магістр"), 
              array('empty' => '',));
      ?>
    </div>
    <div class='span3'>
      <?php echo CHtml::label("Дата", 'Date'); ?>
      <?php
      echo CHtml::textField(
              'Date', 
              date('d.m.Y'), 
              array('class' => 'datepicker'));
      ?>

    </div>
    <div class="span4">
      <?php echo Chtml::label("Секретар", 'secname'); ?>
      <?php
      echo CHtml::dropDownList(
              'secname', 
              "С.В. Іваненко", 
              array(
                  "С.В. Іваненко" => "С.В. Іваненко", 
                  "О.М. Олійник" => "О.М. Олійник"), 
              array('empty' => '',));
      ?>

    </div>

  </div>
 
  <div class="row-fluid">
    <?php
    $this->widget("bootstrap.widgets.TbButton", array(
        'buttonType' => 'submit',
        'type' => 'primary',
        "size" => "large",
        'label' => 'Показати',
    ));
    ?>
  </div>
<?php $this->endWidget(); ?>
</div>
 <hr/>
<!-- ----------------------------------------------------------------------- -->
<br/>

<?php
      Yii::app()->user->setFlash('warning', 'Модуль для статистики та звітів допрацьовується.');
      $this->widget('bootstrap.widgets.TbAlert', array(
              'fade'=>true, // use transitions?
              'block'=>true,
              'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
              'alerts'=>array( // configurations per alert type
                  'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
              ),
              'htmlOptions' => array(
                  'style' =>''
                  . 'font-family: "Tahoma";'
                  . 'font-size: 8pt;'
              )
          )); 
?>

<script>
    $(document).ready(function(){
        
       $(".datepicker").datepicker({'format':"dd.mm.yyyy"});
    });
</script>