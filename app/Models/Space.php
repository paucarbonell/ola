<?php

namespace App\Models;

use App\Models\User;
use App\Models\Address;
use App\Models\Comment;
use App\Models\Service;
use App\Models\Modality;
use App\Models\SpaceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Space extends Model
{
    use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'regNumber',
    'observation_CA',
    'observation_ES',
    'observation_EN',
    'phone',
    'email',
    'website',
    'accessType',
    'totalScore',
    'countScore',
    'space_type_id',
    'address_id',
    'user_id',
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
  public function address()
  {
    return $this->belongsTo(Address::class, 'address_id');
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function spaceType()
  {
    return $this->belongsTo(SpaceType::class, 'space_type_id');
  }

  public function modalities()
  {
    return $this->belongsToMany(Modality::class, 'modality_space');
  }

  public function services()
  {
    return $this->belongsToMany(Service::class, 'service_space');
  }

  public function comments()
  {
    return $this->hasMany(Comment::class);
  }
}
