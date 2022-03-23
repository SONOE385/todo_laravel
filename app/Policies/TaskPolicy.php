<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 指定されたユーザーのタスクの時削除可能
     * 
     * @param User $user
     * @param Task $task
     * @return bool
     */
    public function destroy(User $user,Task $task)
    {
        // print_r($task->user_id);------ブラウザで見ると、タスク削除した後にユーザーIDが割り出される。つまりidが一致するもの
        //-------------------------------しか削除できないようにreturnしている。
        // exit;
        return $user->id === $task->user_id;
    }
}
