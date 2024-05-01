<!--Scoll Top-->
    <span id="site-scroll"><i class="fa-solid fa-austral-sign"></i></span>
    <!--End Scoll Top-->


    <!--Newsletter Popup-->
    <div id="newsletter-modal" class="style2 mfp-with-anim mfp-hide">
        <div class="newsltr-tbl">
			<div class="newsltr-img small--hide"><img src="assets/images/newsletter/newsletter_540.jpg" alt=""></div>
            <div class="newsltr-text text-center">
				<div class="wraptext">
                    <h2>Join Our Mailing List</h2>
                    <p class="sub-text">Stay Informed! Monthly Tips, Tracks and Discount. </p>
                    <form action="#" class="mcNewsletter" method="post">
                      	<div class="input-group">
                        	<input type="email" class="newsletter__input" name="EMAIL" value="" placeholder="Email address" required>
                        	<span class="">
                        		<button type="submit" class="btn mcNsBtn" name="commit"><span>Subscribe</span></button>
                        	</span>
						</div>
                    </form>
                    <ul class="list--inline social-icons">
                      <li><a class="si-link" href="#" title="Facebook" target="_blank"><i class="anm anm-facebook-f" aria-hidden="true"></i></a></li>
                      <li><a class="si-link" href="#" title="Twitter" target="_blank"><i class="anm anm-twitter" aria-hidden="true"></i></a></li>
                      <li><a class="si-link" href="#" title="Pinterest" target="_blank"><i class="anm anm-pinterest-p" aria-hidden="true"></i></a></li>
                      <li><a class="si-link" href="#" title="Instagram" target="_blank"><i class="anm anm-instagram" aria-hidden="true"></i></a></li>
                    </ul>
                    <p class="checkboxlink">
                    	<input type="checkbox" id="dontshow">
                      	<label for="dontshow">Dont show this popup again</label>
                    </p>
              </div>
            </div>
		</div>
			<button title="Close (Esc)" type="button" class="mfp-close">×</button>
	</div>
	<!--End Newsletter Popup-->



    <!--Newsletter Popup Cookies-->
    <script>
       function newsletter_popup(){
           var cookieSignup="cookieSignup", date=new Date();
           if($.cookie(cookieSignup) !='true' && window.location.href.indexOf("challenge#newsletter-modal") <=-1) {
               setTimeout( function() {
                   $.magnificPopup.open( {
                       items: {
                           src: '#newsletter-modal'
                       }
                       , type:'inline', removalDelay:300, mainClass: 'mfp-zoom-in'
                   }
                   );
               }
               , 5000);
           }
           $.magnificPopup.instance.close=function () {
               if($("#dontshow").prop("checked")==true) {
                   $.cookie(cookieSignup, 'true', {
                       expires: 1, path: '/'
                   }
               );
           }
               $.magnificPopup.proto.close.call(this);
           }
       }
       newsletter_popup();
   </script>
    <!--End Newsletter Popup Cookies-->
