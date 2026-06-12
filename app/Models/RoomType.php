<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model
{
    protected $fillable = ['name', 'description', 'capacity', 'facilities', 'image'];

    protected function casts(): array
    {
        return [
            'facilities' => 'array',
            'image' => 'string',
        ];
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
}
