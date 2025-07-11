<?php
namespace App\core\middlewares;

use App\core\Session;

class AuthMiddleware {
    public function __invoke() {
        $session = Session::getInstance();
        if (!$session->get('Client') ) {
            header('Location: /');
            exit();
        }
    }
}

// && !$session->get('')