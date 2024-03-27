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
            'api/personalprogram' => array(
                'controller' => 'personalProgramAPIController', 
                'method' => 'index',
                'api' => true
            ),
            'api/personalprogram/updateticket' => array(
                'controller' => 'personalProgramAPIController', 
                'method' => 'updateTicketQuantity',
                'api' => true
            ),
            'api/personalprogram/deleteticket' => array(
                'controller' => 'personalProgramAPIController', 
                'method' => 'deleteTicket',
                'api' => true
            ),
            'api/personalprogram/setactivestatus' => array(
                'controller' => 'personalProgramAPIController', 
                'method' => 'setActiveStatus',
                'api' => true
            ),
            'history' => array(
                'controller' => 'historycontroller', 
                 'method' => 'index'
            ),

            'foodies' => array(
                'controller' => 'foodiescontroller', 
                 'method' => 'index'
            ),
            'checkout' => array(
                'controller' => 'checkoutcontroller', 
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
        $api = $routes[$uri]['api'] ?? false;

        if ($api) {
            require __DIR__ . '/api/controllers/' . $controller . '.php';
        } else {
            require __DIR__ . '/controllers/' . $controller . '.php';
        }
        
        $controllerObj = new $controller;
        $controllerObj->$method();
    }
}
?>