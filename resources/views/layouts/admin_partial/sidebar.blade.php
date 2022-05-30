<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  @php
  $setting=DB::table('settings')->first();
  @endphp
  <a href="index3.html" class="brand-link">
    <img src=""  class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">
      <img src="{{asset('files/setting/')}}/{{$setting->logo}}" width="80" alt="">
      Lh-ecommerce</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="https://toppng.com//public/uploads/preview/donna-picarro-dummy-avatar-115633298255iautrofxa.png" class="img-circle elevation-2" >
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div>



    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item ">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Category
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('category.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('subcategory.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sub-Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('childcategory.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Child-Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('brand.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Brand</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('warehouse.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Warehouse</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Offer
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('coupon.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Coupon</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('campaign.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>campaign</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Pickup Point
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('pickuppoint.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pickup point</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Product
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('product.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add New Product</p>
              </a>
              </li>
            <li class="nav-item">
              <a href="{{route('product.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Product</p>
              </a>
            </li>
          </ul>

        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Settings
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('seo.setting')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>SEO Settings</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('website.setting')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Website Settings</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('page.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Page Managment</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('smtp.setting')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>SMTP Settings</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('category.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Payment Gateway</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Profile
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.logout')}}" id="logout" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Logout</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.email.change')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Email Change</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.password.change')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Password Change</p>
              </a>
            </li>

            </li>

          </ul>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
