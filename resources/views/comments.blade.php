<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
	<link href="{{ url("/css/bootstrap.min.css") }}" rel="stylesheet">  
	<link href="{{ url("/css/main.css") }}" rel="stylesheet">  
	<link href="{{ url("/css/comments.css") }}" rel="stylesheet">  
	<style type="text/css">
	body {
		background:none;
		background-color:#eee;
	}
	</style>
</head>
<body bgcolor="#eee">

<div class="detailBox">
    <div class="titleBox">
      <label>Comments</label>
    </div>
    @isset ($photo->description)
    <div class="commentBox">        
        <p class="taskDescription caption">{{ $photo->description }}</p>
    </div>
    @endisset
    <div class="actionBox">
    	@if (Auth::check())
        <form class="form-inline" role="form" id="frm-comment" method="POST" action="{{ Request::url() }}">
            <div class="form-group">
                <textarea name="body" id="body" class="form-control" width="100%"></textarea>
            </div>
            <div class="form-group">
                <input class="btn btn-default" type="submit" value="Add">
            </div>

        	{{ csrf_field() }}
        	
        </form> 
        @else
        <div class="taskDescription caption"><a href="{{ route('login') }}" target="_top"><button id="singlebutton" class="btn btn-primary">Login to comment</button></a></div>        
        @endif   

        @include ('ajaxComments')
        @include ('layouts.errors')

    </div>
</div>


	<script type="text/javascript">
	$(document).ready(function() { 

	    $('#frm-comment').on('submit', function(e){
	        e.preventDefault();
	        var data = $(this).serialize();
	        var post = $(this).attr('method');
	        var url = $(this).attr('action');

	        $.ajax({
	            type : post,
	            url : url,
	            data : data,
	            success:function(data) {
	                readByAjax();
	            }
	        })

	        $('#body').val('')

	    })
	    
	    $(document).on("click", '.commentDelete', function(e){ 
	    	e.preventDefault();
	        var conf = confirm('Are you sure ?'); 
	        if( conf == true) {  
	            var id = $(this).data('id');
	            var token = $(this).data('token');
	            var url = '{{ url('comments/')}}/'+id;
	            $.ajax({
	                type : 'POST',
	                url : url,
	                dataType: 'JSON',
	                data: {
	                    "_method" : 'DELETE',
	                    "_token" : token
	                },
	                success:function(data) {
	                }
	            })

	            setTimeout(readByAjax, 200);
	        }   
	    })

	        function readByAjax() {
	            $.ajax({
	                type : 'GET',
	                url : '{{ route('ajaxComments', $photo->id) }}',
	                datatype : 'html',
	                success: function(data) {
	                    $('.responsive-list').html(data);
	                }
	            })  
	        }

	});
	</script>

</body>
</html>