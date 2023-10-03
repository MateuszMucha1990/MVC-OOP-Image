<?php


class App
{
    private $controller = "home";
    private $method = "index";
    private $params = [];

    public function __construct()
    {       //ROUTE
        $url = $this->splitURL();

        if (file_exists("../app/controllers/" . strtolower($url[0]) . ".php")) 
        {  //jesli controller istnieje to
            $this->controller = strtolower($url[0]);   //przypisz 
            unset($url[0]);  //usun z Array
        }

        require "../app/controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller;  //jesli nie ma to stworz nowa klase

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

                //run the class and method
        $this->params = array_values($url);  // 'resetuje indexy w Arr' sa znowu od 0
        call_user_func_array([$this->controller, $this->method], $this->params);
    }



    private function splitURL()
    {             //chcehmy rozdzielic co w URL na poszczegolne elem
        $url = isset($_GET['url']) ? $_GET['url'] : "home"; //jesli nie ma to przypisz home
        return explode("/", filter_var(trim($url, "/"),FILTER_SANITIZE_URL));    //http://minima.localhost/public/pro/mild
    }
}
