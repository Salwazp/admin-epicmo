@extends('layouts.admin.app')

@section('content')
<style>
    .width-4{
        width: 20px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-baseline flex-sm-row flex-column">
                <h4 class="card-title">Traffic Visitor</h4>
            </div>
            <div class="card-body">
                <canvas class="line-area-chart-exs chartjs" data-height="400" style="display: block;height: 316px;width: 1161px;"></canvas>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-4">
        <div class="card card-browser-states">
            <div class="card-header">
                <div>
                    <h4 class="card-title">Recent Direct</h4>
                </div>
            </div>
            <div class="card-body" style="overflow: scroll;height: 336px;">
            @foreach ($sAnalityc as $item)
                <div class="browser-states">
                    <div class="d-flex">
                        
                        <a href="javascript:void()" class="align-self-center mb-0 ml-1" style="width: 200px;">{{ $item->referrer }}</a>
                    </div>
                    <div class="d-flex align-items-center" style="position: relative;">
                        <div class="fw-bold text-body-heading me-1">{{ $item->count }}</div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div> -->
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card card-browser-states">
            <div class="card-header">
                <div>
                    <h4 class="card-title">Location</h4>
                </div>
            </div>
            <div class="card-body" style="overflow: scroll;overflow-x: hidden;height: 336px;">
            @foreach ($countries as $item)
                <div class="browser-states">
                    <div class="d-flex">
                        <h6 class="align-self-center mb-0 ml-1">{{ $item->value ? $item->value : 'Unknown' }}</h6>
                    </div>
                    <div class="d-flex align-items-center" style="position: relative;">
                        <div class="fw-bold text-body-heading me-1">{{ $item->count }}</div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-browser-states">
            <div class="card-header">
                <div>
                    <h4 class="card-title">Browsers</h4>
                </div>
            </div>
            <div class="card-body" style="overflow: scroll;overflow-x: hidden;height: 336px;">
            @foreach ($browser as $item)
                <div class="browser-states">
                    <div class="d-flex">
                        <h6 class="align-self-center mb-0 ml-1">{{ $item->value ? $item->value : 'Unknown' }}</h6>
                    </div>
                    <div class="d-flex align-items-center" style="position: relative;">
                        <div class="fw-bold text-body-heading me-1">{{ $item->count }}</div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-browser-states">
            <div class="card-header">
                <div>
                    <h4 class="card-title">Operating systems</h4>
                </div>
            </div>
            <div class="card-body" style="overflow: scroll;overflow-x: hidden;height: 336px;">
            @foreach ($os as $item)
                <div class="browser-states">
                    <div class="d-flex">
                        <h6 class="align-self-center mb-0 ml-1">{{ $item->value ? $item->value : 'Unknown' }}</h6>
                    </div>
                    <div class="d-flex align-items-center" style="position: relative;">
                        <div class="fw-bold text-body-heading me-1">{{ $item->count }}</div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
	<script src="https://assets-vuexy.sobatteknologi.com/vendors/js/charts/chart.min.js"></script>
	<script src="https://assets-vuexy.sobatteknologi.com/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
	<script src="https://assets-vuexy.sobatteknologi.com/js/scripts/charts/chart-chartjs.js"></script>
    <script src="https://assets-vuexy.sobatteknologi.com/vendors/js/charts/apexcharts.min.js"></script>
    <script src="https://assets-vuexy.sobatteknologi.com/js/scripts/charts/chart-apex.js"></script>
    <script>
        var month           = $('#month');
        var traficChart     = $('.line-area-chart-exs');
        var orderChart      = $('.order-area-chart-ex');
        var o = $(".chartjs");
        var primaryColorShade = '#836AF9',
            yellowColor = '#ffe800',
            successColorShade = '#28dac6',
            warningColorShade = '#ffe802',
            warningLightColor = '#FDAC34',
            infoColorShade = '#299AFF',
            greyColor = '#4F5D70',
            blueColor = '#2c9aff',
            blueLightColor = '#84D0FF',
            greyLightColor = '#EDF1F4',
            tooltipShadow = 'rgba(0, 0, 0, 0.25)',
            lineChartPrimary = '#666ee8',
            lineChartDanger = '#ff4961',
            labelColor = '#6e6b7b',
            grid_line_color = 'rgba(200, 200, 200, 0.2)'; // RGBA color helps in dark layout

        if (traficChart.length) {
            var barChartExample = new Chart(traficChart, {
                type: 'line',
                plugins: [
                    // to add spacing between legends and chart
                    {
                    beforeInit: function (chart) {
                        chart.legend.afterFit = function () {
                        this.height += 20;
                        };
                    }
                    }
                ],
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    backgroundColor: false,
                    hover: {
                    mode: 'label'
                    },
                    tooltips: {
                    // Updated default tooltip UI
                    shadowOffsetX: 1,
                    shadowOffsetY: 1,
                    shadowBlur: 8,
                    shadowColor: tooltipShadow,
                    backgroundColor: window.colors.solid.white,
                    titleFontColor: window.colors.solid.black,
                    bodyFontColor: window.colors.solid.black
                    },
                    layout: {
                    padding: {
                        top: -15,
                        bottom: -25,
                        left: -15
                    }
                    },
                    scales: {
                    xAxes: [
                        {
                        display: true,
                        scaleLabel: {
                            display: true
                        },
                        gridLines: {
                            display: true,
                            color: grid_line_color,
                            zeroLineColor: grid_line_color
                        },
                        ticks: {
                            fontColor: labelColor
                        }
                        }
                    ],
                    yAxes: [
                        {
                        display: true,
                        scaleLabel: {
                            display: true
                        },
                        gridLines: {
                            display: true,
                            color: grid_line_color,
                            zeroLineColor: grid_line_color
                        }
                        }
                    ]
                    },
                    legend: {
                    position: 'top',
                    align: 'start',
                    labels: {
                        usePointStyle: true,
                        padding: 25,
                        boxWidth: 9
                    }
                    }
                },
                data: {
                    labels: @json($date),
                    datasets: [
                    {
                        data: @json($pageViewCount),
                        label: 'Visitor',
                        borderColor: lineChartDanger,
                        lineTension: 0.5,
                        pointStyle: 'circle',
                        backgroundColor: lineChartDanger,
                        fill: false,
                        pointRadius: 1,
                        pointHoverRadius: 5,
                        pointHoverBorderWidth: 5,
                        pointBorderColor: 'transparent',
                        pointHoverBorderColor: window.colors.solid.white,
                        pointHoverBackgroundColor: lineChartDanger,
                        pointShadowOffsetX: 1,
                        pointShadowOffsetY: 1,
                        pointShadowBlur: 5,
                        pointShadowColor: tooltipShadow
                    },
                    {
                        data: @json($visitorCount),
                        label: 'Unique Visitor',
                        borderColor: lineChartPrimary,
                        lineTension: 0.5,
                        pointStyle: 'circle',
                        backgroundColor: lineChartPrimary,
                        fill: false,
                        pointRadius: 1,
                        pointHoverRadius: 5,
                        pointHoverBorderWidth: 5,
                        pointBorderColor: 'transparent',
                        pointHoverBorderColor: window.colors.solid.white,
                        pointHoverBackgroundColor: lineChartPrimary,
                        pointShadowOffsetX: 1,
                        pointShadowOffsetY: 1,
                        pointShadowBlur: 5,
                        pointShadowColor: tooltipShadow
                    },
                    ]
                }
            });
        }

    </script>
@endsection