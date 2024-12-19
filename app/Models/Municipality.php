<?php

namespace App\Models;

use App\Models\Island;
use App\Models\Address;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'island_id'
    ];

    /**
     * The attributes that are automatic.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function island()
    {
        return $this->belongsTo(Island::class, 'island_id');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
