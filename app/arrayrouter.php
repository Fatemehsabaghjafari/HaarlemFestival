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

            'logout' => array(
                'controller' => 'logoutcontroller',
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

            'foodies' => array(
                'controller' => 'foodiescontroller', 
                 'method' => 'index'
            ),
                      
            'dance' => array(
                'controller' => 'dancecontroller', 
                 'method' => 'index'
            ),

            'NickyRomero' => array(
                'controller' => 'dancecontroller', 
                 'method' => 'nicky'
            ),

            'MartinGarrix' => array(
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

            'danceAdmin' => array(
                'controller' => 'admincontroller', 
                 'method' => 'danceAdmin'
            ),
            'danceVenues' => array(
                'controller' => 'admincontroller', 
                 'method' => 'danceVenueAdmin'
            ),

            'adminDanceVenueApi' => array(
                'controller' => 'adminDanceVenueApicontroller', 
                 'method' => 'index'
            ),

            'forgot-password' => array(
                'controller' => 'forgotPasswordcontroller', 
                 'method' => 'index'
            ),
 
            'yummy' => array(
                'controller' => 'yummycontroller', 
                 'method' => 'index'
            ),

            'ratatouille' => array(
                'controller' => 'ratatouillecontroller', 
                 'method' => 'index'
            ),

            'toujours' => array(
                'controller' => 'toujourscontroller', 
                 'method' => 'index'
            ),
            
            'reservation' => array(
                'controller' => 'reservationcontroller', 
                 'method' => 'index'
            ),

            'manageAccount' => array(
                'controller' => 'manageUserAccountcontroller', 
                 'method' => 'index'
            ),

            'manageAccount/api' => array(
                'controller' => 'manageUserAccountApicontroller', 
                 'method' => 'index'
            ),

            'userAdmin' => array(
                'controller' => 'admincontroller', 
                 'method' => 'userAdmin'
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