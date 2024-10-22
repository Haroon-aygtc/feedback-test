@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row gy-4">
  <!-- Congratulations card -->
  <div class="col-md-12 col-lg-4">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-1">Congratulations John! 🎉</h4>
        <p class="pb-0">Best seller of the month</p>
        <h4 class="text-primary mb-1">$42.8k</h4>
        <p class="mb-2 pb-1">78% of target 🚀</p>
        <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a>
      </div>
      <img src="{{asset('assets/img/icons/misc/triangle-light.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background">
      <img src="{{asset('assets/img/illustrations/trophy.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83" alt="view sales">
    </div>
  </div>
  <!--/ Congratulations card -->

  <!-- Transactions -->
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Transactions</h5>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="mdi mdi-dots-vertical mdi-24px"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
              <a class="dropdown-item" href="javascript:void(0);">Share</a>
              <a class="dropdown-item" href="javascript:void(0);">Update</a>
            </div>
          </div>
        </div>
        <p class="mt-3"><span class="fw-medium">Total 48.5% growth</span> 😎 this month</p>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-primary rounded shadow">
                  <i class="mdi mdi-trending-up mdi-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <div class="small mb-1">Sales</div>
                <h5 class="mb-0">245k</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-success rounded shadow">
                  <i class="mdi mdi-account-outline mdi-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <div class="small mb-1">Customers</div>
                <h5 class="mb-0">12.5k</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-warning rounded shadow">
                  <i class="mdi mdi-cellphone-link mdi-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <div class="small mb-1">Product</div>
                <h5 class="mb-0">1.54k</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-info rounded shadow">
                  <i class="mdi mdi-currency-usd mdi-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <div class="small mb-1">Revenue</div>
                <h5 class="mb-0">$88k</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Transactions -->

  <!-- Weekly Overview Chart -->
  <div class="col-xl-4 col-md-6">
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between">
          <h5 class="mb-1">Weekly Overview</h5>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="weeklyOverviewDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="mdi mdi-dots-vertical mdi-24px"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="weeklyOverviewDropdown">
              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
              <a class="dropdown-item" href="javascript:void(0);">Share</a>
              <a class="dropdown-item" href="javascript:void(0);">Update</a>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div id="weeklyOverviewChart"></div>
        <div class="mt-1 mt-md-3">
          <div class="d-flex align-items-center gap-3">
            <h3 class="mb-0">45%</h3>
            <p class="mb-0">Your sales performance is 45% 😎 better compared to last month</p>
          </div>
          <div class="d-grid mt-3 mt-md-4">
            <button class="btn btn-primary" type="button">Details</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Weekly Overview Chart -->

  <!-- Total Earnings -->
  <div class="col-xl-4 col-md-6">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Total Earning</h5>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="totalEarnings" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="mdi mdi-dots-vertical mdi-24px"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalEarnings">
            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="mb-3 mt-md-3 mb-md-5">
          <div class="d-flex align-items-center">
            <h2 class="mb-0">$24,895</h2>
            <span class="text-success ms-2 fw-medium">
              <i class="mdi mdi-menu-up mdi-24px"></i>
              <small>10%</small>
            </span>
          </div>
          <small class="mt-1">Compared to $84,325 last year</small>
        </div>
        <ul class="p-0 m-0">
          <li class="d-flex mb-4 pb-md-2">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/misc/zipcar.png')}}" alt="zipcar" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Zipcar</h6>
                <small>Vuejs, React & HTML</small>
              </div>
              <div>
                <h6 class="mb-2">$24,895.65</h6>
                <div class="progress bg-label-primary" style="height: 4px;">
                  <div class="progress-bar bg-primary" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-md-2">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/misc/bitbank.png')}}" alt="bitbank" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Bitbank</h6>
                <small>Sketch, Figma & XD</small>
              </div>
              <div>
                <h6 class="mb-2">$8,6500.20</h6>
                <div class="progress bg-label-info" style="height: 4px;">
                  <div class="progress-bar bg-info" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </li>
          <li class="d-flex mb-md-3">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/misc/aviato.png')}}" alt="aviato" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Aviato</h6>
                <small>HTML & Angular</small>
              </div>
              <div>
                <h6 class="mb-2">$1,2450.80</h6>
                <div class="progress bg-label-secondary" style="height: 4px;">
                  <div class="progress-bar bg-secondary" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--/ Total Earnings -->

  <!-- Four Cards -->
  <div class="col-xl-4 col-md-6">
    <div class="row gy-4">
      <!-- Total Profit line chart -->
      <div class="col-sm-6">
        <div class="card h-100">
          <div class="card-header pb-0">
            <h4 class="mb-0">$86.4k</h4>
          </div>
          <div class="card-body">
            <div id="totalProfitLineChart" class="mb-3"></div>
            <h6 class="text-center mb-0">Total Profit</h6>
          </div>
        </div>
      </div>
      <!--/ Total Profit line chart -->
      <!-- Total Profit Weekly Project -->
      <div class="col-sm-6">
        <div class="card h-100">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div class="avatar">
              <div class="avatar-initial bg-secondary rounded-circle shadow">
                <i class="mdi mdi-poll mdi-24px"></i>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="totalProfitID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-dots-vertical mdi-24px"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalProfitID">
                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                <a class="dropdown-item" href="javascript:void(0);">Update</a>
              </div>
            </div>
          </div>
          <div class="card-body mt-mg-1">
            <h6 class="mb-2">Total Profit</h6>
            <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
              <h4 class="mb-0 me-2">$25.6k</h4>
              <small class="text-success mt-1">+42%</small>
            </div>
            <small>Weekly Project</small>
          </div>
        </div>
      </div>
      <!--/ Total Profit Weekly Project -->
      <!-- New Yearly Project -->
      <div class="col-sm-6">
        <div class="card h-100">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div class="avatar">
              <div class="avatar-initial bg-primary rounded-circle shadow-sm">
                <i class="mdi mdi-wallet-travel mdi-24px"></i>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="newProjectID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-dots-vertical mdi-24px"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="newProjectID">
                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                <a class="dropdown-item" href="javascript:void(0);">Update</a>
              </div>
            </div>
          </div>
          <div class="card-body mt-mg-1">
            <h6 class="mb-2">New Project</h6>
            <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
              <h4 class="mb-0 me-2">862</h4>
              <small class="text-danger mt-1">-18%</small>
            </div>
            <small>Yearly Project</small>
          </div>
        </div>
      </div>
      <!--/ New Yearly Project -->
      <!-- Sessions chart -->
      <div class="col-sm-6">
        <div class="card h-100">
          <div class="card-header pb-0">
            <h4 class="mb-0">2,856</h4>
          </div>
          <div class="card-body">
            <div id="sessionsColumnChart" class="mb-3"></div>
            <h6 class="text-center mb-0">Sessions</h6>
          </div>
        </div>
      </div>
      <!--/ Sessions chart -->
    </div>
  </div>
  <!--/ Total Earning -->

  <!-- Sales by Countries -->
  <div class="col-xl-4 col-md-6">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Sales by Countries</h5>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="saleStatus" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="mdi mdi-dots-vertical mdi-24px"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="saleStatus">
            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
          <div class="d-flex align-items-center">
            <div class="avatar me-3">
              <div class="avatar-initial bg-label-success rounded-circle">US</div>
            </div>
            <div>
              <div class="d-flex align-items-center gap-1">
                <h6 class="mb-0">$8,656k</h6>
                <i class="mdi mdi-chevron-up mdi-24px text-success"></i>
                <small class="text-success">25.8%</small>
              </div>
              <small>United states of america</small>
            </div>
          </div>
          <div class="text-end">
            <h6 class="mb-0">894k</h6>
            <small>Sales</small>
          </div>
        </div>
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
          <div class="d-flex align-items-center">
            <div class="avatar me-3">
              <span class="avatar-initial bg-label-danger rounded-circle">UK</span>
            </div>
            <div>
              <div class="d-flex align-items-center gap-1">
                <h6 class="mb-0">$2,415k</h6>
                <i class="mdi mdi-chevron-down mdi-24px text-danger"></i>
                <small class="text-danger">6.2%</small>
              </div>
              <small>United Kingdom</small>
            </div>
          </div>
          <div class="text-end">
            <h6 class="mb-0">645k</h6>
            <small>Sales</small>
          </div>
        </div>
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
          <div class="d-flex align-items-center">
            <div class="avatar me-3">
              <span class="avatar-initial bg-label-warning rounded-circle">IN</span>
            </div>
            <div>
              <div class="d-flex align-items-center gap-1">
                <h6 class="mb-0">865k</h6>
                <i class="mdi mdi-chevron-up mdi-24px text-success"></i>
                <small class="text-success"> 12.4%</small>
              </div>
              <small>India</small>
            </div>
          </div>
          <div class="text-end">
            <h6 class="mb-0">148k</h6>
            <small>Sales</small>
          </div>
        </div>
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
          <div class="d-flex align-items-center">
            <div class="avatar me-3">
              <span class="avatar-initial bg-label-secondary rounded-circle">JA</span>
            </div>
            <div>
              <div class="d-flex align-items-center gap-1">
                <h6 class="mb-0">$745k</h6>
                <i class="mdi mdi-chevron-down mdi-24px text-danger"></i>
                <small class="text-danger">11.9%</small>
              </div>
              <small>Japan</small>
            </div>
          </div>
          <div class="text-end">
            <h6 class="mb-0">86k</h6>
            <small>Sales</small>
          </div>
        </div>
        <div class="d-flex flex-wrap justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <div class="avatar me-3">
              <span class="avatar-initial bg-label-danger rounded-circle">KO</span>
            </div>
            <div>
              <div class="d-flex align-items-center gap-1">
                <h6 class="mb-0">$45k</h6>
                <i class="mdi mdi-chevron-up mdi-24px text-success"></i>
                <small class="text-success">16.2%</small>
              </div>
              <small>Korea</small>
            </div>
          </div>
          <div class="text-end">
            <h6 class="mb-0">42k</h6>
            <small>Sales</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Sales by Countries -->

  <!-- Deposit / Withdraw -->
  <div class="col-xl-8">
    <div class="card h-100">
      <div class="card-body row g-2">
        <div class="col-12 col-md-6 card-separator pe-0 pe-md-3">
          <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <h5 class="m-0 me-2">Deposit</h5>
            <a class="fw-medium" href="javascript:void(0);">View all</a>
          </div>
          <div class="pt-2">
            <ul class="p-0 m-0">
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-3">
                  <img src="{{asset('assets/img/icons/payments/gumroad.png')}}" class="img-fluid" alt="gumroad" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Gumroad Account</h6>
                    <small>Sell UI Kit</small>
                  </div>
                  <h6 class="text-success mb-0">+$4,650</h6>
                </div>
              </li>
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-3">
                  <img src="{{asset('assets/img/icons/payments/mastercard-2.png')}}" class="img-fluid" alt="mastercard" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Mastercard</h6>
                    <small>Wallet deposit</small>
                  </div>
                  <h6 class="text-success mb-0">+$92,705</h6>
                </div>
              </li>
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-3">
                  <img src="{{asset('assets/img/icons/payments/stripes.png')}}" class="img-fluid" alt="stripes" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Stripe Account</h6>
                    <small>iOS Application</small>
                  </div>
                  <h6 class="text-success mb-0">+$957</h6>
                </div>
              </li>
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-3">
                  <img src="{{asset('assets/img/icons/payments/american-bank.png')}}" class="img-fluid" alt="american" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">American Bank</h6>
                    <small>Bank Transfer</small>
                  </div>
                  <h6 class="text-success mb-0">+$6,837</h6>
                </div>
              </li>
              <li class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                  <img src="{{asset('assets/img/icons/payments/citi.png')}}" class="img-fluid" alt="citi" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Bank Account</h6>
                    <small>Wallet deposit</small>
                  </div>
                  <h6 class="text-success mb-0">+$446</h6>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-12 col-md-6 ps-0 ps-md-3 mt-3 mt-md-2">
          <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <h5 class="m-0 me-2">Withdraw</h5>
            <a class="fw-medium" href="javascript:void(0);">View all</a>
          </div>
          <div class="pt-2">
            <ul class="p-0 m-0">
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-3">
                  <img src="{{asset('assets/img/icons/brands/google.png')}}" class="img-fluid" alt="google" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Google Adsense</h6>
                    <small>Paypal deposit</small>
                  </div>
                  <h6 class="text-danger mb-0">-$145</h6>
                </div>
              </li>
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-3">
                  <img src="{{asset('assets/img/icons/brands/github.png')}}" class="img-fluid" alt="github" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Github Enterprise</h6>
                    <small>Security &amp; compliance</small>
                  </div>
                  <h6 class="text-danger mb-0">-$1870</h6>
                </div>
              </li>
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-3">
                  <img src="{{asset('assets/img/icons/brands/slack.png')}}" class="img-fluid" alt="slack" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Upgrade Slack Plan</h6>
                    <small>Debit card deposit</small>
                  </div>
                  <h6 class="text-danger mb-0">$450</h6>
                </div>
              </li>
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-3">
                  <img src="{{asset('assets/img/icons/payments/digital-ocean.png')}}" class="img-fluid" alt="digital" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Digital Ocean</h6>
                    <small>Cloud Hosting</small>
                  </div>
                  <h6 class="text-danger mb-0">-$540</h6>
                </div>
              </li>
              <li class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                  <img src="{{asset('assets/img/icons/brands/aws.png')}}" class="img-fluid" alt="aws" height="30" width="30">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">AWS Account</h6>
                    <small>Choosing a Cloud Platform</small>
                  </div>
                  <h6 class="text-danger mb-0">-$21</h6>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Deposit / Withdraw -->

  <!-- Data Tables -->
  <div class="col-12">
    <div class="card">
      <div class="table-responsive">
        <div class="table-responsive text-nowrap">
          <table class="table table-striped table-hover" id="question-table">
            <thead>
            <tr>
              <th colspan="5" class="text-center">
                <div class="btn-group" role="group" aria-label="Language Toggle">
                  <button type="button" class="lang-toggle btn btn-outline-primary active" data-lang="en">English</button>
                  <button type="button" class="lang-toggle btn btn-outline-primary" data-lang="ar">Arabic</button>
                </div>
              </th>
            </tr>
            <tr id="en" data-question-id="en">
              <th data-question-id="text-en">Question Text</th>
              <th data-question-id="title-en">Title</th>
              <th data-question-id="description-en">Description</th>
              <th data-question-id="type-en">Type</th>
              <th data-question-id="actions-en">Actions</th>
            </tr>
            <tr id="ar" class="d-none" data-question-id="ar">
              <th data-question-id="text-ar">سؤال</th>
              <th data-question-id="title-ar">عنوان</th>
              <th data-question-id="description-ar">وصف</th>
              <th data-question-id="type-ar">نوع</th>
              <th data-question-id="actions-ar">إجراءات</th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="question-table-body">
            @foreach($questions as $question)
              <tr data-question-id="{{ $question->id }}-en">
                <td>{{ $question->translations->firstWhere('locale', 'en')->question_text }}</td>
                <td>{{ $question->translations->firstWhere('locale', 'en')->title }}</td>
                <td>{{ Str::limit($question->translations->firstWhere('locale', 'en')->description, 30) }}</td>
                <td>{{ $question->type }}</td>
                <td>
                  <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-outline-secondary view-question-modal" data-question-id="{{ $question->id }}" title="View Translations">
                      <i class="fa fa-language"></i>
                    </button>
                    @if ($question->type === 'radio')
                      <button type="button" class="btn btn-outline-primary view-options-modal" data-toggle="modal" data-target="#option-modal-{{ $question->id }}" title="View Options">
                        <i class="fa fa-list-ul"></i>
                      </button>
                    @endif
                  </div>
                </td>
              </tr>
              <tr class="d-none" data-question-id="{{ $question->id }}-ar">
                <td>{{ $question->translations->firstWhere('locale', 'ar')->question_text }}</td>
                <td>{{ $question->translations->firstWhere('locale', 'ar')->title }}</td>
                <td>{{ Str::limit($question->translations->firstWhere('locale', 'ar')->description, 30) }}</td>
                <td>{{ $question->type }}</td>
                <td>
                  <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-outline-secondary view-question-modal" data-toggle="modal" data-target="#question-modal-{{ $question->id }}-ar" data-question-id="{{ $question->id }}" title="عرض الترجمات">
                      <i class="fa fa-language"></i>
                    </button>
                    @if ($question->type === 'radio')
                      <button type="button" class="btn btn-outline-primary view-options-modal" data-toggle="modal" data-target="#option-modal-{{ $question->id }}" title="عرض الخيارات">
                        <i class="fa fa-list-ul"></i>
                      </button>
                    @endif
                  </div>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          <div class="pagination-wrapper">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Data Tables -->
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Popper.js (for tooltip and popovers) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<!-- Bootstrap 4 JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const viewQuestionButtons = document.querySelectorAll('.view-question-modal');
    const toggleLanguageButton = document.getElementById('toggle-language');
    const table = document.querySelector('table');
    const languageIcon = document.getElementById('language-icon');

    let currentLanguage = 'en';

    // Function to toggle table rows and headers based on language
    function toggleTableLanguage(language) {
      const otherLang = (language === 'en') ? 'ar' : 'en';

      document.querySelectorAll(`tr[data-question-id$="-${language}"]`).forEach(row => {
        row.classList.remove('d-none');
      });
      document.querySelectorAll(`tr[data-question-id$="-${otherLang}"]`).forEach(row => {
        row.classList.add('d-none');
      });

      document.getElementById(language).classList.remove('d-none');
      document.getElementById(otherLang).classList.add('d-none');

      table.style.direction = (language === 'en') ? 'ltr' : 'rtl';
    }

    // Function to toggle rows
    function toggleRows(language) {
      const englishRows = document.querySelectorAll('tr[data-question-id$="-en"]');
      const arabicRows = document.querySelectorAll('tr[data-question-id$="-ar"]');

      englishRows.forEach(row => {
        row.classList.toggle('d-none', language === 'ar');
      });

      arabicRows.forEach(row => {
        row.classList.toggle('d-none', language === 'en');
      });
    }

    // Event listener for the toggle language button
    toggleLanguageButton.addEventListener('click', function() {
      currentLanguage = (currentLanguage === 'en') ? 'ar' : 'en';
      toggleTableLanguage(currentLanguage);
      toggleRows(currentLanguage);

      // Update button text/icon
      this.dataset.language = currentLanguage;
      languageIcon.classList.toggle('fa-flag', currentLanguage === 'ar');
      languageIcon.classList.toggle('fa-globe', currentLanguage === 'en');
      this.title = (currentLanguage === 'en') ? 'Switch to Arabic' : 'Switch to English';
    });

    // Event listener for individual question buttons
    viewQuestionButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        const questionId = this.dataset.questionId;
        const englishRow = document.querySelector(`tr[data-question-id="${questionId}-en"]`);
        const arabicRow = document.querySelector(`tr[data-question-id="${questionId}-ar"]`);
        const arabicHeader = document.querySelector(`th[data-question-id="ar"]`);
        const englishHeader = document.querySelector(`th[data-question-id="en"]`);

        // Check if both rows exist
        if (englishRow && arabicRow) {
          if (englishRow.classList.contains('d-none')) {
            englishRow.classList.remove('d-none');
            arabicRow.classList.add('d-none');

            if (englishHeader) {
              englishHeader.classList.remove('d-none');
            }
            if (arabicHeader) {
              arabicHeader.classList.add('d-none');
            }
          } else {
            englishRow.classList.add('d-none');
            arabicRow.classList.remove('d-none');

            if (arabicHeader) {
              arabicHeader.classList.remove('d-none');
            }
            if (englishHeader) {
              englishHeader.classList.add ('d-none');
            }
          }
        } else {
          console.error(`Rows for question ID ${questionId} not found.`);
        }
      });
    });
  });

  // ================ Fetch Questions Function ================
  // function fetchQuestions(page = 1) {
  //   fetch('#' + `?page=${page}`)
  //     .then(response => {
  //       if (!response.ok) {
  //         throw new Error('Network response was not ok');
  //       }
  //       const questions = data.data;
  //       renderQuestionList(questions);
  //     })
  //     .then(data => {
  //       const questions = data.data;
  //       renderQuestionList(questions);
  //     })
  //     .catch(error => {
  //
  //     });
  // };
 {{--// {{ route('admin.questions.index') }}   ---    {{ route('admin.questions.updateStatus') }} --}}
  // ================ Render Question List Function ================
  // function renderQuestionList(data) {
  //   const questionTableBodyElement = document.getElementById('question-table-body');
  //   questionTableBodyElement.innerHTML = '';
  //
  //   data.data.forEach(question => {
  //     const tableRow = document.createElement('tr');
  //     tableRow.innerHTML = `
  //   <td>${question.id}</td>
  //   <td>
  //     <button class="toggle-button" data-question-id="${question.id}">Toggle</button>
  //     <div class="question-text" data-question-id="${question.id}">
  //       <p>AR: ${question.text_ar}</p>
  //       <p>EN: ${question.text_en}</p>
  //     </div>
  //   </td>
  //   <td>${question.category.name}</td>
  //   <td>${question.type.name}</td>
  //   <td>${question.status ? 'Active' : 'Inactive'}</td>
  //   <td>
  //     <button class="status-button" data-question-id="${question.id}" data-status="${question.status ? 0 : 1}">${question.status ? 'Deactivate' : 'Activate'}</button>
  //   </td>
  // `;
  //     questionTableBodyElement.appendChild(tableRow);
  //   });
  //
  //   // Add event listeners for toggle buttons
  //   document.querySelectorAll('.toggle-button').forEach(button => {
  //     button.addEventListener('click', event => {
  //       const questionId = event.target.dataset.questionId;
  //       const questionTextElement = document.querySelector(`.question-text[data-question-id="${questionId}"]`);
  //       questionTextElement.classList.toggle('hidden');
  //     });
  //   });
  //
  //   // Add event listeners for status buttons
  //   document.querySelectorAll('.status-button').forEach(button => {
  //     button.addEventListener('click', event => {
  //       const questionId = event.target.dataset.questionId;
  //       const status = event.target.dataset.status;
  //       // Send AJAX request to update question status
  //       fetch('', {
  //         method: 'POST',
  //         headers: {
  //           'Content-Type': 'application/json'
  //         },
  //         body: JSON.stringify({ id: questionId, status: status })
  //       })
  //         .then(response => {
  //           if (!response.ok) {
  //             throw new Error('Network response was not ok');
  //           }
  //           return response.json();
  //         })
  //         .then(data => {
  //           // Update the question status in the table
  //           const tableRow = document.querySelector(`tr[data-question-id="${questionId}"]`);
  //           const statusCell = tableRow.querySelector('td:nth-child(5)');
  //           statusCell.textContent = data.status ? 'Active' : 'Inactive';
  //           event.target.textContent = data.status ? 'Deactivate' : 'Activate';
  //         })
  //         .catch(error => {
  //           // ... (Your error handling with Swal) ...
  //         });
  //     });
  //   });
  //
  //   // Render pagination links
  //   renderPaginationLinks(data.meta);
  // };

  // ================ Render Pagination Links Function ================
  // function renderPaginationLinks(meta) {
  //   const paginationElement = document.getElementById('pagination');
  //   paginationElement.innerHTML = '';
  //
  //   if (meta.prev_page_url) {
  //     const prevLink = document.createElement('a');
  //     prevLink.href = `javascript:fetchQuestions(${meta.current_page - 1})`;
  //     prevLink.textContent = 'Previous';
  //     paginationElement.appendChild(prevLink);
  //   }
  //
  //   if (meta.next_page_url) {
  //     const nextLink = document.createElement('a');
  //     nextLink.href = `javascript:fetchQuestions(${meta.current_page + 1})`;
  //     nextLink.textContent = 'Next';
  //     paginationElement.appendChild(nextLink);
  //   }
  // };

  // Call the fetchQuestions function when the page loads
  // document.addEventListener('DOMContentLoaded', fetchQuestions);
</script>




@endsection
