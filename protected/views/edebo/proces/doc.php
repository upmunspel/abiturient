<?php
/* @var $this EdeboController */
/* @var $model EdeboStatusChange */
$this->pageTitle = " Заввнтаження документів | Робота з сервісами ЄДЕБО";
?>

<?php
$this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
    'heading' => 'Завантаження (відправка) документів',
));
?>
<?php $this->endWidget(); ?>
<div class="well">

    <?php $count = count(CJSON::decode($res)); ?>
    <div>
        <h4>
            Інформація
        </h4>
        <div>
            До обробки обрано <?php echo $count; ?> записів.   
        </div>
    </div>
   
    <?php if ($count > 0): ?>
    <hr/>
        <div class="row-fluid" >    
            <div class="span12">
                <?php echo CHtml::button('Старт', array('onclick' => 'EDBO.run()', "class"=>"btn btn-primary btn-large")); ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php if ($count > 0): ?>

    <div class="well status-well" style="display: none;">
         <h4>
            Статус обробки записів
        </h4>
        <div class="row-fluid" >  

            <div class="span12" id="status-info" >
                Обробка заявки <span class="current"></span> из <span class="from"></span>
            </div>
        </div>

        <div class="row-fluid">
            <div  id="status" >
                <div >
                    <?php
                    $this->widget('bootstrap.widgets.TbProgress', array(
                        'type' => 'danger', // 'info', 'success' or 'danger'
                        'percent' => 0, // the progress
                        'striped' => true,
                        'animated' => true,
                        'htmlOptions' => array('style' => "span12"),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>

  

    <div class="row-fluid">
        <div id="results">

        </div>
    </div>
<?php endif; ?>

<script>
    var EDBO = EDBO || {};
    EDBO.data = "";
    EDBO.url = '<?php echo Yii::app()->createUrl("edebo/docsendproc"); ?>';
    EDBO.requests = <?php echo empty($res) ? "[]" : $res; ?>;
    EDBO.showInfo = function (i, data) {
        $("#results").append("<div>" + (i + 1) + ". Персона " + EDBO.requests[i] + " оброблено з результатом:" + data + " </div><hr style='margin:0px;'/>");
        var y = (i + 1) * 100 / EDBO.requests.length;
        $("#status .bar").width(y + "%");
        $("#status-info .current").html(i + 1);
    }
    EDBO.sendRequest = function (i) {
        if (i < EDBO.requests.length) {
            $.ajax({
                'url': EDBO.url,
                'data': EDBO.data + "&idPerson=" + EDBO.requests[i],
                'type': 'GET',
                //'async': false,
                success: function (data) {
                    EDBO.showInfo(i, data);
                    EDBO.sendRequest(i + 1);

                }
            });
        } else {
            $(".status-well").hide();
          
        }
    }
    EDBO.run = function () {
        if (EDBO.requests.length > 0) {
            $(".status-well").show();
            $("#status-info .current").html("1");
            $("#results").html("");
            $("#status-info .from").html(EDBO.requests.length);
            $("#status .bar").width("0%");
            $("#status, #doc-status-info").show();
            $("#edebo-form").hide();

            EDBO.sendRequest(0);



        }
    }

</script>