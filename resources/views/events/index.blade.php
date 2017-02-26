
@extends('layouts.app')

@section('title', 'Page Title')



@section('content')
       

       {{ Form::open(['method' => 'get', 'id' => 'search-ajax', 'class'=>'form-inline']) }}

        <div class="form-group">
          {{ Form::label('title', trans('event.title'))}}
          {{ Form::text('title'), null, ['class' => 'from-control']}}
        </div>
         <div class="form-group">
          {{ Form::label('desc', trans('event.desc'))}}
          {{ Form::text('desc'), null, ['class' => 'from-control']}}
        </div>
        <div class="form-group">
        {{ Form::submit(trans('event.search_button'), ['class'=> 'btn btn-default'])}}
        </div>
        {{ Form::token() }}
       {{ Form::close() }}
       <hr>
        {{ link_to_route('events.index', $title = trans('event.create'), null, $attributes = ['class' => 'btn btn-primary add_row', 'id' => 'add_row', 'data-action'=>'create', 'data-url'=>'/events', 'data-object'=>'event']) }}
        <div id="events">
          <table>
             <thead>
               <tr>
                  <th>{{trans('event.title')}}</th>
                  <th>{{trans('event.desc')}}</th>
                  <th colspan="3"></th>
              </tr> 
              </thead>
              <tbody>
              @foreach ($events as $event)  
                
                <tr data-id="{{$event->id}}">
                  <td class='title'>{{ $event->title }}</td>
                  <td class='desc'>{{ $event->desc }}</td>
                  <td>{{ link_to_route('events.show', trans('event.edit'), ['id'=>$event->id], ['class'=>'add_row btn btn-success btn-xs','id' => 'add_row', 'data-action'=>'update', 'data-object'=>'event']) }}</td>
                  <td>{{ link_to_route('events.show', trans('event.show'), ['id'=>$event->id], ['class'=>'show_data btn btn-success btn-xs','id' => 'add_row', 'data-object'=>'event']) }}</td>
              <td></td>
                </tr>
            @endforeach
              
              </tbody>
              
          </table>
          {{$events->links()}}
        </div>
        <div id="dialog" title="{{trans('event.event')}}">
            @include('events._fields')
        </div>

@endsection