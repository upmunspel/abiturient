<?php

class AccessToDictionaries{
    public static function getAccessRulesToDictionaries(){
        return array( 
           		array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('update','admin'),
				'users'=>array('Users'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('view','create','update','admin','delete'),
				'roles'=>array('Admins',"Root"),
			),
			array('deny',  // deny all users
                                //'actions'=>array('index'),
				'users'=>array('*'),
			), 
        );
    }
}
?>
