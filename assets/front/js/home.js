$('.brands').owlCarousel({
  loop: true,
  margin: 10,
  nav: false,
  navText: [
     "<i class='fa fa-caret-left'></i>",
     "<i class='fa fa-caret-right'></i>"
  ],
  autoplay: true,
  autoplayHoverPause: true,
  responsive: {
     0: {
        items: 1
     },
     600: {
        items: 2
     },
     800: {
        items: 2
     },
     1000: {
        items: 3
     }
  }
});