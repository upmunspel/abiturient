<?php

/**
 * This is the model class for table "documentsubject".
 *
 */
class Documentsubject extends ActiveRecord{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Documents the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
  /**
   * @return array relational rules.
   */
  public function relations(){
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
      'document1' => array(self::BELONGS_TO, 'Documents', 'DocumentID'),
      'document2' => array(self::BELONGS_TO, 'Documents', 'DocumentID'),
      'document3' => array(self::BELONGS_TO, 'Documents', 'DocumentID'),
      'subject1' => array(self::BELONGS_TO, 'Subjects', 'SubjectID'),
      'subject2' => array(self::BELONGS_TO, 'Subjects', 'SubjectID'),
      'subject3' => array(self::BELONGS_TO, 'Subjects', 'SubjectID'),
      'personsepcialities' => array(self::HAS_MANY, 'Personsepciality', 'DocumentSubject2'),
      'personsepcialities1' => array(self::HAS_MANY, 'Personsepciality', 'DocumentSubject3'),
      'personsepcialities2' => array(self::HAS_MANY, 'Personsepciality', 'DocumentSubject1'),
    );
  }

}