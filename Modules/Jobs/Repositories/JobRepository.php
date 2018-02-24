<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 25/01/2018
 * Time: 04:28 PM
 */

namespace Modules\Jobs\Repositories;


use Modules\Account\Models\Role;
use Modules\Jobs\Events\JobWasCreated;
use Modules\Jobs\Models\Job;
use Modules\Users\Models\User;

class JobRepository
{
    /**
     * @var Job
     */
    private $job;


    /**
     * JobRepository constructor.
     * @param Job $job
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    /**
     * @param array $data
     * @return Job
     */
    public function saveJob(array $data)
    {
        $job = $this->job->create([
            'company_id' => $data['company'],
            'title' => $data['title'],
            'description' => $data['description'],
            'time_start' => strToDbTime($data['time']['start']),
            'time_end' => strToDbTime($data['time']['end']),
            'wages' => $data['wages'],
            'rating' => $data['rating'],
            'postcode' => $data['postcode'],
            'metadata' => json_encode([
                'broadcasts_config' => $data['broadcastsConfig'],
                'address' => $data['address'],
            ])
        ]);

        publish(new JobWasCreated($job, $data));

        return $job;
    }

    private function buildAddress(array $address_data)
    {
        $address_string = '';

        $city = $address_data['city'];
        $county = $address_data['county'];

        foreach ($address_data as $line){
            if(!is_array($line) && count_chars($line) > 0){
                $address_string .= $line . ',';
            }
        }
        $address_string .= $city . ',';
        $address_string .= $county;

        return $address_string;
    }

    /**
     * Gets available jobs for a user
     * for instance:
     * (employer) = gets jobs created by the employer
     * (job seeker) = gets jobs associated to the job seeker
     *
     * @param User|null $user
     * @return array
     */
    public function getUserActiveJobs(User $user = null)
    {
        if(!$user) $user = auth()->user();

        /**
         * @var Role $primaryRole
         */
        $primaryRole = $user->getPrimaryRole();

        $jobs = [];

        switch ($primaryRole->name){
            case config('guardme.acl.Employer'):
                $jobs = $user->createdJobs()->latest()->get();
                break;
        }

        return $jobs;
    }
}