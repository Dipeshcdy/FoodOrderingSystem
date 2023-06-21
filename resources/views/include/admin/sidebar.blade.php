 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed;">
    <!-- Brand Logo -->
    <a href="{{auth()->user()->role->role ==="admin"? route('dashboard'):route('vendor.dashboard')}}" class="brand-link text-center">
      {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">{{auth()->user()->role->role === "admin"?"Admin ":"Vendor"}} Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        {{-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> --}}
        <div class="info d-flex">
          <div class="d-flex mx-auto">
            <span class="px-2 rounded-circle bg-white mx-3"><i class="fas fa-user"></i></span>
            <a href="#" class="d-block">{{auth()->user()->username}}</a>
          </div>
        </div>
      </div>

     @if (auth()->user()->role->role ==="admin")
     
     <!-- Sidebar admin Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
        
           
         <li class="nav-item">
           <a href="{{route('slider.index')}}" class="nav-link">
             <i class="nav-icon fas fa-solid fa-image"></i>
             <p>
               Slider
               {{-- <span class="right badge badge-danger">New</span> --}}
             </p>
           </a>
         </li>
         <li class="nav-item">
          <a href="{{route('admin.detail')}}" class="nav-link">
            <i class="nav-icon fa fa-info-circle" aria-hidden="true"></i>

            <p>
              User Details
              {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
          </a>
          </li>
         <li class="nav-item">
           <a href="{{route('admin.profile')}}" class="nav-link">
            <i class="nav-icon fas fa-user-edit"></i>
             <p>
               Profile settings
               {{-- <span class="right badge badge-danger">New</span> --}}
             </p>
           </a>
         </li>
           <li class="nav-item">
             <a href="#" class="nav-link">
              <i class="nav-icon fab fa-product-hunt"></i>
               <p>
                 Products
                 <i class="right fas fa-angle-left"></i>
               </p>
             </a>
             <ul class="nav nav-treeview">
               <li class="nav-item">
                 <a href="{{route('admin.product.items')}}" class="nav-link active">
                   <i class="far fa-circle nav-icon"></i>
                   <p>Product-items</p>
                 </a>
               </li>
               <li class="nav-item">
                 <a href="{{route('product_size.index')}}" class="nav-link">
                   <i class="far fa-circle nav-icon"></i>
                   <p>Product-size</p>
                 </a>
               </li>
               
             </ul>
           </li>
           <li class="nav-item">
             <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
               <p>
                 Vendors
                 <i class="right fas fa-angle-left"></i>
               </p>
             </a>
             <ul class="nav nav-treeview">
               <li class="nav-item">
                 <a href="{{route('vendor.approved')}}" class="nav-link active">
                   <i class="far fa-circle nav-icon"></i>
                   <p>Approved Vendors</p>
                 </a>
               </li>
               <li class="nav-item">
                 <a href="{{route('vendor.pending')}}" class="nav-link">
                   <i class="far fa-circle nav-icon"></i>
                   <p>Pending Vendors</p>
                 </a>
               </li>
               
               
             </ul>
           </li>

           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fab fa-opera"></i>
              <p>
                orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.order.processed')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Processed Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.order.pending')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending orders</p>
                </a>
              </li>
              
              
            </ul>
          </li>


           <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link"  
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
       </ul>
     </nav>
      <!-- /.admin sidebar-menu -->
     @endif
     @if (auth()->user()->role->role ==="vendor")
     
     <!-- Vendor Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
        
           
         <li class="nav-item">
           <a href="{{route('vendor.product.index')}}" class="nav-link">
            <i class="nav-icon fab fa-product-hunt"></i>

             <p>
               products
               {{-- <span class="right badge badge-danger">New</span> --}}
             </p>
           </a>
         </li>
         <li class="nav-item">
          <a href="{{route('vendor.detail')}}" class="nav-link">
            <i class="nav-icon fa fa-info-circle" aria-hidden="true"></i>

            <p>
              User Details
              {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
          </a>
          </li>
          <li class="nav-item">
            <a href="{{route('vendor.profile')}}" class="nav-link">
              <i class="nav-icon fas fa-user-edit"></i>
              <p>
                Profile settings
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fab fa-opera"></i>
              <p>
                orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('vendor.order.processed')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Processed Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('vendor.order.pending')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending orders</p>
                </a>
              </li>
              
              
            </ul>
          </li>


          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link"  
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

       </ul>
     </nav>
     <!-- /.Venor sidebar-menu -->
     @endif
    </div>
    <!-- /.sidebar -->
  </aside>