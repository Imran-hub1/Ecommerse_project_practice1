  <section class="p-2" style="background-color:green;">
      <div class="header">
          <div class="col-md-12">
              <div class="row">
                  <div class="col-md-4">
                      <h5>logo</h5>
                  </div>
                  <div class="col-md-4">
                      <ul class="" style="float:left">
                          <li class="nav-item dropdown">
                              <a href="{{route('category')}}" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                  <i class="nav-icon fas fa-list"></i> Category
                              </a>
                              <ul class="dropdown-menu">
                                  <li>
                                      <a href="{{ route('index') }}" class="dropdown-item">
                                          <i class="far fa-circle nav-icon"></i> View Categories
                                      </a>
                                  </li>
                                  <li>

                                      <a href="{{route('category')}}" class="dropdown-item">
                                          <i class="far fa-circle nav-icon"></i> Add Category
                                      </a>
                                  </li>
                              </ul>
                          </li>

                          <li class="nav-item dropdown">
                              <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                  <i class="nav-icon fas fa-list"></i> SubCategory
                              </a>
                              <ul class="dropdown-menu">
                                  <li>
                                      <a href="{{route('subcategory.manage')}}" class="dropdown-item">
                                          <i class="far fa-circle nav-icon"></i> View SubCategories
                                      </a>
                                  </li>
                                  <li>

                                      <a href="{{route('subcategory')}}" class="dropdown-item">
                                          <i class="far fa-circle nav-icon"></i> Add SubCategory
                                      </a>
                                      <a href="" class="dropdown-item">
                                          <i class="far fa-circle nav-icon"></i> product
                                      </a>
                                  </li>
                              </ul>
                          </li>

                          <li class="nav-item dropdown">
                              <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                  <i class="nav-icon fas fa-list"></i> brand
                              </a>
                              <ul class="dropdown-menu">
                                  <li>
                                      <a href="{{route('brand.manage')}}" class="dropdown-item">
                                          <i class="far fa-circle nav-icon"></i> View brand
                                      </a>
                                  </li>
                                  <li>

                                      <a href="{{route('brand')}}" class="dropdown-item">
                                          <i class="far fa-circle nav-icon"></i> Add brand
                                      </a>
                                      <a href="{{route('product')}}" class="dropdown-item">
                                          <i class="far fa-circle nav-icon"></i> product
                                      </a>
                                      <a href="{{route('product.manage')}}" class="dropdown-item">
                                          <i class="far fa-circle nav-icon"></i> product manage
                                      </a>
                                      <a href="{{route('product.order')}}" class="dropdown-item">
                                          <i class="far fa-circle nav-icon"></i> product order
                                      </a>
                                  </li>
                              </ul>
                          </li>
                      </ul>
                  </div>
                  <div class="col-md-4 button">
                      <a href="" style="text-decoration:none;">button</a>
                  </div>
              </div>
          </div>
      </div>
  </section>