<?php

namespace Modules\Jobs\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Jobs\Http\Resources\JobResource;
use Modules\Jobs\Jobs\SaveJob;
use Modules\Jobs\Repositories\JobRepository;
use Modules\Users\Models\User;

class JobsController extends Controller
{
    public function newJobPage()
    {
        return view('jobs::create-job');
    }

    public function saveJob(JobRepository $jobRepository)
    {
        $data = \request()->all();

        $job = $jobRepository->saveJob($data);

        return $job;
    }

    public function schedule()
    {
        return view('jobs::job-schedule');
    }

    public function getAuthUserActiveJobs(JobRepository $jobRepository)
    {
        /**
         * @var User $user
         */
        $user = auth()->user();

        $jobs = $jobRepository->getUserActiveJobs($user);

        return JobResource::collection($jobs);
    }
}
