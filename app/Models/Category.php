<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    // Updated to include slug and icon for your awards setup
    protected $fillable = ['name', 'slug', 'icon', 'description', 'event_id'];

    /**
     * Relationship to Subcategories
     * This fixes the RelationNotFoundException
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }

    /**
     * Relationship to Nominees
     */
    public function nominees(): HasMany
    {
        return $this->hasMany(Nominee::class);
    }

    /**
     * Relationship to Votes
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * Relationship to Event
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class); 
    }
}