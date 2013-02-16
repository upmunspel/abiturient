<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/datepicker.css" />
      
        
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php Yii::app()->bootstrap->register(); ?>
        <?php Yii::app()->clientScript->registerPackage('bootstrap-switch'); ?>
        
       
</head>

<body>
    
    <?php $this->widget('bootstrap.widgets.TbNavbar',array(
        //'type'=>'inverse', // null or 'inverse'
        'brand'=>'ЗНУ (Абітурієнт)',
        'brandUrl'=>'/',
        
        'items'=>array(
            array(
                'class'=>'bootstrap.widgets.TbMenu',
                'items'=>array(
                    array('label'=>'Головна', 'url'=>array('/site/index')),
                    array('label'=>'Контакти', 'url'=>array('/site/contact'), "icon"=>"icon-envelope"),
                    array('label'=>'Довідники', 'url'=>'#', 'items'=>array(
                        array('label'=>'Пільги', 'url'=>yii::app()->createUrl('Benefit/admin')),
                        array('label'=>'Країни громадянства', 'url'=>yii::app()->createUrl('Country/admin')),
                        array('label'=>'Статі', 'url'=>yii::app()->createUrl('PersonSexTypes/admin')),
                        array('label'=>'Школи', 'url'=>yii::app()->createUrl('Schools/admin')),
                        array('label'=>'Типи документів особи', 'url'=>yii::app()->createUrl('PersonDocumentTypes/admin')),
                        array('label'=>'Національності', 'url'=>'#'),
                       
                    )),
                ),
                
            ),
            array(
                'class'=>'bootstrap.widgets.TbMenu',
                'htmlOptions'=>array('class'=>'pull-right'),
                'items'=>array(
                    array('label'=>'Авторизуватися', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest, 'icon'=>"icon-user"),
                    array('label'=>'Вийти з системи ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest, 'icon'=>"icon-user")
                ),
                
            ),
        ),
    )); 
    ?>

    

<div class="container" id="page">
   
        <?php echo $content; ?>
  
    <hr>
    <footer>
        <div style="margin: 0 auto; width: 500px;">© Кафедра математичного моделювання  2012</div>
    </footer>
</div><!-- page -->

</body>
</html>
