<?php
/* @var $this EdeboController */
/* @var $model EdeboStatusChange */
$this->pageTitle = "Робота з сервісами ЄДЕБО";
?>

<?php
$this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
    'heading' => 'Робота з сервісами ЄДЕБО',
));
?>
<?php $this->endWidget(); ?>
<div class="well">

    <?php
    //$model = new EdeboStatusChange();

    $this->renderPartial("_form", array("model" => $model));
    $count = CJSON::decode($res);

    if ($count > 0):
        ?>
        <div class="row-fluid" >
            <div class="span12">
                <b>Результати пошуку заявок </b>
            </div>
        </div>

        <div class="row-fluid" >
            <div class="span12">
                Отримано <?php echo count(CJSON::decode($res)); ?> заявок!
            </div>
        </div>
        <hr/>
        <div class="row-fluid" >    
            <div class="span12">
                <?php echo CHtml::button('Змінити статуси отриманих заявок', array('onclick' => 'EDBO.run()')); ?>
            </div>
        </div>
        <div class="row-fluid" id="status-info" style="display: none;">
            <div class="span12">
                Обробка заявки <span class="current"></span> из <span class="from"></span>
            </div>

        </div>
        <div class="row-fluid" id="status" style="display: none;">
            <div class="span12">
                <?php
                $this->widget('bootstrap.widgets.TbProgress', array(
                    'type' => 'danger', // 'info', 'success' or 'danger'
                    'percent' => 40, // the progress
                    'striped' => true,
                    'animated' => true,
                    'htmlOptions' => array('style' => "span12"),
                ));
                ?>
            </div>
        </div>
        <div class="row-fluid">
            <div id="results">

            </div>
        </div>
    <?php endif; ?>
</div>
<div class="well">

    <h3>Завантажити результати іспитів з ЄДЕБО (за напрямом підготовки):</h3>
    <hr />
    <div class="row-fluid">
        <div class="span2">
            <?php
            $url = Yii::app()->user->getEdboSearchUrl() . 'request_examinations_get.jsp?idQualification=';
            $this->widget("bootstrap.widgets.TbButton", array(
                'type' => 'primary',
                "size" => "large",
                'label' => 'Бакалавр',
                'url' => $url . "1",
                'htmlOptions' => array("target" => "_blank"),
            ));
            ?>
        </div>
        <div class="span2">
            <?php
            $url = Yii::app()->user->getEdboSearchUrl() . 'request_examinations_get.jsp?idQualification=';
            $this->widget("bootstrap.widgets.TbButton", array(
                'type' => 'primary',
                "size" => "large",
                'label' => 'Магистр',
                'url' => $url . "2",
                'htmlOptions' => array("target" => "_blank"),
            ));
            ?>
        </div>

        <div class="span2">
            <?php
            $url = Yii::app()->user->getEdboSearchUrl() . 'request_examinations_get.jsp?idQualification=';
            $this->widget("bootstrap.widgets.TbButton", array(
                'type' => 'primary',
                "size" => "large",
                'label' => 'Специалист',
                'url' => $url . "3",
                'htmlOptions' => array("target" => "_blank"),
            ));
            ?>
        </div>

    </div>
    <hr>
    <h3>Завантажити результати іспитів з ЄДЕБО (за спецыальныстю):</h3>
    <hr />
    <?php $furl = Yii::app()->user->getEdboSearchUrl() . 'request_examinations_get.jsp'; ?>
    <form action="<?php echo $furl; ?>" >
        <div class="row-fluid">
            <div class="span12">
                <?php echo CHtml::label("Спеціальність", "idSpeciality"); ?>
                <?php echo CHtml::dropDownList("idSpeciality", "", Specialities::DropDown(), array("class" => "span12")); ?>
            </div>
            <?php
            echo CHtml::submitButton('Отримати', array("class" => "btn btn-primary btn-large"));
            ?>
        </div>
    </form>

</div>

<div class="well">

    <h3>Завантажити статуси заяв (за напрямом підготовки):</h3>
    <hr />
    <div class="row-fluid">
        <div class="span2">
            <?php
            $url = Yii::app()->user->getEdboSearchUrl() . 'all_requests_statuses_get.jsp?idQualification=';
            $this->widget("bootstrap.widgets.TbButton", array(
                'type' => 'primary',
                "size" => "large",
                'label' => 'Бакалавр',
                'url' => $url . "1",
                'htmlOptions' => array("target" => "_blank"),
            ));
            ?>
        </div>
        <div class="span2">
            <?php
            $url = Yii::app()->user->getEdboSearchUrl() . 'all_requests_statuses_get.jsp?idQualification=';
            $this->widget("bootstrap.widgets.TbButton", array(
                'type' => 'primary',
                "size" => "large",
                'label' => 'Магистр',
                'url' => $url . "2",
                'htmlOptions' => array("target" => "_blank"),
            ));
            ?>
        </div>

        <div class="span2">
            <?php
            $url = Yii::app()->user->getEdboSearchUrl() . 'all_requests_statuses_get.jsp?idQualification=';
            $this->widget("bootstrap.widgets.TbButton", array(
                'type' => 'primary',
                "size" => "large",
                'label' => 'Специалист',
                'url' => $url . "3",
                'htmlOptions' => array("target" => "_blank"),
            ));
            ?>
        </div>

    </div>
    <hr>
    <h3>Завантажити статуси заяв з ЄДЕБО (за спеціальністю):</h3>
    <hr />
    <?php $furl = Yii::app()->user->getEdboSearchUrl() . 'all_requests_statuses_get.jsp'; ?>
    <form action="<?php echo $furl; ?>" >
        <div class="row-fluid">
            <div class="span12">
                <?php echo CHtml::label("Спеціальність", "idSpeciality"); ?>
                <?php echo CHtml::dropDownList("idSpeciality", "", Specialities::DropDown(), array("class" => "span12")); ?>
            </div>

            <?php
            echo CHtml::submitButton('Отримати', array("class" => "btn btn-primary btn-large"));
            ?>
        </div>
    </form>

    <h3>Завантажити статуси заяв з ЄДЕБО (за напрямком, починаючи з дати):</h3>
    <hr />
    <?php $furl = Yii::app()->user->getEdboSearchUrl() . 'all_requests_statuses_get.jsp'; ?>
    <form action="<?php echo $furl; ?>" >
        <div class="row-fluid">
            <div class="span12">
                <?php echo CHtml::label("Дата створення ( у формаі 2015-06-25 )", "createDate"); ?>
                <?php echo CHtml::textField("createDate", "", array("class" => "span4")); ?>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <?php echo CHtml::dropDownList("idQualification", "1", array("1" => "Бакалавр", "2" => "Магистр", "3" => "Специалист"), array("class" => "span4")); ?>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <?php echo CHtml::submitButton('Отправить', array("class" => "btn btn-primary btn-large")); ?>
            </div>
        </div>
    </form>
</div>

<div class="well">

    <h3>Оновлення (у ЄДЕБО) копій та оригіналів документів: </h3>
    <hr />
    <div class="row-fluid">

        <form  method="POST">
            <div class="span12">
                <?php echo CHtml::label("Спеціальність", "idSpeciality"); ?>
                <?php echo CHtml::dropDownList("idRequestSpeciality", $idRequestSpeciality, Specialities::DropDown(), array("class" => "span12")); ?>
            </div>
            <?php
            //if (count($request_list) == 0) 
            echo CHtml::submitButton('Отримати', array("class" => "btn btn-primary btn-large"));
            ?>

        </form> 
        <?php if (count($request_list) > 0): ?>
            <p>Буде змінено <?php echo count($request_list); ?> заявок! </p>
            <?php echo CHtml::button('Змінити заявки', array('onclick' => 'EDBO_DOC.run()', "class" => "btn btn-primary btn-large")); ?>

        <?php endif; ?>

    </div>

    <div class="row-fluid" id="doc-status" style="display: none; margin: 20px 0px;">
        <div class="span12">
            <?php
            $this->widget('bootstrap.widgets.TbProgress', array(
                'type' => 'danger', // 'info', 'success' or 'danger'
                'percent' => 40, // the progress
                'striped' => true,
                'animated' => true,
                'htmlOptions' => array('style' => "span12",),
            ));
            ?>
        </div>
    </div>
    <div class="row-fluid">
        <div id="doc-results" style="margin: 20px 0px;">

        </div>
    </div>
    <div class="row-fluid" id="doc-status-info" style="display: none;">
        <div class="span12">
            Обробка заявки <span class="current"></span> из <span class="from"></span>
        </div>
    </div>

</div>

<div class="well">

    <h3>Перевірка попередньої освіти персони (за напрямом підготовки):</h3>
    <hr />
    <?php $url = Yii::app()->createUrl("edebo/educationsinfo"); ?>
    <form action="<?php echo $url; ?>" method="GET">
        <div class="row-fluid">
            <div class="span12">
                <?php echo CHtml::label("Спеціальність", "idSpeciality"); ?>
                <?php echo CHtml::dropDownList("idSpeciality", "", Specialities::DropDown(), array("class" => "span12")); ?>
            </div>
            <?php
            echo CHtml::submitButton('Отримати', array("class" => "btn btn-primary btn-large"));
            ?>
        </div>
    </form>

</div>

<?php $this->renderPartial("_form_photo"); ?>
<?php $this->renderPartial("_form_doc"); ?>
<script>
    var EDBO = EDBO || {};
    EDBO.data = "<?php echo "idStatus={$model->NewStatusID}&numberProtocol={$model->Protocol}&dateProtocol=" . date("d.m.Y", strtotime($model->ProtocolData)) . " 17:40:00"; ?>";
    EDBO.url = '<?php echo Yii::app()->createUrl("edebo/changestatus"); ?>';
    EDBO.requests = <?php echo empty($res) ? "[]" : $res; ?>;
    EDBO.showInfo = function (i, data) {
        $("#results").append("<div>" + (i + 1) + ". Персону  (ID=" + EDBO.requests[i] + ") оброблено з результатом:" + data + " </div><hr style='margin:0px;'/>");
        var y = (i + 1) * 100 / EDBO.requests.length;
        $("#status .bar").width(y + "%");
        $("#status-info .current").html(i + 1);
    }
    EDBO.sendRequest = function (i) {
        if (i < EDBO.requests.length) {
            $.ajax({
                'url': EDBO.url,
                'data': EDBO.data + "&idPersonRequest=" + EDBO.requests[i],
                'type': 'GET',
                //'async': false,
                success: function (data) {
                    EDBO.showInfo(i, data);
                    EDBO.sendRequest(i + 1);

                }
            });
        } else {
            $("#status").hide();
        }
    }
    EDBO.run = function () {
        if (EDBO.requests.length > 0) {
            $("#status-info .current").html("1");
            $("#results").html("");
            $("#status-info .from").html(EDBO.requests.length);
            $("#status .bar").width("1%");
            $("#status, #doc-status-info").show();
            $("#edebo-form").hide();

            EDBO.sendRequest(0);



        }
    }

    var EDBO_DOC = EDBO_DOC || {};
    EDBO_DOC.data = "";
    EDBO_DOC.url = '<?php echo Yii::app()->createUrl("edebo/changedoc"); ?>';
    EDBO_DOC.requests = <?php echo empty($request_list) ? "[]" : CJSON::encode($request_list); ?>;
    EDBO_DOC.showInfo = function (i, data) {
        $("#doc-results").append("<div>" + (i + 1) + ". Заявка " + EDBO_DOC.requests[i] + " оброблено з результатом:" + data + " </div><hr style='margin:0px;'/>");
        var y = (i + 1) * 100 / EDBO_DOC.requests.length;
        $("#doc-status .bar").width(y + "%");
        $("#doc-status-info .current").html(i + 1);
    }
    EDBO_DOC.sendRequest = function (i) {
        if (i < EDBO_DOC.requests.length) {
            $.ajax({
                'url': EDBO_DOC.url,
                'data': EDBO_DOC.data + "&edboID=" + EDBO_DOC.requests[i],
                'type': 'GET',
                //'async': false,
                success: function (data) {
                    EDBO_DOC.showInfo(i, data);
                    EDBO_DOC.sendRequest(i + 1);

                }
            });
        } else {
            $("#doc-status").hide();
        }
    }
    EDBO_DOC.run = function () {
        if (EDBO_DOC.requests.length > 0) {
            $("#doc-status-info .current").html("1");
            $("#doc-results").html("");
            $("#doc-status-info .from").html(EDBO_DOC.requests.length);
            $("#doc-status .bar").width("1%");
            $("#doc-status, #doc-status-info").show();
            //$("#doc-edebo-form").hide();

            EDBO_DOC.sendRequest(0);



        }
    }

</script>