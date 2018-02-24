<?php

namespace Modules\Wallet\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Models\User;
use Modules\Wallet\Models\Transactions; 

class Wallet extends Model
{
    //
    protected $guarded = ['id'];

    protected $table = 'wallet';
        /*protected $fillable=[
      'id',
      'user_id',
      'account_id',
      'paypal_email',
      'balance',
      
    ];*/

 public function users()
    {
        return $this->hasOne(User::class);
    }

    public function trans()
    {
        return $this->hasMany(Transactions::class);
    }
    
}
