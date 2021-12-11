<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kudos()
    {
        return $this->hasMany(Kudo::class);
    }

    public function board_type()
    {
        return $this->belongsTo(BoardType::class, 'board_type_id');
    }
}
