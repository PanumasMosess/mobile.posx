  <!-- Page Content -->
  <div class="page-content">
      <div class="container">
          <div class="serach-area">
              <div class="mb-3 input-group input-radius">
                  <span class="input-group-text">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                          <path d="M20.5605 18.4395L16.7528 14.6318C17.5395 13.446 18 12.0262 18 10.5C18 6.3645 14.6355 3 10.5 3C6.3645 3 3 6.3645 3 10.5C3 14.6355 6.3645 18 10.5 18C12.0262 18 13.446 17.5395 14.6318 16.7528L18.4395 20.5605C19.0245 21.1462 19.9755 21.1462 20.5605 20.5605C21.1462 19.9748 21.1462 19.0252 20.5605 18.4395ZM5.25 10.5C5.25 7.605 7.605 5.25 10.5 5.25C13.395 5.25 15.75 7.605 15.75 10.5C15.75 13.395 13.395 15.75 10.5 15.75C7.605 15.75 5.25 13.395 5.25 10.5Z" fill="#B9B9B9" />
                      </svg>
                  </span>
                  <input type="text" placeholder="Search Order" class="form-control main-in ps-0 bs-0" id='search_order' onkeyup="searchOrder()" />
              </div>
          </div>
          <div class="swiper-btn-center-lr">
              <div class="swiper-container mt-4 categorie-swiper">
                  <div id='group_tab' class="swiper-wrapper">
                  </div>
              </div>
          </div>
          <div id="menu_order" class="item-list recent-jobs-list">
          </div>

          <!-- CART -->
          <div class="offcanvas offcanvas-bottom rounded-0" tabindex="-1" id="offcanvasBottom2">
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
                  <i class="fa-solid fa-xmark"></i>
              </button>
              <div class="offcanvas-body container fixed">
                  <div class="item-list style-2">
                      <ul>
                          <li id='list_card'>
                              <!-- <div class="item-content">
                                  <div class="item-media media media-60">
                                      <img src="assets/images/food/pic6.png" alt="logo">
                                  </div>
                                  <div class="item-inner">
                                      <div class="item-title-row">
                                          <h6 class="item-title"><a href="order-list.html">Chicken Briyani Haji Mahmud</a></h6>
                                          <div class="item-subtitle">Coffe, Milk</div>
                                      </div>
                                      <div class="item-footer">
                                          <div class="d-flex align-items-center">
                                              <h6 class="me-3">$ 4.0</h6>
                                              <del class="off-text">
                                                  <h6>$ 8.9</h6>
                                              </del>
                                          </div>
                                          <div class="d-flex align-items-center">
                                              <div class="dz-stepper border-1 ">
                                                  <input class="stepper" type="text" value="3" name="demo3">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div> -->
                          </li>
                      </ul>
                  </div>
                  <div class="view-title">
                      <div class="container">
                          <ul>
                              <li>
                                  <a href="javascript:void(0);" class="promo-bx">
                                      Apply Promotion Code
                                      <span>0</span>
                                  </a>
                              </li>
                              <li>
                                  <span>Subtotal</span>
                                  <span id='sub_total'>฿ 00.00</span>
                              </li>
                              <li>
                                  <!-- <span>TAX (2%)</span>
                                  <span>-$1.08</span> -->
                              </li>
                              <li>
                                  <h5>Total</h5>
                                  <h5 id='total'>฿ 00.00</h5>
                              </li>
                          </ul>
                          <a href="javascript:void(0);" onclick="confrimCart();" class="btn btn-primary btn-rounded btn-block flex-1 ms-2">CONFIRM</a>
                      </div>
                  </div>
              </div>
          </div>
          <!-- CART -->


      </div>
  </div>
  <!-- Page Content End-->