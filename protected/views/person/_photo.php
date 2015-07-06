<div class="row-fluid">
    <div class="span5" >
        <b>Існуюче</b>
        <a href="#" style="width: 120px;" class="thumbnail" rel="tooltip" data-title="Фото абітурієнта">
            <?php
            $path = Yii::app()->baseUrl . Yii::app()->params['photosPath'] . $model->PhotoName;

            //if (!file_exists(Yii::app()->basePath . "/../.." . $path)) {
            if (!file_exists( "." . $path)) {
                $path = Yii::app()->baseUrl . Yii::app()->params['photosPath'] . Yii::app()->params['defaultPersonPhotoSmall'];
            }

            echo CHtml::image($path, 'Фото абітурієнта', array("id" => "existing-photo"));
            ?>

        </a>
    </div>
    <div class="span2" style="padding-top: 70px;" >
        <?php
        $url = Yii::app()->createUrl("photoloader/reloadphoto", array('id' => $model->idPerson));
        $this->widget('bootstrap.widgets.TbButton', array(
            'label' => '',
            'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => null, // null, 'large', 'small' or 'mini' 
             'icon'=>'arrow-left',
            'loadingText' => '...',
            'htmlOptions' => array('id' => 'addSpec',
                'onclick' => "PSN.reloadPersonPhote(this,'$url');",
                'title' => "Замінити існуюче фотографію"
            ),
        ));
        ?>
        <?php
        $url = Yii::app()->createUrl("person/reloadphoto", array('id' => $model->idPerson));
        $this->widget('bootstrap.widgets.TbButton', array(
            'label' => '',
            'icon'=>'refresh',
            'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => null, // null, 'large', 'small' or 'mini'
            'loadingText' => '...',
            'htmlOptions' => array('id' => 'addSpec',
                'onclick' => "PSN.updatePersonPhote(this,'$url');",
                'title' => "Оновити",
                 'style'=>"margin-top: 10px;"
                )
        ));
        ?>
    </div>
    <div class="span5" >
        <b>У ЄДБО</b>
        <a href="#" style="width: 120px;" class="thumbnail" rel="tooltip" data-title="Фото абітурієнта">
            <?php
            $photo_exist = Yii::app()->cache->get($model->codeU);
            if (!empty($model->codeU) && !empty($photo_exist)) {
                $photo = WebServices::getPersonPhotoByCodeU($model->codeU);
                if (!empty($photo)) {
                    echo '<img src="data:image/gif;base64,' . $photo . '" />';
                } else {
                    $path = Yii::app()->baseUrl . Yii::app()->params['photosPath'] . Yii::app()->params['defaultPersonPhotoSmall'];
                    echo CHtml::image($path, 'Фото абітурієнта');
                }
            } else {
                $path = Yii::app()->baseUrl . Yii::app()->params['photosPath'] . Yii::app()->params['defaultPersonPhotoSmall'];
                echo CHtml::image($path, 'Фото абітурієнта');
            }
            ?>
        </a>
    </div>
    <?php if (Yii::app()->user->hasFlash("photomessage")): ?>
        <?php $str = Yii::app()->user->getFlash("photomessage"); ?>
        <div class="row-fluid" ><span style="color: red;"><?php echo $str; ?></span></div>
        <?php endif; ?>
</div>