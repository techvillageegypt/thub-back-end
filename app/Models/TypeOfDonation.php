<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfDonation extends Model
{
    use HasFactory, ImageUploaderTrait;

    protected $table = 'type_of_donations';

    protected $fillable = [
        'donation_id',
        'donation_type_id'
    ];



    #################### Relation ########################

    /**
     * Get the donationType that owns the TypeOfDonation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function donationType()
    {
        return $this->belongsTo(DonationType::class);
    }
}
