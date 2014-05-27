<?php

namespace Core;

use Core\Application;
use Core\Search;

/**
 * Description of Brain
 *
 * @author Olavo Neto <olavocn.neto@gmail.com>
 */
class Brain
{

    /**
     *
     * @var Core\Application
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function think()
    {
        $args = [
            'keyword' => 'tv'
        ];

         $offer = $this->offer($args);

         $s = new Search('TV philips 42 polegadas');

         foreach ($offer->offer as $off) {
             $s->setOffer($off);
             $s->process();
         }

         return $s->theBest();
    }

    protected function offer(array $args)
    {
        return json_decode($this->app['BuscapeAPI']->findOfferList($args));
    }
}
