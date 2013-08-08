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
        
        
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-combobox.css" media="screen" />
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-typeahead.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-combobox.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/spin.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/blockUI.js"></script>
        
        
        
       
</head>

<body>
    <div id="loader" style="display: none;"></div>
    <script>
        
        function blockUI(){
              $.blockUI({ message: $('#loader'),
                css: { 
                    top:  ($(window).height()) /2 + 'px', 
                    left: ($(window).width()) /2 + 'px', 
                    width: '200px',
                    border:         'none', 
                    backgroundColor:'none',
                    'z-index': 1060
                } 
            });
        }
        function unblockUI(){
             $.unblockUI();
        }
        $(document).ajaxStart(function(){
            blockUI();
        }).ajaxStop(function(){
            unblockUI();
        });
        
         $(document).ready(function(){
         
          var opts = {
            lines: 13, // The number of lines to draw
            length: 55, // The length of each line
            width: 15, // The line thickness
            radius: 45, // The radius of the inner circle
            corners: 1, // Corner roundness (0..1)
            rotate: 0, // The rotation offset
            direction: 1, // 1: clockwise, -1: counterclockwise
            color: '#000', // #rgb or #rrggbb
            speed: 1, // Rounds per second
            trail: 60, // Afterglow percentage
            shadow: true, // Whether to render a shadow
            hwaccel: true, // Whether to use hardware acceleration
            className: 'spinner', // The CSS class to assign to the spinner
            zIndex: 2e9, // The z-index (defaults to 2000000000)
            top: 'auto', // Top position relative to parent in px
            left: 'auto' // Left position relative to parent in px
          };
        var target = document.getElementById('loader');
        var spinner = new Spinner(opts).spin(target);     
        });
        
        
    </script>
    <?php 
    $pkname = WebUser::getPkName();
    $this->widget('bootstrap.widgets.TbNavbar',array(
        //'type'=>'inverse', // null or 'inverse'
        'brand'=>'ЗНУ (Абітурієнт)',
        'brandUrl'=>'/',
        'collapse'=>true,
        'items'=>array(
            array(
                'class'=>'bootstrap.widgets.TbMenu',
                'items'=>array(
                    array('label'=>'Головна', 'url'=>array('/site/index'), "icon"=>"icon-home"),
                    array('label'=>'Контакти', 'url'=>array('/site/contact'), "icon"=>"icon-envelope", 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Довідники', 'visible'=>Yii::app()->user->checkAccess('showDirectiries'),
                         'url'=>'#', "icon"=>"icon-book", 'items'=> Directories::listMenu()),
                    array('label'=>'Звіти', 'visible'=>Yii::app()->user->checkAccess('showReports'),
                          'url'=>Yii::app()->createUrl('statistic'), "icon"=>"icon-book", ),
                 ),
            ),
            array(
                'class'=>'bootstrap.widgets.TbMenu',
                'htmlOptions'=>array('class'=>'pull-right'),
                'items'=>array(
                    array('label'=>'Налаштування', 'visible'=>  Yii::app()->user->checkAccess('showProperties'),'url'=>"#", "icon"=>"icon-wrench",
                          'items'=>array(
                                 array('label'=>'Користувачі', 'url'=>Yii::app()->createUrl("user"), "icon"=>" icon-user", ),
                                 array('label'=>'Групи користувачів', 'url'=>Yii::app()->createUrl("srbac"), "icon"=>"icon-lock", ),
                                 array('label'=>'Керування довідниками', 'url'=>Yii::app()->createUrl("directories"), "icon"=>"icon-pencil", ),
                           )
                        ),
                    array('label'=>'Авторизуватися', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest, 'icon'=>"icon-user"),
                    array('label'=>'Вийти з системи ('.Yii::app()->user->name.(empty($pkname)? "":"/".$pkname).')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest, 'icon'=>"icon-user")
                ),
                
            ),
        ),
    )); 
    ?>

    

<div class="container" id="page">
 
        <?php echo $content; ?>
  
    <hr>
    <footer>
        <div style="margin: 0 auto; width: 500px;">© Кафедра математичного моделювання  2013</div>
    </footer>
</div><!-- page -->

</body>
</html>
