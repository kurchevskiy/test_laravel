 
{{ Form::open(['class'=>'form-horizontal']) }}
  
  <div class="form-group">
    {{ Form::label('title', trans('article.title'))}}
     <div class="col-sm-10">
    {{ Form::text('title'), null, ['class' => 'from-control']}}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('desc', trans('article.desc'))}}
     <div class="col-sm-10">
    {{ Form::textarea('desc'), null, ['class' => 'from-control']}}
    </div>
  </div>
    <div class="form-group">
    {{ Form::label('full_text', trans('article.full_text'))}}
     <div class="col-sm-10">
    {{ Form::textarea('full_text'), null, ['class' => 'from-control']}}
    </div>
  </div>
    <div class="form-group">
    {{ Form::label('author', trans('article.author'))}}
     <div class="col-sm-10">
    {{ Form::textarea('author'), null, ['class' => 'from-control']}}
    </div>
  </div>
   
  {{ Form::submit(trans('article.save'), ['class'=> 'btn btn-default'])}}

  {{ Form::close() }}