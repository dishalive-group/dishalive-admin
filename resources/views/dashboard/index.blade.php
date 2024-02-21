@extends("dashboard.layouts.main")
@push("meta")
    <title>Dashboard</title>
@endpush
@section("main-section")

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-items-center">
					<h4 class="card-title">Dashboard</h4>
					<a href="/dashboard/reports" class="btn btn-primary btn-round ml-auto">
						<i class="fa fa-list"></i>
						Reports
					</a>
				</div>
			</div>
			<div class="card-body">
				
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<a href="/dashboard/user-campaigns">
						<div class="card card-stats card-primary card-round">
							<div class="card-body">
								<div class="row">
									<div class="col-3">
										<div class="icon-big text-center">
											<i class="fas fa-chart-pie"></i>
										</div>
									</div>
									<div class="col-9 col-stats">
										<div class="numbers">
											<h4 class="card-title">Campaigns</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
						</a>
					</div>
					<div class="col-sm-6 col-md-4">
						<a href="/dashboard/reports">
						<div class="card card-stats card-primary card-round">
							<div class="card-body">
								<div class="row">
									<div class="col-3">
										<div class="icon-big text-center">
											<i class="fas fa-chart-pie"></i>
										</div>
									</div>
									<div class="col-9 col-stats">
										<div class="numbers">
											<h4 class="card-title">Reports</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
						</a>
					</div>
					<div class="col-sm-6 col-md-4">
						<a href="/dashboard/transactions">
						<div class="card card-stats card-primary card-round">
							<div class="card-body">
								<div class="row">
									<div class="col-3">
										<div class="icon-big text-center">
											<i class="fas fa-piggy-bank"></i>
										</div>
									</div>
									<div class="col-9 col-stats">
										<div class="numbers">
											<h4 class="card-title">Credits:</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
						</a>
					</div>

				</div>
			</div>
		</div>

@endsection