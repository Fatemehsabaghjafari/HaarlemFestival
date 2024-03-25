<?php
class ArrayRouter {
    public function route($uri) {
      
        $routes = array(
            '' => array(
                'controller' => 'homecontroller',
                'method' => 'index'
            ),

            'login' => array(
                'controller' => 'logincontroller',
                'method' => 'index'
            ),

            'register' => array(
               'controller' => 'registercontroller', 
                'method' => 'index'
             ),

            'artCulture' => array(
                'controller' => 'artCulturecontroller', 
                 'method' => 'index'
            ),

            'personalProgram' => array(
                'controller' => 'personalProgramcontroller', 
                 'method' => 'index'
            ),
            'history' => array(
                'controller' => 'historycontroller', 
                 'method' => 'index'
            ),

            'foodies' => array(
                'controller' => 'foodiescontroller', 
                 'method' => 'index'
            ),

            
            'dance' => array(
                'controller' => 'dancecontroller', 
                 'method' => 'index'
            ),

            'nicky' => array(
                'controller' => 'dancecontroller', 
                 'method' => 'nicky'
            ),

            'martin' => array(
                'controller' => 'dancecontroller', 
                 'method' => 'martin'
            ),

            'danceapi' => array(
                'controller' => 'danceapicontroller', 
                 'method' => 'index'
            ),

            'dancePersonalProgramApi' => array(
                'controller' => 'dancePersonalProgramApicontroller', 
                 'method' => 'index'
            ),

            'admin' => array(
                'controller' => 'admincontroller', 
                 'method' => 'index'
            ),

            'adminApi' => array(
                'controller' => 'adminApicontroller', 
                 'method' => 'index'
            ),

            

            
        );

        // Add this method to handle JSON responses
     function jsonResponse($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

        // deal with undefined paths first
        if(!isset($routes[$uri]['controller']) || !isset($routes[$uri]['method'])) {
            http_response_code(404);
            die();
        }

        // dynamically instantiate controller and method
        $controller = $routes[$uri]['controller'];
        $method = $routes[$uri]['method'];

        require __DIR__ . '/controllers/' . $controller . '.php';
        $controllerObj = new $controller;
        $controllerObj->$method();
    }
}
?>