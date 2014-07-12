<?php

Yii::app()->clientScript->registerPackage('select2');
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
  #reportconstructor{
    cursor: pointer;
  }
  #reportconstructor:hover{
    cursor: pointer;
    color: blue;
  }
  .select2-choices {
    min-height: 350px;
    max-height: 350px;
    overflow-y: auto;
  }
  ul.select2-results {
    max-height: 350px;
  }
  
  .right10{
    text-align: right !important; 
    padding-right: 10px;
    font-size: 9pt; 
    font-family: Tahoma;
  }
  
  .acondvals option{
    color: blue;
    font-size: 8pt !important;
    font-family: Tahoma !important;
  }
  
  .condition_remove{
    color: red;
    font-size: 7pt;
  }
  .condition_remove:hover{
    color: red;
    cursor:pointer;
    font-size: 7pt;
  }
  .select2-result-label{
      font-size: 8pt !important;
      font-family: Tahoma !important;
  }
  .select2-chosen{
      font-size: 7pt !important;
      font-family: Tahoma !important;
      color: blue;
  }
  .rept-checkbox{
    width: 25px !important;
    height: 25px !important;
  }
  
</style>
<script>
  
  window.fieldsTextVals = [];
  window.fields = [];
  window.id_num = 0;
  
  function in_array(needle, haystack) {
      for(var i in haystack) {
          if(haystack[i] == needle) return true;
      }
      return false;
  }
  
  function FieldsEvent(){
    var fieldsVal = $('#fields').val();
    var dump = "";
    window.fieldsTextVals = [];
    $('.select2-search-choice').each(function(){
      window.fieldsTextVals.push($(this).children('div').text());
    });
    window.fields = fieldsVal.toString().split ( ',' );
    //console.log(fields);
    //console.log(fieldsTextVals);    
    for (var i = 0; i < fields.length; i++){
      var fnmelement = document.getElementById('field_name-'+window.fields[i]);
      if (fnmelement){
        //dump += window.fields[i] + " : " + window.fieldsTextVals[i] + ';; ';
        $('#field_name-'+window.fields[i]).html(window.fieldsTextVals[i]);
      }
    }
    //$('#selectx').html(dump);
    $('#selectx').html('<center>Умови вибірки</center>');
    for (var i = 0; (i < 30); i++){
      var rmelem = document.getElementById('cond_remove-'+i);
      var element = document.getElementById('condition-container-' + i);
      if (window.fields.length === 1 && window.fields[0] === "" && element){
          var condval = $('#condval-'+i).val();
          if (condval == 0 || condval == 4){
            $('#condition-container-' + i).hide();
          }
          continue;
      }
      if (element && in_array(i,window.fields)){
        if (!$('#condition-container-' + i).is(':visible') ){
          $('#condition-container-' + i).slideDown();
        }
        if (rmelem){
          $('#cond_remove-'+i).remove();
        }
      }
      if (element && !in_array(i,window.fields)){
        if ($('#condition-container-' + i).is(':visible') && !rmelem && 
                $('#cond-'+i).val() != 0){
          $('#condval_block-' + i).after(
            "<div class='span1 condition_remove' id='cond_remove-"+i+"'"
            +" title='Видалити умову вибірки'"
            +" onclick='ConditionTrashClick("+i+")'>"
            +"   <i class='icon-trash'></i>"
            +"</div>"        
          );
        }
        if ($('#condition-container-' + i).is(':visible') && !rmelem && 
                $('#cond-'+i).val() == 0){
          $('#condition-container-' + i).hide();
        }
      }
    }
  }
  
  /**
  * Функція виконує те, що викликається при події натиснення на малюнок корзини.
  * @returns {undefined}   
  * */
  function ConditionTrashClick(idnum){
      var element,anelement,xelement,kelement;
      element = document.getElementById("condval-"+idnum);
      anelement = document.getElementById("acondval-"+idnum);
      xelement = document.getElementById("xcondval-"+idnum);
      kelement = document.getElementById("s2id_xcondval-"+idnum);
      if (anelement){
        $("#acondval-"+idnum).remove();
        $("#condval-"+idnum).show();
      }
      if (xelement){
        $("#condval-"+idnum).show();
        $("#xcondval-"+idnum).hide();
        $("#select2-chosen-"+idnum).text('');
        $("#xcondval-"+idnum).val('');
      }
      if (element){
        $("#condition-container-"+idnum).hide();
        $("#cond_remove-"+idnum).remove();
        $('#condval-'+idnum).attr('disabled','disabled');
        $('#condval-'+idnum).val("");
        $('#cond-'+idnum).attr('value','0');
      }
      if (kelement){
          $("#s2id_xcondval-"+idnum).hide();
      }
  }
  
  function Textfield2Selectbox(textfield_id,ajax_url,term){
    //якщо треба вибрати конкретне значення ***,
    //тоді створюємо новий елемент (вип. список) і ховаємо текстове поле
    $('#'+textfield_id).after(
      "<select"
      +" id='acondval-"+window.id_num+"'"
      +" name='acondval["+window.id_num+"]'"
      +" class='span12 acondvals'>"
      +"</select>"
    );
    //ховаємо основний тип поля вводу
    $('#'+textfield_id).hide();
//    alert(textfield_id);
//    alert(ajax_url);
//    alert(term);
    //завантаження списку *** асинхронно
    $.post(
      ajax_url,
      {'term' : term},
      function(jdata){
        var sel = $("#acondval-"+window.id_num),n;
        sel.empty();
        data = jQuery.parseJSON(jdata);
        if (typeof(data.count) !== 'undefined'){
            n = data.count;
        } else { n = data.length; }
        for (var i = 0; i < n; i++){
          var id,val;
          if (typeof(data[i].spec_id) === 'undefined'){
              id = data[i].id;
          } else {
              id = data[i].spec_id;
          }
          if (typeof(data[i].value) === 'undefined'){
              val = data[i].text;
          } else {
              val = data[i].value;
          }
          sel.append('<option value="'+id+'"> '+val+' </option>');
        }
      } //end function (data)
    ); //end post
  }
  
  $(function (){
    $('#dailystat').click(function(){
      $('#dailystat_block').slideToggle();
    });
    $('#fullstat').click(function(){
      $('#fullstat_block').slideToggle();
    });
    $('#reportconstructor').click(function(){
      $('#report_block').slideToggle();
    });
    
    $("#fields").select2({
        placeholder: "Починайте вводити",
        multiple: true,
        quietMillis: 200,
        //minimumInputLength: 3,
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: "<?php echo Yii::app()->createUrl("/statistic/stat/qdata"); ?>",
            dataType: 'json',
            data: function(term, page) {
                return {
                    q: term // search term
                    //page_limit: 10,
                    //page: page
                };
            },
            results: function(data, page) {
                return {results: data};
            }
        }
    });
    $('#fields').click(function(){
      FieldsEvent();
    });
    $('#fields').keyup(function(){
      FieldsEvent();
    });
    
    $("#xcondval-2").select2({
        placeholder: "Починайте вводити адресу КОАТУУ",
        multiple: false,
        //quietMillis: 50000000, //--воно, гамно, не працює 
        minimumInputLength: 3,
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: "<?php echo Yii::app()->createUrl("/statistic/stat/koatuus"); ?>",
            dataType: 'json',
            data: function(term, page) {
                return {
                    q: term // search term
                    //page_limit: 10,
                    //page: page
                };
            },
            results: function(data, page) {
                return {results: data};
            }
        }
    });

    
    /**
    * Подія зміни значення поля, що відповідає за тип порівняння .
    * Вставляє або прибирає тип поля вводу для вибірки.
    * @returns {undefined}     
    * */
    $('.conditioner').change(function(){
      var id = $(this).attr('id');
      var value = $(this).val();
      var id_parts;
      var id_index_field,fieldName;
      var anelement,xelement;
      var is_date;
      id_parts = id.toString().split ( '-' );
      
      window.id_num = id_parts[1];//відокремили ід. номер стовця-атрибута
      id_index_field = window.fields.indexOf(window.id_num); //.. і його індекс
      
      $('#condval-'+window.id_num).attr('disabled',false);
      anelement = document.getElementById("acondval-"+window.id_num);
      xelement = document.getElementById("xcondval-"+window.id_num);
      fieldName = $('#field_name-'+window.id_num).text();
      
      
      is_date = (window.id_num == 13 || window.id_num == 1);
      is_checkbox = ((window.id_num >=9 && window.id_num <=11) || 
              (window.id_num >=21 && window.id_num <=22));
      
      if (fieldName === 'Спеціальність' && (value == 1) &&
            (!anelement)) {
        Textfield2Selectbox("condval-"+window.id_num,
        '<?php echo Yii::app()->CreateUrl('/rating/specialities/autocomplete'); ?>',
        '.');
      } //end if
      
      if (fieldName === 'Іноземна мова' && (value == 1) &&
            (!anelement)) {
        Textfield2Selectbox("condval-"+window.id_num,
        '<?php echo Yii::app()->CreateUrl('/statistic/stat/languages'); ?>',
        '.');
      } //end if
      
      if (fieldName === 'Статус заявки' && (value == 1) &&
            (!anelement)) {
        Textfield2Selectbox("condval-"+window.id_num,
        '<?php echo Yii::app()->CreateUrl('/statistic/stat/reqstatuses'); ?>',
        '.');
      } //end if
      
      if (fieldName === 'Предмет ЗНО' && (value == 1) &&
            (!anelement)) {
        Textfield2Selectbox("condval-"+window.id_num,
        '<?php echo Yii::app()->CreateUrl('/statistic/stat/zno'); ?>',
        '.');
      } //end if
      
      if (fieldName === 'Тип документа' && (value == 1) &&
            (!anelement)) {
        Textfield2Selectbox("condval-"+window.id_num,
        '<?php echo Yii::app()->CreateUrl('/statistic/stat/doctypes'); ?>',
        '.');
      } //end if
      
      if (fieldName === 'Тип пільги' && (value == 1) &&
            (!anelement)) {
        Textfield2Selectbox("condval-"+window.id_num,
        '<?php echo Yii::app()->CreateUrl('/statistic/stat/benefitgroups'); ?>',
        '.');
      } //end if

      if (fieldName === 'Форма навчання' && (value == 1) &&
            (!anelement)) {
        Textfield2Selectbox("condval-"+window.id_num,
        '<?php echo Yii::app()->CreateUrl('/statistic/stat/eduforms'); ?>',
        '.');
      } //end if
      
      if (fieldName === 'ОКР' && (value == 1) &&
            (!anelement)) {
        Textfield2Selectbox("condval-"+window.id_num,
        '<?php echo Yii::app()->CreateUrl('/statistic/stat/okr'); ?>',
        '.');
      } //end if
      
      if (fieldName === 'Країна громадянства' && (value == 1) &&
            (!anelement)) {
        Textfield2Selectbox("condval-"+window.id_num,
        '<?php echo Yii::app()->CreateUrl('/statistic/stat/countries'); ?>',
        '.');
      } //end if
      
      if (fieldName === 'Закінчено навчальний заклад' && (value == 1) &&
            (!anelement)) {
        Textfield2Selectbox("condval-"+window.id_num,
        '<?php echo Yii::app()->CreateUrl('/statistic/stat/schools'); ?>',
        '.');
      } //end if
      
      if (fieldName === 'Адреса КОАТУУ' && (value == 1) &&
            (xelement)) {
        //якщо треба вибрати конкретне значення КОАТУУ,
        //тоді створюємо новий елемент (вип. список2) і ховаємо текстове поле
        $('#s2id_xcondval-'+window.id_num).show();
        $('#xcondval-'+window.id_num).show();
        $('#xcondval-'+window.id_num).val('');
        $('#condval-'+window.id_num).val('');
        $('#condval-'+window.id_num).hide();
        
      } //end if
      if (fieldName === 'Адреса КОАТУУ' && (value != 1) &&
            (xelement)) {
        $('#s2id_xcondval-'+window.id_num).hide();
        $("#select2-chosen-"+window.id_num).text('');
        $('#xcondval-'+window.id_num).val('');
        $('#condval-'+window.id_num).val('');
        $('#condval-'+window.id_num).show();
      } //end if
      
      if ((fieldName === 'Дата створення заявки' || fieldName === 'Дата народження') 
              && (value == 5) && (xelement)) {
        $('#condval-'+window.id_num).attr('class','span6');
        $('#xcondval-'+window.id_num).show();
        $('#xcondval-'+window.id_num).val('');
      }
      if ((fieldName === 'Дата створення заявки' || fieldName === 'Дата народження') 
              && (value != 5) && (xelement)) {
        $('#condval-'+window.id_num).attr('class','span12');
        $('#xcondval-'+window.id_num).hide();
        $('#xcondval-'+window.id_num).val('');
        $('#condval-'+window.id_num).val('');
      }
      
      if ((value < 5) && (value != 1) &&
              (anelement)) {
        //повернути стандартне текстове поле і видалити специфічне для даного атрибуту
        $('#acondval-'+window.id_num).remove();
        $('#condval-'+window.id_num).show();
        $('#condval-'+window.id_num).attr('class','span12' + ((is_date)? ' datepicker':''));
      }
      
      if ((value == 0 || value == 4)){ //БУДЬ-ЯКЕ АБО ПОРОЖНЄ ЗНАЧЕННЯ
        $('#condval-'+window.id_num).attr('disabled','disabled');
        $('#condval-'+window.id_num).val('');
        if (is_checkbox){
          $('#condval-'+window.id_num).attr('checked',false);
        }
      }
    });
    

  });
  
</script>

<div class="row-fluid">
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

    $statdetail_act = Yii::app()->createUrl("statistic/stat/viewall");
    /* @var $statdetail_form TbActiveForm */
    $statdetail_form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'ratings',
        'enableAjaxValidation' => false,
        'method' => "GET",
        'action' => $statdetail_act,
    ));
    ?>
    <div class="row-fluid">
      <?php
      $smodel= new Specialities();
      ?>
    <div class="span7">
  <?php echo $statdetail_form->checkBoxListRow($smodel, 'modes', array(
          'budget'=>'На бюджет',
          'contract'=>'На контракт',
          'pv'=>'Вступ першочергово',
          'pzk'=>'Вступ поза конкурсом',
          'electro'=>'Електронні заявки',
          'originals'=>'Оригінали',
          'Donetsk' => "Донецька обл.",
          'Lugansk' => "Луганська обл.",
          'Crimea' => "Крим",
            )
        ); 
  ?>
    </div>
    <div class="span5">
  <?php echo $statdetail_form->checkBoxListRow($smodel, 'statuses', 
    Personrequeststatustypes::model()->getStatusList()
        ); 
  ?>
    </div>
    </div>
    <div class="span12 row-fluid">
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
      <div class="span6">
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
    <div class="span12 row-fluid">
      <div class='span6'>
        <?php echo CHtml::label("Від дати", 'DateFrom'); ?>
        <?php
        echo CHtml::textField(
                'DateFrom', 
                date('d.m.Y'), 
                array('class' => 'datepicker span12'));
        ?>

      </div>
      <div class='span6'>
        <?php echo CHtml::label("До дати", 'DateTo'); ?>
        <?php
        echo CHtml::textField(
                'DateTo', 
                date('d.m.Y'), 
                array('class' => 'datepicker span12'));
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
<!-- ----------------------------------------------------------------------- -->

<!-- Конструктор звітів -->
<div class="row-fluid" >
  <div class="well well-large span11">
    <h3 id="reportconstructor">Конструктор звітів</h3>
  <?php
    $rept_act = Yii::app()->createUrl("statistic/rept/index");
    /* @var $statdetail_form TbActiveForm */
    $rept_form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'detail-reports',
        'enableAjaxValidation' => false,
        'method' => "GET",
        'action' => $rept_act,
        'htmlOptions' => array(
          'target' => '_blank',
        ),
    ));
  ?>
    <div id="report_block" style="display:none" class='span12'>
      <div class="span12" >
        <?php echo CHtml::label('Виберіть поля для виведеня у звіті або для формування умови вибірки',
                'fields',array('class'=>'span12')); ?>
      </div>
      <div class='span12'>
        <input type='search' name="fields" id="fields" class="span11" />
      </div>
      <div id='selectx'></div>
      <?php for ($i = 0; $i < 25; $i++){ 
          $is_date = ($i == 13 || $i == 1);
          $is_checkbox = (($i >= 9 && $i <= 11) || ($i >= 21 && $i <= 22));
          $is_koatuu = ($i == 2);
          ?>
        <div id="condition-container-<?php echo $i; ?>" style="display:none;" class="span12">
          <hr class="span11" style="margin:5px 0px;min-height: 3px;"/>
          <div class="span2 right10" id="field_name-<?php echo $i; ?>" ></div>
          <div class='span3'>
          <select name="cond[<?php echo $i; ?>]" id="cond-<?php echo $i; ?>" class="span12 conditioner">
            <option value="0">Будь-яке значення</option>
            <option value="1">У точності, як </option>
            <?php if (!$is_checkbox && !$is_date) { ?>
              <option value="2">Містить </option>
              <option value="3">Не містить </option>
            <?php } ?>
            <option value="4">Порожнє значення</option>
            <?php if ($is_date){ ?>
              <option value="5">Проміжок</option>
            <?php } ?>
            
          </select>
          </div>
          <div class='span5' id='condval_block-<?php echo $i; ?>'>
          <?php if (!$is_checkbox) { ?>
            <input type="text" 
                 id="condval-<?php echo $i; ?>" 
                 name="condval[<?php echo $i; ?>]" 
                 class="span12 <?php if ($is_date){ echo 'datepicker'; }?> "
                 disabled="disabled" />
            <?php if ($is_date){ ?>
            <input type="text" 
                 id="xcondval-<?php echo $i; ?>" 
                 name="acondval[<?php echo $i; ?>]" 
                 class="span6 datepicker"
                 style="display:none;"
                  />
            <?php } ?>
            <?php if ($is_koatuu){ ?>
            <input type="text" 
                 id="xcondval-<?php echo $i; ?>" 
                 name="acondval[<?php echo $i; ?>]" 
                 class="span12"
                 style="display:none;"
                  />
            <?php } ?>
            
          <?php } else { ?>
                <!-- Якщо поле має лише відмічатись як "так\ні" -->
                <?php echo CHtml::checkBox('condval['.$i.']', 
                        false, 
                        array('id'=>'condval-'.$i, 'disabled' => 'disabled', 'class' => 'rept-checkbox',
                            'value' => "1")); ?>
            
          <?php } ?>
          </div>
        </div>
      <?php } ?>
        <div class="span12">
          <hr class="span11" style="margin:5px 0px;min-height: 10px;"/>
          <?php
          $this->widget("bootstrap.widgets.TbButton", array(
              'buttonType' => 'submit',
              'type' => 'primary',
              "size" => "large",
              'label' => 'Створити звіт',
              'id' => 'CreteReport',
          ));
          ?>
          <?php
          $this->widget("bootstrap.widgets.TbButton", array(
              'buttonType' => 'submit',
              'type' => 'success',
              "size" => "large",
              'label' => 'Створити звіт у форматі WEB-Excel',
              'id' => 'CreteExcelReport',
              'htmlOptions' => array(
                'name' => 'excel',
                'value' => 'excel'
              ),
          ));
          ?>
          <?php $this->endWidget(); ?>
        </div>
    </div>
  </div>
</div>
<!-- ----------------------------------------------------------------------- -->
<?php if (Yii::app()->user->checkAccess('showProperties')){ ?>
<div class="row-fluid" >
  <div class="well well-large span11">
    <h3>Контактні дані абітурієнтів</h3>
    <ul>
    <?php 
      foreach (Facultets::model()->findAll('1 ORDER BY FacultetFullName') as $faculty){
        echo '<li>'.CHtml::link($faculty->FacultetFullName,
                Yii::app()->CreateUrl("statistic/stat/contacts?FacultyID=".$faculty->idFacultet));
        echo '</li>';
      }
    ?>
    </ul>
  </div>
</div>
<?php } ?>
<!-- ----------------------------------------------------------------------- -->
 <hr/>

<!-- Статистика заяв на старші курси -->
<div class="row-fluid">
<div class="well well-large span11">
  <h3 id="elderstat">Статистика заяв на старші курси</h3>

  <div class="form" id="fullstat_block" >
    <?php

    $statdetail_act = Yii::app()->createUrl("statistic/stat/statgraduated");
    /* @var $statdetail_form TbActiveForm */
    $statdetail_form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'statgr',
        'enableAjaxValidation' => false,
        'method' => "GET",
        'action' => $statdetail_act,
    ));
    ?>
    <div class="row-fluid">
      <div class="span4">
        <?php echo Chtml::label("ОКР", 'QualificationID'); ?>
        <?php
        echo CHtml::dropDownList(
                'QualificationID', 
                "", 
                array("3" => "Спеціаліст", "2" => "Магістр"), 
                array('empty' => '','class'=>'span12'));
        ?>
      </div>

      <div class='span4'>
        <?php echo CHtml::label("Від дати", 'DateFrom'); ?>
        <?php
        echo CHtml::textField(
                'DateFrom', 
                date('d.m.Y'), 
                array('class' => 'datepicker span12'));
        ?>

      </div>
      <div class='span4'>
        <?php echo CHtml::label("До дати", 'DateTo'); ?>
        <?php
        echo CHtml::textField(
                'DateTo', 
                date('d.m.Y'), 
                array('class' => 'datepicker span12'));
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

<!-- ----------------------------------------------------------------------- -->

<script>
    $(document).ready(function(){
        
       $(".datepicker").datepicker({'format':"dd.mm.yyyy"});
    });
</script>