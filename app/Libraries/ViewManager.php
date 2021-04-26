<?php

namespace App\Libraries;

class ViewManager
{
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
        $data = [
            'mainContent' => view($view, $viewData),
            'navTemplate' => "nav-client.php",
            'title' => $title,
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

    public static function loadViewIntoAdminMasterPage($title, $view, $viewData = [])
    {
        $data = [
            'mainContent' => view($view, $viewData),
            'navTemplate' => "nav-admin.php",
            'title' => $title,
        ];

        return view("MasterPageAdmin", $data);
    }

    public static function loadViewIntoMasterPageAdmin($title, $view, $viewData = [])
    {
        $data = [
            'mainContent' => view($view, $viewData),
            'navTemplate' => "nav-public.php",
            'title' => $title,
        ];

        return view("MasterPageAdmin", $data);
    }
}
