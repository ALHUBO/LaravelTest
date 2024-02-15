<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pub extends Model
{
    use HasFactory;
	protected $fillable = [
		'publicacion'
	];

	public function user():BelongsTo{
		return $this->belongsTo(User::class);
	}
}
