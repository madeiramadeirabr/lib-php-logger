# Laravel

1. [Instalação](instalacao.md)
2. Registrando o provider
- Acesse App\Providers
- Registre o Logger

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MadeiraMadeira\Logger\Core\Config;
use MadeiraMadeira\Logger\LoggerFactory;
use MadeiraMadeira\Logger\Core\Interfaces\LoggerInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LoggerInterface::class, LoggerFactory::class);
        $this->app->singleton(LoggerFactory::class, function() {
            return (new LoggerFactory)->createLoggerInstance(
                new Config([
                    'level' => env('LOG_LEVEL', 'INFO'),
                    'serviceName' => env('APP_NAME', '<app Name>')
                ])
            );  
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
```
- Em qualquer lugar que queira usar estará disponível o Logger. Basta declarar no constructor a interface LoggerInterface. Exemplo:
```php
<?php

namespace App\Services;

use MadeiraMadeira\Logger\Core\Interfaces\LoggerInterface;

class ExampleService
{
    
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function foo()
    {
        $this->logger->info("Bar");
    }
}

```