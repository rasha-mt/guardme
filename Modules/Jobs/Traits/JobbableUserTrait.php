<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 01/02/2018
 * Time: 12:39 PM
 */

namespace Modules\Jobs\Traits;


use Modules\Company\Models\Company;
use Modules\Jobs\Models\Job;

trait JobbableUserTrait
{

    public function createdJobs()
    {
        return $this->hasManyThrough(Job::class,Company::class);
    }

}