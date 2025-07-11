<!-- <?php
namespace App\core;
use App\core\Database;

use App\core\Routeur;


 class App
{
    private static array $container = [];
    private static bool $initialized = false;

    private static function initialize(): void
    {
        if (self::$initialized) {
            return;
        }

        $dependencies = [
            'core' => [
                // 'router' => Routeur(),
                'database' => Database::getInstance(),
                'session' => Session::class,
                'validator' => Validator::class,
                
            ],
            'abstract' => [
                'abstractRepo' => AbstractRepository::class,
                'abstractController' => AbstractController::class,
                'abstractEntity' => AbstractEntity::class,
            ],
            'services' => [
              
            ],
            'repositories' => [
                
            ]
        ];

        foreach ($dependencies as $category => $services) {
            foreach ($services as $key => $class) {
                // self::$container[$category][$key] = fn() => $class::getInstance();
            }
        }

        self::$initialized = true;
    }

    
    public static function getDependency(string $category, string $key)
    {
        self::initialize();

        if (!isset(self::$container[$category][$key])) {
            throw new \Exception("Dependency '{$key}' not found in category '{$category}'");
        }

        $dependency = self::$container[$category][$key];

        if (is_callable($dependency)) {
            self::$container[$category][$key] = $dependency();
        }

        return self::$container[$category][$key];
    }
} 