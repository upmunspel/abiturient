<?php
$this->beginWidget('bootstrap.widgets.TbModal', array(
    'id' => 'specModal',
    'htmlOptions' => array('style' => 'width: 1200px; margin-left: -600px;'),
        )
);
?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4><?php echo $model->isNewRecord ? "Нова спеціальність" : "Редагування спеціальності"; ?></h4>
    <?php
    if ($model->isNewRecord) {
        // empty
    } else {
        $umodel = User::model()->findByPk($model->SysUserID);
        ?>
        <div style="float: right;  font-weight: bold; margin-right: 0px; margin-left: 20px;">
            Користувач: <span style=" font-weight: normal; color: #aaa;"><?php echo $umodel->info; ?></span>
        </div>
        <?php
    }
    ?>
    <div style="float: right; font-weight: bold">
        Статус: <span style=" color: red;"><?php echo $model->status->PersonRequestStatusTypeName; ?></span>
    </div>
    <div style="float: right; color: red; font-weight: bold; margin-right: 20px;">
        <?php echo $model->RequestFromEB == 1 ? "Електронна заява" : "Заява створена оператором ЗНУ"; ?>
    </div>


    <?php if (!$model->isNewRecord): ?>
        <div style="float: right; font-weight: bold; margin-right: 20px;">
            Номер справи: <span><?php echo str_pad($model->RequestNumber, 5, '0', STR_PAD_LEFT); ?></span>
        </div>
    <?php endif; ?>
    Поля з <span class ="required">*</span> необхідно заповнити.
</div>

<div class="modal-body <?php echo Yii::app()->user->isShortForm() ? " short" : ""; ?>" id="spec-modal-body">
    <?php if (Yii::app()->user->hasFlash("specmessage")): ?>
        <div class="row-fluid" style="color: red; font-weight: bold;font-size: 20px;margin-bottom: 10px;"><?php echo Yii::app()->user->getFlash("specmessage"); ?></div>
    <?php endif; ?>

    <?php
    if (Yii::app()->user->isShortForm()) {
        if ($model->isNewRecord || (!$model->isNewRecord && $model->QualificationID > 1)) {
            $this->renderPartial("_formShort", array('model' => $model));
        } else {
            $this->renderPartial("_form", array('model' => $model));
        }
    } else {
        $this->renderPartial("_form", array('model' => $model));
    }
    ?>


</div>

<div class="modal-footer">

    <?php
    $url = $model->isNewRecord ? Yii::app()->createUrl("personspeciality/create") : Yii::app()->createUrl("personspeciality/update", array("id" => $model->idPersonSpeciality));
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'primary',
        'label' => 'Зберегти',
        'htmlOptions' => array('onclick' => "PSN.appendSpec(this, '$url')"),
    ));
    ?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Скасувати',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    ));
    ?>
</div>

<?php $this->endWidget(); ?>