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
          <a href="{{ route('admin.home') }}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item ">
          <a href="{{url('/')}}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              visit site
            </p>
          </a>
        </li>
      @if(Auth::user()->category==1)
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
      @endif
      @if (Auth::user()->offer==1)
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
      @endif
      @if (Auth::user()->blog==1)
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Blogs
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('blog.category')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('blog.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>BLog Post</p>
              </a>
            </li>
          </ul>
        </li>
      @endif
      @if (Auth::user()->userrole==1)
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              User Role
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('user.role.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create New Role</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('manage.role')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Role</p>
              </a>
            </li>
          </ul>
        </li>
      @endif
      @if (Auth::user()->contact==1)
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Contact
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.contact')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Contacts</p>
              </a>
            </li>

          </ul>
        </li>
      @endif
      @if (Auth::user()->order==1)
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Order
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('order.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Orders</p>
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
      @endif
      @if (Auth::user()->report==1)
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Report
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('report.order.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Orders Report</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('customers.orders.report')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Customers  Orders Report</p>
              </a>
            </li>

          </ul>
        </li>
      @endif
      @if (Auth::user()->pickuppoint==1)
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
      @endif
      @if (Auth::user()->ticket==1)
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Ticket
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('ticket.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ticket</p>
              </a>
            </li>
          </ul>
        </li>
      @endif
      @if (Auth::user()->product==1)
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
      @endif
      @if (Auth::user()->setting==1)
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
              <a href="{{route('payment.getway')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Payment Gateway</p>
              </a>
            </li>
          </ul>
        </li>
      @endif
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
