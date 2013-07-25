<?php

class DefaultController extends Controller
{
   // public $layout = "/layouts/main";
    public function actionIndex()
	{  //$this->layout
		$this->render('index');
	}
}