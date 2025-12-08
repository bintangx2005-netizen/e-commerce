<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Nest - Multipurpose eCommerce HTML Template</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend')}}/assets/imgs/theme/favicon.svg" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/plugins/animate.min.css" />
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/main.css?v=5.3" />
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/toastr.min.css" />
</head>

<body>
    <!-- Modal -->

    <!-- Quick view -->
    <div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" id="btnClose" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    <figure class="border-radius-10">
                                        <img id="quickViewImage"
                                            src="{{asset('frontend')}}/assets/imgs/shop/product-16-2.jpg"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{asset('frontend')}}/assets/imgs/shop/product-16-1.jpg"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{asset('frontend')}}/assets/imgs/shop/product-16-3.jpg"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{asset('frontend')}}/assets/imgs/shop/product-16-4.jpg"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{asset('frontend')}}/assets/imgs/shop/product-16-5.jpg"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{asset('frontend')}}/assets/imgs/shop/product-16-6.jpg"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{asset('frontend')}}/assets/imgs/shop/product-16-7.jpg"
                                            alt="product image" />
                                    </figure>
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                    <div><img src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-3.jpg"
                                            alt="product image" /></div>
                                    <div><img src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-4.jpg"
                                            alt="product image" /></div>
                                    <div><img src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-5.jpg"
                                            alt="product image" /></div>
                                    <div><img src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-6.jpg"
                                            alt="product image" /></div>
                                    <div><img src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-7.jpg"
                                            alt="product image" /></div>
                                    <div><img src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-8.jpg"
                                            alt="product image" /></div>
                                    <div><img src="{{asset('frontend')}}/assets/imgs/shop/thumbnail-9.jpg"
                                            alt="product image" /></div>
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                <span id="quickViewBadge" class="stock-status out-stock"> Sale Off </span>
                                <h3 class="title-detail"><a id="quickViewTitle" href="shop-product-right.html"
                                        class="text-heading"></a></h3>
                                <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span id="quickViewCurrentPrice" class="current-price text-brand"></span>
                                        <span>
                                            <span id="quickViewDiscount" class="save-price font-md color3 ml-15"></span>
                                            <span id="quickViewOldPrice" class="old-price font-md ml-15"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="detail-extralink mb-30">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="text" name="quantity" class="qty-val" value="1" min="1">
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <input type="hidden" id="productId" value="">
                                        <button onclick="cartSubmit()" class="button button-add-to-cart"><i
                                                class="fi-rs-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                                <div class="font-xs">
                                    <ul>
                                        <li class="mb-5">Vendor: <span id="quickViewVendor" class="text-brand"></span>
                                        </li>
                                        <li class="mb-5">MFG:<span class="text-brand"> Jun 4.2022</span></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header  -->
    @include('frontend.layout.header')



    <!--End header-->








    <main class="main">
        @yield('frontend')

    </main>






    {{-- footer --}}
    @include('frontend.layout.footer')

    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{asset('frontend')}}/assets/imgs/theme/loading.gif" alt="" />
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
    <script src="{{asset('frontend')}}/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/slick.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/waypoints.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/wow.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/perfect-scrollbar.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/magnific-popup.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/select2.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/counterup.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/images-loaded.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/isotope.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/scrollup.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/jquery.vticker-min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/jquery.theia.sticky.js"></script>
    <script src="{{asset('frontend')}}/assets/js/plugins/jquery.elevatezoom.js"></script>
    <script src="{{asset('admin')}}/assets/js/sweetalert.min.js"></script>
    <!-- Template  JS -->
    <script src="{{asset('frontend')}}/assets/js/main.js?v=5.3"></script>
    <script src="{{asset('frontend')}}/assets/js/shop.js?v=5.3"></script>
    <script src="{{asset('admin')}}/assets/js/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            }

            @if (Session::has('type'))


            let type = "{{ session('type','info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ session('message') }}")
                    break;
                case 'success':
                    toastr.success("{{ session('message') }}")
                    break;
                case 'warning':
                    toastr.warning("{{ session('message') }}")
                    break;
                case 'error':
                    toastr.error("{{ session('message') }}")
                    break;
            }
            @endif


            const token = document.head.querySelector('meta[name="csrf-token"]').content;
            const quickViewTitle = document.getElementById('quickViewTitle');
            const quickViewOldPrice = document.getElementById('quickViewOldPrice');
            const quickViewCurrentPrice = document.getElementById('quickViewCurrentPrice');
            const quickViewDiscount = document.getElementById('quickViewDiscount');
            const quickViewBadge = document.getElementById('quickViewBadge');
            const quickViewImage = document.getElementById('quickViewImage');
            let productId = document.getElementById('productId');
            const closeBtn = document.getElementById('btnClose');

            function quickViewLoad(product,vendorName="Owner"){
                productId.value = product.id;
                quickViewTitle.text = product.product_name;
                quickViewImage.setAttribute('src','./uploaded/product/'+product.thumbnail);
                if(product.discount){

                    quickViewDiscount.innerHTML = product.discount + "% Off";
                    quickViewBadge.innerHTML = product.discount + "% Off";
                    quickViewOldPrice.innerHTML = product.selling_price;
                    quickViewCurrentPrice.innerHTML = product.selling_price - (product.selling_price * (product.discount / 100));
                }else{
                   quickViewOldPrice.innerHTML = product.selling_price;
                   if(product.featured){
                    quickViewBadge.innerHTML = "Featured";
                   }
                   if(product.hot_deals){
                        quickViewBadge.innerHTML = "Hot Deal";
                   }
                   if(product.special_deal){
                        quickViewBadge.innerHTML = "Specail Deal";
                   }

                   if(product.special_offer){
                        quickViewBadge.innerHTML = "Special Offer";
                   }

                }
            }

            async function cartSubmit(page = '') {
                if(page !== ''){
                    productId = document.getElementById('product_'+page);
                }
                const res = await fetch("/add-to-cart/"+productId.value);
                const data = await res.json();
                console.log(data);
                    if(res.status === 200){
                        closeBtn.click();
                        cartLoad();
                        swal({
                        icon: "success",
                        title:data.message,
                        buttons: [false,'close'],
                        timer: 1500,

                        });
                    }else{
                        closeBtn.click();
                        swal({
                        icon: "error",
                        title:data.message,
                        timer: 1500,
                        buttons:[false,'close']
                        });
                    }

            }

      document.onreadystatechange = ()=>{
        if(document.readyState == 'complete'){
           cartLoad();
        }
      }

      const cartTotal = document.getElementById('cartTotal');
      const cartCount = document.getElementById('cartCount');
      const cartParent = document.getElementById('cartParent');
      async function cartLoad() {
        const res = await fetch('/ajax-carts');
        const data = await res.json();
        if(res.status === 200){
            cartTotal.innerHTML = "$ "+data.totalAmount;
            cartCount.innerHTML = data.totalCount;
            cartParent.innerHTML = '';
            for(let cartItem of data.allProducts){
                console.log('counting....');
            let cartHtmlElement = `<li>
                <div class="shopping-cart-img">
                    <a href="shop-product-right.html"><img width="100" alt="Product Image"
                            src="${data.url + '/'+ cartItem.thumbnail}" /></a>
                </div>
                <div class="shopping-cart-title">
                    <h4><a href="shop-product-right.html">${cartItem.product_name.slice(0,16)} ...</a></h4>
                    <h4><span>1 × </span>$${cartItem.selling_price}</h4>
                </div>
                <div class="shopping-cart-delete">
                    <a href="#" onclick="cartDelete(${cartItem.id})"><i class="fi-rs-cross-small"></i></a>
                </div>
            </li>`;
            cartParent.insertAdjacentHTML("beforeend", cartHtmlElement);

        }
        }
      }

      async function cartDelete(params) {
        const res = await fetch("/remove-from-cart/"+params);
        const data = await res.json();
        if(res.status === 200){
            cartLoad();
                swal({
                icon: "success",
                title:data.message,
                timer: 1500,
                buttons:[false,'close']
                });
        }
      }
    </script>

</body>

</html>