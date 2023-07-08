<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DoList;
use Carbon\Carbon;
class ListController extends Controller
{
    public function list()
    {
        $userId = Auth::id();
        if ($userId) {
            $lists = DoList::where('id_user', $userId)->get();
            return redirect()->route('task');
        } else {
            return redirect()->route('login');
        }
    }
    public function task()
    {
        $task = DoList::where('status', 'В процессе')
            ->where('time', '<', Carbon::now())->get();
        foreach ($task as $tk) {
            $tk->status = 'Время вышло';
            $tk->save();
        }
        $lists = DoList::where('id_user', Auth()->user()->id)->paginate(3);
        return view('list', ['lists' => $lists]);
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|regex:/^[А-Яа-яЁё\s]+$/u|max:255',
            'time' => 'required|date_format:H:i',
        ]);



            $status = 'В процессе';

        DoList::create([

            'name' => $validatedData['name'],
            'time' => $validatedData['time'],
            'id_user'=>$request->user()->id,
            'status'=>$status,
        ]);



        return redirect()->back()->with('success', 'Вы успешно добавили задачу!');
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'status' => 'required|string|max:255',
    ]);

    $list = DoList::findOrFail($id);
    $list->status = $validatedData['status'];
    $list->save();

    return redirect()->back()->with('success', 'Статус обновлен!');
}
public function destroy($id)
{
    $list = DoList::findOrFail($id);
    $list->delete();

    return redirect()->back()->with('success', 'Задача успешно удалена!');
}
}

