<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'description', 'status', 'start_date', 'due_date', 'assigned_team'])]
class Project extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'due_date' => 'datetime',
        ];
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'assigned_team');
    }
}
