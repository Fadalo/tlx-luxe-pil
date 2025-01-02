<div class="col-xl-4">
    <div class="card">
        <div class="card-body">
            <div class="float-end">
                <select class="form-select shadow-none form-select-sm">
                    @foreach($year as $key => $value)
                      <option value="{{$value['year']}}">{{$value['year']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="float-end" style="margin-right:3px">
                <select class="form-select shadow-none form-select-sm">
                    {{print_r($month)}}
                    @foreach($month as $key => $value)
                      <option value="{{$value['month']}}">{{$value['month']}}</option>
                    @endforeach
                </select>
            </div>
              
            <h4 class="card-title mb-4">Total Order</h4>
            <div class="row">
                <div class="col-4">
                    <div class="text-center mt-4">
                        <h5>{{$totalThisMonth}}</h5>
                        <p class="mb-2 text-truncate">Total</p>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-4">
                    <div class="text-center mt-4">
                        <h5>{{$totalLastWeek}}</h5>
                        <p class="mb-2 text-truncate">Last Week</p>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-4">
                    <div class="text-center mt-4">
                        <h5>{{$totalLastMonth}}</h5>
                        <p class="mb-2 text-truncate">Last Month</p>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="mt-4">
                <div id="donut-chart" class="apex-charts"></div>
            </div>
        </div>
    </div><!-- end card -->
</div><!-- end col -->
@push('script_ext')
<script>
    var options = {
	series: [42, 26, 15],
	chart: {
		height: 286,
		type: "donut"
	},
	labels: ["Market Place", "Last Week", "Last Month"],
	plotOptions: {
		pie: {
			donut: {
				size: "73%",
				labels: {
					show: !0,
					name: {
						show: !0,
						fontSize: "18px",
						offsetY: 5
					},
					value: {
						show: !1,
						fontSize: "20px",
						color: "#343a40",
						offsetY: 8
					},
					total: {
						show: !0,
						fontSize: "17px",
						label: "SUMMARY",
						color: "#6c757d",
						fontWeight: 600
					}
				}
			}
		}
	},
	dataLabels: {
		enabled: !1
	},
	legend: {
		show: !1
	},
	colors: ["#0f9cf3", "#6fd088", "#ffbb44"]
};
(chart = new ApexCharts(document.querySelector("#donut-chart"), options)).render();
</script>
@endpush