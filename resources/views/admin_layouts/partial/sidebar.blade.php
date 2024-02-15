<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-decoration-none">
      <img src="{{asset('backend')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light ">{{Auth::user()?->email}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('backend')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block text-decoration-none">{{Auth::user()?->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{route('admin.home')}}" class="nav-link {{Request::is('admin/home*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
        <!--Category dashboard start-->
        @if(Auth::user()->category==1)
          <li class="nav-item">
            <a href="#" class="nav-link {{Request::is('admin/category') ? 'active' : ''}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Category
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">5</span>
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
                  <p>Sub Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('childcategory.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Child Category</p>
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
      <!--Category dashboard end-->

        <!--product dashboard start-->
        @if(Auth::user()->product==1)
          <li class="nav-item">
            <a href="#" class="nav-link {{Request::is('admin/product*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Product
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('product.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Product</p>
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
      <!--product dashboard end-->

        <!--Setting dashboard start-->
        @if(Auth::user()->setting==1)
          <li class="nav-item">
            <a href="#" class="nav-link {{Request::is('admin/setting*') ? 'active' : ''}}">
              <i class="nav-icon fa-solid fa-gear"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">5</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('seo.setting')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SEO Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('website.setting')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Website Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('page.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Page Create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('smpt.setting')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SMTP Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('payment.gateway')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payment Gateway</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
      <!--Setting dashboard end-->
        <!--Setting dashboard start-->
        @if(Auth::user()->offer==1)
          <li class="nav-item">
            <a href="#" class="nav-link {{Request::is('admin/offer*') ? 'active' : ''}}">
              <i class="nav-icon fa-solid fa-gear"></i>
              <p>
                Offer
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
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
                  <p>E Campaign</p>
                </a>
              </li>
              
            </ul>
          </li>
          @endif
      <!--Setting dashboard end-->
        <!--pickup point dashboard start-->
        @if(Auth::user()->pickup==1)
          <li class="nav-item">
            <a href="#" class="nav-link {{Request::is('admin/pickup-point*') ? 'active' : ''}}">
              <i class="nav-icon fa-solid fa-gear"></i>
              <p>
                Pickup Point
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">1</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('pickuppoint.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pickup Point</p>
                </a>
              </li>
              
            </ul>
          </li>
          @endif
      <!--pickup point dashboard end-->
      @if(Auth::user()->blog==1)
          <li class="nav-item">
            <a href="#" class="nav-link {{Request::is('admin/blog*') ? 'active' : ''}}">
              <i class="nav-icon fa-solid fa-gear"></i>
              <p>
                Blogs
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">1</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.blog.category')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.blog.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blog</p>
                </a>
              </li>
              
            </ul>
          </li>
          @endif
      <!--orders dashboard end-->
      @if(Auth::user()->order==1)
          <li class="nav-item">
            <a href="#" class="nav-link {{Request::is('admin/order*') ? 'active' : ''}}">
              <i class="nav-icon fa-solid fa-gear"></i>
              <p>
                Orders
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">1</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.order.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Order List</p>
                </a>
              </li>
              
            </ul>
          </li>
          @endif
      <!--orders dashboard end-->

        <!--ticket dashboard start-->
        @if(Auth::user()->ticket==1)
          <li class="nav-item">
            <a href="#" class="nav-link {{Request::is('admin/ticket*') ? 'active' : ''}}">
              <i class="nav-icon fa-solid fa-gear"></i>
              <p>
                Ticket
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">1</span>
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
      <!--ticket dashboard end-->
        <!--ticket dashboard start-->
        @if(Auth::user()->contact==1)
          <li class="nav-item">
            <a href="#" class="nav-link {{Request::is('admin/contact*') ? 'active' : ''}}">
              <i class="nav-icon fa-solid fa-gear"></i>
              <p>
                Contact Message
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">1</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.contact.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact Message</p>
                </a>
              </li>
              
            </ul>
          </li>
          @endif
      <!--ticket dashboard end-->
        <!--Report dashboard start-->
        @if(Auth::user()->report==1)
          <li class="nav-item">
            <a href="#" class="nav-link {{Request::is('admin/report*') ? 'active' : ''}}">
              <i class="nav-icon fa-solid fa-gear"></i>
              <p>
                Report
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">1</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('report.order.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Order Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ticket Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Warehouse Report</p>
                </a>
              </li>
              
            </ul>
          </li>
          @endif
      <!--Report dashboard end-->
      <!--ROle dashboard start-->
      @if(Auth::user()->role==1)
      <li class="nav-item">
        <a href="#" class="nav-link {{Request::is('admin/role*') ? 'active' : ''}}">
          <i class="nav-icon fa-solid fa-gear"></i>
          <p>
            User Role
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">1</span>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('create.role')}}" class="nav-link">
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
  <!--ROle dashboard end-->
    
<!--profile dashboard start-->
          <li class="nav-header text-uppercase">Profile</li>
          <li class="nav-item">
            <a href="{{route('admin.password.change')}}" class="nav-link {{Request::is('admin/passwordChange*') ? 'active' : ''}}">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Password Change</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.logout')}}" id="logout" class="nav-link {{Request::is('admin/logout*') ? 'active' : ''}}">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Logout</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li>
          <!--profile dashboard end-->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>