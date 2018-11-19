
  $('#cmbSura').change(getSurah);
   function getSurah(get_special=null){
    var surah_id=$('#cmbSura').val();
    if(get_special=='pre' && surah_id>1)
    {
      surah_id=surah_id-1;
    }
    else if(get_special=='next' && surah_id!=114 )
    {
      surah_id=surah_id+1;
    }
    console.log(surah_id);
      $.ajax({
      url:'{{ url('/get-surah') }}',
            type: 'post',
            data: {
              "_token": "{{ csrf_token() }}",
              "surah_id" : surah_id,
                  },
                   beforeSend: function(){
                       
                      },
                      complete: function(){
                         
                      },
                      success: function (response) 
                      {
                        if(response!=0)
                        {
                          var arabic='';
                          var translation='';
                          var returnedData = JSON.parse(response);
                          var i=1;
                          console.log(returnedData.verse);
                          returnedData.verse.forEach( function (item) {
                           arabic=arabic+item.arabic_immune+" <span class='icon-round custom-number' ><span style='padding: 5px;'>"+i+"</span></span> ";
                            translation=translation+item.translation+" <span class='icon-round custom-number' ><span style='padding: 5px;'>"+i+"</span></span> ";
                               i++;
                            });
                          
                        }
                        $("#arabic").html("");
                        $("#arabic").append(arabic);
                         $("#translation").html("");
                        $("#translation").append(translation);
                        // $("#arabic").append(view);
                        // 
                      }
                    });
  }