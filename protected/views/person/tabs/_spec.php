<?php
/* END PRINT SPEC LIST */
$cond = "PersonID=$personid and StatusID <> 3 ";
if (Yii::app()->user->checkAccess("updateAllPost")) {
    $cond = "PersonID=$personid";
}
$dataProvider = new CActiveDataProvider("Personspeciality", array('criteria' => array(
        'condition' => $cond,
        //'order'=>'RequestNumber DESC',
        'with' => array('sepciality', "educationForm"),
    ),
    'sort' => array(
        'attributes' => array("",
//                    'sepciality'=>array(
//                                    'asc'=>'sepciality.SpecialityDirectionName',
//                                    'desc'=>'sepciality.SpecialityDirectionName DESC',
//                            ),
//                    '*',
        ),
    ),
    'pagination' => array(
        'pageSize' => 50,
    )
        ));
?>
<div class="form">
    <?php
    $count = 0;
    foreach ($dataProvider->getData() as $obj) {
        if (!($obj->StatusID == 10 || $obj->StatusID == 3)) {
            $count++;
        }
    }
    if ($count < 6 || Yii::app()->user->checkAccess("updateAllPost")):
        ?>
        <div class="row-fluid">
            <?php
            $url = Yii::app()->createUrl("personspeciality/create", array('personid' => $personid));
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Додати спеціальність',
                'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size' => null, // null, 'large', 'small' or 'mini'
                'loadingText' => 'Зачекайте...',
                'htmlOptions' => array('id' => 'addSpec',
                    'onclick' => "PSN.addSpec(this,'$url');",
                ),
            ));
            ?>
            &nbsp;
            <?php
            if (Yii::app()->user->checkAccess("showSpecEdboRequest")):
                $user = Yii::app()->user->getUserModel();
                $us = 0;
                if ($user->syspk->SpecMask != "1") {
                    $us = 1;
                }
                $url2 = Yii::app()->createUrl("personspeciality/create", array('personid' => $personid));
                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'submit',
                    'label' => 'Додати електронну заяву',
                    'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => null, // null, 'large', 'small' or 'mini'
                    'loadingText' => 'Зачекайте...',
                    'htmlOptions' => array('id' => 'addSpec_electron',
                        'onclick' => "PSN.addSpec_electron(this,'$url2','$us');",
                    ),
                ));
                echo CHtml::textField("idRequest", "", array('style' => "margin-left:20px;", "placeholder" => "Код електронної заявки"));

            endif;
            ?>
            &nbsp;
            <?php
            $pr_url = Yii::app()->createUrl("personspeciality/priorityinfo", array('idperson' => $personid));
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'label' => 'Переглянути пріорітети',
                'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size' => null, // null, 'large', 'small' or 'mini'
                'loadingText' => 'Зачекайте...',
                'htmlOptions' => array(
                    'onclick' => "PSN.getPersonSpecInfo(this,'$pr_url')",
                ),
            ));
            ?>
            &nbsp;
            <?php
            $ed_url = Yii::app()->createUrl("personspeciality/educationsinfo", array('idperson' => $personid));
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'label' => 'Переглянути попередню освіту',
                'type' => 'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size' => null, // null, 'large', 'small' or 'mini'
                'loadingText' => 'Зачекайте...',
                'htmlOptions' => array(
                    'onclick' => "PSN.getPersonSpecInfo(this,'$ed_url')",
                    'class'=>"",
                ),
            ));
            ?>
        </div>
        <div class="spec-info-holder">
            <?php
            $this->widget('bootstrap.widgets.TbAlert', array(
                'fade' => true,
                'closeText' => '&times;', // false equals no close link
                'events' => array(),
                'htmlOptions' => array(),
                'userComponentId' => 'user',
                'alerts' => array(// configurations per alert type
                    // success, info, warning, error or danger
                    'success', // => array('closeText' => '&times;'),
                    'info', // you don't need to specify full config
                    'warning', // => array('closeText' => false),
                    'error', // => array('closeText' => 'AAARGHH!!')
                ),
            ));
            ?>
        </div>
        <hr>
    <?php endif; ?>
    <?php if (Yii::app()->user->hasFlash("message")): ?>
        <div class="row-fluid" ><h3 style="color: red;"><?php echo Yii::app()->user->getFlash("message"); ?></h3></div>
    <?php endif; ?>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $dataProvider,
        'template' => "{items}",
        'rowCssClassExpression' => '$data->getRowClass()',
        'columns' => array(
            //"idPersonSpeciality",
            array('name' => 'PersonRequestNumber', "htmlOptions" => array("style" => "width: 120px"), 'value' => '$data->RequestPrefix.str_pad($data->PersonRequestNumber, 5, "0", STR_PAD_LEFT)'),
            array('name' => 'RequestNumber', "htmlOptions" => array("style" => "width: 120px"), 'value' => 'str_pad($data->RequestNumber, 5, "0", STR_PAD_LEFT)'),
            //array('name'=>'typename', 'header'=>'typename',  ),
            array('name' => 'sepcialityCode', 'header' => 'Код спец-ті', "htmlOptions" => array("style" => "width: 120px"), 'value' => '$data->sepciality->SpecialityClasifierCode'),
            array('name' => 'sepciality', 'header' => 'Спеціальність',
                'value' => '(!empty($data->sepciality->SpecialityName)? $data->sepciality->SpecialityName." " :"" ).$data->sepciality->SpecialityDirectionName.(!empty($data->sepciality->SpecialitySpecializationName) ? ": ".$data->sepciality->SpecialitySpecializationName." ":"")'
            //'value' => '!empty($data->sepciality->SpecialityName) ? $data->sepciality->SpecialityName : $data->sepciality->SpecialityDirectionName' 
            ),
            array('name' => 'educationForm', 'header' => 'Форма навчання', 'value' => '$data->educationForm->PersonEducationFormName '),
            array('name' => 'isCopyEntrantDoc', 'header' => 'Копія',
                'value' => '($data->isCopyEntrantDoc) ? "Так":"Ні"',
            ),
            array('name' => 'status', 'header' => 'Статус',
                'value' => '$data->status->PersonRequestStatusTypeName',
            ),
            array('name' => 'CreateDate', 'header' => 'Дата',
                'value' => '$data->CreateDate',
            ),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{update} {trash} {print} {titul} {sinchr} {arcush}',
                'buttons' => array
                    (
                    'update' => array(
                        'label' => 'Редагувати',
                        'icon' => 'pencil',
                        'url' => 'Yii::app()->createUrl("personspeciality/update",array("id"=>$data->idPersonSpeciality))',
                        'options' => array(
                            'class' => 'btn',
                            'onclick' => "PSN.editSpec(this); return false;",
                        ),
                    ),
                    'trash' => array(
                        'label' => 'Видалити',
                        'icon' => 'trash',
                        'url' => 'Yii::app()->createUrl("personspeciality/delete",array("id"=>$data->idPersonSpeciality))',
                        'options' => array(
                            'class' => 'btn',
                            'onclick' => "PSN.delSpec(this); return false;",
                            "style" => Yii::app()->user->checkAccess("denySpecDel") ? "display:none;" : "",
                        ),
                    ),
                    'print' => array(
                        'label' => 'Друкувати',
                        'icon' => 'print',
                        'url' => 'Yii::app()->user->getPrintUrl($data->PersonID, $data->idPersonSpeciality)',
                        'options' => array(
                            'class' => 'btn',
                            'rel' => "prettyPhoto",
                            'title' => "Друкувати заявку",
                        ),
                    ),
                    'titul' => array(
                        'label' => 'Друкувати титульний лист',
                        'icon' => 'file',
                        'url' => 'Yii::app()->user->getTitulUrl($data->idPersonSpeciality)',
                        'options' => array(
                            'class' => 'btn',
                            'title' => "Друкувати титульний лист",
                            'rel' => "prettyPhoto",
                        ),
                    ),
                    'arcush' => array(
                        'label' => 'Друкувати аркуш',
                        'icon' => 'file',
                        'url' => 'Yii::app()->user->getArcushUrl($data->PersonID, $data->idPersonSpeciality)',
                        'options' => array(
                            'class' => 'btn',
                            'title' => "Друкувати аркуш",
                            'rel' => "prettyPhoto",
                        ),
                    ),
                    'sinchr' => array(
                        'label' => 'Синхронізувати',
                        'icon' => 'icon-refresh',
                        'url' => 'Yii::app()->createUrl("personspeciality/edboupdate",array("id"=>$data->idPersonSpeciality))',
                        'options' => array(
                            'class' => 'btn',
                            'onclick' => "PSN.edboSpecsUpdate(this); return false;",
                            'title' => "Синхронізувати",
                        ),
                    ),
//                    'printa' => array(
//                        'label'=>'Друкувати',
//                        'icon'=>'icon-check',
//                        'url'=>  'Yii::app()->user->getPrintUrl($data->PersonID, $data->idPersonSpeciality)',
//                        'options'=>array(
//                            'class'=>'btn',
//                            //'onclick'=>'PSN.printSpec(this); return true;',
//                            'rel'=>"prettyPhoto",
//                            'title'=>"Друкувати аркуш вступних випробувань",
//                        ),
//                    ),
                ),
                'htmlOptions' => array(
                    'style' => 'width: 218px;',
                ),
            )
        ),
            )
    );
    ?>   
    <hr>
    <div style="font-weight: bold;">Статуси заявок:</div>
    <ul>
        <li>Не синхронізована</li>
        <li style="color: green;">Синхронізована</li>
        <li style="color: blue;" >Скасована</li>
        <li style="color: red;" >Видалена</li>
        <li style="color: goldenrod;" >Відмова</li>
    </ul>
</div><!-- form -->
<script type="text/javascript">
    /*<![CDATA[*/
    jQuery('#pretty_photo a').attr('rel', 'prettyPhoto');
    jQuery('a[rel^="prettyPhoto"]').prettyPhoto({'opacity': 0.6, 'modal': true, 'theme': 'facebook'});
    /*]]>*/
</script>
