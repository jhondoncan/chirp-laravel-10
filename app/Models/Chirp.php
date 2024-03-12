<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Chirp extends Model
{
  use HasFactory;

  protected $fillable = ['message', 'user_id'];

  // El modelo Chirp pertenece a un usuario -- Relacion de uno a muchos $user->chirps (un usuario tiene muchos chirps)
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
