<?php

/**
 * This is the model class for table "sys_users".
 *
 * The followings are the available columns in table 'sys_users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $info
 * @property integer $SysPkID
 */
class User extends CActiveRecord {

    public $pkname;
    public $speccount;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sys_users';
    }

    protected function beforeSave() {
        parent::beforeSave();
        $this->password = md5($this->password);
        return true;
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password', 'required'),
            array('username, password, info', 'length', 'max' => 255),
            array('email, info, SysPkID', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, password, email, info, pkname, speccount', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'syspk' => array(self::BELONGS_TO, 'SysPk', 'SysPkID'),
            'spec' => array(self::HAS_MANY, "Personspeciality", "SysUserID"),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'Код',
            'username' => "Им'я",
            'password' => 'Парооль',
            'email' => 'E-Mail',
            'info' => 'Додаткова інформація',
            "SysPkID" => "Приймальна комісія",
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        /* SELECT u . * , pk.PkName AS pkname, COUNT( s.SysUserID ) AS speccount
          FROM  `sys_users` AS u
          LEFT JOIN sys_pk AS pk ON u.`SysPkID` = pk.idPk
          LEFT JOIN personspeciality AS s ON s.SysUserID = u.id
          WHERE 1
          GROUP BY s.SysUserID
          ORDER BY pkname, speccount
         */
        Yii::app()->db->enableParamLogging = true;
        $criteria = new CDbCriteria;
        $criteria->alias = "u";
        $criteria->join = "LEFT JOIN sys_pk AS pk ON u.`SysPkID` = pk.idPk LEFT JOIN personspeciality AS s ON s.SysUserID = u.id";
        $criteria->group = "s.SysUserID";
        $criteria->select = "u . * , pk.PkName AS pkname, COUNT( s.SysUserID ) AS speccount";
        if (!empty($this->speccount) && is_numeric($this->speccount)) {
            $sign = " <=";
            $criteria->having = 'speccount' . $sign . $this->speccount;
        }
        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('u.info', $this->info, true);
        $criteria->compare('SysPkID', $this->pkname);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 100,),
            'sort' => array(
                'defaultOrder' => array(
                    'id' => CSort::SORT_ASC,
                ),
                'attributes' => array(
                    'pkname' => array(
                        'asc' => 'pkname',
                        'desc' => 'pkname DESC',
                    ),
                    'speccount' => array(
                        'asc' => 'speccount',
                        'desc' => 'speccount DESC',
                    ),
                    '*',
                )
            )
        ));
    }

}
