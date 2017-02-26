<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Http\Controllers\Validator
use App\Http\Requests;
//use Illuminate\Http\Response as Response;
use App\Event as Event;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $events =Event::where('title', 'like', '%'.$request->input('title').'%')
                    ->where('desc', 'like', '%'.$request->input('desc').'%')
                    ->paginate(5);
            
       //echo($request->input('title'));
        //echo(Request::ajax());
        if($request->ajax()){
            return view('events.events', compact('events'));
        }
        else{
            return view('events.index', compact('events'));
        }


       
    
    }

    public function search(Request $request)
    {
        $events =Event::where('title', 'like', '%'.$request->title.'%')->get();
        
         echo(Request::isJson());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\EventRequest $request)
    {
        // Create
        $event = Event::create($request->all());
        return response()->json($event);
        //return redirect('events');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $event = Event::findOrFail($id);
        return response()->json($event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\EventRequest $request, $id)
    {
        //
        $event = Event::findOrFail($id);
        $event->update($request->all());
        return response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
