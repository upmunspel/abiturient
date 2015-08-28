<div class="well">

    <h3>Відправка фото до бази ЕДЕБО (за напрямом підготовки):</h3>
    <hr />
    <?php $url = Yii::app()->createUrl("edebo/photosend"); ?>
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
    <h3>Відправка фото до бази ЕДЕБО (за кодами персон):</h3>
    <hr />
    <?php $url = Yii::app()->createUrl("edebo/photosend"); ?>
    <form action="<?php echo $url; ?>" method="GET">
        <div class="row-fluid">
            <div class="span12">
                <?php echo CHtml::label("Коди персон через кому", "idSpeciality"); ?>
                <?php echo CHtml::textField("idPersons", "", array("class" => "span12")); ?>
            </div>
            <?php
            echo CHtml::submitButton('Отримати', array("class" => "btn btn-primary btn-large"));
            ?>
        </div>
    </form>
    <h3>Завантажити статуси заяв (за напрямом підготовки):</h3>
    <hr />
    <div class="row-fluid">
        <div class="span2">
            <?php
            //$url = Yii::app()->user->getEdboSearchUrl() . 'all_requests_statuses_get.jsp?idQualification=';
            $this->widget("bootstrap.widgets.TbButton", array(
                'type' => 'primary',
                "size" => "large",
                'label' => 'Бакалавр',
                'url' => $url . "?idQualification = 1",
                'htmlOptions' => array("target" => "_blank"),
            ));
            ?>
        </div>

        <div class="span5">
            <?php
            //$url = Yii::app()->user->getEdboSearchUrl() . 'all_requests_statuses_get.jsp?idQualification=';
            $this->widget("bootstrap.widgets.TbButton", array(
                'type' => 'primary',
                "size" => "large",
                'label' => 'Всі, що до наказу',
                'url' => $url,
                'htmlOptions' => array("target" => "_blank"),
            ));
            ?>
        </div>
    </div>

</div>
