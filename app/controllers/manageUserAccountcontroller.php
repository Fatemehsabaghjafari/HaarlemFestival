<?php
session_start();
require __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/loginservice.php';

class ManageUserAccountController extends Controller
{

    private $loginService;

    public function __construct()
    {
        $this->loginService = new \App\Services\LoginService();
    }

    public function index()
    {


        if (isset($_SESSION['user'])) {

            include '../views/manageUserAccount.php';

        } else {
            echo 'please login first! <a href="/login">Login</a> ';

        }


    }


}
