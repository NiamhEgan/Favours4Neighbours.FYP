<?php

namespace App\Libraries;

class ViewManager
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

    public static function load403ErrorViewIntoClientMasterPage($viewData = [])
    {
        $data = [
            'mainContent' => view("403", $viewData),
            'navTemplate' => "nav-client.php",
            'title' => 'Favours 4 Neighbours: Unauthorised access',
        ];

        return view("MasterPage", $data);
    }
    
    public static function loadViewIntoClientMasterPage($title, $view, $viewData = [])
    {
		$session = \Config\Services::session();

        $data = [
            'mainContent' => view($view, $viewData),
            'navTemplate' => "nav-client.php",
            'title' => "Favours 4 Neighbours: $title",
            'username' => $session->get('Username'),
        ];

        return view("MasterPage", $data);
    }
    public static function loadViewIntoMasterPage($title, $view, $viewData = [])
    {
        $data = [
            'mainContent' => view($view, $viewData),
            'navTemplate' => "nav-public.php",
            'title' => $title,
        ];

        return view("MasterPage", $data);
    }


    public static function load403ErrorViewIntoAdminMasterPage($viewData = [])
    {
        $data = [
            'mainContent' => view("403", $viewData),
            'navTemplate' => "nav-admin.php",
            'title' => 'Favours 4 Neighbours: Unauthorised access',
        ];

        return view("MasterPageAdmin", $data);
    }

    public static function load404ErrorViewIntoClientMasterPage($message)
    {
        $viewData =['message'=>$message];
        $data = [
            'mainContent' => view("404", $viewData),
            'navTemplate' => "nav-client.php",
            'title' => 'Favours 4 Neighbours: Unauthorised access',
        ];

        return view("MasterPage", $data);
    }

}
