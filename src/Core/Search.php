<?php

namespace Core;
use stdClass;

/**
 * Description of Search
 *
 * @author Olavo Neto <olavocn.neto@gmail.com>
 */
class Search
{


    protected $search;

    protected $offer;

    protected $podium = array();

    protected $history = array();

    public function __construct($search)
    {
        $this->search = $search;
    }

    public function process()
    {
        $offer = $this->getOffer();

        $points = $this->howManyPoints($offer->offer->offername);

        $this->setHistory($offer->offer->id, $points);
    }

    public function theBest()
    {
        $hystory = $this->getHistory();

        arsort($hystory, SORT_NUMERIC);

        $this->setPodium(array_slice($hystory, 0, 3, true));

        return $this->getPodium();
    }


    protected function howManyPoints($search)
    {
        $points = 0;
        $phrase = $this->explode($this->search);
        $search = $this->explode($search);

        foreach ($phrase as $w) {
            if (in_array($w, $search)) {
                $points++;
            }
        }

        return $points;
    }

    protected function explode($string)
    {
        return explode(" ", $string);
    }

    public function getOffer()
    {
        return $this->offer;
    }

    public function getPodium()
    {
        return $this->podium;
    }

    public function getHistory()
    {
        return $this->history;
    }

    public function setOffer(stdClass $offer)
    {
        $this->offer = $offer;
    }

    public function setPodium($podium)
    {
        $this->podium = $podium;
    }

    public function setHistory($offer, $points)
    {
        $this->history[$offer] = $points;
    }
}
