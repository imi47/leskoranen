 <link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/nav_css.css">
 <section id="container" style="margin-top: 69px;">
      
      <div id="containerBody">
        <section class="panes_box">
          <section>
            <form>
              <section class="quran_menu">
                <ul>
                  <li>
                    <section class="nav_box">
                      <label>Sura / Chapter</label>
                      <select class=""
                        id="cmbSura" name="SuraID" style="width: 237px;">
                        <option value="1" selected>1 - Al-Fatiha</option>
                        <option value="2">2 - Al-Baqara</option>
                        <option value="3">3 - Al-E-Imran</option>
                        <option value="4">4 - An-Nisa</option>
                      </select>
                      <label>Juz</label>
                      <select class=""
                        id="cmbJuz" name="JuzID" style="width: 65px;">
                        <option value="1">1</option>
                        <option value="2">2</option>
                      </select>
                      <label>From Verse</label>
                      <select class="" 
                        id="cmbFVerse" name="VerseID" style="width: 65px;">
                        <option value="1">1</option>
                        
                      </select>
                      <label>To Verse</label>
                      <select class="" id="cmbTVerse" name="VerseID" style="width: 65px;">
                        <option value="1">1</option>
                        <option value="2">2</option>
                      </select>
                      <label id="lblRukuHizbCap">Hizb</label>
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
                        <option value="15">IndoPak</option>
                        <option value="1">Usmani</option>
                      </select>
                      <a href="#" class="container_btn1" id="btnMAA" title="Arabic Audio">
                        <img id="btnMAA_Img" src="https://read.quranexplorer.com/public/Images/Quran/spacer.gif" alt="Mute Arabic Audio" />
                      </a>
                      <br />
                      <label>Reciter</label>
                      <select class="" id="cmbReciter" name="ResourceID">
                        <option value="4">Abdul-Baasit</option>
                      </select>
                    </section>
                  </li>
                  <li>
                    <section class="translate_box">
                      <p>
                        <label>Translation </label>
                      </p>
                      <p>
                        <select class="" id="cmbTranslation" name="ResourceID">
                          <option value="9">Deutsch</option>
                        </select>
                        <a href="javascript:void(0);" class="container_btn1" id="btnMTA" title="Translation Audio">
                          <img id="btnMTA_Img" src="https://read.quranexplorer.com/public/Images/Quran/spacer.gif" alt="Mute Translation Audio" />
                        </a>
                      </p>
                    </section>
                  </li>
                  <li>
                    <section class="memorization_box">
                      <div>
                        <p>
                          <label>Verse Repeat</label>
                          <select id="cmbVerseRepeat" class="">
                            <option>1</option>
                            <option>2</option>
                          </select>
                        </p>
                        <p>
                          <label>Range Repeat</label>
                          <select id="cmbRangeRepeat" class="">
                            <option>1</option>
                            <option>2</option>
                          </select>
                        </p>
                      </div>
                     
                    </section>
                  </li>
                  <li>
                    <section class="option_box">
                      <input id="chkAPNS" type="checkbox" checked="checked" value="" />
                      <label for="chkAPNS">Auto play next surah</label>
                    
                    </section>
                  </li>
                  <li>
                    <section class="intro-footnote">
                      <div id="CP_ForeColor">
                        <label style="padding-right:22px;">Fore Color </label>
                        <div id="CP_ForeColorInSide" style="width:1px; color:#000000; cursor:pointer; display:inline; font-family:Arial; font-size:21px;">
                          █
                        </div>
                        <select id="cmbFColor" style="width:30px; height:20px; margin-left:-5px; margin-top:-6px" class="">
                          <option style="background-color:#394a59" value="#394a59">&nbsp;</option>
                        </select>
                      </div>
                      <div id="CP_BackColor">
                        <label style="width:100px;">Select Color </label>
                        <div id="CP_BackColorInSide" style="width:1px; color:#C4ECBD; cursor:pointer; display:inline; font-family:Arial; font-size:21px;">
                          █
                        </div>
                        <select id="cmbBColor" style="width:30px; height:20px; margin-left:-5px; margin-top:-6px" class="">
                          <option style="background-color:#acc0c7" value="#acc0c7">&nbsp;</option>
                          <option style="background-color:#dad6cb" value="#dad6cb">&nbsp;</option>
                         
                        </select>
                      </div>
                    </section>
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
                    <select class="" id="cmbSearchSura" name="SuraID" style="width: 200px;">
                      <option value="">-- All Chapter --</option>
                      <option value="1">1 - Al-Fatiha</option>
                      <option value="2">2 - Al-Baqara</option>
                 
                     
                    </select>
                    <label>Language</label>
                    <select class="" id="cmbSearchLanguage" name="ResourceID" style="width: 200px;">
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
        
      </div>
    </section>