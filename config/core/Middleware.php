<?php

namespace App\core;

use App\core\middlewares\AuthMiddleware;

class Middleware {
    private static array $middlewares = [
        'auth' => AuthMiddleware::class,
    ];
    
    // public static function apply(string $middlewareName): void {
    //     if (!isset(self::$middlewares[$middlewareName])) {
    //         throw new \RuntimeException("Middleware '$middlewareName' non trouvé");
    //     }
        
    //     $middlewareClass = self::$middlewares[$middlewareName];
    //     $middleware = new $middlewareClass();
        
    //     $middleware();
    // }
    
    // public static function register(string $name, string $class): void {
    //     self::$middlewares[$name] = $class;
    // }
    
    // public static function getMiddlewares(): array {
    //     return self::$middlewares;
    // }
}