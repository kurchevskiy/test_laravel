 
{{ Form::open() }}
  
  <div class="form-group">
    {{ Form::label('title', trans('event.title'))}}
     <div class="col-sm-10">
    {{ Form::text('title'), null, ['class' => 'from-control']}}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('desc', trans('event.desc'))}}
     <div class="col-sm-10">
    {{ Form::textarea('desc'), null, ['class' => 'from-control']}}
    </div>
  </div>
  <hr>
  <div class="form-group">
  {{ Form::submit(trans('event.save'), ['class'=> 'btn btn-default'])}}
  </div>
  {{ Form::close() }}