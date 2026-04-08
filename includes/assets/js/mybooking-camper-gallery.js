jQuery(document).ready(function ($) {
  // Change main image on thumbnail click
  $('.mybooking-campers_carousel-thumbnail').on('click', function () {
    var fullSizeImage = $(this).attr('data-full-size');
    $('.mybooking-campers_main-image img').attr('src', fullSizeImage);
  });

  // Smooth scroll to center clicked thumbnail
  const thumbnails = document.querySelectorAll('.mybooking-campers_carousel-thumbnail');
  const carouselContainer = document.querySelector('.mybooking-campers_carousel');

  if (carouselContainer) {
    thumbnails.forEach(function (thumbnail) {
      thumbnail.addEventListener('click', function () {
        var targetOffset = thumbnail.offsetLeft;
        var containerWidth = carouselContainer.offsetWidth;
        var thumbnailWidth = thumbnail.offsetWidth;
        var scrollPosition = targetOffset - (containerWidth / 2) + (thumbnailWidth / 2);

        carouselContainer.scrollTo({
          left: scrollPosition,
          behavior: 'smooth',
        });
      });
    });
  }
});
