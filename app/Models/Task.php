<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'description', 'assigned_to', 'assigned_team', 'status', 'due_date'])]
class Task extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'due_date' => 'datetime',
        ];
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'assigned_team');
    }
}
