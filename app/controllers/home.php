<?php

class Home extends Controller
{
    function index()
    {  
        $data['page_title']="Home"; 
        //show($data[0]->images);
       $this->view("minima/index",$data);
    }

   
}