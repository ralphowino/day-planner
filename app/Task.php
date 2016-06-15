<?php

namespace RalphowinoPlanner;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'description', 'start_at', 'due_at', 'assigned_to', 'created_by', 'status'];

    protected $casts = [
        'outcome' => 'json'
    ];

    protected $dates = ['start_at', 'due_at'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
