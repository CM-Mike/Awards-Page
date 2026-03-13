<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nomination extends Model
{
 protected $fillable = [
    'nominee_type',
    'name',
    'email',
    'phone',
    'category',
    'reason',
    'image',
    'nomination_count'
];
public function nominee()
{
    return $this->belongsTo(Nominee::class);
}
}
