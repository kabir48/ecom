<form  method="post" id="delete-form" action="{{ url('admin/customer-comment-replay/'.$comments->id) }}">
    @csrf
    <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel1">{{$title}} by {{$comments->users->name}}</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="input-group mb-3">
                <p>
                   {{$comments->comment}}  
                </p>
            </div>
        </div>

        <div class="form-group">
            <label>Comments Replay By Admin</label>
            <div class="input-group">
                 <textarea class="form-control" id="elm1" name="comment_replay" row="5" cols="40">
                   </textarea>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
        <button type="submit" class="btn btn-danger">Submit</button>
    </div>
</form>
