<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 27/09/2017
 * Time: 09:39 AM
 */

namespace Modules\Users\Repositories;


use Modules\Users\Models\User;

class UsersRepository
{
    /**
     * @var User
     */
    private $user;


    /**
     * UsersRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param $user_id
     * @return User
     */
    public function getUserById($user_id)
    {
        return $this->user->find($user_id);
    }

    public function getRecommendedUsers()
    {
        return $this->user
            ->latest()
            ->has('posts', '>=', 4)
            ->take(20)
            ->get()
            ;
    }

    /**
     * @param $username
     * @return User
     */
    public function getUserByUsername($username)
    {
        return $this->user->where('username', $username)->first();
    }
}