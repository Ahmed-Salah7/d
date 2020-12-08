<?php

namespace App\Observers;

use App\EmploymentContract;
use Carbon\Carbon;

class EmploymentContractObserver
{
    /**
     * Handle the employment contract "created" event.
     *
     * @param  \App\EmploymentContract  $employmentContract
     * @return void
     */
    public function created(EmploymentContract $employmentContract)
    {
        //
    }

    /**
     * Handle the employment contract "updated" event.
     *
     * @param  \App\EmploymentContract  $employmentContract
     * @return void
     */
    public function updated(EmploymentContract $employmentContract)
    {
        //
    }

    public function updating(EmploymentContract $employmentContract)
    {
        if(
            ( request()['date']['date_of_contract'] > Carbon::now()->subDays(90)->toDateString())
            && ( $employmentContract->getOriginal('date_of_contract') <= Carbon::now()->subDays(90)->toDateString())
            && ($employmentContract->status == 1)
            && ($employmentContract->getOriginal('date_of_contract') != request()['date']['date_of_contract'])
        ){
            $employmentContract->compleated = 1;
        }
    }

    /**
     * Handle the employment contract "deleted" event.
     *
     * @param  \App\EmploymentContract  $employmentContract
     * @return void
     */
    public function deleted(EmploymentContract $employmentContract)
    {
        //
    }

    /**
     * Handle the employment contract "restored" event.
     *
     * @param  \App\EmploymentContract  $employmentContract
     * @return void
     */
    public function restored(EmploymentContract $employmentContract)
    {
        //
    }

    /**
     * Handle the employment contract "force deleted" event.
     *
     * @param  \App\EmploymentContract  $employmentContract
     * @return void
     */
    public function forceDeleted(EmploymentContract $employmentContract)
    {
        //
    }
}
