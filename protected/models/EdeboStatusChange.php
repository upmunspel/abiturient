<?php

/**
 * This is the model class for table "sys_pk".
 *
 * The followings are the available columns in table 'sys_pk':
 * @property integer $idPk
 * @property integer $PkName
 * @property integer $DepartmentID
 * @property integer $CourseID
 * @property integer $QualificationID
 * @property string $SpecMask
 * @property string $Info
 * @property string $isBudget
 * @property string $isContract
 * @property string $isShortForm
 * @property integer $EducationFormID
 * @property string $printIP
 * @property string $searchIP
 */
class EdeboStatusChange extends CFormModel {

    public $StatusID = 1;
    public $NewStatusID = 4;
    public $QualificationID;
    public $Data;
    public $Protocol;
    public $ProtocolData;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {

        return array(
            array('StatusID, NewStatusID, Protocol, ProtocolData,  QualificationID, Data', 'required'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'StatusID' => 'Статус заявки',
            'QualificationID' => 'Кваліфікація',
            "Data" => 'Дата',
            "ProtocolData"=>"Дата протокола",
            "Protocol"=>"Номер протокола",
            "NewStatusID"=>"Новий статус",
        );
    }

}
