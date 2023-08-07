<?php

namespace App\Observers;

use App\Notifications\DeleteRecord;
use App\Models\Queue;

class QueueObserver
{
    /**
     * Handle the Queue "created" event.
     *
     * @param  \App\Models\Queue  $queue
     * @return void
     */
    public function created(Queue $queue)
    {
        //
    }

    /**
     * Handle the Queue "updated" event.
     *
     * @param  \App\Models\Queue  $queue
     * @return void
     */
    public function updated(Queue $queue)
    {
        //
    }

    /**
     * Handle the Queue "deleted" event.
     *
     * @param  \App\Models\Queue  $queue
     * @return void
     */
    public function deleted(Queue $queue)
    {
        $queues = $queue->guests;
        $guests = Queue::all();
        foreach ($guests as $guest) {
            $guest->notify(new DeleteRecord($queue, $queues));
        }
    }

    /**
     * Handle the Queue "restored" event.
     *
     * @param  \App\Models\Queue  $queue
     * @return void
     */
    public function restored(Queue $queue)
    {
        //
    }

    /**
     * Handle the Queue "force deleted" event.
     *
     * @param  \App\Models\Queue  $queue
     * @return void
     */
    public function forceDeleted(Queue $queue)
    {
        //
    }
}
