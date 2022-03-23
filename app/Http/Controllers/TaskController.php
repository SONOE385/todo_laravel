<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

//リポジトリ（ファイル分け）したやつ
use App\Repositories\TaskRepository;


class TaskController extends Controller
{
    /**
     * タスクリポジトリ
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * コンストラクタ
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

 /**
    * タスク一覧
    *
    * @param Request $request
    * @return Response
    */
    public function index(Request $request)
    {
        ////print_r($tasks);
        ////$tasks = Task::orderBy('created_at', 'asc')->get();
        //$tasks = $request->user()->tasks()->get();//$request->userで登録user全体を取得し、
        //userのtasksを呼び出し、getパラメータで取得している。それを$tasksに格納している
        return view('tasks.index', [
         'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }
    /**
    * タスク登録
    *
    * @param Request $request
    * @return Response
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',//$requestの中に配列として組み込む。
        ]);
     
        // タスク作成
        // Task::create([
        //     'user_id' => 0,
        //     'name' => $request->name
        // ]);
        $request->user()->tasks()->create([
            'name' => $request->name,//リクエスト内容をnameとしてネームに格納
        ]);
     
        return redirect('/tasks');
    }
     
    /**
    * タスク削除
    *
    * @param Request $request
    * @param Task $task
    * @return Response
    */
    public function destroy(Request $request,Task $task)//Requestはuse Illuminate\Http\RequestのRequestからきている
    //Taskも一緒。use App\Models\Taskから取ってくるという意味。
    {
        // print_r($task);
        // exit;
        $this->authorize('destroy',$task);

        $task->delete();
        return redirect('/tasks');
    }
    
}
//http://127.0.0.1:8000/task/10
//index.blade.phpの、TODO削除ボタンtask/{$task->id}に当てはまる。