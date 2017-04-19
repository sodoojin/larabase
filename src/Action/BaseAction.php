<?php

namespace Visualplus\Larabase\Action;

abstract class BaseAction
{
    /**
     * @var array
     */
    private $performedData = [];

    /**
     * @param $tag
     * @param $data
     * @return void
     */
    public function addPerformedData($tag, $data)
    {
        $this->performedData[$tag] = $data;
    }

    /**
     * @return array
     */
    abstract public function getData();

    /**
     * @return array
     */
    abstract public function getJobs();
}