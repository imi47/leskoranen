@extends('user/master_layout') @section('data')

@php  
$audio='';
$lastverse='';
@endphp
<script>
  $(document).ready(function()
  {
    if(typeof $.cookie('surah_id') === 'undefined'){
      $.cookie('surah_id','3', { expires: 60 });
      $.cookie('from_verse','0', { expires: 60 });
    }
     var from_verse=$.cookie("from_verse");
     var surah_id=$.cookie("surah_id");
      // from_verse=+from_verse + +1;
      if($.cookie("surah_id")!='null')
      {
        $('#cmbSura').val(surah_id);
         getSurah('',from_verse);
      }
     
      
     // alert(from_verse);
  });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/material-scrolltop/1.0.1/material-scrolltop.js"></script>
<style>
  .AutoScroll {
        /*background-color: #191919;*/
        /*color: #fff;*/
        /*position: relative;*/
        /*top: 100px;*/
        max-height: 400px;
        overflow-y: scroll;
        /*padding: 20px;*/
        /*border: 1px solid #121212;*/
      }
      .os-content-glue {
        height:1000px !important;
      }

      .os-theme-block-dark > .os-scrollbar-vertical {
        width:12px;
      }

      #arab-side:hover .os-scrollbar-handle:before,
      #tran-side:hover .os-scrollbar-handle:before {
        background: #8a2b44;
      }

      #home_content #translation {
        margin-left: 12px;
        direction: ltr;
      }
      @media (max-width:575px) {

        #home_content > .container-fluid {
          padding: 0;
        }

        #home_content > .container-fluid > .row {
          width: 100%;
          margin: 0;
        }
      }
</style>

<img src="{{$PUBLIC_ASSETS}}/img/design-filled.png" alt="" class="design-filled">
<img src="{{$PUBLIC_ASSETS}}/img/design-filled.svg" alt="" class="design-filled-2">


<div id="wait" style="display: none;"></div>

<section id="home_content" >
  
  <div class="container-fluid" >

   <div class="row mt-5" >
   
    <div class="col-sm-6 left tran-side" id="tran-side">
      <p class="text-center"  dir="ltr">
        <span class="trns" style="color: #4c1426"><span id="sura_nm">{{ $surah->surah_name }}</span></span>
      </p>
      @if($surah->surah_number!=9)
      <p class="text-center" id="trans0"  dir="ltr">
        <span class="trns bismila"  style="color: #4c1426">I Allahs navn, den Barmhjertige, den Nåderike</span>
        <span class='ayah-end1 fatiha'>
          <span style="width: 24px; padding: 3px 2px 3px 2px;">1</span>
        </span>
      </p>
      @endif
      
     <p id="translation">
      @foreach ($surah->verse as $verse)
        <span class="trns" id="trans{{$verse->verse}}"> {!!$verse->translation!!}
        <!-- <img src="{{$PUBLIC_ASSETS}}/img/ayah-end.png" class='ayah-end'>
        <span style="padding: 5px;">{{$verse->verse}}</span></span> -->
        <span class='ayah-end1 fatiha'>
          @php $verse_number=$verse->verse+1; @endphp
          <span>{{$verse_number}}</span>
        </span></span>
        @if($audio=='')
        <?php $audio=$verse->link_to_audio; ?>
        @endif
      @endforeach 

    </p>
  </div>
  <div class="col-sm-6 right notranslate arabicSide" id="arab-side">

    <p class="text-center" dir="rtl">
      <span class="arbic" style="color: #4c1426">سُوۡرَةُ  <span id="sura_n">{{ $surah->surah_name_arabic }}</span> </span>
    </p>
    @if($surah->surah_number!=9)
     <script>

          c_obj['arb_link0'] = '11.mp3';
          c_obj['verse_id0'] = '0';
          c_obj['arb_desc0'] = 'Surah Al-Fatihah er en bønn Allah lærer mennesker som skal studere Hans bok. Dens plassering i begynnelsen viser viktigheten av den for enhver som ønsker å dra nytte av Boken, og denne bønnen til Herren over alle universene bør derfor fremlegges først.';
          $('#cmbFVerse').val(0);
          </script>
          
    <p class="text-center" id="arabic0"  dir="rtl">
      <span class="arbic bismila"  style="color: #4c1426;">بِسۡمِ ٱللَّهِ ٱلرَّحۡمَـٰنِ ٱلرَّحِيمِ</span>
      <span class='ayah-end1 fatiha'>
          <span style="width: 24px; padding: 3px 2px 3px 2px;">1</span>
        </span>
    </p>
    @endif
   <p class="pull-right" id="arabic" dir="rtl">
       @foreach ($surah->verse as $key=>$verse)
        <script type="text/javascript">
          c_obj['verse_id' + {{ $verse->verse }}] = '{{ $verse->verse }}';
          c_obj['arb_link' + {{ $verse->verse }}] = '{{ $verse->link_to_audio }}';
          c_obj['arb_desc' + {{ $verse->verse }}] = '{!! str_replace('<br />', '\\', $verse->description) !!}';
        </script>
        <span class="arbic" data='{{$verse->verse}}' style="height: 100px;" id="arabic{{$verse->verse}}"> {!!$verse->arabic_immune!!}
        <span class='ayah-end1 fatiha'>
          @php $verse_number=$verse->verse+1; @endphp
          <span>{{$verse_number}}</span>
        </span>
      </span>
       @endforeach
     


   </p>

 </div>

</div>

</div>
<div class="row">
  <div class="col-md-12">
    
    <div class="footerDrawer" data-toggle="tooltip" data-placement='bottom' title='Verse Footnotes'>
      <div class="open">
        <p class="triangle trn">Footnotes</p>
        <p class="triangle trn">Close</p>
      </div>
      <div class="content">
        <div>
          <a id="btnNext" class="next_b" onclick="nextfootnotes()" title="Next footnotes"> <i class="fa fa-chevron-right" aria-hidden="true"></i> </a>
          <a href="javascript:;" style="line-height: 1.2 !important;display: grid;justify-content: center;" data-toggle="modal" data-target="#footnotes">
            
            {{-- <p class="c-verse" style="font-size: 12px">{!!$surah->verse[0]->description!!}
              </p> --}}
              {{-- <p class="c-verse" style="font-size: 12px">{!! str_replace( '</p>', '' , str_replace('<p>' , '' , $surah->verse[0]->description)) !!}
              </p> --}}
              <p class="c-verse" style="font-size: 12px;">Surah Al-Fatihah er en bønn Allah lærer mennesker som skal studere Hans bok. Dens plassering i begynnelsen viser viktigheten av den for enhver som ønsker å dra nytte av Boken, og denne bønnen til Herren over alle universene bør derfor fremlegges først.</p>
          </a>
          <a id="btnPrevious" class="pre_b" onclick="prefootnotes()" title="Previous Footnotes"> <i class="fa fa-chevron-left"></i>
        </a>
        </div>
      </div>
    </div>
  </div>
</div>




</section>
<img src="{{$PUBLIC_ASSETS}}/img/design-hollow.png" alt="" class="design-hollow">
<div class="page-header-section footer">
  <img src="{{$PUBLIC_ASSETS}}/img/design-hollow.png" alt="" class="design-hollow-footer">
  <div class="container">

  <div class="row">

   <div class="page-header-area">
    <div class="page-header-content " >

     <section class="audio_player">
      <section class="control_panel">
       <section class="extra_button">
        <a href="#" onclick="zoomout()" class="zoom_text minus_size vertical" title="Zoom Out">
          <img src="{{$PUBLIC_ASSETS}}/img/zoom_out.svg" style='width:29px;'>                       
        </a>
        <a href="#" onclick="zoomin()"  class="zoom_text vertical" title="Zoom In">
          <img src="{{$PUBLIC_ASSETS}}/img/zoom.svg" class="zoomin" style='width:29px;'>                       
        </a>
      </section>
      <section class="main_control">
        <a href="#" class="stop_b" title="Stop" onclick="stop_player()">
          <img src="{{$PUBLIC_ASSETS}}/img/stop.svg"></a>
          <a href="#" class="play_b" title="Play/Pause">
           <div style="padding-left:2.2px;">
            <div id="buf_2" class="cp-buffer-2" style="clip: rect(48px, 24px, 48px, 0px);">
            </div>
            <div id="buf_1" class="cp-buffer-1" style="clip: rect(0px, 48px, 0px, 24px);">
            </div>
          </div>

          <div id="playbtn">
            <button id="play_btn" onclick="playPause()" class="paused"></button>
            <span id="payer_area">
              <audio id="myAudio" onended="audio_player();">
                <source src="" id="audio_source" type="audio/mpeg">
              </audio>
              </span>
            </div>
          </a>
          <audio id="next-audio">
            <source src="{{$ADMIN_ASSETS}}/audios/{{ $surah->verse[0]->link_to_audio }}" id="next-audio-src" type="audio/mpeg">
          </audio>
          <a id="btnPrevious" class="pre_b" onclick="previousSurah()" title="Previous Sura"> <img src="{{$PUBLIC_ASSETS}}/img/rewind.svg">
          </a>
          <a id="btnNext" class="next_b" onclick="nextSurah()" title="Next Sura"> <img src="{{$PUBLIC_ASSETS}}/img/forward.svg"> </a>
        </section>
        <section class="extra_button barBox2">
          @if(\Auth::check())
          <a href="#" data-toggle="tooltip" rel="#bookmark_Scr"  id="_myBookMark" class="book_mark">
           <img src="{{$PUBLIC_ASSETS}}/img/bookmark.svg" onclick="save_bookmarks()">
           @else
           <a href="#" data-toggle="tooltip" rel="#bookmark_Scr"  id="_myBookMark" class="book_mark">
           <img src="{{$PUBLIC_ASSETS}}/img/bookmark.svg" onclick="change_content('bookmark')">
           @endif
         </a>
       </section>

     </section>

   </section>

 </div>
</div>
</div>
</div>
</div>
<section id="search_content" style="display: none;">
  <div class="container-fluid">
    <div class="row mt-2">
      <div class="col-md-6 mr-auto">
        <div class="jumbotron jumbotron-fluid pt-2">
          <div class="container-fluid">
            <h3 class="trn">Search Results</h3>
            <hr>
            <ul class="unstyled-list mb-2">
              {{--               <li>Current Rage : 1 - 10</li> --}}
              <li><span id="total"  class="trn" style="display: none;">Total Search Count</span><span id="total_found"></span></li>
            </ul>
            <span class="notranslate" id="results">

            </span>


          </div>
        </div>
      </div>
    </div>

  </div>
</section>
<section id="bookmark_content" style="display: none;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mr-auto">
        <div class="jumbotron jumbotron-fluid pt-2">
          <div class="container-fluid">
            <h3 class="trn">Bookmarks</h3><span id="" style="color:#9c3;"></span>
            <hr>
            @if(!\Auth::check())
<style>
   #logedout{
    display: none;
   }

</style>
@else
<style>
   #logedin{
    display: none;
   }
   </style>
 
@endif
  
  <div id="logedin">
  <p style="color: red" class="trn">Kindly login for view or add bookmarks</p>
  <div class="col-md-12">
  <a  href="#" class="trn btn btn-danger" onclick="change_content('Login')">Login</a>
  <a href="#" class="trn btn btn-danger" onclick="change_content('Signup')">Signup</a>
  <a href="#" class="trn btn btn-danger" onclick="change_content('forget')">Forget Password</a>
  <br>
</div>
</div>
  
  {{-- @if(Session::get('success'))
  <script>
    $(document).ready(function(){
      change_content('bookmark');
    });
  </script>
  @endif --}}
  <div id="logedout">
  <div class="col-md-2">
  <a href="{{ route('logout') }}" class="trn btn btn-danger">logout</a>
</div>

            
            <form style="margin-top: 10px;" id="get_bookmarks" class="shake" role="form" method="post">
             @csrf
             <?php
            if(\Auth::check()){
                $user_email = auth()->user()->email;
            }else{
                $user_email = "";
            }
            ?>
             <div class="form-group">
              <input type="hidden" class="form-control trn" placeholder="Your email" id="get_bookmarks_email" required="" value="{{$user_email}}" name="email"> 
            </div>
            <div class="form-group">
              <input style="height: auto; width: auto;" type="submit" name="btnSub" class="btn btn-primary trn" value="Get Bookmarks">
              <!-- <input class="btn btn-del-bookmark" type="" name="" value="Delete Bookmark"> -->
            </div>
          </form>
          </div>
           
          <ul class="unstyled-list mb-2">
            {{--               <li>Current Rage : 1 - 10</li> --}}
            <li><span id="total_found_bookmarks" class="trn" style="display: none;">Total Search Count</span><span id="totalb"></span></li>
          </ul>
          <span style="color: red;" id="results_bookmarks">

          </span>
        </div>
      </div>
    </div>
  </div>

</div>
</section>

<section id="login_content" style="display: none;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mr-auto">
        <div class="jumbotron jumbotron-fluid pt-2">
          <div class="container-fluid">
            <h3 class="trn">Login</h3><span id="" style="color:#9c3;"></span>
            <span style="color: red" class="trn">Kindly login for view or add bookmarks</span>
            <hr>

            @if(Session::get('successs'))
            <p class="alert alert-success">{{ Session::get('successs') }}</p>
            @endif
            <p class="alert alert-success" style="display: none;" id="login_success"></p>
            <p class="alert alert-danger" style="display: none;" id="login_status"></p>
            <form id="login" class="shake" role="form" method="post">
             @csrf
             <div class="form-group">
              <input type="email" class="form-control trn" placeholder="Your email" id="" required="" name="email">
            </div>
            <div class="form-group">
              <input type="password" class="form-control trn" placeholder="Your Password" id="" required="" name="password">
            </div>
            <div class="form-group">
              <input style="height: auto; width: auto;" type="submit" name="btnSub" class="btn btn-danger trn" value="Login">
              <a href="#" class="trn btn btn-danger" onclick="change_content('Signup')">Signup</a>
  <a href="#" class="trn btn btn-danger" onclick="change_content('forget')">Forget Password</a>
              <!-- <input class="btn btn-del-bookmark" type="" name="" value="Delete Bookmark"> -->
            </div>
          </form>
          

          </span>
        </div>
      </div>
    </div>
  </div>

</div>
</section>




<section id="forget" style="display: none;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mr-auto">
        <div class="jumbotron jumbotron-fluid pt-2">
          <div class="container-fluid">
            <h3 class="trn">Forget Password</h3><span id="" style="color:#9c3;"></span>
            {{-- <p style="color: red">Kindly login for view or add bookmarks</p> --}}
            <hr>
            
             <p class="alert alert-success trn" style="display: none;" id="forget_success"></p>
            <p class="alert alert-danger" style="display: none;" id="forget_error"></p>
            <form id="forget_password" class="shake" role="form" method="post">
             @csrf
             <div class="form-group">
              <input type="email" class="form-control trn" placeholder="Your email" id="" required="" name="email">
            </div>
            
            <div class="form-group">
              <input style="height: auto; width: auto;" type="submit" name="btnSub" class="btn btn-danger trn" value="Verify">
              <a href="#" class="trn btn btn-danger" onclick="change_content('Signup')">Signup</a>
              <a href="#" class="trn btn btn-danger" onclick="change_content('Login')">Login</a>
  {{-- <a href="#" class="trn btn btn-danger" onclick="change_content('forget')">Forget Password</a> --}}
  {{-- <a href="#" class="trn btn btn-danger" onclick="change_content('forget')">Forget Password</a> --}}
              <!-- <input class="btn btn-del-bookmark" type="" name="" value="Delete Bookmark"> -->
            </div>
          </form>
          

          </span>
        </div>
      </div>
    </div>
  </div>

</div>
</section>




<section id="Signup" style="display: none;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mr-auto">
        <div class="jumbotron jumbotron-fluid pt-2">
          <div class="container-fluid">
            <h3 class="trn">Signup</h3><span id="" style="color:#9c3;"></span>
            <hr>
            
            {{-- <p class="alert alert-success" style="display: none;" id="login_success"></p>
            <p class="alert alert-danger" style="display: none;" id="login_status"></p> --}}
            <form id="signup" class="shake" role="form" method="post">
             @csrf
             <div class="form-group">
              <input type="email" class="form-control trn" placeholder="Your email" id="" required="" name="email">
              <span id="email" style="color: red;"></span>
            </div>
            <div class="form-group">
              <input type="password" class="form-control trn" placeholder="Your Password" id="" required="" name="password">
              <span id="password" style="color: red;"></span>
            </div>
            <div class="form-group">
              <input type="password" class="form-control trn" placeholder="Confirm Your Password"  required="" name="password_confirmation">
              <span id="password_confirmation" style="color: red;"></span>
            </div>
            <div class="form-group">
              <input style="height: auto; width: auto;" type="submit" name="btnSub" class="btn btn-danger trn" value="Signup">

              
              <a href="#" class="trn btn btn-danger" onclick="change_content('Login')">Login</a>
  <a href="#" class="trn btn btn-danger" onclick="change_content('forget')">Forget Password</a>


              <!-- <input class="btn btn-del-bookmark" type="" name="" value="Delete Bookmark"> -->
            </div>
          </form>
          

          </span>
        </div>
      </div>
    </div>
  </div>

</div>
</section>


<section id="inv_friend_content" style="display: none;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mr-auto">
        <div class="jumbotron jumbotron-fluid pt-2">
          <div class="container-fluid">
            <h3 class="trn">Invite Friend</h3>
            <span id="invite_results" style="color:#9c3;font-size:20px;"></span>
            <hr>
            <div class="form-group">
              <form id="form" class="shake" role="form" method="post">
               @csrf
               <input type="text" name="name" placeholder="Your name" class="contact-control form-control trn" required="" >
             </div>

             <div class="form-group">
              <input type="email" placeholder="Your email" name="sender_email" class="form-control trn" required="">
            </div>
            <div class="form-group">
              <input type="email" name="receiver_email" placeholder="Friend's email" class="form-control trn" required="">
            </div>
            <div class="form-group">
              <textarea class="form-control trn" placeholder="Message" name="message" required=""></textarea>
            </div>
            <div class="form-group">
              <button class="btn btn-primary trn" style="height: auto; width: auto;" type="submit" name="btnSub">Send Invitation</button>
              
            </div>
          </form>

          

          <div class="social">
            <div class="social__item">
                <span class="fa fa-facebook" data-count="..." data-social="fb"></span>
            </div>
            <!-- <div class="social__item">
                <span class="fa fa-vk" data-count="..." data-social="vk"></span>
            </div> -->
            <div class="social__item">
                <span class="fa fa-twitter" data-count="..." data-social="tw"></span>
            </div>
            <!-- <div class="social__item">
                <span class="fa fa-linkedin" data-count="..." data-social="ln"></span>
            </div> -->
            <!-- <div class="social__item">
                <span class="fa fa-pinterest" data-count="..." data-social="pt"></span>
            </div> -->
        </div>

          
          <script>
            $(function () {
            $('[data-social]').socialButtons({
                url: 'digitalmediexpert.no/quran/#'
              });
            });

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-36251023-1']);
            _gaq.push(['_setDomainName', 'jqueryscript.net']);
            _gaq.push(['_trackPageview']);

            (function() {
              var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
              ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
              var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
          </script>
        </div>
      </div>
    </div>
  </div>

</div>
</section>
<section id="bug_report" style="display: none;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mr-auto">
        <div class="jumbotron jumbotron-fluid pt-2">
          <div class="container-fluid">
            <h3 class="trn">Bug Reporting</h3>
            <span id="report_results" style="color:#9c3;font-size:20px;"></span>
            <hr>
            <div class="form-group">
              <form id="form_bug_report" class="shake" role="form" method="post">
               @csrf
               <input type="text" name="name" placeholder="Your name" class="contact-control form-control trn" required="" >
             </div>
             <div class="form-group">
              <select class="form-control trn" name="erorr_script">
                <option class="trn" selected="">Select</option>
                <option value="Arabic Text">Arabic Text</option>
                <option value="Arabic Audio">Arabic Audio</option>
                <option value="Norsk Translation">Norsk Translation</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" name="summery" placeholder="Summary" class="form-control trn" required="">
            </div>
            <div class="form-group">
              <textarea class="form-control trn" placeholder="Details" name="details" required=""></textarea>
            </div>
            {{-- <div class="form-group">


              <div id="captcha">
                <div class="controls">
                  <input class="form-control" placeholder="Type here" type="text" />
                  <input value="Check" type="button" class="validate btn-common">
                  <!-- this image should be converted into inline svg -->
                  <input value="Reload" type="button" class="refresh btn-common">
                  <!-- this image should be converted into inline svg -->
                </div>
              </div>
            </div> --}}
            <div class="form-group">
              <label id="Surah_b_id"></label>,&nbsp;&nbsp;&nbsp;&nbsp;
              <label id="verse_b_id"></label>,&nbsp;&nbsp;&nbsp;&nbsp;
              <label id="recitor_b_id"></label>
            </div>
            <input type="hidden" value="" id="Surah_b_id_in" name="surah_id">
            <input type="hidden" value="" id="from_verse_b_id_in" name="from_verse">
            <input type="hidden" value="" id="to_verse_b_id_in" name="to_verse">
            <input type="hidden" value="" id="recitor_b_id_in" name="recitor_id">
            <div class="form-group">
              <input style="height: auto; width: auto;" type="submit" name="btnSub" value="Send" class="btn btn-primary">
            </div>
            <span id="results_report"></span>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</section>
{{-- 
<audio controls autoplay >
   @foreach($surah->verse as $verse)
   <source src="{{$ADMIN_ASSETS}}/audios/{{$verse->link_to_audio}}" type ="audio/mp3">
   @endforeach;
</audio>
--}}
@endsection
@push('css')
{{-- 
<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/bootstrap.min.css">
--}} 
<style type="text/css">
.footer{
 position: fixed;
 bottom: 0;
 z-index: 1;
 overflow: hidden;
}
#wait {
  position: fixed;
  left: 0px;
  top: 10px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url('{{$PUBLIC_ASSETS}}/img/loader.gif') 50% 50% no-repeat rgba(249,249,249,0.7);
  background-size: 1150px 250px;
}

.footnote-modal-btn {
      border-radius: 5px;
    height: 43px;
    background-color: #8a2b44;
    /* border: 2px solid; */
    /* box-shadow: none; */
    border: none;
    padding: 0px 5px;
}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/style_nav.css">
<link rel="stylesheet" href="{{ $PUBLIC_ASSETS }}/sweetalert/dist/sweetalert.css">
{{-- <link rel="icon" type="image/png" href="favicon.ico">
<link rel="apple-touch-icon" href="apple-touch-icon.png">    
--}}
<script type="text/javascript">
  var c_obj = {};
  var myAudio = [];
</script>
@endpush 
@push('js')

<script src="{{ $PUBLIC_ASSETS }}/sweetalert/dist/sweetalert.js"></script>
{{-- <script src="{{$PUBLIC_ASSETS}}/captcha/client_captcha.js" defer></script>
--}}

<div class="modal fade" id="footnotes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content" style="margin-top: 115px;">
<div class="modal-header">
<h5 class="modal-title tb-modal-title" id="exampleModalLabel">Verse Footnotes</h5>
</div>
<div class="modal-body">

<div class="form-group">
 
 <p class="c-verse" style="line-height: 30px;
    font-size: 1.20rem;">Surah Al-Fatihah er en bønn Allah lærer mennesker som skal studere Hans bok. Dens plassering i begynnelsen viser viktigheten av den for enhver som ønsker å dra nytte av Boken, og denne bønnen til Herren over alle universene bør derfor fremlegges først.</p>
 
</div>
<div class="pull-right">
<button type="button" class="footnote-modal-btn" data-dismiss="modal">Close</button>

</div>
<div class="clearfix"></div>

</div>
</div>
</div>
</div>
<div style="display:none !important"> 
    <p class="trn" id="save_bookmark">Save Bookmark</p> 
    <p class="trn" id="btn_cancel">Cancel</p> 
    <p class="trn" id="btn_save">Save</p> 
    <p class="trn" id="btn_find">Find</p> 
    <p class="trn" id="b_exist">Bookmark is already saved</p> 
    <p class="trn" id="btn_close">Close</p> 
    <p class="trn" id="b_saved">Bookmark is saved</p> 
    <p class="trn" id="b_wrong">Something went wrong</p>  
    <p class="trn" id="b_deleted">Bookmark is deleted</p> 
    <p class="trn" id="b_sure">Are you sure you want delete</p> 
    <p class="trn" id="b_again">Try Again</p> 
    <p class="trn" id="btn_delete">Delete</p> 
    <p class="trn" id="b_sent_link">Sent a link in your email for change password</p> 
    <p class="trn" id="b_invalid_email">Invalid email. Kindly try again!</p>  
</div>
@if(Session::get('successs'))
<script>
  document.getElementById("home_content").style.display = "none";
  document.getElementById("login_content").style.display = "block";
</script>
@endif
<script type="text/javascript">

   
  // console.log(c_obj);
 $("body").tooltip({
    selector: '[data-toggle="tooltip"]'
});
 $('#cmbScript').on('change' , function(){
  v = $(this).val();
  if(v == 'hide'){
    $('#arab-side').hide();
    $('#tran-side').removeClass('col-sm-6 left').addClass('col-sm-12');
  }else if(v == 15){
    $('#arab-side').show();
    $('#tran-side').removeClass('col-sm-12').addClass('col-sm-6 left');
  }
 });
 $('#cmbTranslation').on('change' , function(){
  v = $(this).val();
  if(v == 'hide'){
    $('#tran-side').hide();
    $('#arab-side').removeClass('col-sm-6 right').addClass('col-sm-12');
    $('.trans-mobile').addClass('hidden');
  }else if(v == 9){
    $('#tran-side').show();
    $('#arab-side').removeClass('col-sm-12').addClass('col-sm-6 right');
    $('.trans-mobile').removeClass('hidden');
  }
 });
 st_ver = 1;
  $(function () {
   $('#form_bug_report').on('submit',function (e) {
     e.preventDefault();
        //here check the file attachment 
        $.ajax({
         url: "{{ url('/save_bug_report') }}",
         type: 'post',
         data: new FormData(this),
         contentType: false,       
         cache: false,            
                 processData:false,             // No need to process data.
                 beforeSend: function(){
                   document.getElementById('wait').style.display = "block";
                 },
                 complete: function(){
                   document.getElementById('wait').style.display = "none";
                 },
                 success: function (response) 
                 {
                  if(response!=0 && response!=2)
                  {
                    $('#results_report').html('<span style="color:green;">Your Bug is submitted for review and bug id is ['+response+']</span>')
                  }
                  else
                  {
                    $('#results_report').html('<span style="color:red;">Something went wrong. Please try again.</span>')
                  }
                }
              });
      });
 });
 // document.addEventListener("DOMContentLoaded", function() {
 //        document.body.scrollTop; //force css repaint to ensure cssom is ready

 //        var timeout; //global timout variable that holds reference to timer

 //        var captcha = new $.Captcha({
 //          onFailure: function() {
 //           alert("wrong!!!");

 //         },

 //         onSuccess: function() {
 //          alert("CORRECT!!!");
 //        }
 //      });

 //        captcha.generate();
 //      });

// var aud = document.getElementById("myAudio");
// aud.onended = 
var next_play=false;
var equal_check=false;
var repeat_num = ''; 
var repeat_range = '';
var start_verse = ''; 
var t_ver = 0;
var is_ended = false;
var highlight = '';
t_ver = '{{ $surah->verses }}';
t_ver = parseInt(t_ver);
function audio_player() 
{
  var surah_id=$('#cmbSura').val();
  var current_verse_id = $('#cmbFVerse').val();
  var limit_verse = $('#cmbTVerse').val();
  repeat_num=$('#cmbVerseRepeat').val();
  repeat_range=$('#cmbRangeRepeat').val();
  var verse_no = current_verse_id;

  if(start_verse=='')
  {
    
    start_verse=current_verse_id;
  }
   if(equal_check){
    if($('#chkAPNS'). prop("checked") == true)
    {

     start_verse='';
    assign_temp();
    nextSurah();
    playPause();
    return;
}
else
{

  start_verse='';
    assign_temp();
    // $('#cmbFVerse').val('1');
    $('#cmbFVerse').val(1).change();
    playPause();
    return;
}
    
  }
  // if(current_verse_id=={{$surah->verses}})
  // {
  //   start_verse='';
  //   assign_temp();
  //   return;
  // }
  if(next_play)
  {
      
    current_verse_id = eval(current_verse_id)+eval(1);
  
    
  }
  else
  {
    next_play=true;
  }

  var id = eval(current_verse_id)-eval(1);
  $("#arabic"+id).css("background-color", "rgba(0,0,0,0)");
  $("#trans"+id).css("background-color", "rgba(0,0,0,0)");
  $("#trans-mobile"+id).css("background-color", "rgba(0,0,0,0)");

  //$('#cmbFVerse').val(current_verse_id+1);

    // if(typeof c_obj['verse_id' + current_verse_id] === 'undefined') {
    //   does not exist
    //   alert('not');
    // }
    // else {
    //     alert('yes');
    // }
    // alert(eval('c_obj.arb_link'+ current_verse_id));
    c_cur_verse_elem = eval('c_obj.verse_id'+ current_verse_id);
    if(c_cur_verse_elem == t_ver){
      is_ended = true;
    }
     
    var link = "{{$ADMIN_ASSETS}}/audios/"+eval('c_obj.arb_link'+ current_verse_id);
     
    $('#cmbFVerse').val(c_cur_verse_elem);
    $('#cmbFVerse1').val(c_cur_verse_elem);
    $.cookie('from_verse',c_cur_verse_elem, { expires: 60 });
    $.cookie('surah_id',surah_id, { expires: 60 });
    $('.c-verse').html(eval('c_obj.arb_desc'+ current_verse_id).replace(/\\r\\n/g, "<br />"));
    if(limit_verse==c_cur_verse_elem)
    {
      equal_check=true;
    }
    var audio = $('#myAudio').get(0);
    

    if(highlight=='')
   
      highlight = '#f2db8c';
   
    $('#highlight-color div').click(function(){
      highlight = $(this).css('background-color');
    });
    $("#arabic"+current_verse_id).css("background-color", highlight);
    $("#trans"+current_verse_id).css("background-color", highlight);
    $("#trans-mobile"+current_verse_id).css("background-color", highlight);
    $("#audio_source").prop('src', link);
    
    audio.load();
    audio.play();
     

            // var parentPos = $("#trans"+c_cur_verse_elem).parent().offset();
            // var childPos = $("#trans"+c_cur_verse_elem).offset();
            // var childtop =  childPos.top - parentPos.top;
            // $('.tran-side').animate({
            //     scrollTop: childtop
            // },2000);

            // var parentPos = $("#arabic"+c_cur_verse_elem).parent().offset();
            // var childPos = $("#arabic"+current_verse_id).offset();
            // var childtop =  childPos.top - parentPos.top;
            // $('.arabicSide').animate({
            //     scrollTop: childtop
            // },2000);


            // document.getElementById("arabic"+current_verse_id).scrollIntoView({
            //   behavior: 'smooth'
            // });
            var elmnt = document.getElementById("trans"+current_verse_id);
             elmnt.scrollIntoView();
            var elmnt = document.getElementById("arabic"+current_verse_id);
             elmnt.scrollIntoView();

             $('.extra_button a').click(function() {
             var elmnt = document.getElementById("trans"+current_verse_id);
             elmnt.scrollIntoView();
             var elmnt = document.getElementById("arabic"+current_verse_id);
             elmnt.scrollIntoView();
            });

              // $(window).scrollTop(0);
            // document.getElementById("trans"+current_verse_id).scrollIntoView({
              // behavior: 'smooth'
            // });
            // document.querySelector("#arabic"+current_verse_id).scrollIntoView({
            //   behavior: 'smooth'
            // });



  

    if(repeat_range==1)
    {

       var range =1;
    }
    // if(repeat_num >1 && repeat_range>=verse_no)
    if(repeat_num >1)
      {
         // alert(repeat_num);
        var count = 2;

       audio.onended = function()
        {
// if(count<=repeat_num && repeat_range>=range){
        if(count<=repeat_num){
          count++;
          range++;
            this.play();
          // if(repeat_range>1)
          // {
          //   repeat_range--; 
          // }
          // else
          // {
          //   audio_player();   
          // }
        }
        else
        {
          audio_player();
        }
      };
    }
    
//   $.ajax({
//    url:'{{ url('/get-next-audio') }}',
//    type: 'post',
//    data: {
//      "_token": "{{ csrf_token() }}",
//      "surah_id" : surah_id,
//      "current_verse_id" : current_verse_id,
//    },
//    beforeSend: function(){
//     document.getElementById("wait").style.display = "block";
//   },
//   complete: function(){
//   },
//   success: function (response) 
//   {
//     document.getElementById("wait").style.display = "none";
//     var returnedData = JSON.parse(response);
//     if(returnedData.f == 'true'){
//       var link = "{{$ADMIN_ASSETS}}/audios/"+returnedData.link_to_audio;
//       if(returnedData.verse == t_ver){
//         is_ended = true;
//       }
//       //$("#audio_source").attr('src', link);  

//       // document.getElementById('audio_source').setAttribute('src', link);

//       $('#cmbFVerse').val(returnedData.verse);
//       $('#c-verse').html(returnedData.description);
//       if(limit_verse==returnedData.verse)
//       {
//         equal_check=true;
//       }
//       var audio = $('#myAudio').get(0);

//       $("#arabic"+returnedData.verse).css("background-color",$('#cmbBColor').val());
//       $("#trans"+returnedData.verse).css("background-color",$('#cmbBColor').val());
//       $("#audio_source").prop('src', link);
//       audio.load();
//       audio.play();
//       if(repeat_num >1)
//       {
//        var count = 2;
//        audio.onended = function() {
//         if(count <= repeat_num){
//           count++;
//           this.play();
//         }
//         else
//         {
//           audio_player();
//         }
//       };
//     }else{

//     }
//     }

// }
// });

};


// Functions

    function mute()
    {
      // playPause();
      $('.mute-icon').toggleClass('mute_btn');
      var bool = $("#myAudio").prop("muted");
        $("#myAudio").prop("muted",!bool);
    }
    

var state="pause";
var one_time=true;
function playPause(){
  
  var x = document.getElementById("myAudio");
  var playbtn = document.getElementById("play_btn");
  if(one_time )
  {
   audio_player();
   one_time=false;
 }
 if(state=="pause")
 {    
   x.play(); 
   state="play";
   playbtn.className = "playing";
 } 
 else 
 {
   x.pause();
   state="pause";
   playbtn.className = "paused";
 } 
}

function stop_player(cond) {

// alert(cond);
  var audio = $('#myAudio').get(0);
  $("#audio_source").prop('src', "https://raw.githubusercontent.com/anars/blank-audio/master/250-milliseconds-of-silence.mp3");
  audio.load();
  audio.play();
  var savePlayer = $('#payer_area').html(); // Save player code
  $('#myAudio').remove(); // Remove player from DOM
  $('#payer_area').html(savePlayer); // Restore it
  // c_obj['arb_link0'] = '11.mp3';
  //         c_obj['verse_id0'] = 'sample text';
  //         c_obj['arb_desc0'] = 'samp';
         // from_verse=from_verse+'<option class="opt" value="'+0+'">'+0+'</option>';
          // $('#cmbFVerse').val(0);
  $('#cmbFVerse').val('1').change();
  // if($('#cmbSura').val()==='3'){
  //   $('#cmbSura').val('3').change();
  // }
  // $('#cmbTVerse').val({{$surah->verses}}).change();
  
}
function assign_temp() {
 var audio = $('#myAudio').get(0);
 $("#audio_source").prop('src', "https://raw.githubusercontent.com/anars/blank-audio/master/250-milliseconds-of-silence.mp3");
 audio.load();
 audio.play();
 state="playing";
 // playPause();
 var savePlayer = $('#payer_area').html(); // Save player code
 $('#myAudio').remove(); // Remove player from DOM
 $('#payer_area').html(savePlayer); // Restore it

 if(is_ended){
   $('#cmbFVerse').val(st_ver);
   equal_check = false;
   next_play=false;
   $("#arabic"+t_ver).css("background-color", "white");
   $("#trans"+t_ver).css("background-color", "white");
   $("#trans-mobile"+t_ver).css("background-color", "white");
   is_ended = false;
 }
}
//repeat audio
//  $('#cmbRangeRepeat').change(reapeater);
//  function reapeater() {
  //   audio_player('repeat');
  // }

//get raku
$('#cmbHizb').change(getraku);
function getraku()
{
  assign_temp();
  emptyObject(c_obj);
  console.log(c_obj);
  var raku_number=$('#cmbHizb').val();
  var surah_id=$('#cmbSura').val();
   
  $.ajax({
   url:'{{ url('/get-raku') }}',
   type: 'post',
   data: {
     "_token": "{{ csrf_token() }}",
     "raku_number" : raku_number,
     "surah_id" : surah_id,
   },
   beforeSend: function(){
    document.getElementById("wait").style.display = "block";
  },
  complete: function(){
  },
  success: function (response) 
  {
   document.getElementById("wait").style.display = "none";
   if(response!=0)
   {
     // alert(response);
     var arabic='';
     var translation='';
     var from_verse='';
     var to_verse='';
     var returnedData = JSON.parse(response);
     var i=1;

     //update from verse option 
     var i;
     for (i = 1; i <= returnedData.verses; i++) { 
       from_verse=from_verse+'<option class="opt" value="'+i+'">'+i+'</option>';
        
     }
     for (i = returnedData.verses; i >= 1; i--) { 
       to_verse=to_verse+'<option class="opt" value="'+i+'">'+i+'</option>';

     }
     // $("#cmbFVerse").val(returnedData.from);
     // $('#sura_n').html(returnedData.surah['surah_name_arabic']);
     // $('#sura_nm').html(returnedData.surah['surah_name']);
     // $('#c-surah').html(returnedData.surah['introduction']);
     //update to verse option 
     returnedData.verse.forEach( function (item) {
      c_obj['verse_id' + item.verse] = item.verse;
      c_obj['arb_link' + item.verse] = item.link_to_audio;
      c_obj['arb_desc' + item.verse] = item.description;
      arabic=arabic+"<span class='arbic' id='arabic"+item.verse+"'>"+item.arabic_immune+" <span class='ayah-end1'> <span>"+item.verse+"</span> </span></span> <p class='trns trans-mobile' id='trans-mobile"+item.verse+"'>"+item.translation+" <span class='ayah-end1'> <span>"+item.verse+"</span> </span> </p>";
      translation=translation+"<span class='trns' id='trans"+item.verse+"'>"+item.translation+" <span class='ayah-end1'> <span>"+item.verse+"</span> </span> </span>";
      i++;
    });
     // alert();
     
     //assign 1st audio 

     // var link = "{{$ADMIN_ASSETS}}/audios/"+returnedData.link_to_audio;
     //  alert(link);
     //  $("audio #audio_source").attr('src',"'"+link+"'");
     $('#cmbSura').val(returnedData.id);
     $("#arabic").html("");
     $("#arabic").append(arabic);
     $("#translation").html("");
     $("#translation").append(translation); 
     $("#cmbFVerse").html("");
     $("#cmbFVerse").append(from_verse);
     $("#cmbFVerse").val(returnedData.verse[0]['verse']);
     $("#cmbTVerse").html("");
     $("#cmbTVerse").append(to_verse);
     var f_ver=$("#cmbFVerse").val();
     var t_ver=$("#cmbTVerse").val();
     // alert(t_ver);
     $("#cmbFVerse1").val(f_ver);
     $("#cmbTVerse1").val(t_ver); 
     playPause();
   }
   else
   {
    alert('Data not found');
  }

}
});
}
 

 //get juz 

 $('#cmbJuz').change(getJuz);
 function getJuz()
 {
  
  assign_temp();
  emptyObject(c_obj);
  console.log(c_obj);
  var juz_number=$('#cmbJuz').val();
  $.ajax({
   url:'{{ url('/get-juzz') }}',
   type: 'post',
   data: {
     "_token": "{{ csrf_token() }}",
     "juz_number" : juz_number,
   },
   beforeSend: function(){
    document.getElementById("wait").style.display = "block";
  },
  complete: function(){
  },
  success: function (response) 
  {
   document.getElementById("wait").style.display = "none";
   if(response!=0)
   {
     
     var arabic='';
     var translation='';
     var from_verse='';
     var to_verse='';
     var raku='';
     var returnedData = JSON.parse(response);
     
     // alert(returnedData.surah['id']);
     // $("#cmbFVerse").val(returnedData.from);
     // $("#cmbFVerse1").val(returnedData.from);
     // alert(returnedData.from);
     // getSurah(from);
     // getSurah('',returnedData.from);

     var i=1;
     // var i;
     // console.log(returnedData.surah);
     // $('#sura_n').html(returnedData.surah['surah_name_arabic']);
     // $('#sura_nm').html(returnedData.surah['surah_name']);
     // $('#c-surah').html(returnedData.surah['introduction']);
     // for (i = 1; i <= returnedData.surah['verses']; i++) { 
     //   from_verse=from_verse+'<option class="opt" value="'+i+'">'+i+'</option>';
        
     // }
     // for (i = returnedData.surah['verses']; i >= 1; i--) { 
     //   to_verse=to_verse+'<option class="opt" value="'+i+'">'+i+'</option>';

     // }
     // for (i = 1; i <= returnedData.surah['raku']; i++) { 
     //   raku=raku+'<option  value="'+i+'">'+i+'</option>';
     // }
     // update to verse option 
    //  returnedData.verses.forEach( function (item) {
    //   c_obj['verse_id' + item.verse] = item.verse;
    //   c_obj['arb_link' + item.verse] = item.link_to_audio;
    //   c_obj['arb_desc' + item.verse] = item.description;
    //   arabic=arabic+"<span class='arbic' id='arabic"+item.verse+"'>"+item.arabic_immune+" <span class='ayah-end1'> <span>"+item.verse+"</span> </span></span>";
    //   translation=translation+"<span class='trns' id='trans"+item.verse+"'>"+item.translation+" <span class='ayah-end1'> <span>"+item.verse+"</span> </span> </span>";
      
    // });
     
     // console.log(c_obj);
     $('#cmbSura').val(returnedData.surah['id']);
     getSurah('',returnedData.from);
     /*$("#arabic").html("");
     $("#arabic").append(arabic);
     $("#translation").html("");
     $("#translation").append(translation); 
     $("#cmbFVerse").html("");
     $("#cmbFVerse").append(from_verse); 
     $("#cmbFVerse").val(returnedData.from);
     $("#cmbTVerse").html("");
     $("#cmbTVerse").append(to_verse);*/
     // var f_ver=$("#cmbFVerse").val();
     // var t_ver=$("#cmbTVerse").val();
     // $("#cmbFVerse1").val(f_ver);
     // $("#cmbTVerse1").val(t_ver);
     // $("#cmbHizb").html("");
     // $("#cmbHizb").append(raku); 
      // playPause();
   }
   else
   {
    // alert('Data not found');
  }

}
});

}
function emptyObject(obj) {
  Object.keys(obj).forEach(k => delete obj[k])
}
//surah js 
$('#cmbSura').change(getSurah);
function getSurah(get_special,verse='false'){
  // alert(verse);
  next_play=false;
  state="stop";
  equal_check=false;
  assign_temp();
  emptyObject(c_obj);
  var surah_id=$('#cmbSura').val();
  $.cookie('surah_id',surah_id, { expires: 60 });
  if(get_special=='pre')
  {
    type = 'pre';
  }
  else if(get_special=='next')
  {

    type = 'next';
  }else{
    type = 'null';
  }
  // alert(surah_id);
  $.ajax({
   url:'{{ url('/get-surah') }}',
   type: 'post',
   data: {
     "_token": "{{ csrf_token() }}",
     "surah_id" : surah_id,
     "get_special" : type
   },
   beforeSend: function(){
    document.getElementById("wait").style.display = "block";
  },
  complete: function(){

  },
  success: function (response) 
  {
    document.getElementById("wait").style.display = "none";
    if(response!=0)
    {

     var returnedData = JSON.parse(response);
     st_ver = 1;
     t_ver = returnedData.verses;
     var arabic='';
     var translation='';
     var from_verse=st_ver;
     var to_verse= t_ver;
     var raku=returnedData.raku
     // alert(returnedData.surah_number);
     var i=1;
     //update from verse option 
     // var i;
  
      if(returnedData.surah_number!=9)
      {
          c_obj['arb_link0'] = '11.mp3';
          c_obj['verse_id0'] = '0';
          if(returnedData.surah_number==1)
          {
             c_obj['arb_desc0'] = 'Surah Al-Fatihah er en bønn Allah lærer mennesker som skal studere Hans bok. Dens plassering i begynnelsen viser viktigheten av den for enhver som ønsker å dra nytte av Boken, og denne bønnen til Herren over alle universene bør derfor fremlegges først.';
          }
          else
          {

          c_obj['arb_desc0'] = '';
          }
         from_verse=from_verse+'<option hidden class="opt" value="'+0+'">'+0+'</option>';
          $('#cmbFVerse').val(0);
          
       }
        
          
     var link='';
     for (i = 1; i <= returnedData.raku; i++) { 
       raku=raku+'<option  value="'+i+'">'+i+'</option>';
        
     }
     
     for (i = 1; i <= returnedData.verses; i++) { 
       from_verse=from_verse+'<option class="opt" value="'+i+'">'+i+'</option>';
        
     }
     for (i = returnedData.verses; i >= 1; i--) { 
       to_verse=to_verse+'<option class="opt" value="'+i+'">'+i+'</option>';

     }


     //update to verse option 
     var foot=1;
     $('#sura_n').html(returnedData.surah_name_arabic);
     $('#sura_nm').html(returnedData.surah_name);
     $('#c-surah').html(returnedData.introduction);
     returnedData.verse.forEach( function (item) {
      
      c_obj['verse_id' + item.verse] = item.verse;
      c_obj['arb_link' + item.verse] = item.link_to_audio;
      c_obj['arb_desc' + item.verse] = item.description;
      if(returnedData.surah_number!=1)
      {
         arabic=arabic+"<span class='arbic' id='arabic"+item.verse+"'>"+item.arabic_immune+" <span class='ayah-end1'> <span>"+item.verse+"</span> </span></span> <p class='trns trans-mobile' id='trans-mobile"+item.verse+"'>"+item.translation+" <span class='ayah-end1'> <span>"+item.verse+"</span> </span> </p>";
      translation=translation+"<span class='trns' id='trans"+item.verse+"'>"+item.translation+" <span class='ayah-end1'> <span>"+item.verse+"</span> </span> </span>";  
      }
      else
      {
        verses=+item.verse + +1;
         arabic=arabic+"<span class='arbic' id='arabic"+item.verse+"'>"+item.arabic_immune+" <span class='ayah-end1'> <span>"+verses+"</span> </span></span> <p class='trns trans-mobile' id='trans-mobile"+item.verse+"'>"+item.translation+" <span class='ayah-end1'> <span>"+verses+"</span> </span> </p>";
      translation=translation+"<span class='trns' id='trans"+item.verse+"'>"+item.translation+" <span class='ayah-end1'> <span>"+verses+"</span> </span> </span>";  
      }

      
      // alert();

       
      if(returnedData.surah_number==1 && foot==1)
      {
      $(".c-verse").html('');
      // desc = item.description;
      // desc = desc.replace('<p>' , '');
      // desc = desc.replace('</p>' , '');
      $(".c-verse").append('Surah Al-Fatihah er en bønn Allah lærer mennesker som skal studere Hans bok. Dens plassering i begynnelsen viser viktigheten av den for enhver som ønsker å dra nytte av Boken, og denne bønnen til Herren over alle universene bør derfor fremlegges først.');
         foot=2;
      }
      if(returnedData.surah_number!=1)
      {
        $(".c-verse").html('');
      }
    });
     console.log(c_obj);
     $('#cmbSura').val(returnedData.id);
     $("#arabic").html("");
     $("#arabic").append(arabic);
     $("#translation").html("");
     $("#translation").append(translation); 
     $("#cmbFVerse").html("");
     $("#cmbFVerse").append(from_verse); 
     $("#cmbTVerse").html("");
     $("#cmbTVerse").append(to_verse);
     $("#cmbTVerse1").val(t_ver); 
     if(verse=='false')
   {
     $("#cmbJuz").val(returnedData.juz_id);
   }
     $("#cmbHizb").html("");
     $("#cmbHizb").append(raku);
     if(returnedData.surah_number!=9)
      {
     $('.bismila').show();
     } else{

   
      $('.bismila').hide();
     }

     if(returnedData.surah_number!=1)
     {
       $('.fatiha').hide();
     }
     else
     {
       $('.fatiha').show();
     }
     
       
if(verse=='false')
{
    // alert(t_ver);
    playPause();
    highlight = '#f2db8c';
    $("#cmbFVerse").val(0);
    $("#cmbFVerse1").val(1);
    $.cookie('from_verse',1, { expires: 60 });
    $.cookie('surah_id',surah_id, { expires: 60 });
    $.cookie('to_verse',returnedData.verses, { expires: 60 });
    
    // $("#arabic"+1).css("background-color", highlight);
    // $("#trans"+1).css("background-color", highlight);
}
  else
  {
   highlight = '#f2db8c';
   $("#cmbFVerse").val(verse);
   $("#cmbFVerse1").val(verse);
   var to_verse=$.cookie("to_verse");
   // alert(to_verse);
   $('#cmbTVerse').val(to_verse);
   $('#cmbTVerse1').val(to_verse);
   
   
    $("#arabic"+verse).css("background-color", highlight);
    $("#trans"+verse).css("background-color", highlight);
    $("#trans-mobile"+verse).css("background-color", highlight);
    playPause();      
  }
  

   }
   else
   {
   }

   // $("#arabic").append(view);
   // 
 }
});

}
function previousSurah(){
  getSurah('pre');
}
function nextSurah(){
  getSurah('next');
}


function nextfootnotes()
{
  var surah_id=$('#cmbSura').val();
  var from_verse=$('#cmbFVerse').val();
  
  $.ajax({
   url:'{{ url('/get-next-foot') }}',
   type: 'post',
   data: {
     "_token": "{{ csrf_token() }}",
     "surah_id" : surah_id,
     "from_verse" : from_verse,
     
   },
   beforeSend: function(){
     document.getElementById("wait").style.display = "block"; 
   },
   complete: function(){

   },
   success: function (response) 
   {

    document.getElementById("wait").style.display = "none";
    var returnedData = JSON.parse(response);
       
      // $(".c-verse").html('');
      // $(".c-verse").append(returnedData.description);
      $(".c-verse").html('');
      desc = returnedData.description;
      desc = desc.replace('<p>' , '');
      desc = desc.replace('</p>' , '');
      $(".c-verse").append(desc);
      $("#cmbFVerse").val(returnedData.verse);
      
    
 }
});
}


function prefootnotes()
{
  var surah_id=$('#cmbSura').val();
  var from_verse=$('#cmbFVerse').val();
  
  $.ajax({
   url:'{{ url('/get-pre-foot') }}',
   type: 'post',
   data: {
     "_token": "{{ csrf_token() }}",
     "surah_id" : surah_id,
     "from_verse" : from_verse,
     
   },
   beforeSend: function(){
     document.getElementById("wait").style.display = "block"; 
   },
   complete: function(){

   },
   success: function (response) 
   {
    
    document.getElementById("wait").style.display = "none";
    var returnedData = JSON.parse(response);
      $(".c-verse").html('');
      $(".c-verse").append(returnedData.description);
      $("#cmbFVerse").val(returnedData.verse);
    
 }
});
}
//end surah js
//from verse change js
$('#cmbFVerse').change(getSurahFromVerse);
function getSurahFromVerse(){
  foot=1;
  next_play=false;
  equal_check=false;
  $(this).addClass('slectedopt');
  assign_temp();
  var surah_id=$('#cmbSura').val();
  var from_verse=$('#cmbFVerse').val();
  if(surah_id === '3'){
    $.cookie('from_verse',parseInt(from_verse)-1, { expires: 60 });
  }
  else{
    $.cookie('from_verse',from_verse, { expires: 60 });
  }
  
  var to_verse=$('#cmbTVerse').val();
  $.ajax({
   url:'{{ url('/get-surah-from-verse') }}',
   type: 'post',
   data: {
     "_token": "{{ csrf_token() }}",
     "surah_id" : surah_id,
     "from_verse" : from_verse,
     "to_verse" : to_verse,
   },
   // beforeSend: function(){
   //   // document.getElementById("wait").style.display = "block"; 
   // },
   complete: function(){

   },
   success: function (response) 
   {
    // document.getElementById("wait").style.display = "none";
    if(response!=0)
    {
     var arabic='';
     var translation='';
     var returnedData = JSON.parse(response);
     var i=1;
     var link='';
     returnedData.verse.forEach( function (item) {
      if(returnedData.surah_number!=1)
      {
         arabic=arabic+"<span class='arbic' id='arabic"+item.verse+"'>"+item.arabic_immune+" <span class='ayah-end1'> <span>"+item.verse+"</span> </span></span> <p class='trns trans-mobile' id='trans-mobile"+item.verse+"'>"+item.translation+" <span class='ayah-end1'> <span>"+item.verse+"</span> </span> </p>";
      translation=translation+"<span class='trns' id='trans"+item.verse+"'>"+item.translation+" <span class='ayah-end1'> <span>"+item.verse+"</span> </span> </span>";  
      }
      else
      {
        verses=+item.verse+1;
         arabic=arabic+"<span class='arbic' id='arabic"+verses+"'>"+item.arabic_immune+" <span class='ayah-end1'> <span>"+verses+"</span> </span></span> <p class='trns trans-mobile' id='trans-mobile"+verses+"'>"+item.translation+" <span class='ayah-end1'> <span>"+verses+"</span> </span> </p>";
      translation=translation+"<span class='trns' id='trans"+verses+"'>"+item.translation+" <span class='ayah-end1'> <span>"+verses+"</span> </span> </span>";  
      }


      if(returnedData.surah_number==1 && item.verse==1)
      {
      $(".c-verse").html('');
      // desc = item.description;
      // desc = desc.replace('<p>' , '');
      // desc = desc.replace('</p>' , '');
      $(".c-verse").append('Surah Al-Fatihah er en bønn Allah lærer mennesker som skal studere Hans bok. Dens plassering i begynnelsen viser viktigheten av den for enhver som ønsker å dra nytte av Boken, og denne bønnen til Herren over alle universene bør derfor fremlegges først.');
         foot=2;
      }
      else
      {
        if(foot==1)
      {
        // $(".c-verse").html('');
        // $(".c-verse").append(item.description);
        $(".c-verse").html('');
        desc = item.description;
        desc = desc.replace('<p>' , '');
        desc = desc.replace('</p>' , '');
        $(".c-verse").append(desc);
        foot=2;
      }
      }
      // if(returnedData.surah_number!=1)
      // {
      //   $(".c-verse").html('');
      // }
      if(i==1)
      {
       link = "{{$ADMIN_ASSETS}}/audios/"+item.link_to_audio;
       st_ver = item.verse; 
      }
     i++;
   });

   }

   $("audio #audio_source").attr('src',"'"+link+"'");   
   $("#arabic").html("");
   $("#arabic").append(arabic);
   $("#translation").html("");
   $("#translation").append(translation);
   if(returnedData.surah_number!=9 && from_verse==1)
   {
   $('.bismila').show();
   if(returnedData.surah_number==1)
   {
      $('.fatiha').show();
   }
   $('#cmbFVerse').val(0);
   }
   else
   {

    $('.bismila').hide();
    $('.fatiha').hide();
   }
    // highlight = 'white'; 
    // $("#arabic"+from_verse).css("background-color", highlight);
    // $("#trans"+from_verse).css("background-color", highlight);
    playPause();
   // $("#arabic").append(view);
   // 
 }
});
}

//end from verse js
//to verse change js
$('#cmbTVerse').change(getSurahToVerse);
function getSurahToVerse(){
  var foot=1;
  $(this).addClass('slectedopt');
  next_play=false;
  equal_check=false;
  assign_temp();
  var surah_id=$('#cmbSura').val();
  var from_verse=$('#cmbFVerse1').val();
  var to_verse=$('#cmbTVerse').val();
  $.cookie('to_verse',to_verse, { expires: 60 });
  $.ajax({
   url:'{{ url('/get-surah-to-verse') }}',
   type: 'post',
   data: {
     "_token": "{{ csrf_token() }}",
     "surah_id" : surah_id,
     "from_verse" : from_verse,
     "to_verse" : to_verse,
   },
   // beforeSend: function(){
   //   document.getElementById("wait").style.display = "block"; 
   // },
   complete: function(){

   },
   success: function (response) 
   {
    // document.getElementById("wait").style.display = "none";
    if(response!=0)
    {
     var arabic='';
     var translation='';
     var returnedData = JSON.parse(response);
     var i=1;
     t_ver = to_verse;

     returnedData.verse.forEach( function (item) {
      arabic=arabic+"<span class='arbic' id='arabic"+item.verse+"'>"+item.arabic_immune+" <span class='ayah-end1'> <span>"+item.verse+"</span> </span> </span> <p class='trns  trans-mobile' id='trans-mobile"+item.verse+"'>"+item.translation+" </span> <span class='ayah-end1'> <span>"+item.verse+"</span> </p> ";
      translation=translation+"<span class='trns' id='trans"+item.verse+"'>"+item.translation+" </span> <span class='ayah-end1'> <span>"+item.verse+"</span> </span>";
      if(foot==1)
      {
        // $(".c-verse").html('');
        // $(".c-verse").append(item.description);
        $(".c-verse").html('');
        desc = item.description;
        desc = desc.replace('<p>' , '');
        desc = desc.replace('</p>' , '');
        $(".c-verse").append(desc);
      foot=2;
      }
      if(i==1)
      {
       link = "{{$ADMIN_ASSETS}}/audios/"+item.link_to_audio;

     }
     i++;
   });

   }
   //$("audio #audio_source").attr('src',"'"+link+"'");   
   $("#arabic").html("");
   $("#arabic").append(arabic);
   $("#translation").html("");
   $("#translation").append(translation);
   // $('.bismila').hide();
   // highlight = 'white'; 
   //  $("#arabic"+to_verse).css("background-color", highlight);
   //  $("#trans"+to_verse).css("background-color", highlight);
    playPause();
   // $("#arabic").append(view);
   // 
 }
});
}

//end from verse js

//zoomin
var ayah_end_width = 21;
var ayah_end_font_size = 14;
var zoom_size=25;
var cust_num_size = 1;
var arabic_zoom;
var surah_name_line_height = 62;
var _surah_name_line_height;

// reset text when some other surah, ayah, juz, etc. is selected
$('.nav_box select').change(function(){
  ayah_end_width = 21;
  ayah_end_font_size = 14;
  zoom_size=25;
  cust_num_size = 1;

  $('.trns').css('font-size', '1.2rem');
  $('.arbic').css('font-size', '1.9rem');
  $('#sura_nm').css('line-height', '62px');
  $('#translation').css('margin-top', 0);
  $('.ayah-end1').css('width', '30px');
  $('.ayah-end1 span').css('font-size', '14px');
});

function zoomin() {
  if(zoom_size<45)
  {
    zoom_size=zoom_size+5;
    var zoom=zoom_size+"px";
    arabic_zoom = zoom_size+3;
    arabic_zoom = arabic_zoom+"px";
    $(".arbic").css("font-size", arabic_zoom);
    z=zoom_size/24.5;
    var zm=z+"rem";
    $(".trns").css("font-size", zm);
    $(".trns").css("line-height","1.6");
    $(".arbic").css("line-height", "1.6");
    cust_num_size = cust_num_size + 0.1;
    ayah_end_width =  ayah_end_width + 9;
    if(ayah_end_width > 43)
      ayah_end_width = 43;
    ayah_end_font_size += 2;
    $('.custom-number').css("font-size", cust_num_size+'rem');
    $('.ayah-end1').css('width', ayah_end_width+'px');
    $('.ayah-end1 span').css({'font-size':ayah_end_font_size+'px'});

    surah_name_line_height+=8;
    _surah_name_line_height = surah_name_line_height;
    $('#sura_nm').css('line-height', _surah_name_line_height+'px');
    $('#translation').css('margin-top', (_surah_name_line_height-39)+'px');
  }
}
function zoomout() {
  if(zoom_size<=45 && zoom_size>25)
  {
    zoom_size=zoom_size-5;
    arabic_zoom = zoom_size+3;
    arabic_zoom = arabic_zoom+"px";
    var zoom=zoom_size+"px";
    $(".arbic").css("font-size", arabic_zoom);
    z=zoom_size/24.5;
    var zm=z+"rem";
    $(".trns").css("font-size", zm);
    $(".trns").css("line-height","1.5");
    $(".arbic").css("line-height", "1.5");
    cust_num_size = cust_num_size - 0.1;
    ayah_end_width =  ayah_end_width - 9;
    if(ayah_end_width < 30)
      ayah_end_width = 30;
    ayah_end_font_size -= 2;
    $('.custom-number').css("font-size", cust_num_size+'rem');
    $('.ayah-end1').css('width', ayah_end_width+'px');
    $('.ayah-end1 span').css({'font-size':ayah_end_font_size+'px'});

    surah_name_line_height-=8;
    _surah_name_line_height = surah_name_line_height;
    $('#sura_nm').css('line-height', _surah_name_line_height+'px');
    $('#translation').css('margin-top', (_surah_name_line_height-39)+'px');
  }
  if(zoom_size == 25) {
    $('.trns').css('font-size', '1.2rem');
    $('.arbic').css('font-size', '1.9rem');
    $('.ayah-end1').css('width', '30px');
    $('#translation').css('margin-top', 0);
  }
}
//change fore color

      $('#highlight-color div').click(function(){
      $('#highlight-color').addClass('hidden');
      var from_verse=$('#cmbFVerse')
      highlight = $(this).css('background-color');
      $("#arabic"+from_verse).css("background-color", highlight);
      $("#trans"+from_verse).css("background-color", highlight);
      $("#trans-mobile"+from_verse).css("background-color", highlight);
    });
   $('#font-color div').click(function(){
    $('#font-color').addClass('hidden');
    color_code = $(this).css('background-color');
    $("#arabic").css("color",color_code);
    $("#translation").css("color",color_code);
    $("#fore-color").css("color",color_code);
  });

function searchResult()
{
   var search_text=$('#txtSearchText').val();
 var surah_id=$('#cmbSearchSura').val();
 var search_lang=$('#cmbSearchLanguage').val();
 // var immn=$('#immn').val();
 // stop_player();
 $.ajax({
   url:'{{ url('/get-search') }}',
   type: 'post',
   data: {
     "_token": "{{ csrf_token() }}",
     "surah_id" : surah_id,
     "search_text" : search_text,
      "search_lang" : search_lang,
     // "immn" : immn
   },
   beforeSend: function(){
     document.getElementById("wait").style.display = "block"; 
   },
   complete: function(){

   },
   success: function (response) 
   {
     document.getElementById("wait").style.display = "none"; 
     //  var returnedData = JSON.parse(response);

     var results='';
     var total_found=0;
     // alert(response);
     response.forEach( function (item) {
      total_found++;
      if(item.arabic_immune)
      {

        results=results+'<a href="#" onclick="show_verse('+item.surah.id+','+item.verse+')"> <h6><span class="trn">Sura</span> '+item.surah.surah_number+' - '+item.surah.surah_name+' : <span class="trn">Verse</span> '+item.verse+'</h6></a><p class="arbic">'+item.arabic_immune+'</p>';

      }
      else
      {
       results=results+'<a href="#" onclick="show_verse('+item.surah.id+','+item.verse+')"> <h6><span class="trn">Sura</span> '+item.surah.surah_number+' - '+item.surah.surah_name+' : <span class="trn">Verse</span> '+item.verse+'</h6></a><p>'+item.translation+'</p>';

     }

   });
     $("#results").html("");
     $("#results").append(results);
     $("#total_found").html("");
     $("#total_found").append(" : "+total_found);
     var c_lan = $('.lang-selected').find('a').data('value'); 
                  var _t = $('body').translate({  
                    lang: c_lan,  
                    t: dict 
                    }); 
                    var str = _t.g("translate");
     $("#total").show();
   }
 });
    }

$('#searchform').submit(function(e){
    e.preventDefault();
});

$('#txtSearchText').on("keydown", function (e) {

    if (e.keyCode === 13) { 
      searchResult();

    }
        
});

//seach page content js
$('#searchBtn').click(function(){
  // alert();
    searchResult();

});
function show_verse(surah_id,verse){
 change_content("home"); 
 // alert(verse);
 $('#cmbSura').val(surah_id);
 
  // $('#cmbTVerse').val(verse);
 // $('#cmbSura').val(surah_id).change();
 getSurah('',verse);
}

function show_verse_bookmark(surah_id,from_verse,to_verse){
 change_content("home"); 
 
 // $('#cmbSura').val(surah_id).change();
 
  $('#cmbTVerse').val(to_verse);
  $('#cmbFVerse').val(from_verse);
 $('#cmbSura').val(surah_id);
  getSurah('',from_verse);
}



function pause_page_switch_audio() {
 var x = document.getElementById("myAudio");
 var playbtn = document.getElementById("play_btn");
 x.pause();
 state="pause"
 playbtn.className = "paused";
}

function change_content(page) {

  if(page=="home")
  {
    document.getElementById("search_menu").style.display = "none";
    document.getElementById("search_content").style.display = "none";
    document.getElementById("home_menu").style.display = "block";
    document.getElementById("bookmark_content").style.display = "none";
    document.getElementById("inv_friend_content").style.display = "none";
    document.getElementById("bug_report").style.display = "none";
    document.getElementById("login_content").style.display = "none";
    document.getElementById("Signup").style.display = "none";
    document.getElementById("forget").style.display = "none";
    document.getElementById("home_content").style.display = "block";
  }
  else if (page=="search")
  {
    pause_page_switch_audio();
    document.getElementById("home_menu").style.display = "none";
    document.getElementById("Signup").style.display = "none";
    document.getElementById("home_content").style.display = "none";
    document.getElementById("bookmark_content").style.display = "none";
    document.getElementById("inv_friend_content").style.display = "none";
    document.getElementById("bug_report").style.display = "none";
    document.getElementById("login_content").style.display = "none";
    document.getElementById("search_menu").style.display = "block";
    document.getElementById("forget").style.display = "none";
    document.getElementById("search_content").style.display = "block";
  }
  else if (page=="inv_friend")
  {
   pause_page_switch_audio();
   document.getElementById("home_menu").style.display = "none";
   document.getElementById("home_content").style.display = "none";
   document.getElementById("search_menu").style.display = "none";
   document.getElementById("search_content").style.display = "none";
   document.getElementById("bookmark_content").style.display = "none";
   document.getElementById("bug_report").style.display = "none";  
   document.getElementById("login_content").style.display = "none";
   document.getElementById("Signup").style.display = "none";
   document.getElementById("forget").style.display = "none";
   document.getElementById("inv_friend_content").style.display = "block";
 }
 else if (page=="bug_report")
 {
  pause_page_switch_audio();
  form_set();
  document.getElementById("home_menu").style.display = "none";
  document.getElementById("home_content").style.display = "none";
  document.getElementById("search_menu").style.display = "none";
  document.getElementById("search_content").style.display = "none";
  document.getElementById("bookmark_content").style.display = "none";
  document.getElementById("inv_friend_content").style.display = "none";
  document.getElementById("login_content").style.display = "none";
  document.getElementById("Signup").style.display = "none";
  document.getElementById("forget").style.display = "none";
  document.getElementById("bug_report").style.display = "block";  
}
else if (page=="bookmark")
{
  pause_page_switch_audio();
  document.getElementById("home_menu").style.display = "none";
  document.getElementById("home_content").style.display = "none";
  document.getElementById("search_menu").style.display = "none";
  document.getElementById("search_content").style.display = "none";
  document.getElementById("inv_friend_content").style.display = "none";
  document.getElementById("bug_report").style.display = "none";
  document.getElementById("login_content").style.display = "none";
  document.getElementById("Signup").style.display = "none";
  document.getElementById("forget").style.display = "none";
  document.getElementById("bookmark_content").style.display = "block";
}
else if (page=="Login")
{
  pause_page_switch_audio();
  document.getElementById("home_menu").style.display = "none";
  document.getElementById("home_content").style.display = "none";
  document.getElementById("search_menu").style.display = "none";
  document.getElementById("search_content").style.display = "none";
  document.getElementById("inv_friend_content").style.display = "none";
  document.getElementById("bug_report").style.display = "none";
  document.getElementById("bookmark_content").style.display = "none";
  document.getElementById("forget").style.display = "none";
  document.getElementById("Signup").style.display = "none";
  document.getElementById("login_content").style.display = "block";
  
}
else if (page=="Signup")
{
  pause_page_switch_audio();
  document.getElementById("home_menu").style.display = "none";
  document.getElementById("home_content").style.display = "none";
  document.getElementById("search_menu").style.display = "none";
  document.getElementById("search_content").style.display = "none";
  document.getElementById("inv_friend_content").style.display = "none";
  document.getElementById("bug_report").style.display = "none";
  document.getElementById("bookmark_content").style.display = "none";
  document.getElementById("login_content").style.display = "none";
  document.getElementById("forget").style.display = "none";
  document.getElementById("Signup").style.display = "block";
}


else if (page=="forget")
{
  pause_page_switch_audio();
  document.getElementById("home_menu").style.display = "none";
  document.getElementById("home_content").style.display = "none";
  document.getElementById("search_menu").style.display = "none";
  document.getElementById("search_content").style.display = "none";
  document.getElementById("inv_friend_content").style.display = "none";
  document.getElementById("bug_report").style.display = "none";
  document.getElementById("bookmark_content").style.display = "none";
  document.getElementById("login_content").style.display = "none";
  document.getElementById("Signup").style.display = "none";
  document.getElementById("forget").style.display = "block";
  
}

else 
{

}

}
function form_set() {
  $('#Surah_b_id').html("<b>Suarh : </b>"+$("#cmbSura option:selected").text());
  var verse_text="<b>Verse : </b>"+$('#cmbFVerse').val()+' - '+$('#cmbTVerse').val();
  $('#verse_b_id').html(verse_text);
  $('#recitor_b_id').html("<b>Recitor : </b>"+$("#cmbReciter option:selected").text());
  $('#Surah_b_id_in').val($("#cmbSura").val());
  $('#from_verse_b_id_in').val($('#cmbFVerse').val());
  $('#to_verse_b_id_in').val( $('#cmbTVerse').val());
  $('#recitor_b_id_in').val($('#cmbReciter').val());
}
//send invitarion
$(function () {
 $('#form').on('submit',function (e) {
   e.preventDefault();
        //here check the file attachment 
        $.ajax({
         url: "{{ url('/send_invitation') }}",
         type: 'post',
         data: new FormData(this),
         contentType: false,       
         cache: false,            
                 processData:false,             // No need to process data.
                 beforeSend: function(){
                   document.getElementById('wait').style.display = "block";
                 },
                 complete: function(){
                   document.getElementById('wait').style.display = "none";
                 },
                 success: function (response) 
                 {
                  

                  if(response==1)
                  {
                   $('#invite_results').html('Invitation is successfully sent.');
                  }
                  else
                  {
                    $('#invite_results').html('Something went wrong.');
                  }
                  
                }
              });
      });
});


//save bookmarks
function book()
{
  pause_page_switch_audio();
  document.getElementById("home_menu").style.display = "none";
  document.getElementById("home_content").style.display = "none";
  document.getElementById("search_menu").style.display = "none";
  document.getElementById("search_content").style.display = "none";
  document.getElementById("inv_friend_content").style.display = "none";
  document.getElementById("bug_report").style.display = "none";
  document.getElementById("bookmark_content").style.display = "block";
  swal.close();
}
function save_bookmarks() {
  var t_title = $('#save_bookmark').html(); 
    var t_cancel = $('#btn_cancel').html(); 
    var t_save = $('#btn_save').html(); 
    var t_find = $('#btn_find').html(); 
    @if(\Auth::check()) 
    var user_email = "{{auth()->user()->email}}"; 
    @else 
    var user_email = "";  
    @endif  
  swal({
    type: "info",
    title: '<span  class="trn">'+t_title+'</span>',
    text: '<div class="control-group trn"><input type="hidden" id="email_bookmark" class="form-control" value="'+user_email+'" placeholder="Enter your email" name="email" required></div><input type="hidden" value=" name="ticket_id"><div class="control-group"><br/><input type="reset" value="'+t_cancel+'" onclick="swal.close()" class="btn btn-danger">&nbsp;&nbsp;&nbsp;<input type="submit" onclick="submit()" value="'+t_save+'" class="btn btn-success"> <a href="#" onclick="return book()")"  class="btn btn-find">'+t_find+'</a> </div> ',
    html: true,
    showConfirmButton: false ,

  });
}

function submit() {
var btn_cancel = $('#btn_cancel').html(); 
    var b_again = $('#b_again').html();
 var email = $('#email_bookmark').val();
 if(email=='')
 {
  swal({
    type: "error",
    title: 'Provide Your Email',
    text: 'Email is required to save bookmarks.',
    html: true,
    text: '<input type="reset" value="'+btn_cancel+'" onclick="swal.close()" class="btn btn-danger">&nbsp;&nbsp;&nbsp;<input type="button" onclick="save_bookmarks()" value="'+b_again+'" class="btn btn-success"></div>',
    showConfirmButton: false ,

  });

}
else
{
 var surah_id = $('#cmbSura').val();

 var from_verse = $('#cmbFVerse').val();
 var to_verse = $('#cmbTVerse').val();
       //here check the file attachment 
       console.log(email);
       console.log(surah_id);console.log(from_verse);console.log(to_verse);
       $.ajax({
         url: "{{ url('/save_bookmarks') }}",
         type: 'post',
         data: {
          "_token": "{{ csrf_token() }}",
          "email" : email,
          "surah_id" : surah_id,
          "from_verse" : from_verse,
          "to_verse" : to_verse,
        },
              // No need to process data.
              beforeSend: function(){
               document.getElementById('wait').style.display = "block";
             },
             complete: function(){
               document.getElementById('wait').style.display = "none";
             },
             success: function (response) 
             {
              if(response==3)
              {
                    swal({
    type: "info",
    title: 'invalid email kindly provide valid input (like login)',
    text: '<div class="control-group"><input type="email" id="email_bookmark" class="form-control" placeholder="Enter your email" name="email" required></div><input type="hidden" value=" name="ticket_id"><div class="control-group"><br/><input type="reset" value="Cancel" onclick="swal.close()" class="btn btn-danger">&nbsp;&nbsp;&nbsp;<input type="submit" onclick="submit()" value="Save" class="btn btn-success"> <a href="#" onclick="return book()")"  class="btn btn-find">Find</a> </div> ',
    html: true,
    showConfirmButton: false ,

  });
              }
              else if(response==1)
              {
                var b_saved = $('#b_saved').html();
                var btn_close = $('#btn_close').html();
                $('#results_bookmarks').html(b_saved);
                swal({
                  type: "success",
                  title: b_saved,
                  html: true,
                  text: '<input type="button" value="'+btn_close+'" onclick="swal.close()" class="btn btn-success">',
                  showConfirmButton: false ,

                });
              }
              else if(response==2)
              {
                var b_exist = $('#b_exist').html(); 
                var btn_close = $('#btn_close').html();
                swal({
                  type: "error",
                  title: b_exist,
                  html: true,
                  text: '<input type="button" value="'+btn_close+'" onclick="swal.close()" class="btn btn-success">',
                  showConfirmButton: false ,

                });
              }
              else
              {
                swal({
                  type: "error",
                  title: b_exist,
                  html: true,
                  text: '<input type="reset" value="'+btn_cancel+'" onclick="swal.close()" class="btn btn-danger">&nbsp;&nbsp;&nbsp;<input type="button" onclick="save_bookmarks()" value="'+b_again+'" class="btn btn-success"></div>',
                  showConfirmButton: false ,

                });
              }

            }
          });
     }
   }
//get book marks
// $(function () {
 $('#get_bookmarks').on('submit',function (e) {
   e.preventDefault();
        //here check the file attachment 
        $.ajax({
         url: "{{ url('/get_bookmarks') }}",
         type: 'post',
         data: new FormData(this),
         contentType: false,       
         cache: false,            
                 processData:false,             // No need to process data.
                 beforeSend: function(){
                   document.getElementById('wait').style.display = "block";
                 },
                 complete: function(){
                   document.getElementById('wait').style.display = "none";
                 },
                 success: function (response) 
                 {document.getElementById('wait').style.display = "none";
                 // alert(response);
                 if(response==3)
                 {
                     $('#results_bookmarks').html('Kindly use the valid input for view bookmarks');
                 }
                 else if(response!=0 && response!=2)
                 {
                  var results='';
                  var total_found=0;
                  var returnedData = JSON.parse(response);
                  returnedData.forEach( function (item) {
                    total_found++;

                    results=results+'<a href="#" onclick="show_verse_bookmark('+item.surah_id+','+item.from_verse+','+item.to_verse+')"> <h6 id='+item.id+'><span class="trn">Sura</span> '+item.surah_number+',From <span class="trn">Verse</span> '+item.from_verse+', To <span class="trn">Verse</span> '+item.to_verse+'</a><a href="#" onclick="delete_book('+item.id+')">  <i class="fa fa-times" style="color:red; font-size:15px;"></i></h6> </a><p></p>';
                  });
                  $("#results_bookmarks").html("");
                  $("#results_bookmarks").append(results);
                  $("#totalb").html("");
                  $("#totalb").append(" : "+total_found);
                  var c_lan = $('.lang-selected').find('a').data('value'); 
                  var _t = $('body').translate({  
                    lang: c_lan,  
                    t: dict 
                    }); 
                    var str = _t.g("translate");
                  $("#total_found_bookmarks").show();
                }
                else
                {
                  var b_wrong = $('#b_wrong').html();
                  $('#results_bookmarks').html(b_wrong);
                }

              }
            });
      });




$('#forget_password').on('submit',function (e) {
  

   e.preventDefault();
        //here check the file attachment 
        $.ajax({
         url: "{{ url('/forget_password') }}",
         type: 'post',
         data: new FormData(this),
         contentType: false,       
         cache: false,            
                 processData:false,             // No need to process data.
                 beforeSend: function(){
                   document.getElementById('wait').style.display = "block";
                 },
                 complete: function(){
                   document.getElementById('wait').style.display = "none";
                 },
                 success: function (response) 
                 {document.getElementById('wait').style.display = "none";
                 
                 if(response=='true')
                 {
                    $('#forget_error').hide();
                    $('#forget_success').show();
                  $('#forget_success').html($('#b_sent_link').html()); 
                  
                }
                else
                {
                  $('#forget_success').hide();
                  $('#forget_error').show();
                  $('#forget_error').html($('#b_invalid_email').html());
                }

              }
            });
      });

$('#login').on('submit',function (e) {
  
   e.preventDefault();
        //here check the file attachment 
        $.ajax({
         url: "{{ url('/login') }}",
         type: 'post',
         data: new FormData(this),
         contentType: false,       
         cache: false,            
                 processData:false,             // No need to process data.
                 beforeSend: function(){
                   document.getElementById('wait').style.display = "block";
                 },
                 complete: function(){
                   document.getElementById('wait').style.display = "none";
                 },
                 success: function (response) 
                 {document.getElementById('wait').style.display = "none";
                 
                 if(response=='true')
                 {
                    location.reload(true);
                    document.getElementById("logedout").style.display = "block";
                    document.getElementById("logedin").style.display = "none";
                    document.getElementById("login_content").style.display = "none";
                     change_content('bookmark');
                     
                  
                }
                else
                {
                  $('#login_status').show();
                  $('#login_status').html('invalid email or password');
                }

              }
            });
      });
 $('#signup').on('submit',function (e) {
  
   e.preventDefault();
        //here check the file attachment 
        $.ajax({
         url: "{{url('/signup')}}",
         type: 'post',
         data: new FormData(this),
         contentType: false,       
         cache: false,            
                 processData:false,             // No need to process data.
                 beforeSend: function(){
                   document.getElementById('wait').style.display = "block";
                 },
                 complete: function(){
                   document.getElementById('wait').style.display = "none";
                 },
                 success: function (data) 
                 {
                   response = $.parseJSON(data);
                  
                  document.getElementById('wait').style.display = "none";
                  if(response.feedback=='fals')
                  {
                   $('#email').html('Email already registerd');  
                  }
                  else if(response.feedback=='false')
            {
              
              $.each(response.errors, function( key, value) {
                // alert(value);
                $('#'+key).html(value);
                
                
              });
            }
              
                else
                {
                  $('#login_success').show();
                  $('#login_success').html('Dear user you are successfully register please login');
                  change_content('Login');
                }

              }
            });
      });
// });






function delete_book(id) {
  var b_sure = $('#b_sure').html();   
var btn_cancel = $('#btn_cancel').html(); 
var btn_delete = $('#btn_delete').html();
  swal({
    type: "info",
    title: b_sure+'?',
    text: '<div class="control-group"><br/><input type="reset" value="'+btn_cancel+'" onclick="swal.close()" class="btn btn-danger">&nbsp;&nbsp;&nbsp;<input type="submit" onclick="deletes_book('+id+')" value="'+btn_delete+'" class="btn btn-success"> </div> ',
    html: true,
    showConfirmButton: false ,

  });
}




function deletes_book(id) {
  

         $.ajax({
   url:'{{ url('/delete_bookmark') }}',
   type: 'post',
   data: {
     "_token": "{{ csrf_token() }}",
     "id" : id,
     
   },
   beforeSend: function(){
    document.getElementById("wait").style.display = "block";
  },
  complete: function(){
  },
  success: function (response) 
  {
    document.getElementById("wait").style.display = "none";
    if(response=='true')
    {
      $('#'+id).html('');
      var b_deleted = $('#b_deleted').html(); 
    var btn_close = $('#btn_close').html();

    swal({
                  type: "success",
                  title: 'Bookmark is deleted',
                  html: true,
                  text: '<input type="button" value="'+btn_close+'" onclick="swal.close()" class="btn btn-success">',
                  showConfirmButton: false ,

                });

      
    }
    else
    {
      alert('error');
    }
}
});

      }


  $(function() {
    // $('#arabic1').after('<p>sample text</p>');
  });
      

</script>
@endpush