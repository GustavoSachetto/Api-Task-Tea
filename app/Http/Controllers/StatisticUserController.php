<?php
namespace App\Http\Controllers;

use App\Models\TaskUser;
use App\Models\UserRelationships;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\ForbiddenException;

class StatisticUserController extends Controller
{
    private int $totalPoints = 0;

    /** 
     * View authenticated user statistics.
    */
    public function myTotal()
    {
        return $this->total(Auth::user()->id);
    }

    /** 
     * View user statistics by from user id.
    */
    public function fetchTotal(string $userId)
    {
        $this->checkId($userId);
        $this->checkAuthUserIsRelated($userId);

        return $this->total($userId);
    }

    /** 
     * View statistics for the authenticated user's week.
    */
    public function myWeekly()
    {
        return $this->weekly(Auth::user()->id);
    }

    /** 
     * View statistics for the week of the user id.
    */
    public function fetchWeekly(string $userId)
    {
        $this->checkId($userId);
        $this->checkAuthUserIsRelated($userId);

        return $this->weekly($userId);
    }

    /** 
     * Check if authenticated user is related to the child user. 
     * 
     * @throws \App\Exceptions\ForbiddenException
    */
    private function checkAuthUserIsRelated(string $userId)
    {
        $userRelationship = UserRelationships::where('user_id', Auth::user()->id)
            ->where('user_related_id', $userId)
            ->count();

        if ($userRelationship == 0)
            throw new ForbiddenException("Você não está associado a essa criança."); 
    }

    /** 
     * Display the child user statistics in total.
    */
    private function total(int $id)
    {
        $totalCompleted = TaskUser::where('user_receiver_id', $id)
            ->where('done', true)
            ->count();
        $totalIncomplete = TaskUser::where('user_receiver_id', $id)
            ->where('done', false)
            ->count();
        $userChallengeDifficulty = TaskUser::where('user_receiver_id', $id)
            ->select('difficult_level', DB::raw('count(*) as total'))
            ->whereNotNull('finished_at')
            ->groupBy('difficult_level')
            ->get();
        $firstUserChallenge = TaskUser::where('user_receiver_id', $id)
            ->whereNotNull('finished_at')
            ->orderBy('finished_at', 'asc')
            ->first();

        $tasksFinished = TaskUser::where('user_receiver_id', $id)->where('done', true)->get();

        foreach ($tasksFinished as $taskUser) {
           $this->totalPoints += $this->calculatePoints($taskUser->task->level);
        }

        $totalDays = $firstUserChallenge ? now()->diffInDays($firstUserChallenge->finished_at) : 1;
        $userDailyAverage = $totalDays > 0 ? $totalCompleted / $totalDays : $totalCompleted;

        return [
            'user_receiver_id'          => (int) $id,
            'total_completed'           => $totalCompleted,
            'total_incomplete'          => $totalIncomplete,
            'total_points'              => $this->totalPoints,
            'user_challenge_difficulty' => $userChallengeDifficulty,
            'user_daily_average'        => $userDailyAverage
        ];
    }

    /** 
     * Display the child user statistics in week.
    */
    private function weekly(string $id)
    {
        $oneWeekAgo = now()->subDays(7);

        $totalCompleted = TaskUser::where('user_receiver_id', $id)
            ->where('done', true)
            ->whereBetween('finished_at', [$oneWeekAgo, now()])
            ->count();
        $totalIncomplete = TaskUser::where('user_receiver_id', $id)
            ->where('done', false)
            ->whereBetween('created_at', [$oneWeekAgo, now()])
            ->count();
        $userChallengeDifficulty = TaskUser::where('user_receiver_id', $id)
            ->whereBetween('finished_at', [$oneWeekAgo, now()])
            ->select('difficult_level', DB::raw('count(*) as total'))
            ->groupBy('difficult_level')
            ->get();
        $firstUserChallenge = TaskUser::where('user_receiver_id', $id)
            ->whereNotNull('finished_at')
            ->whereBetween('finished_at', [$oneWeekAgo, now()])
            ->orderBy('finished_at', 'asc')
            ->first();
    
        $totalDays = $firstUserChallenge ? now()->diffInDays($firstUserChallenge->finished_at) : 1;
        $userDailyAverage = $totalDays > 0 ? $totalCompleted / $totalDays : $totalCompleted;
    
        return [
            'user_receiver_id'          => (int) $id,
            'total_completed'           => $totalCompleted,
            'total_incomplete'          => $totalIncomplete,
            'user_challenge_difficulty' => $userChallengeDifficulty,
            'user_daily_average'        => $userDailyAverage
        ];
    }

    /**
     * Calculate user points by task level.
     */
    private function calculatePoints(string $level): int
    {
        switch ($level) {
            case 'easy':
                return 1;
                break;

            case 'medium':
                return 2.2;
                break;

            case 'hard':
                return 3.5;
                break;
        }
    }
}
