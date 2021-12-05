<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientComplaint extends Model
{
    protected $fillable = [
        'user_id',
        'bin_id',
        'title',
        'description',
        'address_1',
        'address_2',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/client-complaints/'.$this->getKey());
    }
}
