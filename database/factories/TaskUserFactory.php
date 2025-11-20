<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\UserRelationships;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskUser>
 */
class TaskUserFactory extends Factory
{
    private array $taskUser = [];
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->randomUserId();
        $this->randomTaskStatus();
        
        $this->taskUser['tasks_id'] = Task::inRandomOrder()->first()->id ?? Task::factory()->count(10);

        return $this->taskUser;
    }

    /**
     * Get a random user_assigner_id and user_receiver_id from the user_relationships in storage.
     */
    private function randomUserId(): void
    {
        $userRelationship = UserRelationships::inRandomOrder()->first();

        $this->taskUser['user_assigner_id'] = $userRelationship->user_id;
        $this->taskUser['user_receiver_id'] = $userRelationship->user_related_id;
    }

    /** 
     * Get a random task status if user finished the task.
    */
    private function randomTaskStatus(): void
    {
        if (fake()->boolean()) {
            $this->taskUser['done'] = true;
            $this->taskUser['difficult_level'] = fake()->optional()
                ->randomElement(['very easy', 'easy', 'medium', 'hard', 'very hard']);
                
            $this->taskUser['finished_at'] = fake()->dateTimeInInterval('-1 week', '+3 days');
        } else {
            $this->taskUser['done'] = false;
            $this->taskUser['difficult_level'] = null;
            $this->taskUser['finished_at'] = null;
        }
    }
}
