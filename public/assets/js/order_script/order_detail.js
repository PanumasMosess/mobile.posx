var searchParams = window.location.pathname;
var searchParams_ = searchParams.split("/details/");
var order_code = "";
var order_order_name = "";
var order_price = 0;
var order_table_code = "";
var order_companies_id = 0;
var src_order_picture = "";
var order_customer_des = "";
(function ($) {
  let code_array = searchParams_[1].split("_");
  let id = code_array[0];
  let table = code_array[1];
  let companies_id = code_array[2];
  loadDetail(id);
  order_table_code = table;
  order_companies_id = companies_id;
})(jQuery);

function loadDetail(id_menu) {
  $.ajax({
    url: serverUrl + "/orderMenuDetail/" + id_menu,
    method: "get",
    success: function (response) {
      order_code = response.data.order_code;
      order_order_name = response.data.order_name;
      order_price = response.data.order_price;
      src_order_picture = response.data.src_order_picture;  
      order_customer_des = response.data.order_des; 
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
        "<input class='stepper' type='text' value='1' id='pcs_to_car' name='demo3'>" +
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

function getToCart() {
  var pcs = $("#pcs_to_car").val();
  arr_data_cart = [
    {
      table_code: order_table_code,
      pcs: pcs,
      order_code: order_code,
      order_order_name: order_order_name,
      order_price: order_price,
      order_companies_id: order_companies_id,
      src_order_picture: src_order_picture,
      order_customer_des: order_customer_des
    },
  ];

  $.ajax({
    url: serverUrl + "insertCart",
    method: "post",
    data: {
      data: arr_data_cart,
    },
    cache: false,
    success: function (response) {
      if (response.message == "เพิ่มสำเร็จ") {
        window.history.go(-1);
        return false;
      }
    },
  });
}
