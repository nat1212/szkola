<?php
namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class PhpFileLogger
{
    public function __invoke(array $config)
    {
        $log = new Logger('php_file');

        $log->pushHandler(new StreamHandler(
            $config['path'] . '/' . date('Y-m-d') . '.php',
            $config['level']
        ));

        return $log;
    }
}
?>