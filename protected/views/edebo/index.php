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
<script>
    var EDBO = EDBO || {};
    EDBO.data = "<?php  echo "idStatus={$model->NewStatusID}&numberProtocol={$model->Protocol}&dateProtocol=".date("d.m.Y", strtotime($model->ProtocolData))." 17:40:00"; ?>";
    EDBO.url = '<?php echo Yii::app()->createUrl("edebo/changestatus"); ?>';
    EDBO.requests = <?php echo empty($res) ? "[]" : $res; ?>;
    EDBO.showInfo = function(i, data) {
        $("#results").append("<div>" + (i + 1) + ". Заявка " + EDBO.requests[i] + " оброблено з результатом:" + data + " </div><hr style='margin:0px;'/>");
        var y = (i + 1) * 100 / EDBO.requests.length;
        $("#status .bar").width(y + "%");
        $("#status-info .current").html(i + 1);
    }
    EDBO.sendRequest = function(i) {
        if (i < EDBO.requests.length) {
            $.ajax({
                'url': EDBO.url,
                'data': EDBO.data+"&idPersonRequest="+EDBO.requests[i],
                'type': 'GET',
                //'async': false,
                success: function(data) {
                    EDBO.showInfo(i, data);
                    EDBO.sendRequest(i + 1);

                }
            });
        } else {
            $("#status").hide();
        }
    }
    EDBO.run = function() {
        if (EDBO.requests.length > 0) {
            $("#status-info .current").html("1");
            $("#results").html("");
            $("#status-info .from").html(EDBO.requests.length);
            $("#status .bar").width("1%");
            $("#status, #status-info").show();
            $("#edebo-form").hide();

            EDBO.sendRequest(0);



        }
    }


</script>