<?php
namespace Visualplus\Larabase\Contracts;

/**
 * Interface Presentable
 * @package Visualplus\Larabase\Contracts
 */
interface Presentable
{
    /**
     * @param PresenterInterface $presenter
     *
     * @return mixed
     */
    public function setPresenter(PresenterInterface $presenter);

    /**
     * @return mixed
     */
    public function presenter();
}
