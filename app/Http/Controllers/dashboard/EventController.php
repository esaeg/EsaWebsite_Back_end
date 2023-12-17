<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EventController extends DashboardController
{
    public function __construct()
    {
        parent::__construct('Event');

        $validation = [
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'date' => 'required',
            'location' => 'required',
        ];
        $this->inputsValidation = $validation;
        $this->inputsEditValidation = $validation;
        $this->inputsValidationMessages = [];

        $this->tableColumns = [
            [
                'columnName' => 'title',
                'title' => 'Event Name',
                'type' => 'text',
                'message' => 'Required',
                'canSearch' => true,
                'canOrder' => true
            ],
            [
                'columnName' => 'description',
                'title' => 'Description',
                'type' => 'editor',
                'message' => 'Required',
                'canSearch' => true,
                'canOrder' => true
            ],
            [
                'columnName' => 'date',
                'title' => 'Event Date',
                'type' => 'date',
                'message' => 'Required',
                'format' => 'dateTime',
                'canSearch' => true,
                'canOrder' => true
            ],
            [
                'columnName' => 'location',
                'title' => 'Location',
                'type' => 'text',
                'message' => 'Required',
                'canSearch' => true,
                'canOrder' => true
            ],
        ];
    }


    public function index(Request $request)
    {
        $this->authorize($this->controllerName.'-view');
        $display['path'] = $this->path;
        $display['pageTitle'] = 'Events';
        $display['tableName'] = $this->tableName;
        $display['tablePk'] = $this->tablePk;
        $display['tableHeader'] = $this->tableColumns;
        $display['message'] = session('message');
        //Search on database
        $keyword = $request->input('search');
        $customSearch = $request->input('customSearch');
        $order = $request->input('order');
        // custom search start
        if ($keyword) {
            $display['data'] = $this->tableModel->SearchByKeyword($keyword)
                ->orderBy($order ?? 'id', $request->input('dir') ?? 'desc')->paginate(20);
        } else {
            $display['data'] = $this->tableModel
                ->orderBy($order ?? 'id', $request->input('dir') ?? 'desc')->paginate(20);
        }
        $display['data']->appends(request()->query()); //to merge query string with pagination url
        return view('dashboard.index')->with($display);
    }


    public function store(Request $request)
    {
        $this->authorize($this->controllerName.'-create');

        $this->validate($request, $this->inputsValidation, $this->inputsValidationMessages);
        $this->tableModel::create($request->except('payment'));

        return Redirect::to($this->path);
    }

    public function edit($id)
    {
        $this->authorize($this->controllerName.'-update');
        $getData = $this->tableModel::find($id);
        $display['path'] = $this->path;
        $display['pageTitle'] = $this->pageTitle.' | Update';
        $display['tablePk'] = $this->tablePk;
        $display['pageName'] = $this->pageTitle;
        $display['tableName'] = $this->tableName;
        $display['inputs'] = $this->tableColumns;
        $display['data'] = $getData;
        return view('dashboard.edit')->with($display);
    }

    public function update(Request $request, $id)
    {
        $this->authorize($this->controllerName.'-update');
        $this->validate($request, $this->inputsEditValidation, $this->inputsValidationMessages);

        $event = $this->tableModel::find($id);
        if (!$event) {
            return Redirect::to($this->path)->with('message', 'Event not found');
        }
        $event->update($request->except('payment'));;

        return Redirect::to($this->path);
    }

    public function destroy($id)
    {
        $this->authorize($this->controllerName.'-delete');
        $event = $this->tableModel->find($id);
        if ($event) {
            $event->delete();

            return json_encode(['msg' => 'Row Deleted', 'status' => 'success']);
        } else {
            return json_encode(['msg' => 'Failed Deleting Row', 'status' => 'failed']);
        }
    }
}
