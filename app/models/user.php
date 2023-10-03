<?php

class User
{
    function login($POST)        //$POST to nasza zmienna, nie _POST
    {
        $DB = new Database();
        $_SESSION['error'] = "";

        if (isset($POST['username']) && isset($POST['password'])) {
            $arr['username'] = $POST['username'];
            $arr['password'] = $POST['password'];

            $query = "SELECT * FROM users WHERE username = :username && password = :password LIMIT 1 ";
            $data =  $DB->read($query, $arr);

            if (is_array($data)) {   //gdy zalogowany
                $_SESSION['user_id'] = $data[0]->userid;
                $_SESSION['user_name'] = $data[0]->username;
                $_SESSION['user_url'] = $data[0]->url_address;
            } else {
                $_SESSION['error'] = "zly login lub haslo";
            }
        } else {
            $_SESSION['error'] = "prosze podac poprawny login i haslo";
        }
    }



    function signup($POST)
    {
        $DB = new Database();
        $_SESSION['error'] = "";

        if (isset($POST['username']) && isset($POST['password'])) {
            $arr['username'] = $POST['username'];
			$arr['password'] = $POST['password'];
            $arr['email'] = $POST['email'];
            $arr['url_address'] = get_random_string_max(60);
            $arr['date'] = date("Y-m-d H:i:s");

            $query = "INSERT INTO users (username,password,email,url_address,date) VALUES (:username,:password,:email,:url_address,:date)";
            $data =  $DB->write($query, $arr);

            if ($data) {   //gdy zalogowany
                header("Location:" . ROOT . "login");
                die;
            }
        } else {
            $_SESSION['error'] = "prosze podac poprawny login i haslo";
        }
    }





    function check_logged_in()
    {
        $DB = new Database();

        if (isset($_SESSION['user_url'])) 
        {
            $arr['user_url'] = $_SESSION['user_url'];

            $query = "SELECT * FROM users WHERE url_address = :user_url LIMIT 1 ";
            $data =  $DB->read($query, $arr);

            if (is_array($data)) {   //gdy zalogowany
                $_SESSION['user_id'] = $data[0]->userid;
                $_SESSION['user_name'] = $data[0]->username;
                $_SESSION['user_url'] = $data[0]->url_address;

                return true;
            }
        }
        return false;
    }
}
