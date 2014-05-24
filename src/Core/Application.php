<?php

namespace Core;
use Pimple\Container;
use Zend\Db\Adapter\Adapter;

/**
 * Description of Application
 *
 * @author Olavo Neto <olavocn.neto@gmail.com>
 */
class Application extends Container
{
    public function __construct()
    {
        parent::__construct();

        $app = $this;

        $app['version'] = '1.0.0.0';
    }

    protected function initialize() {
        $this->initDatabase();

        return $this;
    }

    protected function run() {
        
    }

    protected function initDatabase() {
        $this['Zend\Db'] = $this->protect(function () {
            $adapter = [
                'driver' => 'Pdo',
                'database' => 'bd',
                'username' => 'root',
                'password' => 'password',
                'hostname' => '127.0.0.1'
            ];

            return new Adapter($adapter);
        });
    }
}
