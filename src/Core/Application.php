<?php

namespace Core;

use Pimple\Container;
use Zend\Config\Config;
use Zend\Db\Adapter\Adapter;
use Apiki_Buscape_API;
use Core\Brain;

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

    public function initialize()
    {
        $this->initConfig();
        $this->initDatabase();
        $this->initServices();

        return $this;
    }

    public function run()
    {
        $brain = new Brain($this);
        $offer = $brain->think();

        return $offer;
    }

    protected function initConfig()
    {
        $this['Config'] = function () {
            $config = include __DIR__ . '/../../config/local.php';

            return new Config($config);
        };
    }

    protected function initDatabase()
    {
        $this['Zend\Db'] = $this->protect(function () {
            $adapter = $this['Config']->adapter;

            return new Adapter($adapter);
        });
    }

    public function initServices()
    {
        $this['BuscapeAPI'] = function () {
            $configBuscape = $this['Config']->buscape;

            $buscape = new Apiki_Buscape_API($configBuscape->applicationId);
            $buscape->setFormat('json');
            $buscape->setSandbox();

            return $buscape;
        };
    }
}
