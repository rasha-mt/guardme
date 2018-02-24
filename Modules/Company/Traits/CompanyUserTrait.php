<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 01/02/2018
 * Time: 12:41 PM
 */

namespace Modules\Company\Traits;


use Modules\Company\Models\Company;

trait CompanyUserTrait
{

    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}