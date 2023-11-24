var searchParams = window.location.pathname;
var searchParams_ = searchParams.split("/details/");
(function ($) {
  loadDetail(searchParams_[1]);
})(jQuery);

function loadDetail(id_menu) {
  $.ajax({
    url: serverUrl + "/orderMenuDetail/" + id_menu,
    method: "get",
    success: function (response) {
      let html_menu_detail =
        "<div class='content-body fb'>" +
        "<div class='swiper-btn-center-lr my-0'>" +
        "<div class='swiper-container demo-swiper'>" +
        "<div class='swiper-wrapper'>" +
        "<div class='swiper-slide'>" +
        "<div class='z-banner-heading'>" +
        "<div class='overlay-black-light'>" +
        "<img src='" +
        CDN_IMG +
        "/uploads/temps_order/" +
        response.data.src_order_picture +
        "' class='bnr-img' alt='bg-image' width='500' height='500'>" +
        "</div>" +
        "</div>" +
        "</div>" +
        //   <!-- <div class="swiper-slide">
        //       <div class="dz-banner-heading">
        //           <div class="overlay-black-light">
        //               <img src="<?php echo base_url('assets/images/food/pic6.png'); ?>" class="bnr-img" alt="bg-image">
        //           </div>
        //       </div>
        //   </div>
        //   <div class="swiper-slide">
        //       <div class="dz-banner-heading">
        //           <div class="overlay-black-light">
        //               <img src="<?php echo base_url('assets/images/food/pic6.png'); ?>" class="bnr-img" alt="bg-image">
        //           </div>
        //       </div>
        //   </div>
        //   <div class="swiper-slide">
        //       <div class="dz-banner-heading">
        //           <div class="overlay-black-light">
        //               <img src="<?php echo base_url('assets/images/food/pic6.png'); ?>" class="bnr-img" alt="bg-image">
        //           </div>
        //       </div>
        //   </div> -->
        "</div>" +
        "<div class='swiper-btn'>" +
        "<div class='swiper-pagination style-2 flex-1'></div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "<div class='container'>" +
        "<div class='company-detail'>" +
        "<div class='detail-content'>" +
        "<div class='flex-1'>" +
        "<h4>" +
        response.data.order_name +
        "</h4>" +
        "<p>" +
        response.data.order_des +
        ".</p>" +
        "</div>" +
        " </div>" +
        /* <!-- <ul class="item-inner">
                      <li>
                          <div class="reviews-info">
                              <i class="fa fa-star"></i>
                              <h6 class="reviews">4.5</h6>
                          </div>
                      </li>
                      <li>
                          <i class="fa-solid fa-clock"></i>
                          <h6 class="mb-0 ms-2">6-7 Min</h6>
                      </li>
                      <li>
                          <a class="d-flex delivery" href="javascript:void(0);">
                              <i class="fa-solid fa-truck"></i>
                              <h6 class="mb-0 ms-2">FREE DELIVERY</h6>
                          </a>
                      </li>
                  </ul> --> */

        "</div>" +
        "<div class='item-list-2'>" +
        "<div class='price'>" +
        "<span class='text-style'>Price</span>" +
        "<h3>฿ " +
        response.data.order_price +
        " <del>฿ " +
        "0.00" +
        "</del></h3>" +
        "</div>" +
        "<div class='dz-stepper border-1 col-5'>" +
        "<input class='stepper' type='text' value='1' name='demo3'>" +
        "</div>" +
        "</div>" +
        "<div class='d-flex align-items-center justify-content-between'>" +
        //   <!-- <div class="badge badge-danger font-w400 px-3">20% OFF DISCOUNT</div>
        //  <a href="javascript:void(0);" class="btn-link font-16">Apply promo code</a> -->
        "</div>" +
        "</div>" +
        "</div>";
      $("#detail_context").html(html_menu_detail);
      $(".stepper").TouchSpin();
    },
  });
}
