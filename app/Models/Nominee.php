<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nomination;


class Nominee extends Model
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
   public function index() {
    // Fetch nominations with nominee info
    $nominations = Nomination::orderBy('created_at', 'desc')->paginate(10);

    return view('admin.nominees.index', compact('nominations'));
}
    // Relation to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relation to Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relation to Votes
    public function votes()
    {
         return $this->hasMany(Vote::class);
    }
    public function nominations()
{
    return $this->hasMany(Nomination::class);
}


}