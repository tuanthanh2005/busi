<?php
class Controller
{
    public function model($model)
    {
        $modelPath = __DIR__ . '/../Models/' . $model . '.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $model();
        }
        return null;
    }

    public function view($view, $data = [])
    {
        $viewPath = __DIR__ . '/../Views/' . $view . '.php';
        if (file_exists($viewPath)) {
            extract($data);
            require_once $viewPath;
        } else {
            die('View does not exist: ' . $view);
        }
    }
}
