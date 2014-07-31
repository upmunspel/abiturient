<?php

/**
 * This is the model class for table "documentsubject".
 *
 * @property Subjects $subject1
 * @property Subjects $subject2
 * @property Subjects $subject3
 */
class Documentsubject extends ActiveRecord{

  public static function model($className=__CLASS__){
    return parent::model($className);
  }

  /**
   * @return array relational rules.
   */
  public function relations(){
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
      'document' => array(self::BELONGS_TO, 'Documents', 'DocumentID'),
      'subject1' => array(self::BELONGS_TO, 'Subjects', 'SubjectID'),
      'subject2' => array(self::BELONGS_TO, 'Subjects', 'SubjectID'),
      'subject3' => array(self::BELONGS_TO, 'Subjects', 'SubjectID'),
      'personsepcialities' => array(self::HAS_MANY, 'Personsepciality', 'DocumentSubject2'),
      'personsepcialities1' => array(self::HAS_MANY, 'Personsepciality', 'DocumentSubject3'),
      'personsepcialities2' => array(self::HAS_MANY, 'Personsepciality', 'DocumentSubject1'),
    );
  }
}