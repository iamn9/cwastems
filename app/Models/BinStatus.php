<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BinStatus extends Model
{
    protected $fillable = [
        'bin_id',
        'status',
        'remarks',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/bin-statuses/'.$this->getKey());
    }
}
