<?php

class About  extends Controller
{
    function index()
    {
        $data['page_title'] = "about";
        $this->view("minima/about-us",$data);
    }
}
