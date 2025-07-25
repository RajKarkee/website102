$(document).ready(function(){
  $('.hero-slider').slick({
    dots: true,
    arrows: true,
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: 'linear',
    autoplay: true,
    autoplaySpeed: 5000,
    prevArrow: '<button type="button" class="slick-prev"><i data-lucide="chevron-left"></i></button>',
    nextArrow: '<button type="button" class="slick-next"><i data-lucide="chevron-right"></i></button>'
  });
});
