<?php


?>
<!--http://10.1.11.57:8080/request_report-1.0/journal?SpecialityID=  idOKR=  eduFormID=  date=-->
<!--http://10.1.11.57:8080/request_report-1.0/bachelor.jsp?PersonID=1&PersonSpecialityID=1&iframe=true&width=1024&height=600-->

<style>
  .btn.active, .btn:active {
    background-color: blue;
    color: white;
  }
  
  #dailystat{
    cursor: pointer;
  }
  #dailystat:hover{
    cursor: pointer;
    color: blue;
  }
  #fullstat{
    cursor: pointer;
  }
  #fullstat:hover{
    cursor: pointer;
    color: blue;
  }
  
</style>
<script>
  $(function (){
    $('#dailystat').click(function(){
      $('#dailystat_block').slideToggle();
    });
    $('#fullstat').click(function(){
      $('#fullstat_block').slideToggle();
    });
  });
</script>

<div class="row row-fluid">
<!-- Щоденна статистика заяв абітурієнтів за напрямками -->

<div class="well well-large span5">
  
  <h3 id="dailystat">Щоденна статистика заяв абітурієнтів за напрямками</h3>

  <div class="form" id="dailystat_block" style="display:none;">
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
      <div class="span12"></div>
      <div class="span6">
        <?php echo Chtml::label("ОКР", 'QualificationID'); ?>
        <?php
        echo CHtml::dropDownList(
                'QualificationID', 
                "", 
                array("1" => "Бакалавр", "3" => "Спеціаліст", "2" => "Магістр"), 
                array('empty' => '','class'=>'span12'));
        ?>
      </div>
      <div class='span4'>
        <?php echo CHtml::label("Дата", 'Date'); ?>
        <?php
        echo CHtml::textField(
                'Date', 
                date('d.m.Y'), 
                array('class' => 'span12 datepicker'));
        ?>

      </div>
      <div class="span10">
        <?php echo Chtml::label("Секретар", 'secname'); ?>
        <?php
        echo CHtml::dropDownList(
                'secname', 
                "С.В. Іваненко", 
                array(
                    "С.В. Іваненко" => "С.В. Іваненко", 
                    "О.М. Олійник" => "О.М. Олійник"), 
                array('empty' => '','class'=>'span12'));
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
</div>
<!-- ----------------------------------------------------------------------- -->


<!-- Детальна статистика заяв абітурієнтів за обраний інтервал -->
<div class="well well-large span6">
  <h3 id="fullstat">Детальна статистика заяв абітурієнтів за обраний інтервал</h3>

  <div class="form" id="fullstat_block" style="display:none;">
    <?php

    $act = Yii::app()->createUrl("statistic/stat/viewall");
    /* @var $form TbActiveForm */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'ratings',
        'enableAjaxValidation' => false,
        'method' => "GET",
        'action' => $act,
    ));
    ?>
    <div class="row-fluid">
      <?php
      $smodel= new Specialities();
      ?>
    <div class="span7">
  <?php echo $form->checkBoxListRow($smodel, 'modes', array(
          'budget'=>'На бюджет',
          'contract'=>'На контракт',
          'pv'=>'Вступ першочергово',
          'pzk'=>'Вступ поза конкурсом',
          'electro'=>'Електронні заявки',
          'originals'=>'Оригінали')
        ); 
  ?>
    </div>
    <div class="span5">
  <?php echo $form->checkBoxListRow($smodel, 'statuses', 
    Personrequeststatustypes::model()->getStatusList()
        ); 
  ?>
    </div>
    </div>
    <div class="row-fluid">
      <div class="span6">
        <?php echo Chtml::label("ОКР", 'QualificationID'); ?>
        <?php
        echo CHtml::dropDownList(
                'QualificationID', 
                "", 
                array("1" => "Бакалавр", "3" => "Спеціаліст", "2" => "Магістр"), 
                array('empty' => '',));
        ?>
      </div>
      <div class="span6">
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
      <div class='span6'>
        <?php echo CHtml::label("Від дати", 'DateFrom'); ?>
        <?php
        echo CHtml::textField(
                'DateFrom', 
                date('d.m.Y'), 
                array('class' => 'datepicker'));
        ?>

      </div>
      <div class='span6'>
        <?php echo CHtml::label("До дати", 'DateTo'); ?>
        <?php
        echo CHtml::textField(
                'DateTo', 
                date('d.m.Y'), 
                array('class' => 'datepicker'));
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
</div>
</div>
 <hr/>
<!-- ----------------------------------------------------------------------- -->

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
                  . 'font-size: 12pt;'
              )
          )); 
?>

<script>
    $(document).ready(function(){
        
       $(".datepicker").datepicker({'format':"dd.mm.yyyy"});
    });
</script>