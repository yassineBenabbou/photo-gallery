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