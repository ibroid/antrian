<div class="container-fluid py-3">
  <div class="row">
    <div class="text-left my-3">
      <h4>Monitoring Hari Ini</h4>
    </div>
    <div class="row">
      <div class="col-xxl-3 col-md-6 box-col-6">
        <?= $this->load->component("admin/sidang_today_chart_pie") ?>
      </div>
      <div class="col-xxl-9 box-col-12">
        <div class="card">
          <div class="card-header card-no-border">
            <h5>Order Overview</h5>
          </div>
          <div class="card-body pt-0">
            <div class="row m-0 overall-card overview-card">
              <div class="col-xl-9 col-md-8 col-sm-7 p-0 box-col-7">
                <div class="chart-right">
                  <div class="row">
                    <div class="col-xl-12">
                      <div class="card-body p-0">
                        <ul class="balance-data">
                          <li><span class="circle bg-secondary"></span><span class="f-light ms-1">Refunds</span></li>
                          <li><span class="circle bg-primary"> </span><span class="f-light ms-1">Earning</span></li>
                          <li><span class="circle bg-success"> </span><span class="f-light ms-1">Order</span></li>
                        </ul>
                        <div class="current-sale-container order-container">
                          <div class="overview-wrapper" id="orderoverview"></div>
                          <div class="back-bar-container">
                            <div id="order-bar"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-4 col-sm-5 p-0 box-col-5">
                <div class="row g-sm-3 g-2">
                  <div class="col-md-12">
                    <div class="light-card balance-card widget-hover">
                      <div class="svg-box">
                        <svg class="svg-fill">
                          <use href="../assets/svg/icon-sprite.svg#orders"></use>
                        </svg>
                      </div>
                      <div> <span class="f-light">Orders</span>
                        <h6 class="mt-1 mb-0">10,098 </h6>
                      </div>
                      <div class="ms-auto text-end">
                        <div class="dropdown icon-dropdown">
                          <button class="btn dropdown-toggle" id="orderdropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orderdropdown"><a class="dropdown-item" href="#">Today</a><a class="dropdown-item" href="#">Tomorrow</a><a class="dropdown-item" href="#">Yesterday </a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="light-card balance-card widget-hover">
                      <div class="svg-box">
                        <svg class="svg-fill">
                          <use href="../assets/svg/icon-sprite.svg#expense"></use>
                        </svg>
                      </div>
                      <div> <span class="f-light">Earning</span>
                        <h6 class="mt-1 mb-0">$12,678</h6>
                      </div>
                      <div class="ms-auto text-end">
                        <div class="dropdown icon-dropdown">
                          <button class="btn dropdown-toggle" id="earningdropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningdropdown"><a class="dropdown-item" href="#">Today</a><a class="dropdown-item" href="#">Tomorrow</a><a class="dropdown-item" href="#">Yesterday </a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="light-card balance-card widget-hover">
                      <div class="svg-box">
                        <svg class="svg-fill">
                          <use href="../assets/svg/icon-sprite.svg#doller-return"></use>
                        </svg>
                      </div>
                      <div> <span class="f-light">Refunds</span>
                        <h6 class="mt-1 mb-0">3,001</h6>
                      </div>
                      <div class="ms-auto text-end">
                        <div class="dropdown icon-dropdown">
                          <button class="btn dropdown-toggle" id="incomedropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="incomedropdown"><a class="dropdown-item" href="#">Today</a><a class="dropdown-item" href="#">Tomorrow</a><a class="dropdown-item" href="#">Yesterday</a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>