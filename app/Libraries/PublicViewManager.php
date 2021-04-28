<?php

namespace App\Libraries;

class PublicViewManager
{
    public static function loadView($title, $view, $viewData = [])
    {
        $data = [
            'mainContent' => view($view, $viewData),
            'navTemplate' => "nav-public.php",
            'title' => "Favours 4 Neighbours: $title",
        ];

        return view("MasterPage", $data);
    }
    public static function load403Error($viewData = [])
    {
        return self::loadView('Unauthorised access', '403', $viewData);
    }
    public static function load404Error($message)
    {
        $viewData = ['message' => $message];
        return self::loadView('Resource not found', '404', $viewData);
    }
}