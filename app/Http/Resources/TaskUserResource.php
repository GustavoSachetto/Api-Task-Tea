<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray(Request $request)
    {
        return [
            'id'               => $this->id,
            'done'             => (bool) $this->done,
            'finished_at'      => $this->finished_at,
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at,
            'difficult_level'  => $this->difficult_level,
            'task'             => $this->task ? new TaskResource($this->task): null,
            'user_receiver'    => $this->userReceiver ? new UserResource($this->userReceiver) : null,
        ];
    }
}
