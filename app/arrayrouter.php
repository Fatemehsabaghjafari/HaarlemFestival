<?php
class ArrayRouter
{
    public function route($uri)
    {

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
            'scan' => array(
                'controller' => 'orderscontroller',
                'method' => 'scan'
            ),
            'foodies' => array(
                'controller' => 'foodiescontroller',
                'method' => 'index'
            ),

            'checkout' => array(
                'controller' => 'checkoutcontroller', 
                 'method' => 'index'
            ),
            'pay' => array(
                'controller' => 'paymentcontroller', 
                'method' => 'pay'
            ),
            'order-confirmation' => array(
                'controller' => 'paymentcontroller', 
                'method' => 'orderConfirmation'
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

            'danceArtistAdminApi' => array(
                'controller' => 'danceArtistAdminApicontroller',
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

            'danceEvents' => array(
                'controller' => 'admincontroller',
                'method' => 'danceEventAdmin'
            ),

            'adminDanceVenueApi' => array(
                'controller' => 'adminDanceVenueApicontroller',
                'method' => 'index'
            ),

            'adminDanceEventApi' => array(
                'controller' => 'adminDanceEventApicontroller',
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

            'userAdminApi' => array(
                'controller' => 'userAdminApicontroller',
                'method' => 'index'
            ),

            'orderAdmin' => array(
                'controller' => 'admincontroller',
                'method' => 'orderAdmin'
            ),

            'resetPassword' => array(
                'controller' => 'resetPasswordcontroller',
                'method' => 'reset'
            ),

            'resetPasswordSuccess' => array(
                'controller' => 'resetPasswordcontroller',
                'method' => 'updatePassword'
            ),
            'api/users' => array(
                'controller' => 'UserController',
                'method' => 'getUserById',
                'api' => true
            ),

            'exportCsv' => array(
                'controller' => 'exportcontroller',
                'method' => 'exportToCSV'
            ),
            'pages/:name' => array(
                'controller' => 'PagesController',
                'method' => 'index'
            ),
            'admin/pages' => array(
                'controller' => 'PagesController',
                'method' => 'listPages'
            ),
            'admin/createpage' => array(
                'controller' => 'PagesController',
                'method' => 'createPage'
            ),
            'admin/pageeditor/:name' => array(
                'controller' => 'PagesController',
                'method' => 'pageEditorView'
            ),
            'admin/deletepage' => array(
                'controller' => 'PagesController',
                'method' => 'deletePage'
            ),
            'admin/updatepage' => array(
                'controller' => 'PagesController',
                'method' => 'updatePage'
            ),
            'admin/pagepreview' => array(
                'controller' => 'PagesController',
                'method' => 'processPreviewContent'
            ),
        );

        // Add this method to handle JSON responses
        function jsonResponse($data)
        {
            header('Content-Type: application/json');
            echo json_encode($data);
            exit;
        }

        $uri = explode('?', $uri)[0];

        // Handle parameterized routes
        $params = [];
        $matchedRoute = null;

        foreach ($routes as $route => $routeData) {
            $routePattern = preg_replace('/:[^\/]+/', '([^\/]+)', $route);
            if (preg_match('@^' . $routePattern . '$@', $uri, $matches)) {
                array_shift($matches);
                $params = $matches;
                $matchedRoute = $routeData;
                break;
            }
        }

        // If no route matched, return 404
        if (!$matchedRoute) {
            http_response_code(404);
            die();
        }

        // Dynamically instantiate controller and method
        $controller = $matchedRoute['controller'];
        $method = $matchedRoute['method'];
        $api = $matchedRoute['api'] ?? false;

        if ($api) {
            require __DIR__ . '/api/controllers/' . $controller . '.php';
        } else {
            require __DIR__ . '/controllers/' . $controller . '.php';
        }

        $controllerObj = new $controller;
        if (!empty($params)) {
            call_user_func_array([$controllerObj, $method], $params);
        } else {
            $controllerObj->$method();
        }
    }
}
?>