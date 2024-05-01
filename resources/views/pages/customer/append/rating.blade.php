    <form method="post" action="{{url('/check-user-review-update/'.$review->id)}}" id="profileForm" enctype="multipart/form-data">
        <div class="row g-4">
                @csrf
                
                <strong>Review For The Size</strong>
                 <div class="col-xxl-6">
                    <div class="form-floating theme-form-floating">
                        <textarea rows="5" cols="40" class="form-control" id="review" name="size_review">{{$review->size_review}}</textarea>
                        <label for="finame">review</label>
                    </div>
                </div>

                <div class="col-xxl-6">
                    <div class="form-floating theme-form-floating">
                        <div class="rate">
                            <input type="radio" id="star5" name="size_rating" value="5" <?php if($review->size_rating == 5){ echo 'checked';} ?>/>
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="size_rating" value="4" <?php if($review->size_rating == 4){ echo 'checked';} ?>/>
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="size_rating" value="3" <?php if($review->size_rating == 3){ echo 'checked';} ?>/>
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="size_rating" value="2" <?php if($review->size_rating == 2){ echo 'checked';} ?>/>
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="size_rating" value="1" <?php if($review->size_rating == 1){ echo 'checked';} ?>/>
                            <label for="star1" title="text">1 star</label>
                        </div>
                    </div>
                </div>
                
                <strong>Review For The Colors</strong>
                
                <div class="col-xxl-6">
                    <div class="form-floating theme-form-floating">
                        <textarea rows="5" cols="40" class="form-control" id="review" name="color_review">{{$review->color_review}}</textarea>
                        <label for="finame">review</label>
                    </div>
                </div>

                <div class="col-xxl-6">
                    <div class="form-floating theme-form-floating">
                        <div class="rate">
                            <input type="radio" id="star5" name="color_rating" value="5" <?php if($review->color_rating == 5){ echo 'checked';} ?>/>
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="color_rating" value="4" <?php if($review->color_rating == 4){ echo 'checked';} ?>/>
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="color_rating" value="3" <?php if($review->color_rating == 3){ echo 'checked';} ?>/>
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="color_rating" value="2" <?php if($review->color_rating == 2){ echo 'checked';} ?>/>
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="color_rating" value="1" <?php if($review->color_rating == 1){ echo 'checked';} ?>/>
                            <label for="star1" title="text">1 star</label>
                        </div>
                    </div>
                </div>
                
                <strong>Review For The Products</strong>
                <div class="col-xxl-6">
                    <div class="form-floating theme-form-floating">
                        <textarea rows="5" cols="40" class="form-control" id="review" name="review">{{$review->review}}</textarea>
                        <label for="finame">review</label>
                        
                    </div>
                </div>

                <div class="col-xxl-6">
                    <div class="form-floating theme-form-floating">
                        <div class="rate">
                            <input type="radio" id="star5" name="rating" value="5" <?php if($review->rating == 5){ echo 'checked';} ?>/>
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="rating" value="4" <?php if($review->rating == 4){ echo 'checked';} ?>/>
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="rating" value="3" <?php if($review->rating == 3){ echo 'checked';} ?>/>
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="rating" value="2" <?php if($review->rating == 2){ echo 'checked';} ?>/>
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="rating" value="1" <?php if($review->rating == 1){ echo 'checked';} ?>/>
                            <label for="star1" title="text">1 star</label>
                        </div>
                    </div>
                </div>
                
                
               <div class="modal-footer">
                    <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light">Submit</button>
                </div>
        </div>
    </form>