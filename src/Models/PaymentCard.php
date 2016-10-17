<?php

namespace EdStevo\Billing\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentCard extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["type", "last4", "customer_id", "payment_id"];

    /**
     * Define the relationship to access the customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(config('billing.customer_model'));
    }
}