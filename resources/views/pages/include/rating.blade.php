                <?php 
                    $getOrderStarCount=$reviewCount->count();
                ?>
                    <h3 class="total_review">{{$getOrderStarCount}} Reviews</h3>
                 
                   @foreach($reviewSize as $data)
                    <div class="reviews active" id="fit">
                        <div class="review">
                            <div class="review_header">
                                <div class="review_image">
                                    <img src="{{ asset('public/no_image.png')}}" alt="">
                                </div>
                                <div class="review_bio">
                                    <p class="name"> <strong>{{$data['user']['name']??"No Name"}}.</strong></p>
                                    <ul class="stars">
                                        <?php
                                            $star=1;
                                            while ($star <= $data['rating']) {?>
                                            <li><img src="{{asset('public/frontend/assets/img/star.png')}}" alt=""></li>
                                            <?php $star++;
                                        }?>
                                    </ul>
                                </div>
                                <div class="review_date ms-auto">
                                    <p>@if($data['created_at']) {{date('Y-M-d',strtotime($data['created_at']))}} @endif</p>
                                </div>
                            </div>
                            <div class="review_body">
                                <p><strong>Height:</strong> {{$data['height']}}</p>
                                <p><strong>Body Type:</strong> {{$data['body']??""}}</p>
                                <p><strong>Size:</strong> {{$data['product_size']}}</p>
                                <p><strong>Fit </strong> {{$data['fit']}}</p>
                                <p><strong>Color </strong> {{$data['color_review']}}</p>
                                <h4 class="review_title"> {{$data['size_review']}}</h4>
                                <p class="review_message"> {{$data['review']}}</p>
                                <ul class="reviewmeata">
                                    <li><a href="#">
                                        <img src="{{asset('public/frontend/assets/img/share.png')}}" alt="">
                                        <span>Share</span>
                                    </a></li>
                                    <li>|</li>
                                    <li>
                                        <a href="#">Facebook</a>
                                        <sapn class="bolet"> . </sapn>
                                        <a href="#">Twitter</a>
                                        <sapn class="bolet"> . </sapn>
                                        <a href="#">Linkdin</a>
                                    </li>
                                    <li>|</li>
                                    <li>
                                        <?php
                                            $name=preg_replace('/\s+/', '', $data['product']['product_name']);
                                        ?>
                                        <span class="text-placeholder">Reviewed on:</span>
                                        <a href="{{url('product/details/'.$data['product']['id'].'/'.$name)}}">{{$data['product']['product_name']}}</a>
                                        <span class="bolet"> | </span>
                                    </li>
                                </ul>
                                <ul class="reviewgetuser">
                                    <li>Was This Review Helpful?</li>
                                    <li>😊 {{$data['rating']}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                   @endforeach 