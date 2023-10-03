<?php

class Controller{

    protected function view($view,$data = [])
	{
		if(file_exists("../app/views/". $view .".php"))
 		{
 			include "../app/views/". $view .".php";
           
 		}else{
 			include "../app/views/404.php";
 		}
	}


    protected function loadModel($model)
    {
        if (file_exists("../app/models/" . $model . ".php")) 
        {  
            include "../app/models/" . $model . ".php";
            echo 'ss2';
           return $model = new $model();   //gdy plik istnieje to inicjujemy
        }
        return false;
    }
}