$( function() {
	var dialog, dialog_show, item;
	dialog = $( "#dialog" ).dialog({
      width: 650,
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });

    dialog_show = $( '<div id="dialog_show"></div>' ).dialog({
      width: 650,
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });

    // Добавление записи
    function add_table_row_event(data){

		var row = '<tr data-id="'+data.id+'">';
		row = row+'<td class="title">'+data.title +'</td>';
    	row = row+'<td class="desc">'+data.title +'</td><td><a href="/articles/'+data.id+'"';
    	row = row+'class="add_row btn btn-success" id="add_row" data-action="update" data-object="article">Edit</a></td>'
        row = row+'<td><a href="http://localhost:8000/articles/'+data.id+'" class="show_data btn btn-success btn-xs" id="add_row" data-object="article">Show</a></td><td></td></tr>';
        $('tbody').append(row);
    }
    //обновление записис
    function update_table_row_event(data){
    	var row = $('tbody').find('tr[data-id='+data.id+']');
    	$(row).find('.title').html(data.title);
    	$(row).find('.desc').html(data.desc);

    }
    function listener_button_show(){
      $('.show_data').on( "click", function(e) {
      e.preventDefault();
      dialog_show.dialog( "open" );

      $.ajax({
            type: 'get',
            url: $(this).attr('href'),
            dataType: 'json',
            success: function (data) {
              $(dialog_show).html('<table><tr><td>Title: </td><td>'+data.title+'</td><tr><tr><td>Desc: </td><td>'+data.desc+'</td><tr></table>')
            },
        });
      });
    }
    function listener_button_page(){
      $('.pagination').find('a').on('click',function(e){
        e.preventDefault();
        var url = $(this).attr('href'), pages = url.split('page=')[1];

        $.ajax({
            type: 'get',
            url: $('#search-ajax').attr('href'),
            dataType: 'html',
             data: {page: pages, title: $('#search-ajax').find('input[name=title]').val(), desc: $(this).find('input[name=desc]').val()},
            success: function (data) {
              $('#events').html(data);
              listener_button_form();
              listener_button_show();
              listener_button_page();
            },
        });

      });
    }

    function listener_button_form(){
        // Вызов форм
      $( ".add_row" ).on( "click", function(e) {
        e.preventDefault();
        $('#dialog form').attr('data-action', $(this).data('action'));
        $( "#dialog" ).dialog( "open" );
        // Создание
        if ($(this).data('action') === 'create'){
          $('#dialog').find('#title').val('');
          $('#dialog').find('#desc').val('');
          $('#dialog').find('#author').val('');
          $('#dialog').find('#full_text').val('');
          $('#dialog form').attr('method', 'POST');
            
        }

        // Обновление
        if ($(this).data('action') === 'update'){
          $.ajax({
            type: 'get',
            url: $(this).attr('href'),
            dataType: 'json',
            success: function (data) {
              $('#dialog').find('#title').val(data.title);
              $('#dialog').find('#desc').val(data.desc);
                console.log(data);
              if($('#dialog form').data('object') === 'article')
              {
                $('#dialog form').find('#author').val(data.author);
                $('#dialog form').find('#full_text').val(data.full_text);
              }
            },
          });
          $('#dialog form').attr('action', $(this).attr('href'));
          $('#dialog form').attr('method', 'PATCH');
          
          
        }
        $('#dialog form').attr('data-object', $(this).data('object'));
        $('#dialog form').attr('action', $(this).attr('href'));
      });
    }
    // Вывод ошибок новостей
    function add_error(data){
    	var obj = jQuery.parseJSON(data.responseText);
    	console.log(obj);
    	var errors = '<div id="error_form" class="alert alert-danger"><strong>Whoops! Something went wrong!</strong><br><ul>'
    	if(typeof(obj.title) != "undefined" && obj.title !== null) {
		    errors = errors + '<li>Title:'+obj.title[0];
		}
		if(typeof(obj.desc) != "undefined" && obj.desc !== null) {
		    errors = errors + '<li>Desc:'+obj.desc[0];
		}
    	errors = errors + '</ul></div>';
    	$(errors).insertBefore(dialog.find('form'));
    	console.log(errors);

    }

    listener_button_form();
    listener_button_show();
    listener_button_page();
   
    
    

    // отработка submit 
    dialog.find('form').on( "submit", function(e) {
    	e.preventDefault();
    	$( "#error_form" ).remove();
    	if($(this).data('object') === "event"){
	    	var formData = {
	    		title: $(this).find('#title').val(),
	    		desc: $(this).find('#desc').val(),
	    	}
	    }
    	if($(this).data('object') === "article"){
    	 	var formData = {
	    		title: $(this).find('#title').val(),
	    		desc: $(this).find('#desc').val(),
	    		author: $(this).find('#author').val(),
	    		full_text: $(this).find('#full_text').val(),
	    	}
    	 }
    	 $.ajax({
    	 	 headers: { 'X-CSRF-Token' : $(this).find('input[name=_token]').val() },
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: formData,
            dataType: 'json',
            success: function (data) {
            	// при добавление 
                if ($('#dialog form').data('action') === "create"){
                	console.log(data);
	                add_table_row_event(data);
	                
	            }
	            // при при обновление
	            if ($('#dialog form').data('action') === "update"){
	            	console.log(data);
	            	update_table_row_event(data);
	            	 
	            	
	            }
                $( "#dialog" ).dialog( "close" );
            },
            error: function (data) {
                add_error(data);
            }
        });
    });

    $('#search-ajax').on( "submit", function(e) {
      e.preventDefault();
      $.ajax({
          headers: { 'X-CSRF-Token' : $(this).find('input[name=_token]').val() },
          type: 'get',
          url: $(this).attr('href'),
          data: {title: $(this).find('input[name=title]').val(), desc: $(this).find('input[name=desc]').val()},
          dataType: 'html',
          success: function (data) {
            $('#events').html(data);
            listener_button_form();
            listener_button_show();
            listener_button_page();
          }
      });
    });
})