<?php

class EdbodataController extends Controller
{
  /**
   * @var string the default layout for the views. Defaults to '//layouts/main', meaning
   * using main layout. See 'protected/views/layouts/main.php'.
   */
  public $layout='//layouts/main';
  public $defaultAction='admin';

  /**
   * Filters.
   * @return array action filters
   */
  public function filters(){
    return array(
      'accessControl', // perform access control for CRUD operations
      'postOnly + delete', // we only allow deletion via POST request
    );
  }

  /**
   * Specifies the access control rules.
   * This method is used by the 'accessControl' filter.
   * @return array access control rules
   */
  public function accessRules(){
    return array(
      array('allow', // allow users with admin privileges to perform all CRUD actions
        'actions' => array('view', 'create', 'update', 'admin', 'delete', 
           'datauploader', 'upload', 'deletecsv'),
        'users' => array('@'),
      ),
      array('deny', // deny all users
        'users' => array('*'),
      ),
    );
  }
  
  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate()
  {
    $reqEdboData = Yii::app()->request->getPost('EdboData',null);
    $model = new EdboData;
    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if(is_array($reqEdboData)){
      $model->attributes = $reqEdboData;
      if ($model->save()){
        $this->redirect(array('view','id' => $model->ID));
      }
    }

    $this->render('create',array(
      'model' => $model,
    ));
  }

  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
  public function actionUpdate($id){
    $reqEdboData = Yii::app()->request->getPost('EdboData',null);
    $model=$this->loadModel($id);

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if(is_array($reqEdboData)){
      $model->attributes = $reqEdboData;
      if($model->save()){
        $this->redirect(array('view','id'=>$model->ID));
      }
    }

    $this->render('update',array(
      'model'=>$model,
    ));
  }

  /**
   * Deletes a particular model.
   * If deletion is successful, the browser will be redirected to the 'admin' page.
   * @param integer $id the ID of the model to be deleted
   */
  public function actionDelete($id){
    $this->loadModel($id)->delete();

    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
    if(!isset($_GET['ajax'])){
      $this->redirect( isset($_POST['returnUrl']) ? 
        $_POST['returnUrl'] : array('admin') );
    }
  }

  /**
   * Manages all models.
   */
  public function actionAdmin(){
    $reqEdboData = Yii::app()->request->getParam('EdboData');
    $model = new EdboData('search');
    $model->unsetAttributes();  // clear any default values
    if(is_array($reqEdboData)){
      $model->attributes = $reqEdboData;
    }
    $this->render('admin',array(
      'model'=>$model,
    ));
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadModel($id){
    $model = EdboData::model()->findByPk($id);
    if ($model === null){
      throw new CHttpException(404,'Помилка. Екземпляр класу EdboData з ID '.$id.' не інсує.');
    }
    return $model;
  }

  /**
   * Performs the AJAX validation.
   * @param CModel the model to be validated
   */
  protected function performAjaxValidation($model){
    $reqAjax = Yii::app()->request->getPost('ajax',null);
    if($reqAjax === 'edbo-data-form'){
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
  
  /**
   * Метод формує сторінку, з якої можна завантажувати CSV-файли
   */
  public function actionDatauploader(){
      $SQL="SHOW FULL COLUMNS FROM edbo_data";
      $connection = Yii::app()->db; 
      $command = $connection->createCommand($SQL);
      $rowCount = $command->execute(); // execute the non-query SQL
      $data_items = $command->queryAll(); // execute a query SQL
      $this->render('/edbodata/datauploader',array(
         'data_items' => $data_items,
         'model' => new EdboData(),
         'rowCount' => $rowCount,
      ));
  }
  
  /**
   * Метод збереження CSV-файлів (асинхронно)
   * @return null
   * @throws CHttpException
   */
  public function actionUpload() {
    header('Vary: Accept');
    if (isset($_SERVER['HTTP_ACCEPT']) &&
            (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
      header('Content-type: application/json');
    } else {
      header('Content-type: text/plain');
    }
    $this->layout = '//layouts/clear';
    $data = array();

    $model = new EdboData();
    $model->csv_file = CUploadedFile::getInstance($model, 'csv_file');
    
    //якщо файл завантажено
    if ($model->csv_file !== null && $model->validate(array('csv_file'))) {
      //формується назва файлу із його MD5-хешу
      $md5_name = md5_file($model->csv_file->getTempName());
      $ext = $model->csv_file->extensionName;
      $new_filename = Yii::app()->getBasePath().'/data/'.$md5_name.'.'.$ext;
      //спроба збереження файлу
      if ($model->csv_file->saveAs($new_filename) !== true){
        $data[] = array('error', $new_filename. ' не зберігся...');
        echo json_encode($data);
        return ;
      }
      
      $file = $new_filename;
      
      //завантаження даних із файлу в таблицю edbo_data
      $ret_list = $this->LoadCsvToDB($file);
      $message = '';
      if (!isset($ret_list[0]) || $ret_list[0]===false){
        $inserted = 'error';
        $message = (isset($ret_list[1]))? $ret_list[1] : 'Невідома помилка';
      } else {
        $inserted = $ret_list[0]." ";
        $updated = $ret_list[1]." ";
        $message = " ( Втавлено : ". $inserted . ", оновлено : " . $updated . ') із ' . $ret_list[2];
      }
      //дані для виведення (асинхронно)
      $data[] = array(
          'name' => $model->csv_file->name,
          'type' => $model->csv_file->type,
          'size' => $model->csv_file->size,
          'uploaded' => $message,
          'delete_url' => $this->createUrl('/edbodata/deletecsv',array('path' => $file)),
          'delete_type' => 'POST');
    } else {
      //якщо файл не пройшов валідацію
      if ($model->hasErrors('csv_file')) {
        $data[] = array('error', $model->getErrors('csv_file'));
      } else {
        throw new CHttpException(500, "Could not upload file " . CHtml::errorSummary($model));
      }
    }
    // JQuery File Upload expects JSON data
    echo json_encode($data);
  }
  
  /**
   * Метод видалення CSV-файлу (асинхронно)
   */
  public function actionDeletecsv(){
    if (Yii::app()->request->isPostRequest){
      $path = Yii::app()->request->getParam('path',null);
      if ($path){
        unlink($path);
      } else {
        $data[] = array('error', 'No path');
        echo json_encode($data);
      }
    }
  }
  
  /**
   * Метод завантажує в БД дані із CSV-файлу
   * @param string $file повний шлях до файлу
   * @return array лічильники в результаті оновлення БД
   */
  protected function LoadCsvToDB($file){
    /*спочатку витягуємо контент із CSV-файлу, ім'я якого $file*/
    if (!$file) {
      return array(false,'no file');
    }
    $hfile = fopen($file,"r");
    if (!$hfile){
      return array(false,'can not open');
    }
    $fsize = filesize($file);
    $csvcontent = fread($hfile,$fsize);
    if (!$csvcontent){
      return array(false,'not readable');
    }
    fclose($hfile);
    /**********************************************************/

    /*потім дістаємо структуру таблиці edbo_data, 
     * щоб знати кількість і атрибути полів*/
    $SQL="SHOW FULL COLUMNS FROM edbo_data";
    $connection = Yii::app()->db; 
    $command = $connection->createCommand($SQL);
    $rowCount = $command->execute(); // execute the non-query SQL
    $row_header = $command->queryAll(); // execute a query SQL
    /********************************************/
    
    /*встановлюємо початкові параметри*/
    //кількість полів
    $field_count = $rowCount;
    //сепаратор полів
    $fieldseparator = ";";
    //сепаратор рядків
    $lineseparator = "\n";
    //сепаратор цілісних записів
    $wholestrseparator = "\"";
    //лічильник - скільки нових записів додано в базу
    $inserted = 0;
    //лічильник - скільки існуючих записів оновлено в базі
    $updated = 0;
    /**********************************/
    
    //розбивка на рядки
    $arr_lines = explode($lineseparator,$csvcontent);
    //загальний лічильник
    $id = 0;
    
    $independent_counter = 0;
    
    //цикл по всім рядкам
    foreach($arr_lines as $line) {
      $independent_counter++;
      $id++;
      $edbo_model = new EdboData();
      
      /*перетворення тексту в потрібне кодування
        і обробка символів, що є сепараторами цілісних виразів, але це насправді не вони*/
      $line_utf8 = iconv('windows-1251','utf-8',$line);

      if (mb_strlen(trim($line_utf8," \t\n\r"),'utf8') == 0){
        //якщо це пустий рядок, пропуск
        $id--;
        continue;
      }
      
      $line_utf8_trio_quots_in_begin = str_replace(
              $fieldseparator.$wholestrseparator.$wholestrseparator.$wholestrseparator,
                      $fieldseparator.$wholestrseparator.'__quots__',
                      $line_utf8);
      $line_utf8_trio_quots_in_the_end = str_replace(
              $wholestrseparator.$wholestrseparator.$wholestrseparator.$fieldseparator,
              '__quots__'.$wholestrseparator.$fieldseparator,
              $line_utf8_trio_quots_in_begin);
      $line_utf8_double_quots = str_replace(
              $wholestrseparator.$wholestrseparator,
              '__quots__',
              $line_utf8_trio_quots_in_the_end);

      $field_attrs = explode($wholestrseparator,$line_utf8_double_quots);
      /**********************************************************************************/
      
      //обробка символів, що є сепараторами полів, але це насправді не вони
      for($k = 0; $k < count($field_attrs); $k++) {
        if ($k % 2){
          $field_attrs[$k] = str_replace($fieldseparator,"__SEPARATOR__",$field_attrs[$k]);
        }
      }
      //очищення від зайвих пробілів по кінцям і символа переходу на новий рядок
      $new_clear_line = str_replace("\r","",trim(implode($wholestrseparator,$field_attrs)," "));
      //заміна коми на крапку, ящо це дійсне число у регулярному форматі
      $escaped_line = preg_replace("/([1-9][0-9]*?),([0-9]+?)/","$1.$2",$new_clear_line);
      
      //розщеплення рядка на дані
      $row_data = explode($fieldseparator,$escaped_line);
      $current_field_count = count($row_data);
      
      if ($current_field_count != $field_count) {
        //у випадку, якщо к-сть полів новорозщепленного рядка не така, 
        // як к-сть полів у таблиці БД, то...
        return array(false,'К-сть полів не співпадає : '.$current_field_count.' != '.$field_count);
      }
      $edbo_attributes = array();
      //прохід по всім полям
      for ($k = 0; $k < $current_field_count; $k++){
        //повернення символів, що є сепараторами полів, але це насправді не вони
        $data_item_0 = str_replace("__SEPARATOR__",$fieldseparator,$row_data[$k]);
        //видалення сепараторів цілісних виразів (вони розміщенні по краях)
        $data_item_1 = str_replace($wholestrseparator,'',$data_item_0);
        //повернення символів, що є сепараторами цілісних виразів, але це насправді не вони
        $data_item_2 = str_replace("__quots__",$wholestrseparator,$data_item_1);
        
        if (!isset($row_header[$k]['Field'])){
          //про всяк випадок
          return array(false,'row_header with index '.$k.' doesn\'t exist');
        }
        //врахування того, що деякі поля - дійсні числа у регулярному форматі
        $is_float = (strstr($row_header[$k]['Type'],'float')!==false);
        //врахування того, шщо деякі поля - цілі числа
        $is_integer = (strstr($row_header[$k]['Type'],'int')!==false);
        
        /*врахування розміру поля таблиці БД*/
        $match = array();
        preg_match('/\(([0-9]+)\)/', $row_header[$k]['Type'], $match);
        $data_size = isset($match[1]) ? $match[1]  :  1024; 
        $data_item = (mb_strlen($data_item_2,'utf8') > $data_size 
                && !$is_float && !$is_integer) ? 
                  mb_substr($data_item_2,0,$data_size,'utf8') 
                  : $data_item_2;
        $edbo_attributes[$row_header[$k]['Field']] = $data_item;
        /************************************/
      }
      
      

      if (!is_numeric($edbo_attributes['ID'])){
        //якщо поле з числовим ідентифікатором не є числом, 
        // то далі нічого робити не потрібно
        $id--;
        continue;
      }
      
      //якщо рядок (кортеж) в таблиці БД існує, то його можна знайти по ID
      $edbo_existing_model = EdboData::model()->findByPk($edbo_attributes['ID']);
      $is_new = false;
      $is_change = false;
      if (!$edbo_existing_model){
        //якщо ж не існує, то це новий запис у базу
        $is_new = true;
      }
      //порівняння прибулих значень з існуюючими;
      //якщо усі такі самі, то оновлювати не треба
      for ($k = 0; ($k < $current_field_count && $edbo_existing_model); $k++){
        $edbo_field_value = $edbo_existing_model->getAttribute($row_header[$k]['Field']);
        $income_field_value = $edbo_attributes[$row_header[$k]['Field']];
        $edbo_param = $edbo_field_value;
        $income_param = $income_field_value;
        $is_change = ($income_param != $edbo_param);
        if ($is_change){ 
          break;
        }
      }
      
      if (!$is_new & !$is_change){
        continue;
      }
      /*оновлення або створення нового запису в БД з перевірками*/
      $result_of_saving_new_model = false;
      if ($is_new){
        $inserted++;
        $edbo_model->attributes = $edbo_attributes;
        $result_of_saving_new_model = $edbo_model->save();
      }
      if ($is_new && !$result_of_saving_new_model && !empty($edbo_model->errors)){
        $err_msgs = array();
        foreach ($edbo_model->errors as $ferrors){
          foreach ($ferrors as $err){
            $err_msgs[] = $err;
          }
        }
        $err_msg = implode(' & ',$err_msgs);
        return array(false,'error (Row:'.$id.') '
            .
            $err_msg);
      }
      if ($is_new && $result_of_saving_new_model){
        continue;
      }
      
      $result_of_saving_existing_model = false;
      if ($is_change){
        $updated++;
        $edbo_existing_model->attributes = $edbo_attributes;
        
        $result_of_saving_existing_model = $edbo_existing_model->save();
        
      }
      if ($is_change && !$result_of_saving_existing_model && !empty($edbo_existing_model->errors)){
        $err_msgs = array();
        foreach ($edbo_existing_model->errors as $ferrors){
          foreach ($ferrors as $err){
            $err_msgs[] = $err;
          }
        }
        $err_msg = implode(' & ',$err_msgs);
        return array(false,'error (Row:'.$id.') '
            .
            $err_msg);
      }
      /**********************************************************/
    }
    $at_all = $id;
    //повернення лічильників
    return array($inserted,$updated,$at_all);
  }
  
  

}
