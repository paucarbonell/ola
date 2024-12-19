<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modality extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description_CA',
        'description_ES',
        'description_EN'
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
    public function spaces()
    {
        return $this->belongsToMany(Space::class);
    }
}
