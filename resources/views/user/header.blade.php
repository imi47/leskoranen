<style>

#cmbFColor, #cmbBColor, #cmbFColor option, #cmbBColor option {
  -webkit-appearance:none;
  -moz-appearance:none;
}

.topnav {
 overflow: hidden;
 background-color: #fff;
 font-family: Roboto, sans-serif
}
.topnav a {
 float: left;
 display: block;
 color: #1a1a1a;
 text-align: center;
 padding: 14px 16px;
 text-decoration: none;
 font-size: 17px;
}
/* .topnav a:hover {
 color: #ffa3b9;
} */
.active {
 color: #8a2b44 !important;
}
.topnav .icon {
 display: none;
}
.text_search {
  width: 260px;
  height: 59px;
  text-align: left; 
}

#logo + .inner-tabs {
  height:0;
  transition:350ms;
}

.language {
  width: auto;
  height: 40px;
  margin-top: 4px;
  display:flex;
  align-items: center;
  position:relative;
  margin-left:5px;
  margin-right:5px;
}

.language a {
  float: none;
  padding: 0;
  display: inline;
  color: #fff;
}

.language:hover a {
  color:#fff;
}

.language.not-selected:hover a {
  color:red;
}

.language.lang-selected {
  background-color: #4c1426;
}

.language.lang-not-selected {
  background-color: #fff;
  border:1px solid #4c1426;
}

.language.lang-not-selected a {
  color:#4c1426;
}

/* .language .not-selected {
  top:45px;
  position:fixed;
  color: #333;
  padding-top:17px;
  padding-bottom:5px;
  display:none;
  padding-right:90px;
} */

.language:hover .not-selected {
  display:block;
}

@media (min-width:891px) {
  #logo + .inner-tabs {
  height:0 !important;
  }

  .language {
    float:right;
  }
}

@media screen and (max-width: 890px) {
 .topnav a, .language {display: none;}
 .topnav #logo {display: block;}
 .topnav a.icon {
   float: right;
   display: block;
 }

 .topnav.responsive {position: relative;}
 .topnav.responsive .icon {
   position: absolute;
   right: 10px;
   top: -53px;
 }
 .topnav.responsive a, .topnav.responsive, .topnav.responsive button {
   float: none;
   display: block;
   text-align: left;
 }

 .topnav.responsive button {
   margin:0;
   height:auto;
   margin: 14px 6px;
 }

 .topnav.responsive button a {
   display:inline;
 }

 .language .not-selected {
    position: absolute;
    left: 0;
    top: 31px;
    display:none !important;
 }

 .language:hover .not-selected {
  display:block !important;
 }
}

body>:nth-last-child(2) {
  display: none !important;
}
.skiptranslate{
    display: none !important;
}
body{
  top:0 !important;
}

</style>
<body>
 <section id="container">
  <div id="containerBody">
  <div class="topnav" id="myTopnav">
    <a href="#" id="logo"><img src="{{$PUBLIC_ASSETS}}/img/forweb2.jpg" width="97px" height="35px" alt=""></a>
<div class="inner-tabs" style="padding: 10px;">
  <a href="#" class="active trn" onclick="change_content('home')">Home</a>
  <a href="#" class="trn" onclick="change_content('search')">Search</a>
  <a href="#" class="trn" onclick="change_content('inv_friend')">Invite Friend</a>
  <a href="#" class="trn" onclick="change_content('bug_report')">Bug Reporting</a>
  <a href="#" class="trn" onclick="change_content('bookmark')">Bookmarks</a>
  
    <button class="btn btn-default language English lang-selected">
      <a href="javascript:;" id="English" class="en lang_selector" data-value="en">English</a>
    </button>

    <button class="btn btn-default Norwegian language lang-not-selected">
      <a href="javascript:;" id="Norwegian" class="no lang_selector" data-value="no">Norsk</a>
    </button>
      
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>

      </div>

  </div>
 <section class="panes_box" id="home_menu" style='position:relative;'>
  <div class="aboveDrawer" data-toggle="tooltip" title='Surah Introduction'>
      <div class="content">
        {{-- <div class=""> --}}
          <div class="col-md-12">
            <span id="c-surah" style="line-height: 1.2 !important; line-height: 1.2 !important;display: grid;justify-content: center;">{!! $surah->introduction !!}</span>
          </div>
        </div>
      {{-- </div> --}}
      <div class="open">
        <p class="triangle trn">Surah intro</p>
        <p class="triangle trn">Close</p>
      </div>

    </div>
  <section>
   <form>
    <section class="quran_menu">
     <ul>
      <li>
       <section class="nav_box">
        <label class="trn">Sura / Chapter</label>
        <select class="" id="cmbSura" name="SuraID" style="width: 237px;">
          @if($surah)
          @foreach ($surahs as $key)
          <option value="{{$key->id}}">{{$key->surah_number}} - {{$key->surah_name}}</option>
          @endforeach
          @endif
        </select>
        <label class="trn">Juz</label>
        <select class="" id="cmbJuz" name="JuzID" style="width: 65px; margin-left: 5px;">
          @for(@$i=1;$i<=30;$i++)
            <option value="{{$i}}">{{$i}}</option>
          @endfor
        </select>
        
      <label class="trn" style="line-height: 15px ; margin-top: 10px;">From Verse</label>
      {{-- <select id="cmbFVerse" name="VerseID" style="width: 65px;">
        @if($surah)
        @for(@$i=1;$i<=$surah->verses;$i++)
        <option value="{{$i}}">{{$i}}</option>
        @endfor
        @endif
      </select> --}}
      <div class="input-group Qinput">
      <input onfocus="from()" onkeyup="this.value=this.value.replace(/[^\d]/,'')" type="text" id="cmbFVerse1" value="1" class="form-control" >
            <div class="input-group-btn">
              
              <select style="
    background: url(https://read.quranexplorer.com/public/images/Quran/qe-portal-icons.png) top 8px right 8px no-repeat #8a2b44;
    color: rgba(0,0,0,0) !important;
    background-size: 15px auto;
    padding: 3px 22px 3px 5px;
    border-radius: 10px;" id="cmbFVerse" class="slectedopt fromdrop btn btn-default verseSelector">
    {{-- <option value=""></option> --}}
                  @if($surah)
                  @if($surah->surah_number!=9)
                  {{-- <option hidden="" class="opt" value="0">0</option> --}}
                  @endif
        @for(@$i=1;$i<=$surah->verses;$i++)

        <option class="opt" value="{{$i}}">{{$i}}</option>
        @endfor
        @endif
              </select>
            </div>
          </div> 

      <label class="trn" style="margin-left: 197px; margin-top:7px; line-height: 15px !important">To Verse</label>
      {{-- <select id="cmbTVerse" name="VerseID" class="" style="width: 65px;">
       @if($surah)
       @for(@$i=$surah->verses;$i>=1;$i--)
        <option value="{{$i}}">{{$i}}</option>
        @endfor
       @endif
     </select> --}}
     <div class="input-group Qinput" style="margin-left: 276px;">
      <input onfocus="to()" type="text" id="cmbTVerse1" onkeyup="this.value=this.value.replace(/[^\d]/,'')" value="{{ $surah->verses }}" class="form-control">
            <div class="input-group-btn">
              
              <select id="cmbTVerse"  style="
    background: url(https://read.quranexplorer.com/public/images/Quran/qe-portal-icons.png) top 8px right 8px no-repeat #8a2b44;
    color: rgba(0,0,0,0) !important;
    background-size: 15px auto;
    padding: 3px 22px 3px 5px;
    border-radius: 10px;" class="fromdrop btn btn-default verseSelector slectedopt">
  
                  @if($surah)
       @for(@$i=$surah->verses;$i>=1;$i--)
        <option class="opt"  id="hideselect{{ $i }}" value="{{$i}}">{{$i}}</option>
        @endfor
       @endif
              </select>
            </div>
          </div> 
       
       


<script type="text/javascript">
  var formv=''
  var tov=''
  function from() {
   formv=$('#cmbFVerse1').val();
   }
  function to() {
   tov=$('#cmbTVerse1').val();
   }
  $("#cmbTVerse1").focusout(function(){
  var cmbTVerse1= $('#cmbTVerse1').val();

  if(tov!=cmbTVerse1)
  {  
    
   $('#cmbTVerse').val(cmbTVerse1).change();
  }
})
  $("#cmbFVerse1").focusout(function(){
    
  var cmbFVerse1=$('#cmbFVerse1').val();
  
  if(formv!=cmbFVerse1)
  {  
    $('#cmbFVerse').val(cmbFVerse1).change();
  }
  })
  $('#cmbTVerse1').keypress(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);
  if(keycode == '13'){

    $('.fromdrop').focus();
   var cmbTVerse1= $('#cmbTVerse1').val();
   if(tov!=cmbTVerse1)
{
   $('#cmbTVerse').val(cmbTVerse1).change(); 
   playPause(); 
  }
}
  
});
  $('#cmbFVerse1').keypress(function(event){
  
  var keycode = (event.keyCode ? event.keyCode : event.which);
  if(keycode == '13'){

    $('.fromdrop').focus();
   var cmbFVerse1= $('#cmbFVerse1').val();
   if(fromv==cmbFVerse1)
   {
   $('#cmbFVerse').val(cmbFVerse1).change();
    playPause();  
    
   }
  }
  
});
  $(document).ready(function(){
    
    $("select.btn-default").change(function(){  
     $(this).closest(".input-group").find("input").val($(this).find('option:selected').text());
   })
  })
</script>
     <label class="trn" id="lblRukuHizbCap" style="margin-left: 379px;
    ">Ruku</label>
     <select class="" id="cmbHizb" name="HizbRuku" style="width: 65px; margin-top:2px;">
      @for(@$i=1;$i<=$surah->raku;$i++)
            <option value="{{$i}}">{{$i}}</option>
          @endfor
       {{-- <option value="1">1</option>
       <option value="2">1 &#188;</option>
       <option value="3">1 &#189;</option>
       <option value="4">1 &#190;</option> --}}
     </select>
   </section>
 </li>
 <li>
   <section class="script_box">
    <label class="trn">Script</label>
    <select class="" id="cmbScript" name="ResourceID">
     <option value="hide">Hide</option>
     <option selected="" value="15">IndoPak</option>
   </select>
   <a href="javascript:;" onclick="return mute();" class="container_btn1 un" id="btnMAA" title="Arabic Audio">
    <img id="btnMAA_Img" src="https://read.quranexplorer.com/public/Images/Quran/spacer.gif" alt="Mute Arabic Audio"/ class="mute-icon">

  </a>
  

  <br />
  <label class="trn">Reciter</label>
  <select style="" class="" id="cmbReciter" name="ResourceID">
   @if(!empty($recitors))
   @foreach($recitors as $recitor)
   <option value="{{$recitor->id}}">{{$recitor->name}}</option>
   @endforeach
   @endif
 </select>

</section>


</li>

<li>

 <section class="translate_box ">
  <p>
   <label class="trn">Language</label>
 </p> 
 <p>
   <select class="" id="cmbTranslation" name="ResourceID">
     <option value="hide">Hide</option>
    <option value="9" selected="">Norsk</option>
  </select>
  {{-- <a href="javascript:void(0);" class="container_btn1" id="btnMTA" title="Translation Audio">
   <img id="btnMTA_Img" src="https://read.quranexplorer.com/public/Images/Quran/spacer.gif" alt="Mute Translation Audio" /> --}}
 </a>
</p>
</section>

</li>
<li>
<img src="{{$PUBLIC_ASSETS}}/img/repeat.svg" alt="repeat" width='40px' height='40px'>
 <section class="memorization_box">
  <div>
   <p>
    <label class="trn" >Verse Repeat</label>
    <select id="cmbVerseRepeat" class=""  >
     @if($surah)
        @for($i=1;$i<=$surah->verses;$i++)
        <option value="{{$i}}">{{$i}}</option>
        @endfor
        @endif
   </select>
 </p>
 <p>
  <label class="trn">Range Repeat</label>
  <select id="cmbRangeRepeat" class="" >
   @if($surah)
        @for($i=1;$i<=$surah->verses;$i++)
        <option value="{{$i}}">{{$i}}</option>
        @endfor
        @endif
 </select>
</p>
</div>
</section>

</li>
<li>
 <section> 
   <!-- removed class option_box from section tag above-->
  <input id="chkAPNS" type="checkbox" checked="checked" value="" />
  <label for="chkAPNS" class="trn">Auto play next surah</label>

  <div id="CP_ForeColor">
   <label class="trn">Font</label>
   <div id="CP_ForeColorInSide" id="fore-color" style="width:1px; cursor:pointer; display:inline; font-family:Arial; font-size:21px;">
    █
    <img src="{{$PUBLIC_ASSETS}}/img/caret-down.svg" alt="" class='color-dropdown-toggle'>
    <div class="color-dropdown hidden " id='font-color'>
      <div style="background:#394a59"></div>
      <div style="background:#675545"></div>
      <div style="background:#913d1e"></div>
      <div style="background:#4f552a"></div>
      <div style="background:#20505f"></div>
      <div style="background:#3d263a"></div>
      <div style="background:#61162d"></div>
      <div style="background:#001d77"></div>
      <div style="background:#897a1a"></div>
      <div style="background:#4b471a"></div>
      <div style="background:#654458"></div>
      <div style="background:#4d4e53"></div>
      <div style="background:#6a5e16"></div>
      <div style="background:#006066"></div>
      <div style="background:#002e5f"></div>
      <div style="background:#43165e"></div>
      <div style="background:#C4ECBD"></div>
      <div style="background:#c05017"></div>
  </div>
</div>
<div id="CP_BackColor">
 <label style="width:110px;" class="trn">Highlight</label>
 <div id="CP_BackColorInSide" style="width:1px; color:#f2db8c; cursor:pointer; display:inline; font-family:Arial; font-size:21px;">
  █
  <img src="{{$PUBLIC_ASSETS}}/img/caret-down.svg" class='color-dropdown-toggle'>
  <div class="color-dropdown hidden" id='highlight-color'>
    <div style="background-color:#acc0c7"></div>
    <div style="background-color:#dad6cb"></div>
    <div style="background-color:#ebc4b7"></div>
    <div style="background-color:#c9d18b"></div>
    <div style="background-color:#c5d7ed"></div>
    <div style="background-color:#d9d8e4"></div>
    <div style="background-color:#b7badb"></div>
    <div style="background-color:#e8baa5"></div>
    <div style="background-color:#c5d6e8"></div>
    <div style="background-color:#e2deae"></div>
    <div style="background-color:#d6d4ae"></div>
    <div style="background-color:#d2c1c7"></div>
    <div style="background-color:#d8d8d8"></div>
    <div style="background-color:#f4ed73"></div>
    <div style="background-color:#c2d8d7"></div>
    <div style="background-color:#d7e0e8"></div>
    <div style="background-color:#C4ECBD"></div>
    <div style="background-color:#c05017"></div>
  </div>
</div>
</div>
</section>

</li>
<li>
  <object data="{{$PUBLIC_ASSETS}}/img/double-arrow.svg" type=""></object>
 <section class="intro-footnote">
    <div>
      <span class="trn">Surah introduction</span>
    </div>
    <div>
      <span class="trn">Footnotes</span>
    </div>
</section>
</li>
<li class="brightness">
  <img src="{{$PUBLIC_ASSETS}}/img/brightness.svg" alt="brightness">
  <img src="{{$PUBLIC_ASSETS}}/img/brightness-beige.svg" alt="brightness-full">
</li>
</ul>
</section>

<audio id="qe_player_tf">
 <source id="QE_Tafseer_Player" src="" type="audio/mpeg" />
</audio>
<audio id="qe_player_sc">
 <source id="QE_Script_Player" src="" type="audio/mpeg" />
</audio>
<audio id="qe_player_tr">
 <source id="QE_Translation_Player" src="" type="audio/mpeg" />
</audio>
</form>
</section>

<section>
 <section class="quran_menu">
  <ul>
   <li>
    <section class="search_cl">
     <label class="trn">Chapter</label>
     <select class="" id="" name="SuraID" style="width: 200px;">
      <option value="" class="trn">All Chapter</option>
      <option value="1">1 - Al-Fatiha</option>
      <option value="2">2 - Al-Baqara</option>
    </select>
    <label class="trn">Language</label>
    <select class="" id="" name="ResourceID" style="width: 200px;">
      <option value="1">--- Usmani</option>
      <option value="15">--- IndoPak</option>
    </select>
  </section>

</li>
<li>
</li>
</ul>
</section>


</section>


</section>


<section class="panes_box" id="search_menu" style="display: none;">
  <section>
   <form>
    <section class="quran_menu">
     <ul>
      <li>
        <section class="nav_box" style="width: auto";>
          <label style="width: auto;" class="trn">Chapter</label>
          <select class="" id="cmbSearchSura" style="width: 237px;">
            <option value="all" class="trn">All Chapters</option>
            @if($surah)
            @foreach ($surahs as $key)
            <option value="{{$key->id}}">{{$key->surah_number}} - {{$key->surah_name}}</option>
            @endforeach
            @endif
          </select>
          <br>
          <label style="width: auto;" class="trn">Language</label>
          <select class="cmbSearchLanguage-search-section" id="cmbSearchLanguage" name="ResourceID" style="width: 236px;">
            <option value="1">Arabic</option>
            <option value="2">Norsk</option>
          </select>
        </section>
      </li>
      <li>
       <section class="text_search nav_box">
         <div class="input-group mb-3" style="flex-wrap: nowrap;">
          <input id="txtSearchText" type="text" class="form-control p-0" value="" style="background: #8a2b44; border-radius: 10px; border: none; color: #fff;">
          <div class="input-group-append">
           <a href="#" id="searchBtn"> <span class="input-group-text bg-white"> <i class="fa fa-search"></i></span></a>

         </div>
       </div>

     </section>
   </li>
 </ul>
</section>


</section>

</form>
</section>


</section>

</div>
</section>

<script>
  $('#myTopnav .btn.Norwegian a').click(function(){
    $('section.quran_menu section.script_box').addClass('norweg');
    $('.cmbSearchLanguage-search-section').css('width', '236px');
  });
  $('#myTopnav .btn.English a').click(function(){
    $('section.quran_menu section.script_box').removeClass('norweg');
    $('.cmbSearchLanguage-search-section').css('width', '209px');
  });

  document.querySelector('.brightness').onclick = function() {
    document.querySelector('body').classList.toggle('beige');
    document.querySelector('#myTopnav').classList.toggle('beige');
    this.classList.toggle('beige');
  }
</script>
