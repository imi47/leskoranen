/**
 * @file jquery.translate.js
 * @brief jQuery plugin to translate text in the client side.
 * @author Manuel Fernandes
 * @site
 * @version 0.9
 * @license MIT license <http://www.opensource.org/licenses/MIT>
 *
 * translate.js is a jQuery plugin to translate text in the client side.
 *
 */

(function($){
  $.fn.translate = function(options) {

    var that = this; //a reference to ourselves
	
    var settings = {
      css: "trn",
      lang: "en"/*,
      t: {
        "translate": {
          pt: "tradução",
          br: "tradução"
        }
      }*/
    };
    settings = $.extend(settings, options || {});
    if (settings.css.lastIndexOf(".", 0) !== 0)   //doesn't start with '.'
      settings.css = "." + settings.css;
       
    var t = settings.t;
 
    //public methods
    this.lang = function(l) {
      if (l) {
        settings.lang = l;
        this.translate(settings);  //translate everything
      }
        
      return settings.lang;
    };


    this.get = function(index) {
      var res = index;
      try {
        res = t[index][settings.lang];
      }
      catch (err) {
        //not found, return index
        return index;
      }
      
      if (res)
        return res;
      else
        return index;
    };

    this.g = this.get;


    
    //main
    this.find(settings.css).each(function(i) {
      var $this = $(this);
      tag = $this.prop('tagName');
      if(tag == 'INPUT' || tag == 'TEXTAREA' ){
        attribute = 'placeholder';
        input_type = $this.prop('type');
        if(input_type == 'submit'){
          attribute = 'value';
        }else if(input_type == 'text'){
          attribute = 'placeholder';
        }
      }

      var trn_key = $this.attr("data-trn-key");
      if (!trn_key) {
        if(tag == 'INPUT' || tag == 'TEXTAREA'){
          trn_key = $this.attr(attribute);
          $this.attr("data-trn-key", trn_key);   //store key for next time
        }else if(tag == 'SELECT'){
          $this.find('option').each(function(){
            $(this).attr('data-trn-key' , $(this).html());
          });
          $this.attr("data-trn-key", 'SELECT');   //store key for next time
        }else{
          trn_key = $this.html();
          $this.attr("data-trn-key", trn_key);   //store key for next time
        }
      }
      // alert(that.get(trn_key));
      if(tag == 'INPUT' || tag == 'TEXTAREA'){
        $this.attr(attribute , that.get(trn_key));
      }else if(tag == 'SELECT'){
        $this.find('option').each(function(){
          ci = $(this).attr("data-trn-key");
          $(this).html(that.get(ci));  
        });
      }else{
        $this.html(that.get(trn_key));
      }
    });
    
    
		return this;
		
		

  };
})(jQuery);