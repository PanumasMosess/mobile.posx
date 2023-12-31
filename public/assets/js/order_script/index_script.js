var searchParams = window.location.pathname;
var searchParams_ = searchParams.split("/home/");
var sum_price_upload_old = 0;
var sum_pcs_upload_old = 0;
var companies,
  table_code,
  price_val = "";
var array_cart = [];

(function ($) {
  let code_array = searchParams_[1].split("_");
  companies = code_array[1];
  table_code = code_array[0];
  loadvalueMoney(companies);
  loadTypeMenu(searchParams_[1]);
  loadMenu(searchParams_[1]);
  loadCart(companies, table_code);
 
})(jQuery);

function loadTypeMenu(code) {
  let code_array = code.split("_");

  $.ajax({
    url: serverUrl + "/orderType/" + code_array[1],
    method: "get",
    success: function (response) {
      let group_html = "";
      let all_id = "";

      group_html =
        "<div class='swiper-slide'>" +
        "<a href='javascript:void(0);' class='categore-box style-2 green' onclick='loadMenuBytype(" +
        all_id +
        ")'>" +
        "<div class='icon-bx'>" +
        "<svg width='24' height='22' viewBox='0 0 24 22' fill='none' xmlns='http://www.w3.org/2000/svg'>" +
        "<path d='M18.3281 17.3282H11.2969L14.8125 19.9649L18.3281 17.3282Z' fill='#84CA93' />" +
        "<path d='M1.02026 14.648C0.984375 14.6425 0.948303 14.6365 0.911499 14.6279C0.948486 14.6365 0.984192 14.6427 1.02026 14.648Z' fill='#84CA93' />" +
        "<path d='M0.517669 10.8394C0.153289 11.5098 0.272673 12.3409 0.812102 12.8803L0.86502 12.9333C0.95877 13.027 1.08713 13.0774 1.21951 13.0722C1.35208 13.0671 1.47623 13.0069 1.56247 12.9063C1.58023 12.8857 1.59708 12.8655 1.61319 12.8465C1.99771 12.3913 2.57797 11.7032 3.56253 11.7032C4.55679 11.7032 5.08212 12.2285 5.46591 12.6123C5.8107 12.9571 5.97952 13.1094 6.37503 13.1094C6.77054 13.1094 6.93954 12.9571 7.28415 12.6123C7.66794 12.2285 8.19327 11.7032 9.18753 11.7032C10.1818 11.7032 10.7071 12.2285 11.0909 12.6123C11.4357 12.9571 11.6045 13.1094 12 13.1094C12.3955 13.1094 12.5645 12.9571 12.9091 12.6123C13.2929 12.2285 13.8183 11.7032 14.8125 11.7032C15.8068 11.7032 16.3321 12.2285 16.7159 12.6123C17.0607 12.9571 17.2295 13.1094 17.625 13.1094C18.0205 13.1094 18.1895 12.9571 18.5341 12.6123C18.9179 12.2285 19.4433 11.7032 20.4375 11.7032C21.4223 11.7032 22.0023 12.3913 22.3869 12.8465C22.4145 12.8791 22.4449 12.9151 22.4766 12.9523C22.546 13.0331 22.6485 13.0777 22.7549 13.0735C22.8615 13.0691 22.96 13.0166 23.0228 12.9303L23.103 12.8206C23.6307 12.0972 23.6715 11.1262 23.2066 10.3608C23.1936 10.3394 23.1806 10.3181 23.1674 10.2969H0.83261C0.726409 10.4688 0.620208 10.651 0.517669 10.8394Z' fill='#84CA93' />" +
        "<path d='M20.6713 17.3282L15.2342 21.4061C15.1091 21.5002 14.9608 21.5469 14.8125 21.5469H19.0312C21.1705 21.5469 23.2885 20.1701 23.9612 18.2587C24.1208 17.8053 23.7678 17.3282 23.2872 17.3282H20.6713Z' fill='#84CA93' />" +
        "<path d='M22.1558 15.9219C22.3797 15.5377 22.5163 15.0998 22.5355 14.6284C21.9794 14.5118 21.5696 14.0594 21.3116 13.7536C20.9751 13.3539 20.7526 13.1094 20.4375 13.1094C20.042 13.1094 19.8732 13.2619 19.5284 13.6065C19.1446 13.9903 18.6193 14.5157 17.625 14.5157C16.6307 14.5157 16.1054 13.9903 15.7216 13.6065C15.377 13.2619 15.208 13.1094 14.8125 13.1094C14.417 13.1094 14.2482 13.2619 13.9034 13.6065C13.5196 13.9903 12.9943 14.5157 12 14.5157C11.0057 14.5157 10.4804 13.9903 10.0966 13.6065C9.75201 13.2619 9.58301 13.1094 9.1875 13.1094C8.79199 13.1094 8.62317 13.2619 8.27838 13.6065C7.89459 13.9903 7.36926 14.5157 6.375 14.5157C5.38074 14.5157 4.85541 13.9903 4.47162 13.6065C4.12701 13.2619 3.95801 13.1094 3.5625 13.1094C3.24738 13.1094 3.0249 13.3539 2.68835 13.7536C2.42963 14.0601 2.02478 14.531 1.46631 14.6458C1.4881 15.1106 1.62305 15.5425 1.84424 15.9219H22.1558Z' fill='#84CA93' />" +
        "<path d='M8.95367 17.3282H0.712828C0.232359 17.3282 -0.120668 17.8053 0.0388165 18.2587C0.711729 20.1701 2.82953 21.5469 4.96875 21.5469H14.8125C14.6642 21.5469 14.5159 21.5002 14.391 21.4061L8.95367 17.3282Z' fill='#84CA93' />" +
        "<path d='M23.29 8.89064C23.713 8.89064 24.0601 8.51637 23.9911 8.09908C23.2755 3.76846 19.3428 0.453156 14.8124 0.453156H9.18742C4.65704 0.453156 0.724306 3.76846 0.00873078 8.09908C-0.0602998 8.51637 0.286867 8.89064 0.70984 8.89064H23.29ZM16.2187 4.6719C16.607 4.6719 16.9218 4.98666 16.9218 5.37502C16.9218 5.76339 16.607 6.07815 16.2187 6.07815C15.8303 6.07815 15.5155 5.76339 15.5155 5.37502C15.5155 4.98666 15.8303 4.6719 16.2187 4.6719ZM13.4062 3.26565C13.7945 3.26565 14.1093 3.58041 14.1093 3.96877C14.1093 4.35714 13.7945 4.6719 13.4062 4.6719C13.0178 4.6719 12.703 4.35714 12.703 3.96877C12.703 3.58041 13.0178 3.26565 13.4062 3.26565ZM11.9999 6.07815C12.3883 6.07815 12.703 6.3929 12.703 6.78127C12.703 7.16963 12.3883 7.48439 11.9999 7.48439C11.6116 7.48439 11.2968 7.16963 11.2968 6.78127C11.2968 6.3929 11.6116 6.07815 11.9999 6.07815ZM9.18742 3.26565C9.57579 3.26565 9.89055 3.58041 9.89055 3.96877C9.89055 4.35714 9.57579 4.6719 9.18742 4.6719C8.79906 4.6719 8.4843 4.35714 8.4843 3.96877C8.4843 3.58041 8.79906 3.26565 9.18742 3.26565ZM6.37493 4.6719C6.7633 4.6719 7.07805 4.98666 7.07805 5.37502C7.07805 5.76339 6.7633 6.07815 6.37493 6.07815C5.98656 6.07815 5.67181 5.76339 5.67181 5.37502C5.67181 4.98666 5.98656 4.6719 6.37493 4.6719Z' fill='#84CA93' />" +
        "</svg>" +
        "</div>" +
        " <span class='title'>" +
        "All" +
        "</span>" +
        "</a>" +
        "</div>&nbsp;";

      for (let index = 0; index < response.data.length; index++) {
        if (response.data[index].name == "อาหาร") {
          color_type =
            "<a href='javascript:void(0);' class='categore-box style-2 primary' onclick='loadMenuBytype(" +
            response.data[index].id +
            ")'>" +
            " <div class='icon-bx'>" +
            "<svg width='24' height='22' viewBox='0 0 24 22' fill='none' xmlns='http://www.w3.org/2000/svg'>" +
            "<path d='M18.3281 17.3282H11.2969L14.8125 19.9649L18.3281 17.3282Z' fill='#42A7E5' />" +
            "<path d='M1.02026 14.648C0.984375 14.6425 0.948303 14.6365 0.911499 14.6279C0.948486 14.6365 0.984192 14.6427 1.02026 14.648Z' fill='#42A7E5' />" +
            "<path d='M0.517669 10.8394C0.153289 11.5098 0.272673 12.3409 0.812102 12.8803L0.86502 12.9333C0.95877 13.027 1.08713 13.0774 1.21951 13.0722C1.35208 13.0671 1.47623 13.0069 1.56247 12.9063C1.58023 12.8857 1.59708 12.8655 1.61319 12.8465C1.99771 12.3913 2.57797 11.7032 3.56253 11.7032C4.55679 11.7032 5.08212 12.2285 5.46591 12.6123C5.8107 12.9571 5.97952 13.1094 6.37503 13.1094C6.77054 13.1094 6.93954 12.9571 7.28415 12.6123C7.66794 12.2285 8.19327 11.7032 9.18753 11.7032C10.1818 11.7032 10.7071 12.2285 11.0909 12.6123C11.4357 12.9571 11.6045 13.1094 12 13.1094C12.3955 13.1094 12.5645 12.9571 12.9091 12.6123C13.2929 12.2285 13.8183 11.7032 14.8125 11.7032C15.8068 11.7032 16.3321 12.2285 16.7159 12.6123C17.0607 12.9571 17.2295 13.1094 17.625 13.1094C18.0205 13.1094 18.1895 12.9571 18.5341 12.6123C18.9179 12.2285 19.4433 11.7032 20.4375 11.7032C21.4223 11.7032 22.0023 12.3913 22.3869 12.8465C22.4145 12.8791 22.4449 12.9151 22.4766 12.9523C22.546 13.0331 22.6485 13.0777 22.7549 13.0735C22.8615 13.0691 22.96 13.0166 23.0228 12.9303L23.103 12.8206C23.6307 12.0972 23.6715 11.1262 23.2066 10.3608C23.1936 10.3394 23.1806 10.3181 23.1674 10.2969H0.83261C0.726409 10.4688 0.620208 10.651 0.517669 10.8394Z' fill='#42A7E5' />" +
            "<path d='M20.6713 17.3282L15.2342 21.4061C15.1091 21.5002 14.9608 21.5469 14.8125 21.5469H19.0312C21.1705 21.5469 23.2885 20.1701 23.9612 18.2587C24.1208 17.8053 23.7678 17.3282 23.2872 17.3282H20.6713Z' fill='#42A7E5' />" +
            "<path d='M22.1558 15.9219C22.3797 15.5377 22.5163 15.0998 22.5355 14.6284C21.9794 14.5118 21.5696 14.0594 21.3116 13.7536C20.9751 13.3539 20.7526 13.1094 20.4375 13.1094C20.042 13.1094 19.8732 13.2619 19.5284 13.6065C19.1446 13.9903 18.6193 14.5157 17.625 14.5157C16.6307 14.5157 16.1054 13.9903 15.7216 13.6065C15.377 13.2619 15.208 13.1094 14.8125 13.1094C14.417 13.1094 14.2482 13.2619 13.9034 13.6065C13.5196 13.9903 12.9943 14.5157 12 14.5157C11.0057 14.5157 10.4804 13.9903 10.0966 13.6065C9.75201 13.2619 9.58301 13.1094 9.1875 13.1094C8.79199 13.1094 8.62317 13.2619 8.27838 13.6065C7.89459 13.9903 7.36926 14.5157 6.375 14.5157C5.38074 14.5157 4.85541 13.9903 4.47162 13.6065C4.12701 13.2619 3.95801 13.1094 3.5625 13.1094C3.24738 13.1094 3.0249 13.3539 2.68835 13.7536C2.42963 14.0601 2.02478 14.531 1.46631 14.6458C1.4881 15.1106 1.62305 15.5425 1.84424 15.9219H22.1558Z' fill='#42A7E5' />" +
            "<path d='M8.95367 17.3282H0.712828C0.232359 17.3282 -0.120668 17.8053 0.0388165 18.2587C0.711729 20.1701 2.82953 21.5469 4.96875 21.5469H14.8125C14.6642 21.5469 14.5159 21.5002 14.391 21.4061L8.95367 17.3282Z' fill='#42A7E5' />" +
            "<path d='M23.29 8.89064C23.713 8.89064 24.0601 8.51637 23.9911 8.09908C23.2755 3.76846 19.3428 0.453156 14.8124 0.453156H9.18742C4.65704 0.453156 0.724306 3.76846 0.00873078 8.09908C-0.0602998 8.51637 0.286867 8.89064 0.70984 8.89064H23.29ZM16.2187 4.6719C16.607 4.6719 16.9218 4.98666 16.9218 5.37502C16.9218 5.76339 16.607 6.07815 16.2187 6.07815C15.8303 6.07815 15.5155 5.76339 15.5155 5.37502C15.5155 4.98666 15.8303 4.6719 16.2187 4.6719ZM13.4062 3.26565C13.7945 3.26565 14.1093 3.58041 14.1093 3.96877C14.1093 4.35714 13.7945 4.6719 13.4062 4.6719C13.0178 4.6719 12.703 4.35714 12.703 3.96877C12.703 3.58041 13.0178 3.26565 13.4062 3.26565ZM11.9999 6.07815C12.3883 6.07815 12.703 6.3929 12.703 6.78127C12.703 7.16963 12.3883 7.48439 11.9999 7.48439C11.6116 7.48439 11.2968 7.16963 11.2968 6.78127C11.2968 6.3929 11.6116 6.07815 11.9999 6.07815ZM9.18742 3.26565C9.57579 3.26565 9.89055 3.58041 9.89055 3.96877C9.89055 4.35714 9.57579 4.6719 9.18742 4.6719C8.79906 4.6719 8.4843 4.35714 8.4843 3.96877C8.4843 3.58041 8.79906 3.26565 9.18742 3.26565ZM6.37493 4.6719C6.7633 4.6719 7.07805 4.98666 7.07805 5.37502C7.07805 5.76339 6.7633 6.07815 6.37493 6.07815C5.98656 6.07815 5.67181 5.76339 5.67181 5.37502C5.67181 4.98666 5.98656 4.6719 6.37493 4.6719Z' fill='#42A7E5' />" +
            "</svg>" +
            " </div>" +
            " <span class='title'>" +
            response.data[index].name +
            "</span>" +
            "</a>";
        } else if (response.data[index].name == "เครื่องดื่ม") {
          color_type =
            "<a href='javascript:void(0);' class='categore-box style-2 secondary' onclick='loadMenuBytype(" +
            response.data[index].id +
            ")'>" +
            " <div class='icon-bx'>" +
            "<svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>" +
            "<path d='M18.7621 9.46073C18.6935 9.11906 18.3934 8.8732 18.0449 8.8732H1.04517C0.696656 8.8732 0.396563 9.11906 0.327984 9.46073C0.110344 10.545 0 11.6676 0 12.7973C0 14.8466 0.349875 16.8033 1.03997 18.6132C1.7047 20.3566 2.67727 21.8953 3.85252 23.0629C3.98953 23.1991 4.17492 23.2755 4.36805 23.2755H14.7219C14.9152 23.2755 15.1005 23.1991 15.2376 23.0629C16.4129 21.8953 17.3854 20.3566 18.0501 18.6131C18.7401 16.8033 19.09 14.8465 19.09 12.7973C19.0901 11.6677 18.9797 10.5451 18.7621 9.46073Z' fill='#FF6B53' />" +
            "<path d='M6.69997 3.17564C6.69997 3.02091 6.73044 2.98046 6.8922 2.79146C7.10877 2.53852 7.436 2.15621 7.436 1.45599C7.436 1.05202 7.10848 0.724503 6.70452 0.724503C6.30055 0.724503 5.97303 1.05202 5.97303 1.45599C5.97303 1.61067 5.94256 1.65113 5.7808 1.84013C5.56423 2.09311 5.237 2.47542 5.237 3.17564C5.237 3.87591 5.56419 4.25822 5.7807 4.51121C5.94247 4.70021 5.97294 4.74075 5.97294 4.89553C5.97294 5.05032 5.94247 5.09082 5.78066 5.27986C5.69872 5.37563 5.59672 5.49483 5.50522 5.64253C5.2925 5.98599 5.39853 6.43683 5.74198 6.64955C5.86194 6.7238 5.99497 6.75924 6.12641 6.75924C6.37128 6.75924 6.61058 6.63628 6.74905 6.41283C6.78134 6.36071 6.83267 6.30066 6.89216 6.23119C7.10867 5.97821 7.43591 5.59589 7.43591 4.89563C7.43591 4.19536 7.10867 3.81305 6.89216 3.56006C6.73044 3.37092 6.69997 3.33042 6.69997 3.17564Z' fill='#FF6B53' />" +
            "<path d='M9.90859 3.17564C9.90859 3.02091 9.93905 2.98046 10.1008 2.79146C10.3174 2.53852 10.6446 2.15621 10.6446 1.45599C10.6446 1.05202 10.3171 0.724503 9.91313 0.724503C9.50916 0.724503 9.18165 1.05202 9.18165 1.45599C9.18165 1.61067 9.15118 1.65113 8.98941 1.84013C8.77285 2.09311 8.44562 2.47542 8.44562 3.17564C8.44562 3.87591 8.77285 4.25822 8.98937 4.51121C9.15113 4.70021 9.1816 4.74075 9.1816 4.89553C9.1816 5.05032 9.15113 5.09082 8.98932 5.27986C8.90738 5.37563 8.80538 5.49483 8.71388 5.64253C8.50116 5.98599 8.6072 6.43683 8.95065 6.64955C9.0706 6.7238 9.20363 6.75924 9.33507 6.75924C9.57995 6.75924 9.8192 6.63628 9.95771 6.41283C9.99001 6.36071 10.0413 6.30066 10.1008 6.23119C10.3173 5.97821 10.6446 5.59589 10.6446 4.89563C10.6446 4.19536 10.3173 3.81305 10.1008 3.56006C9.93905 3.37092 9.90859 3.33042 9.90859 3.17564Z' fill='#FF6B53' />" +
            "<path d='M13.1171 3.17564C13.1171 3.02091 13.1476 2.98046 13.3093 2.79146C13.5259 2.53852 13.8531 2.15621 13.8531 1.45599C13.8531 1.05202 13.5256 0.724503 13.1216 0.724503C12.7177 0.724503 12.3902 1.05202 12.3902 1.45599C12.3902 1.61067 12.3597 1.65113 12.1979 1.84013C11.9814 2.09311 11.6541 2.47542 11.6541 3.17564C11.6541 3.87591 11.9814 4.25822 12.1978 4.51121C12.3596 4.70021 12.3901 4.74075 12.3901 4.89553C12.3901 5.05032 12.3596 5.09082 12.1978 5.27986C12.1159 5.37563 12.0139 5.49483 11.9224 5.64258C11.7097 5.98603 11.8157 6.43688 12.1592 6.64955C12.2791 6.7238 12.4121 6.75924 12.5436 6.75924C12.7884 6.75924 13.0277 6.63624 13.1662 6.41278C13.1985 6.36071 13.2498 6.30066 13.3093 6.23119C13.5258 5.97821 13.853 5.59585 13.853 4.89563C13.853 4.19536 13.5258 3.81305 13.3093 3.56006C13.1476 3.37092 13.1171 3.33042 13.1171 3.17564Z' fill='#FF6B53' />" +
            "<path d='M22.4694 10.7257C21.8535 10.4296 21.1429 10.3487 20.4072 10.4689C20.4683 10.9536 20.5102 11.4429 20.5329 11.9347C21.0723 11.8289 21.5262 11.8956 21.8356 12.0442C22.2945 12.2648 22.5371 12.6739 22.5371 13.227C22.5371 14.4714 21.6479 16.467 19.8745 17.755C19.7412 18.2223 19.5893 18.6826 19.4171 19.1344C19.3249 19.376 19.2274 19.6142 19.1245 19.8486C20.5581 19.2554 21.5662 18.3329 22.2233 17.5411C23.3192 16.2207 24 14.5676 24 13.2269C24 12.1215 23.4278 11.1864 22.4694 10.7257Z' fill='#FF6B53' />" +
            "</svg>" +
            " </div>" +
            " <span class='title'>" +
            response.data[index].name +
            "</span>" +
            "</a>";
        }

        group_html +=
          "<div class='swiper-slide'>" + color_type + "</div>&nbsp;";
      }
      $("#group_tab").html(group_html);
    },
  });
}

function loadMenu(code) {
  let code_array = code.split("_");

  $.ajax({
    url: serverUrl + "/orderMenu/" + code_array[1],
    method: "get",
    success: function (response) {
      let html_menu = "";
      for (let index = 0; index < response.data.length; index++) {
        html_menu +=
          "<h4 class='title my-4'>" +
          "<a href='" +
          serverUrl +
          "details/" +
          response.data[index].id_order +
          "_" +
          searchParams_[1] +
          "'>" +
          response.data[index].order_name +
          "</a>" +
          "</h4>" +
          "<ul>" +
          "<li>" +
          "<div class='item-content'>" +
          "<div class='item-inner'>" +
          " <div class='item-title-row'>" +
          " <h6 class='item-title'>" +
          "<a href='" +
          serverUrl +
          "details/" +
          response.data[index].id_order +
          "_" +
          searchParams_[1] +
          "'>" +
          response.data[index].order_des +
          "</a>" +
          "</h6>" +
          "<div class='item-subtitle'>" +
          response.data[index].name +
          "</div>" +
          "</div>" +
          "<div class='item-footer'>" +
          "<div class='d-flex align-items-center'>" +
          "<h6 class='me-3'>" + price_val + " " +
          response.data[index].order_price +
          "</h6>" +
          "<del class='off-text'>" +
          "<h6>" + price_val + " " +
          "0.00" +
          "</h6>" +
          "</del>" +
          "</div>" +
          "<div class='d-flex align-items-center'>" +
          "<i class='fa-solid fa-star'></i>" +
          "<h6>4.5</h6>" +
          "</div>" +
          "</div>" +
          "</div>" +
          "<div class='item-media media media-90'>" +
          "<img src='" +
          CDN_IMG +
          "/uploads/temps_order/" +
          response.data[index].src_order_picture +
          "' alt='logo' width='100' height='100' />" +
          "</div>" +
          "</div>" +
          "</li>" +
          "</ul>" +
          "<div class='saprater'></div>";
      }
      $("#menu_order").html(html_menu);
    },
  });

  $.ajax({
    url: serverUrl + "/getTableDynamic/" + code_array[0],
    method: "get",
    success: function (response) {
      $("#name_table").html(
        "<h3 id='name_table' class='name mb-0'>" +
          response.data.table_name +
          " 👋</h3>"
      );
    },
  });
}

function loadCart(companies, table_code) {
  get_data_cart = [
    {
      companies: companies,
      table_code: table_code,
    },
  ];
  $.ajax({
    url: serverUrl + "orderCart",
    method: "post",
    data: {
      data: get_data_cart,
    },
    cache: false,
    success: function (response) {
      $("#num_cart").html(
        "<font id='num_cart' >" + response.data.length + "</font>"
      );
      let html_menu = "";
      let sub_total = 0;
      let total = 0;
      for (let index = 0; index < response.data.length; index++) {
        html_menu +=
          "<li>" +
          "<div class='item-content'>" +
          "<div class='item-media media media-60'>" +
          "<img src='" +
          CDN_IMG +
          "/uploads/temps_order/" +
          response.data[index].src_order_picture +
          "' alt='logo'>" +
          "</div>" +
          "<div class='item-inner'>" +
          "<div class='item-title-row'>" +
          "<h6 class='item-title'>" +
          response.data[index].order_customer_ordername +
          "</h6>" +
          // "<div class='item-subtitle'>Coffe, Milk</div>" +
          "</div>" +
          "<div class='item-footer'>" +
          "<div class='d-flex align-items-center'>" +
          "<h6 class='me-3'>" + price_val + "  " +
          response.data[index].order_customer_price +
          "</h6>" +
          "<del class='off-text'>" +
          // "<h6>$ 8.9</h6>" +
          "</del>" +
          "</div>" +
          "<div class='d-flex align-items-center'>" +
          "<div class='dz-stepper border-1 col-5'>" +
          "<input class='stepper' type='text' value='" +
          response.data[index].order_customer_pcs +
          "' name='pcs_cart' data-price='" +
          response.data[index].order_customer_price +
          "' data-id='" +
          response.data[index].id +
          "'>" +
          "</div>" +
          "</div>" +
          "</div>" +
          "</div>" +
          "</div>" +
          "</li> ";

        sub_total +=
          parseFloat(response.data[index].order_customer_price) *
          parseFloat(response.data[index].order_customer_pcs);
        total +=
          parseFloat(response.data[index].order_customer_price) *
          parseFloat(response.data[index].order_customer_pcs);

        sum_pcs_upload_old += parseFloat(
          response.data[index].order_customer_pcs
        );

        array_cart_temp = [
          {
            order_customer_ordername:
              response.data[index].order_customer_ordername,
            order_customer_des: "",
            order_customer_pcs: parseFloat(
              response.data[index].order_customer_pcs
            ),
            order_code: response.data[index].order_code,
            order_customer: "",
            order_customer_table_code: table_code,
            created_by: table_code,
            companies_id: companies,
            order_price_sum: total,
            order_status: "IN_KITCHEN",
            order_printer_name: response.data[index].printer_name,
          },
        ];
        array_cart.push(array_cart_temp);
      }

      $("#list_card").html(html_menu);
      $("#sub_total").html(
        "<span  id='sub_total'>" + price_val + "  " + sub_total.toFixed(2) + "</span>"
      );
      $("#total").html("<h5 id='total'>" + price_val + "  " + total.toFixed(2) + "</h5>");
      $(".stepper").TouchSpin();

      sum_price_upload_old = sub_total.toFixed(2);

      $("input[name='pcs_cart']").on("change", function (event) {
        update_summary(
          event.target.getAttribute("data-price"),
          event.target.value,
          event.target.getAttribute("data-id")
        );
      });
    },
  });
}

function update_summary(price, pcs, id) {
  let total_update = parseFloat(price * pcs);
  get_data_cart_update = [
    {
      id: id,
      sum_price: total_update,
      sum_pcs: pcs,
      table_code: table_code,
    },
  ];

  $.ajax({
    url: serverUrl + "orderCartUpdate",
    method: "post",
    data: {
      data: get_data_cart_update,
    },
    cache: false,
    success: function (response) {
      loadCart(companies, table_code);
    },
  });
}

function loadMenuBytype(id) {
  let data_id = "";
  if (id == undefined) {
    data_id = "All";
  } else {
    data_id = id;
  }

  arr_data = [
    {
      id: data_id,
      companies: companies,
    },
  ];

  $.ajax({
    url: serverUrl + "orderMenuByType",
    method: "post",
    data: {
      data: arr_data,
    },
    success: function (response) {
      let html_menu = "";
      for (let index = 0; index < response.data.length; index++) {
        html_menu +=
          "<h4 class='title my-4'>" +
          "<a href='" +
          serverUrl +
          "details/" +
          response.data[index].id_order +
          "_" +
          searchParams_[1] +
          "'>" +
          response.data[index].order_name +
          "</a>" +
          "</h4>" +
          "<ul>" +
          "<li>" +
          "<div class='item-content'>" +
          "<div class='item-inner'>" +
          " <div class='item-title-row'>" +
          " <h6 class='item-title'>" +
          "<a href='" +
          serverUrl +
          "details/" +
          response.data[index].id_order +
          "_" +
          searchParams_[1] +
          "'>" +
          response.data[index].order_des +
          "</a>" +
          "</h6>" +
          "<div class='item-subtitle'>" +
          response.data[index].name +
          "</div>" +
          "</div>" +
          "<div class='item-footer'>" +
          "<div class='d-flex align-items-center'>" +
          "<h6 class='me-3'>" + price_val + "   " +
          response.data[index].order_price +
          "</h6>" +
          "<del class='off-text'>" +
          "<h6>" + price_val + "   " +
          "0.00" +
          "</h6>" +
          "</del>" +
          "</div>" +
          "<div class='d-flex align-items-center'>" +
          "<i class='fa-solid fa-star'></i>" +
          "<h6>4.5</h6>" +
          "</div>" +
          "</div>" +
          "</div>" +
          "<div class='item-media media media-90'>" +
          "<img src='" +
          CDN_IMG +
          "/uploads/temps_order/" +
          response.data[index].src_order_picture +
          "' alt='logo' width='100' height='100' />" +
          "</div>" +
          "</div>" +
          "</li>" +
          "</ul>" +
          "<div class='saprater'></div>";
      }
      $("#menu_order").html(html_menu);
    },
  });
}

function searchOrder() {
  let data_name = $("#search_order").val();
  arr_data = [
    {
      name: data_name,
      companies: companies,
    },
  ];

  $.ajax({
    url: serverUrl + "orderMenuSearch",
    method: "post",
    data: {
      data: arr_data,
    },
    success: function (response) {
      let html_menu = "";
      for (let index = 0; index < response.data.length; index++) {
        html_menu +=
          "<h4 class='title my-4'>" +
          "<a href='" +
          serverUrl +
          "details/" +
          response.data[index].id_order +
          "_" +
          searchParams_[1] +
          "'>" +
          response.data[index].order_name +
          "</a>" +
          "</h4>" +
          "<ul>" +
          "<li>" +
          "<div class='item-content'>" +
          "<div class='item-inner'>" +
          " <div class='item-title-row'>" +
          " <h6 class='item-title'>" +
          "<a href='" +
          serverUrl +
          "details/" +
          response.data[index].id_order +
          "_" +
          searchParams_[1] +
          "'>" +
          response.data[index].order_des +
          "</a>" +
          "</h6>" +
          "<div class='item-subtitle'>" +
          response.data[index].name +
          "</div>" +
          "</div>" +
          "<div class='item-footer'>" +
          "<div class='d-flex align-items-center'>" +
          "<h6 class='me-3'>" + price_val + "   " +
          response.data[index].order_price +
          "</h6>" +
          "<del class='off-text'>" +
          "<h6>" + price_val + "   " +
          "0.00" +
          "</h6>" +
          "</del>" +
          "</div>" +
          "<div class='d-flex align-items-center'>" +
          "<i class='fa-solid fa-star'></i>" +
          "<h6>4.5</h6>" +
          "</div>" +
          "</div>" +
          "</div>" +
          "<div class='item-media media media-90'>" +
          "<img src='" +
          CDN_IMG +
          "/uploads/temps_order/" +
          response.data[index].src_order_picture +
          "' alt='logo' width='100' height='100' />" +
          "</div>" +
          "</div>" +
          "</li>" +
          "</ul>" +
          "<div class='saprater'></div>";
      }
      $("#menu_order").html(html_menu);
    },
  });
}

function confrimCart() {
  $.ajax({
    url: serverUrl + "orderCustomerInsert",
    method: "post",
    data: {
      data: array_cart,
    },
    cache: false,
    success: function (response) {
      location.reload();
    },
  });
}

function loadvalueMoney(companies) {
  $.ajax({
    url: serverUrl + "/priceValue/" + companies,
    method: "get",
    success: function (response) {
      price_val =  response.data.valueMoney;
    },
  });
}
