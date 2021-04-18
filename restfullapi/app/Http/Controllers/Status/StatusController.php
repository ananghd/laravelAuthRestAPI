<?php

namespace App\Http\Controllers\Status;

use App\Models\User;
use App\Models\Status;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Http\Resources\StatusCollection;
use Illuminate\Http\Request;

class StatusController extends ApiController
{
    
    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index', 'show', 'store', 'destroy']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
        $statuses->transformer = StatusCollection::class;
        return $this->showAll($statuses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            //'user_id' => 'required', // due requirement - auto increment
            'status' => 'required|in:' . Status::ACTIVE_USER . ',' . Status::INACTIVE_USER,
            'position' => 'required|min:6|max:255',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $status = Status::create($data);

        return $this->showOne($status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        return $this->showOne($status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        $rules = [
            'status' => 'max:255|in:' . Status::ACTIVE_USER . ',' . Status::INACTIVE_USER,
            'position' => 'min:6|max:255',
        ];


        if ($request->has('status')) {
            $status->status = $request->status;
        }

        if ($request->has('position')) {
            $status->position = $request->position;
        }

        if (!$status->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $status->save();

        return $this->showOne($status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $status->delete();

        return $this->showOne($status);
    }
}
