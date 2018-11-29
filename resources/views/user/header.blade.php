<style>
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
.topnav a:hover {
 color: #9c3;
}
.active {
 color: #9c3 !important;
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

@media (min-width:682px) {
  #logo + .inner-tabs {
  height:0 !important;
  }
}

@media screen and (max-width: 682px) {
 .topnav a {display: none;}
 .topnav #logo {display: block;}
 .topnav a.icon {
   float: right;
   display: block;
 }
}

@media screen and (max-width: 682px) {
 .topnav.responsive {position: relative;}
 .topnav.responsive .icon {
   position: absolute;
   right: 7px;
   top: 10px;
 }
 .topnav.responsive a {
   float: none;
   display: block;
   text-align: left;
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
       <a href="#" class="active" onclick="change_content('home')">Home</a>
       <a href="#" onclick="change_content('search')">Search</a>
       <a href="#" onclick="change_content('inv_friend')">Invite Friend</a>
       <a href="#" onclick="change_content('bug_report')">Bug Reporting </a>
       <a href="#" onclick="change_content('bookmark')">Bookmarks </a>
       
       <a href="javascript:void(0);" class="icon" onclick="myFunction()">
         <i class="fa fa-bars"></i>
       </a>
      <div class="dropdown language" style="width: 800px;">
                            <button style="width: 115px;
    height: 34px;
    margin-top: 7px;
    background-color: yellowgreen;" class="btn btn-default dropdown-toggle" type="button" id="languageDrop" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true">
                                <i class="fa fa-language"></i> Language
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="languageDrop">
                                <li>
                                    <a href="javascript:;" id="English" class="en" onclick="translateLanguage(this.id, this);">English</a>
                                </li>
                                <li>
                                    <a href="javascript:;" id="Norwegian" class="no" onclick="translateLanguage(this.id, this);">Norwegian</a>
                                </li>
                            </ul>

                            
                            <div id="google_translate_element" style="display: none">
                            </div>
  
                            
                            </div>


      </div>
  </div>
 <section class="panes_box" id="home_menu" style='position:relative;'>
  <div class="aboveDrawer" data-toggle="tooltip" title='Surah Introduction'>
      <div class="content">
        <div class="row container">
          <div class="col-md-12">
            <span id="c-surah" style="line-height: 1.2 !important">{!! $surah->introduction !!}</span>
          </div>
        </div>
      </div>
      <div class="open">
        <img src="{{$PUBLIC_ASSETS}}/img/triangle.svg" alt="" class='triangle'>
      </div>

    </div>
  <section>
   <form>
    <section class="quran_menu">
     <ul>
      <li>
       <section class="nav_box">
        <label>Sura / Chapter</label>
        <select class="" id="cmbSura" name="SuraID" style="width: 237px;">
          @if($surah)
          @foreach ($surahs as $key)
          <option value="{{$key->id}}">{{$key->surah_number}} - {{$key->surah_name}}</option>
          @endforeach
          @endif
        </select>
        <label class="notranslate">Juz</label>
        <select class="" id="cmbJuz" name="JuzID" style="width: 65px;">
          @for(@$i=1;$i<=30;$i++)
            <option value="{{$i}}">{{$i}}</option>
          @endfor
        </select>
      </select>
      <label>From Verse</label>
      <select id="cmbFVerse" name="VerseID" style="width: 65px;">
        @if($surah)
        @for(@$i=1;$i<=$surah->verses;$i++)
        <option value="{{$i}}">{{$i}}</option>
        @endfor
        @endif
      </select>
      <label>To Verse</label>
      <select id="cmbTVerse" name="VerseID" class="" style="width: 65px;">
       @if($surah)
       @for(@$i=$surah->verses;$i>=1;$i--)
        <option value="{{$i}}">{{$i}}</option>
        @endfor
       @endif
     </select>
     <label class="notranslate" id="lblRukuHizbCap">Ruku</label>
     <select class="" id="cmbHizb" name="HizbRuku" style="width: 65px;">
       <option value="1">1</option>
       <option value="2">1 &#188;</option>
       <option value="3">1 &#189;</option>
       <option value="4">1 &#190;</option>
     </select>
   </section>
 </li>
 <li>
   <section class="script_box">
    <label>Script</label>
    <select class="" id="cmbScript" name="ResourceID">
     <option value="hide">Hide</option>
     <option selected="" value="15">IndoPak</option>
   </select>
   <a href="#" class="container_btn1" id="btnMAA" title="Arabic Audio">
    <img id="btnMAA_Img" src="https://read.quranexplorer.com/public/Images/Quran/spacer.gif" alt="Mute Arabic Audio"/>
  </a>
  <br />
  <label>Reciter</label>
  <select class="" id="cmbReciter" name="ResourceID">
   @if(!empty($recitors))
   @foreach($recitors as $recitor)
   <option value="{{$recitor->id}}">{{$recitor->name}}</option>
   @endforeach
   @endif
 </select>

</section>


</li>

<li>

 <section class="translate_box">
  <p>
   <label>Language</label>
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
<img src="{{$PUBLIC_ASSETS}}/img/repeat.png" alt="repeat" width='40px' height='40px'>
 <section class="memorization_box">
  <div>
   <p>
    <label>Verse Repeat</label>
    <select id="cmbVerseRepeat" class="">
     @if($surah)
        @for($i=1;$i<=$surah->verses;$i++)
        <option value="{{$i}}">{{$i}}</option>
        @endfor
        @endif
   </select>
 </p>
 <p>
  <label>Range Repeat</label>
  <select id="cmbRangeRepeat" class="">
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
  <label for="chkAPNS">Auto play next sura</label>

  <div id="CP_ForeColor">
   <label style="padding-right:22px;">Fore Color </label>
   <div id="CP_ForeColorInSide" id="fore-color" style="width:1px; cursor:pointer; display:inline; font-family:Arial; font-size:21px;">
    █
  </div>
  <select id="cmbFColor" style="width:30px; height:20px; margin-top:-6px" class="">
    <option style="background-color:#394a59" value="#394a59">&nbsp;</option>
    <option style="background-color:#675545" value="#675545">&nbsp;</option>
    <option style="background-color:#913d1e" value="#913d1e">&nbsp;</option>
    <option style="background-color:#4f552a" value="#4f552a">&nbsp;</option>
    <option style="background-color:#20505f" value="#20505f">&nbsp;</option>
    <option style="background-color:#3d263a" value="#3d263a">&nbsp;</option>
    <option style="background-color:#61162d" value="#61162d">&nbsp;</option>
    <option style="background-color:#001d77" value="#001d77">&nbsp;</option>
    <option style="background-color:#897a1a" value="#897a1a">&nbsp;</option>
    <option style="background-color:#4b471a" value="#4b471a">&nbsp;</option>
    <option style="background-color:#654458" value="#654458">&nbsp;</option>
    <option style="background-color:#4d4e53" value="#4d4e53">&nbsp;</option>
    <option style="background-color:#6a5e16" value="#6a5e16">&nbsp;</option>
    <option style="background-color:#006066" value="#006066">&nbsp;</option>
    <option style="background-color:#002e5f" value="#002e5f">&nbsp;</option>
    <option style="background-color:#43165e" value="#43165e">&nbsp;&nbsp;</option>
    <option style="background-color:#C4ECBD" value="#C4ECBD"></option>
    <option style="background-color:#c05017" value="#c05017">&nbsp;</option>
    <option style="background-color:#000000" value="#000000" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
  </select>
</div>
<div id="CP_BackColor">
 <label style="width:100px;">Select Color </label>
 <div id="CP_BackColorInSide" style="width:1px; color:#C4ECBD; cursor:pointer; display:inline; font-family:Arial; font-size:21px;">
  █
</div>
<select id="cmbBColor" style="width:30px; height:20px; margin-top:-6px" class="">
  <option style="background-color:#acc0c7" value="#acc0c7">&nbsp;</option>
  <option style="background-color:#dad6cb" value="#dad6cb">&nbsp;</option>
  <option style="background-color:#ebc4b7" value="#ebc4b7">&nbsp;</option>
  <option style="background-color:#c9d18b" value="#c9d18b">&nbsp;</option>
  <option style="background-color:#c5d7ed" value="#c5d7ed">&nbsp;</option>
  <option style="background-color:#d9d8e4" value="#d9d8e4">&nbsp;</option>
  <option style="background-color:#b7badb" value="#b7badb">&nbsp;</option>
  <option style="background-color:#e8baa5" value="#e8baa5">&nbsp;</option>
  <option style="background-color:#c5d6e8" value="#c5d6e8">&nbsp;</option>
  <option style="background-color:#e2deae" value="#e2deae">&nbsp;</option>
  <option style="background-color:#d6d4ae" value="#d6d4ae">&nbsp;</option>
  <option style="background-color:#d2c1c7" value="#d2c1c7">&nbsp;</option>
  <option style="background-color:#d8d8d8" value="#d8d8d8">&nbsp;</option>
  <option style="background-color:#f4ed73" value="#f4ed73">&nbsp;</option>
  <option style="background-color:#c2d8d7" value="#c2d8d7">&nbsp;</option>
  <option style="background-color:#d7e0e8" value="#d7e0e8">&nbsp;&nbsp;</option>
  <option style="background-color:#C4ECBD" value="#C4ECBD" selected="selected"></option>
  <option style="background-color:#c05017" value="#c05017">&nbsp;</option>
  <option style="background-color:#FFFFE0" value="#FFFFE0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select>
</div>
</section>

</li>
<li>
  <object data="{{$PUBLIC_ASSETS}}/img/double-arrow.svg" type=""></object>
 <!-- <section class="ColorTheme_box">
  
</section> -->
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
     <label>Chapter</label>
     <select class="" id="" name="SuraID" style="width: 200px;">
      <option value="">-- All Chapter --</option>
      <option value="1">1 - Al-Fatiha</option>
      <option value="2">2 - Al-Baqara</option>
    </select>
    <label>Language</label>
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
          <label style="width: auto;">Chapter &nbsp;&nbsp;&nbsp;</label>
          <select class="" id="cmbSearchSura" style="width: 237px;">
            <option value="all" >All Chapters</option>
            @if($surah)
            @foreach ($surahs as $key)
            <option value="{{$key->id}}">{{$key->surah_number}} - {{$key->surah_name}}</option>
            @endforeach
            @endif
          </select>
          <br>
          <label style="width: auto;">Language</label>
          <select class="" id="cmbSearchLanguage" name="ResourceID" style="width: 200px;">
            <option value="1">Arabic</option>
            <option value="2">Norsk</option>
          </select>
        </section>


      </li>
      <li>
       <section class="text_search nav_box">
          <select class="" id="immn" name="immn" style="width: 200px;">
            <option value="1">With Immune</option>
            <option value="2" selected="">Without Immune</option>
          </select>
          <br>
         <div class="input-group mb-3" style="flex-wrap: nowrap;">
          <input id="txtSearchText" type="text" class="form-control p-0" value="" style="background: #cde69a; border-radius: 10px;">
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

