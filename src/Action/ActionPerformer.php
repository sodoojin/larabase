<?php

namespace Visualplus\Larabase\Action;

use DB;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Database\DatabaseManager;

class ActionPerformer
{
    /**
     * @var Dispatcher
     */
    private $dispatcher;
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * ActionPerformer constructor.
     * @param Dispatcher $dispatcher
     * @param DatabaseManager $databaseManager
     */
    public function __construct(
        Dispatcher $dispatcher,
        DatabaseManager $databaseManager
    ) {
        $this->dispatcher = $dispatcher;
        $this->databaseManager = $databaseManager;
    }

    /**
     * @param BaseAction $action
     */
    public function perform(BaseAction $action)
    {
        $this->databaseManager->connection()->beginTransaction();

        foreach ($action->getTransactionalJobs() as $job) {
            $performedData = $this->dispatcher->dispatchNow(new $job($action));

            if ($performedData !== null) {
                $action->addPerformedData($job, $performedData);
            }
        }

        $this->databaseManager->connection()->commit();

        foreach ($action->getFinishJobs() as $finishJob) {
            $this->dispatcher->dispatch(new $finishJob($action));
        }
    }
}