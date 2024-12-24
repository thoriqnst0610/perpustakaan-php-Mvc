<?php

namespace perpustakaan\App;

class View
{

    public static function render(string $view, $model)
    {

        // var_dump($view);
        // exit();

        if($view == "user/login" || $view == "User/login" || $view == "user/register" || $view == "/laporan/laporan" ||
         $view == "User/register"){


        }else{

            require __DIR__ . '/../View/header.php';

        }
        
        require __DIR__ . '/../View/' . $view . '.php';
        
        if($view == "user/login" || $view == "User/login" || $view == "user/register" || $view == "/laporan/laporan" ||
         $view == "User/register"){


        }else{

            require __DIR__ . '/../View/footer.php';

        }
        
    }

    public static function redirect(string $url)
    {
        header("Location: $url");
        if (getenv("mode") != "test") {
            exit();
        }
    }

}