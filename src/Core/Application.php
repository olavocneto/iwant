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

        $this->initDatabase();
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
