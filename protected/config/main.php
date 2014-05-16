<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Абітурієнт',
        'sourceLanguage'=>'uk',
        'language'=>'uk',
        //'theme'=>'bootstrap',

	// preloading 'log' component
	'preload'=>array('log'),
    

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
                'application.controllers.directory.*',
                'application.models.directory.*',
		'application.components.*',
                'application.modules.srbac.controllers.SBaseController',
                'ext.EHttpClient.*',
                'ext.EHttpClient.adapter.*',
                'ext.EWideImage.EWideImage',
         ),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'srbac' => array(
                    'userclass' => 'User',
                    'userid' => 'id',
                    'username' => 'username',
                    'debug' => true,
                    'delimeter'=>"@",
                    'pageSize' => 10,
                    'superUser' => 'Root',
                    'css' => 'srbac.css',
                    'layout' => 'application.views.layouts.main',
                    'notAuthorizedView' => 'srbac.views.authitem.unauthorized',
                    'alwaysAllowed'=>array(),
                    //'userActions' => array('show', 'View', 'List'),
                    'listBoxNumberOfLines' => 15,
                    'imagesPath' => 'srbac.images',
                    'imagesPack' => 'tango',
                    'iconText' => false,
                    'header' => 'srbac.views.authitem.header',
                    'footer' => 'srbac.views.authitem.footer',
                    'showHeader' => true,
                    'showFooter' => true,
                    'alwaysAllowedPath' => 'srbac.components',
                ),
		'gii'=>array(
                    
                    'generatorPaths'=>array(
                    'bootstrap.gii',
                    ), 
			'class'=>'system.gii.GiiModule',
			'password'=>'111',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
                "pfd"=>array(
                    'layout' => "/layouts/main",
                    'defaultController'=>"prices",
                   
                ),
                
		
	),

	// application components
	'components'=>array(
                'session' => array (
                        'autoStart' => true,
                 ),

                'authManager' => array(
                    'class' => 'srbac.components.SDbAuthManager',
                    'connectionID' => 'db',
                    'itemTable' => 'sys_roles',
                    'assignmentTable' => 'sys_roleassignments',
                    'itemChildTable' => 'sys_rolechildren',
                ),
		'user'=>array(
			'class'=>"WebUser",// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
                'bootstrap'=>array(
                    'class'=>'bootstrap.components.Bootstrap',
                ),
                
                'clientScript'=>array(
                    'packages'=>array(
                       // описание пакета catalog
                       'bootstrap-switch' => array(
                          'basePath'=>'ext.bootstrap-switch.static',
                          'js'=>array('js/bootstrapSwitch.js'),
                          'css'=>array('stylesheets/bootstrap-switch.css'),
                       ),
                   ),
                 ),
            
           
                
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'caseSensitive'=>false,
                        'showScriptName'=>false,
                        
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                                 
                               //  '<module>/<controller:\w+>/<id:\d+>'=>'<module>/<controller>/view',
                                 '<module>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
				 '<module>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
                           
			),
		),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=abiturient',
			'emulatePrepare' => true,
			 'username' => 'edbo',
			'password' => 'eU7InIl',    
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
          
		/*'log'=>array(
			'class'=>'CLogRouter',
                    'routes' => array(
                            array(
                                'class' => 'ext.phpconsole.PhpConsoleYiiExtension',
                                'handleErrors' => true,
                                'handleExceptions' => true,
                                'basePathToStrip' => dirname($_SERVER['DOCUMENT_ROOT'])
                            )
                        ),
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				/*array(
					'class'=>'CWebLogRoute',
				),//
				
			//),
		),*/
            /* Это тестовое сохранение */
            'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'ext.phpconsole.PhpConsoleYiiExtension',
                    'handleErrors' => false,
                    'handleExceptions' => false,
                    'basePathToStrip' => dirname($_SERVER['DOCUMENT_ROOT']."/abiturient/")
                ),
                
            // uncomment the following to show log messages on web pages
           
              /*array(
              'class'=>'CWebLogRoute',
              ),*/
                         ),
        ),
        ),
	

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
            
                'personSearchURL'=>":8080/PersonSearch/search.jsp",
                'documentSearchURL'=>":8080/PersonSearch/documents.jsp",
                'contactSearchURL'=>":8080/PersonSearch/contacts.jsp",
                'personAddURL'=>":8080/PersonSearch/personaddedbo.jsp",
            
                'printUrl'=>":8080/request_report-1.0/?",
                'photosPath'=>"/images/Photos/",
                'photosBigPath'=>"/images/Photos/big/",
                'defaultPersonPhoto'=>"180x240.gif",
            
	),
   
     
    
);
