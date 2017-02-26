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