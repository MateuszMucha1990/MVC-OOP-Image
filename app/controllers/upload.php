<?php

class Upload extends Controller
{
    function index()
    {  
    //     $data['page_title']="Upload"; 
    //    $this->view("minima/upload",$data);
       header("Location:" . ROOT . "upload/image");
            die;
    }


    function image()
    {  
        $user = $this->loadModel('user');   // ladowanie modeluz User
      show($user);
        if(!$result = $user->check_logged_in()) //Spr czy jest zalogowany
        {
            header("Location:" . ROOT . "login");
            die;
        }
        
        
        $data['page_title']="Upload"; 
       $this->view("minima/upload",$data);
    }

   
}