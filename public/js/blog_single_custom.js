$(function () {
  (function initBrandsSlider() {
    if ($('.gallery_slider').length) {
      var gallerySlider = $('.gallery_slider');

      gallerySlider.owlCarousel(
        {
          loop: true,
          autoplay: true,
          autoplayTimeout: 5000,
          nav: false,
          dots: false,
          autoWidth: true,
          items: 8,
          margin: 42
        });

      if ($('.gallery_prev').length) {
        var prev = $('.gallery_prev');
        prev.on('click', function () {
          gallerySlider.trigger('prev.owl.carousel');
        });
      }

      if ($('.gallery_next').length) {
        var next = $('.gallery_next');
        next.on('click', function () {
          gallerySlider.trigger('next.owl.carousel');
        });
      }
    }
  })();
});