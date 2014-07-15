<?php
/* @var $this EdeboController */
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
    ?>

    <div class="row-fluid">
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
</div>
<script>
    var EDBO = EDBO || {};

    EDBO.url = '<?php echo Yii::app()->createUrl("edebo/changestatus"); ?>';
    EDBO.requests = <?php echo $res ?>;

    $(document).ready(function() {
        if (EDBO.requests.length > 0) {
            for (var i = 0; i < EDBO.requests.length; i++){
                $.ajax({
                    'url': EDBO.url,
                    //'data': fdata,
                    'type': 'POST',
                    success: function(data) {
                        $("#results").append("<div>"+i+". Заявка " + EDBO.requests[i] + " успішно додана :" + data + " </div>");
                    }
                });
            }


        }
    });

</script>