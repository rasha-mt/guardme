<?php

namespace Modules\Wallet\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Wallet\Wallet;

class Transactions extends Model
{
    //
   protected $guarded = ['id'];

    protected $table = 'transactions';
        protected $fillable=[
      'id',
      'wallet_id',
      'trans_type',
      'trans_status',
      'amount',
      'confirm',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

}
