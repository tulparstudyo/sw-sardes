<?php
$nav = $this->get( 'nav', [] );
?>
<!--  Start Mobile-offcanvas Menu Section   -->
<div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
  <div class="offcanvas__top"> <span class="offcanvas__top-text"></span>
    <button class="offcanvas-close"><i class="fal fa-times"></i></button>
  </div>
  <div class="offcanvas-inner">
    <?=$nav['locale']?>
    <form class="header-search m-tb-15" action="#" method="post">
      <div class="header-search__content pos-relative">
        <input type="search" name="header-search" placeholder="<?= $this->translate( 'client', 'Search our store' ); ?>" required>
        <button class="pos-absolute" type="submit"><i class="icon-search"></i></button>
      </div>
    </form>
    <!-- Start Mobile User Action -->
    <ul class="header__user-action-icon m-tb-15 text-center">
      <!-- Start Header Wishlist Box -->
      <li> <a href="my-account.html"> <i class="icon-users"></i> </a> </li>
      <!-- End Header Wishlist Box --> 
      <!-- Start Header Wishlist Box -->
      <li> <a href="wishlist.html"> <i class="icon-heart"></i> <span class="item-count pos-absolute">3</span> </a> </li>
      <!-- End Header Wishlist Box --> 
      <!-- Start Header Add Cart Box -->
      <li> <a href="cart.html"> <i class="icon-shopping-cart"></i> <span class="wishlist-item-count pos-absolute">3</span> </a> </li>
      <!-- End Header Add Cart Box -->
    </ul>
    <!-- End Mobile User Action -->
    <div class="offcanvas-menu">
      <ul>
        <li><a href="index.html"><span>Home</span></a></li>
        <li> <a href="#"><span>Shop</span></a>
          <ul class="sub-menu">
            <li> <a href="#">Shop Layout</a>
              <ul class="sub-menu">
                <li><a href="shop-sidebar-grid-left.html">Grid Left Sidebar</a></li>
                <li><a href="shop-sidebar-grid-right.html">Grid Right Sidebar</a></li>
                <li><a href="shop-sidebar-full-width.html">Full Width</a></li>
                <li><a href="shop-sidebar-left-list-view.html">List Left Sidebar</a></li>
                <li><a href="shop-sidebar-right-list-view.html">List Right Sidebar</a></li>
              </ul>
            </li>
          </ul>
          <ul class="sub-menu">
            <li> <a href="#">Shop Pages</a>
              <ul class="sub-menu">
                <li><a href="cart.html">Cart</a></li>
                <li><a href="checkout.html">Checkout</a></li>
                <li><a href="compare.html">Compare</a></li>
                <li><a href="empty-cart.html">Empty Cart</a></li>
                <li><a href="wishlist.html">Wishlist</a></li>
                <li><a href="my-account.html">My Account</a></li>
                <li><a href="login.html">Login</a></li>
              </ul>
            </li>
          </ul>
          <ul class="sub-menu">
            <li> <a href="#">Product Single</a>
              <ul class="sub-menu">
                <li><a href="product-single-default.html">Simple</a></li>
                <li><a href="product-single-affiliate.html">Affiliate</a></li>
                <li><a href="product-single-group.html">Grouped</a></li>
                <li><a href="product-single-variable.html">Variable</a></li>
                <li><a href="product-single-tab-left.html">Left Tab</a></li>
                <li><a href="product-single-tab-right.html">Right Tab</a></li>
                <li><a href="product-single-slider.html">Single Slider</a></li>
                <li><a href="product-single-gallery-left.html">Gallery Left</a></li>
                <li><a href="product-single-gallery-right.html">Gallery Right</a></li>
                <li><a href="product-single-sticky-left.html">Sticky Left</a></li>
                <li><a href="product-single-sticky-right.html">Sticky Right</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li> <a href="#"><span>Blogs</span></a>
          <ul class="sub-menu">
            <li> <a href="#">Blog Grid</a>
              <ul class="sub-menu">
                <li><a href="blog-grid-sidebar-left.html"> Blog Grid Left Sidebar</a></li>
                <li><a href="blog-grid-sidebar-right.html"> Blog Grid Right Sidebar</a></li>
              </ul>
            </li>
            <li> <a href="#">Blog List</a>
              <ul class="sub-menu">
                <li><a href="blog-list-sidebar-left.html"> Blog List Left Sidebar</a></li>
                <li><a href="blog-list-sidebar-right.html"> Blog List Right Sidebar</a></li>
              </ul>
            </li>
            <li> <a href="#">Blog Single</a>
              <ul class="sub-menu">
                <li><a href="blog-single-sidebar-left.html"> Blog Single Left Sidebar</a></li>
                <li><a href="blog-single-sidebar-right.html"> Blog Single Right Sidebar</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li> <a href="#"><span>Pages</span></a>
          <ul class="sub-menu">
            <li><a href="about.html">About Us</a></li>
            <li><a href="frequently-questions.html">Frequently Questions</a></li>
            <li><a href="privacy-policy.html">Privacy Policy</a></li>
            <li><a href="404.html">404 Page</a></li>
          </ul>
        </li>
        <li><a href="contact.html">Contact Us</a></li>
      </ul>
    </div>
  </div>
  <ul class="offcanvas__social-nav m-t-50">
    <li class="offcanvas__social-list"><a href="#" class="offcanvas__social-link"><i class="fab fa-facebook-f"></i></a></li>
    <li class="offcanvas__social-list"><a href="#" class="offcanvas__social-link"><i class="fab fa-twitter"></i></a></li>
    <li class="offcanvas__social-list"><a href="#" class="offcanvas__social-link"><i class="fab fa-youtube"></i></a></li>
    <li class="offcanvas__social-list"><a href="#" class="offcanvas__social-link"><i class="fab fa-google-plus-g"></i></a></li>
    <li class="offcanvas__social-list"><a href="#" class="offcanvas__social-link"><i class="fab fa-instagram"></i></a></li>
  </ul>
</div>
<!--  End Mobile-offcanvas Menu Section   --> 

