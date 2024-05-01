    <form method="post" action="{{url('admin/category-delete/'.$category->id)}}">
        @csrf
                  	
      	<div class="modal-header">
      		<h5 class="modal-title">Confirm Message</h5>
      	</div>
      	
      	<div class="modal-body">
      		<p> {{$title}} </p>
      	</div>	
      	
      	<div class="modal-footer">
             <button type="submit" class="btn btn-success">Confirm</button>
      		 <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close
      		</button>
      	</div>
    </form>