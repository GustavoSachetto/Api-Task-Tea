<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskUser extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'task_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'done',
        'difficult_level',
        'finished_at',
        'tasks_id',
        'user_receiver_id',
        'user_assigner_id'
    ];

    protected $dates = ['finished_at'];

    /**
     * Get the user who is the receiver of the task.
     */
    public function userReceiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_receiver_id');
    }

    /**      
     * Get the user who assigned the task.
     */
    public function userAssigner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_assigner_id');
    }

    /**
     * Get the task related to this pivot record.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'tasks_id');
    }
}