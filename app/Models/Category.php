<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    // Relationship to votes
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    // Relationship to nominees
    public function nominees()
    {
        return $this->hasMany(Nominee::class);
    }

   
    public function event()
    {
        return $this->belongsTo(Event::class); 
    }
}