<?php

namespace App\Libraries;

/**
 * Admin View Manger
 * load views in to Admin Master Page
 */
class AdminViewManger
{
    public static function loadView($title, $view, $viewData = [])
    {
        $session = \Config\Services::session();

        $data = [
            'mainContent' => view($view, $viewData),
            'navTemplate' => "nav-admin.php",
            'title' => "Favours 4 Neighbours Admin: $title",
            'username' => $session->get('Username'),
        ];

        return view("MasterPageAdmin", $data);
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