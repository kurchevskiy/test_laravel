
@extends('layouts.app')

@section('title', 'Page Title')



@section('content')
       {{ link_to_route('articles.index', $title = trans('article.create'), null, $attributes = ['class' => 'btn btn-primary add_row', 'id' => 'add_row', 'data-action'=>'create', 'data-url'=>'/events', 'data-object'=>'article']) }}
    	<table>
    		<thead>
    		 <tr>
      			<th>{{trans('article.title')}}</th>
      			<th>{{trans('article.desc')}}</th>
      			<th colspan="3"></th>
  			</tr>	
    		</thead>
    		<tbody>
    		@foreach ($articles as $article)	
    			<tr data-id="{{$article->id}}">
    				<td class='title'>{{ $article->title }}</td>
    				<td class='desc'>{{ $article->desc }}</td>
    				<td>{{ link_to_route('articles.show', trans('article.edit'), ['id'=>$article->id], ['class'=>'add_row btn btn-success  btn-xs','id' => 'add_row', 'data-action'=>'update', 'data-object'=>'article' ]) }}</td>
            <td>{{ link_to_route('articles.show', trans('article.show'), ['id'=>$article->id], ['class'=>'show_data btn btn-success  btn-xs','id' => 'add_row', 'data-object'=>'article']) }}</td>
        <td></td>
    			</tr>
			@endforeach
    		</tbody>
    	</table>

        <div id="dialog">
            @include('articles._fields')
        </div>

@endsection