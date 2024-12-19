<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name'
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
    'updated_at',
    'remember_token'
  ];
  public function users()
  {
    return $this->hasMany(User::class);
  }
}
