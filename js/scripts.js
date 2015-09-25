jQuery(document).ready(function($) {
  
  if($(window).width() < 900){
    $('.header-inner .menu-container').hide();
  }
  
  if($(window).width() >= 700){
    var elementHeights = $('.location-item-title-row').map(function() {
      return $(this).height();
    }).get();
  
    var maxHeight = Math.max.apply(null, elementHeights);
  
    $('.location-item-title-row').height(maxHeight);
  }
  
  var slideHeights = $('.ttf-tweet').map(function() {
    return $(this).height();
  }).get();
  
  var slideHeight = Math.max.apply(null,slideHeights);
  
  var instagramBlockHeight = $('.instagram-block').height();
  
  $('.instagram-wrapper').height(instagramBlockHeight);
  
  
  $('.menu-button-area').click(function(){
    if($(window).width() >= 900){
      if($(this).hasClass('active')){
        $(this).removeClass('active');
        $('.menu-button').removeClass('active');
        $('#menu-main').removeClass('active');
        $('.menu-button-txt').html('Menu');
      }
      else{
        $(this).addClass('active');
        $('.menu-button').addClass('active');
        $('#menu-main').addClass('active');
        $('.menu-button-txt').html('Close');
      }
    }
    else{
      if($('.menu-container').css('display') === 'none'){
        $(this).addClass('active');
        $('.menu-button').addClass('active');
        $('.menu-container').slideDown();
        $('.menu-button-txt').html('Close');
      }
      else{
        $(this).removeClass('active');
        $('.menu-button').removeClass('active');
        $('.menu-container').slideUp();
        $('.menu-button-txt').html('Menu');
      }
    }
  });  
  
  $('.special-btn').each(function(){
    
    if($(this).hasClass('fill-space')){
      var maxHeight = $(this).height();
    
      console.log(maxHeight);
    
      $(this).children('.panel').height(maxHeight-4);
      
      $(this).css('max-height', maxHeight);
    }
    else{
    
      var elementHeights = $(this).children('.panel').map(function() {
        return $(this).outerHeight(true);
      }).get();
    
      var maxHeight2 = Math.max.apply(null, elementHeights);
      
      console.log(maxHeight2);
    
      $(this).children('.panel').height(maxHeight2);
      
      $(this).height(maxHeight2);
      
      var elementWidths = $(this).find('.panel-inner').map(function() {
        return $(this).width();
      }).get();
    
      var maxWidth = Math.max.apply(null, elementWidths);
          
      $(this).find('.panel-inner').width(maxWidth);
    }
  
  });
  
  $(window).resize(function(){
    if($(window).width() >= 700){
      var elementHeights2 = $('.location-item-title-row').map(function() {
        return $(this).height();
      }).get();
    
      var maxHeight2 = Math.max.apply(null, elementHeights2);
    
      $('.location-item-title-row').height(maxHeight2);
      
      var blockHeight2 = $('.instagram-block').height();
      
      $('.half-height').css('min-height', blockHeight2);
    }
    
    var instagramBlockHeight2 = $('.instagram-block').height();
  
    $('.instagram-wrapper').height(instagramBlockHeight2);
  });  
  
  var wow = new WOW({
    mobile: false, 
  });
  
  wow.init();
  
  var sliderWidth = $('.twitter-slider').width();
  
  $('.twitter-slider .timeline-twitter-feed').owlCarousel({
    items: 1,
    nav: true,
    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    autoHeight:true,
    onInitialize: function(){
      $('.owl-item').width(sliderWidth);
      $('.owl-stage-outer').width(sliderWidth);
    }
  });
  
  
   
  
  $(window).scroll(function() {
    console.log('scrolling ', $(window).scrollTop(), $(document).height());
    if ($(window).scrollTop() >= 400) {
      $('#scrollTop').addClass('show');
    }
    else if ($(window).scrollTop() <= 300) {
      $('#scrollTop').removeClass('show');
    }
  });
  
  $('#scrollTop').click(function(){
    $(window).scrollTo($('#top'), 500, {onAfter:function() { $('#scrollTop').removeClass('show'); } });  
  });
  
   $('.position-form').hide(); 
  
  $('.show-apply-form').click(function(){
    if($('.position-form').css('display') === 'none'){
      $('.position-form').slideDown();
    }
    else{
      $('.position-form').slideUp();
    }
  });
  
});