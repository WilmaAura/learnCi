<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link <?php echo (uri_string() == '') ? "" : "collapsed" ?>" href="/">
          <i class="bi bi-grid"></i>
          <span>Home</span>
        </a>
      </li><!-- End Dashboard Nav -->  

      <li class="nav-item">
        <a class="nav-link <?php echo (uri_string() == 'keranjang')? "" : "collapsed"?>" href="keranjang">
          <i class="bi bi-cart-check"></i>
          <span>Keranjang</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link <?php echo (uri_string() == 'checkout') ? "" : "collapsed" ?>" href="checkout">
          <i class="bi bi-credit-card"></i> <span>Checkout</span>
        </a>
      </li>
      <li class="nav-item">
         <a class="nav-link <?php echo (uri_string() == 'contact') ? "" : "collapsed" ?>" href="contact">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <?php
      if (session()->get('role') == 'admin'){
        ?>
      <li class="nav-item">
         <a class="nav-link <?php echo (uri_string() == 'produk') ? "" : "collapsed" ?>" href="produk">
          <i class="bi bi-receipt"></i>
          <span>Produk</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
           <a class="nav-link <?php echo (uri_string() == 'diskon' || uri_string() == 'discount') ? "" : "collapsed" ?>" href="diskon">
            <i class="bi bi-percent"></i> <span>Diskon</span>
          </a>
        </li>
        <li class="nav-item">
             <a class="nav-link <?php echo (uri_string() == 'pembelian') ? "" : "collapsed" ?>" href="pembelian">
              <i class="bi bi-bag-check"></i> <span>Pembelian</span>
            </a>
        </li>
      <?php
      }
      ?>
    
      <li class="nav-item">
        <a class="nav-link <?php echo (uri_string() == 'history') ? "" : "collapsed" ?>" href="history">
            <i class="bi bi-person"></i>
            <span>History</span>
        </a>
</li><!-- End History Nav -->
    </ul> 
  </aside><!-- End Sidebar-->