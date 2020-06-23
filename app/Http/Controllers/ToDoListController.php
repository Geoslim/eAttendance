<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ToDoList;
use Validator;

class ToDoListController extends Controller
{
    public function store_to_do_item(Request $request)
    {
        // $this->validate($request, [

        //     'employee_id' => 'required',
        //     'status' => 'required',
        //     'to_do_item' => 'required|string|min:7|max:225',
        //     'priority' => 'required',
            
        // ]);

        // $new_to_do_item = new ToDoList;
        // $new_to_do_item->employee_id = $request->input('employee_id');
        // $new_to_do_item->status = $request->input('status');
        // $new_to_do_item->to_do_item = $request->input('to_do_item');
        // $new_to_do_item->priority = $request->input('priority');

        // $new_to_do_item->save();
        // alert()->success('To-Do Item Added successfully','Entry Success' )->autoclose(10000);
        // return back();

        
        $rules = array(
            'employee_id' => 'required',
            'status' => 'required',
            'to_do_item' => 'required|string|min:7|max:225',
            'priority' => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'employee_id' => $request->input('employee_id'),
            'status' => $request->input('status'),
            'to_do_item' => $request->input('to_do_item'),
            'priority' => $request->input('priority')
        );

        ToDoList::create($form_data);

        return response()->json(['success' => 'To do Item Was Added Successfully! Page will reload ']);
    }


    public function update_status(Request $request, $id)
    {

        if ($request->status == 1) {

            ToDoList::where('id', $id)->update([
                'status' => 1,
                ]);
            alert()->success('To-Do Item Marked As Complete','Entry Success' )->autoclose(10000);
            return back();
        }else {
           ToDoList::where('id', $id)->update([
                'status' => 0,
                ]);
            alert()->success('To-Do Item Marked As Incomplete','Entry Success' )->autoclose(10000);
            return back();
        }

    }

    public function destroy($id)
    {
        dd($id);
        $to_do_item = ToDoList::find($id);
        $to_do_item->delete();
    
        alert()->success('To Do Item Deleted Successfully','Success');
        return back();
    }
}
