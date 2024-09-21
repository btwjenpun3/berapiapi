<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HubDefinition extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function hub()
    {
        return $this->belongsTo(Hub::class, 'hub_id', 'id');
    }

    public function setEndpointAttribute($value)
    {
        $this->attributes['endpoint'] = $value === '' ? null : $value;
    }
}
