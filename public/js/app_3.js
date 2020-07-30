 function mode_show() {
        var aTags = document.getElementsByTagName("h5");
        var searchText = "New message to undefined";
        var found;

        for (var i = 0; i < aTags.length; i++) {
            if (aTags[i].textContent.includes(searchText)) {
                found = aTags[i];
                aTags[i].textContent = "إدخال بيانات";
            }
        }
    }


    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
    }

   

    window.onload = function () {
        document.getElementById('massage').onkeyup = function () {
            if (this.value.length >= 69) {
                this.style.color = "red";

            }else{
                this.style.color="#000";
            }

            var massages=Math.ceil(this.value.length/69);
            var chars=(chars<69)?this.value.length:this.value.length -(69*massages) ;
            if(chars<0)
                chars=chars*-1;
            document.getElementById('count_msg').innerText = massages+"/"+chars;
        }

    }


    function pop(e) {
        event.preventDefault();
        $(this).addClass("kt-notification__item--read");
        var the_id = e.getAttribute('the_id');
        var the_href = e.getAttribute('the_href');
        console.log(the_href);
        $.get('/admin/getnotfiy/' + the_id, function (data, status) {
        });
        console.log('test');
        location.href = the_href;
    };




    $(function () {
        //$("#Confirm").modal("show");
        $(".Confirm").click(function () {
            $("#kt_modal_1").modal("show");
            $("#kt_modal_1 .btn-danger").attr("href", $(this).attr("href"));
            return false;
        });
    });


    $(document).ready(function () {


$('.table-responsive').on('show.bs.dropdown', function () {
     $('.table-responsive').css( "overflow", "inherit" );
});

$('.table-responsive').on('hide.bs.dropdown', function () {
     $('.table-responsive').css( "overflow", "auto" );
})

        $('ul.pagination').css({"margin": "auto"});

        function arabicInput(event) {
            var value = String.fromCharCode(event.which);
            var pattern = new RegExp(/^[\u0621-\u064A\u0660-\u0669\-_@& ]+$/i);
            return pattern.test(value);
        }

        function turkeyInput(event) {
            var value = String.fromCharCode(event.which);
            var pattern = new RegExp(/[a-zåäöığüşöçĞÜŞÖÇİ\-_@& ]/i);
            return pattern.test(value);
        }

        function numbersInput(event) {
            var value = String.fromCharCode(event.which);
            var pattern = new RegExp(/^\+?\d*\.?\d*$/i);
            return pattern.test(value);
        }

        $('.arabic').bind('keypress', arabicInput);
        $('.turkey').bind('keypress', turkeyInput);
        $(".numbers").bind('keypress', numbersInput);
        /*keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which < 1632 || e.which > 1641)) {
                return false;
            }
        });*/
        for(i=0;i<document.querySelectorAll('[data-toggle="dropdown"]').length;i++){
document.querySelectorAll('[data-toggle="dropdown"]')[i].click();
            document.querySelector('#kt_header_menu').click();
$(window).scrollTop(0);
}

var aTags = document.getElementsByTagName("td");
var searchText = "$";
var found;

for (var i = 0; i < aTags.length; i++) {
  if (aTags[i].textContent.includes(searchText)) {
    found = aTags[i];
    aTags[i].style.fontFamily="Aril,serif";
  }
}

var aTags = document.getElementsByTagName("th");
var searchText = "#";
var found;

for (var i = 0; i < aTags.length; i++) {
  if (aTags[i].textContent.includes(searchText)) {
    found = aTags[i];
    aTags[i].style.fontFamily="Aril,serif";
  }
}


    });
    $("form").submit(function(){
        localStorage.removeItem('ids');
    })
"use strict";

// Class definition
var KTDashboard = function() {

    // Sparkline Chart helper function
    var _initSparklineChart = function(src, data, color, border) {
        if (src.length == 0) {
            return;
        }

        var config = {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
                datasets: [{
                    label: "",
                    borderColor: color,
                    borderWidth: border,

                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 12,
                    pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('danger'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),
                    fill: false,
                    data: data,
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    enabled: false,
                    intersect: false,
                    mode: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false,
                    labels: {
                        usePointStyle: false
                    }
                },
                responsive: true,
                maintainAspectRatio: true,
                hover: {
                    mode: 'index'
                },
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },

                elements: {
                    point: {
                        radius: 4,
                        borderWidth: 12
                    },
                },

                layout: {
                    padding: {
                        left: 0,
                        right: 10,
                        top: 5,
                        bottom: 0
                    }
                }
            }
        };

        return new Chart(src, config);
    }

    // Daily Sales chart.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var dailySales = function() {
        var chartContainer = KTUtil.getByID('kt_chart_daily_sales');

        if (!chartContainer) {
            return;
        }

        var chartData = {
            labels: ["Label 1", "Label 2", "Label 3", "Label 4", "Label 5", "Label 6", "Label 7", "Label 8", "Label 9", "Label 10", "Label 11", "Label 12", "Label 13", "Label 14", "Label 15", "Label 16"],
            datasets: [{
                //label: 'Dataset 1',
                backgroundColor: KTApp.getStateColor('success'),
                data: [
                    15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
                ]
            }, {
                //label: 'Dataset 2',
                backgroundColor: '#f3f3fb',
                data: [
                    15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
                ]
            }]
        };

        var chart = new Chart(chartContainer, {
            type: 'bar',
            data: chartData,
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    intersect: false,
                    mode: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                barRadius: 4,
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        stacked: true
                    }],
                    yAxes: [{
                        display: false,
                        stacked: true,
                        gridLines: false
                    }]
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                }
            }
        });
    }

    // Profit Share Chart.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var profitShare = function() {
        if (!KTUtil.getByID('kt_chart_profit_share')) {
            return;
        }

        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
        };

        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        35, 30, 35
                    ],
                    backgroundColor: [
                        KTApp.getStateColor('success'),
                        KTApp.getStateColor('danger'),
                        KTApp.getStateColor('brand')
                    ]
                }],
                labels: [
                    'Angular',
                    'CSS',
                    'HTML'
                ]
            },
            options: {
                cutoutPercentage: 75,
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Technology'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                tooltips: {
                    enabled: true,
                    intersect: false,
                    mode: 'nearest',
                    bodySpacing: 5,
                    yPadding: 10,
                    xPadding: 10,
                    caretPadding: 0,
                    displayColors: false,
                    backgroundColor: KTApp.getStateColor('brand'),
                    titleFontColor: '#ffffff',
                    cornerRadius: 4,
                    footerSpacing: 0,
                    titleSpacing: 0
                }
            }
        };

        var ctx = KTUtil.getByID('kt_chart_profit_share').getContext('2d');
        var ctx1 = KTUtil.getByID('kt_chart_profit_share').getContext('2d');
        var myDoughnut = new Chart(ctx, config);
        var myDoughnut = new Chart(ctx1, config);
    }

    // Sales Stats.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var salesStats = function() {
        if (!KTUtil.getByID('kt_chart_sales_stats')) {
            return;
        }

        var config = {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December",
                    "January", "February", "March", "April"
                ],
                datasets: [{
                    label: "Sales Stats",
                    borderColor: KTApp.getStateColor('brand'),
                    borderWidth: 2,
                    //pointBackgroundColor: KTApp.getStateColor('brand'),
                    backgroundColor: KTApp.getStateColor('brand'),
                    pointBackgroundColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('danger'),
                    pointHoverBorderColor: Chart.helpers.color(KTApp.getStateColor('danger')).alpha(0.2).rgbString(),
                    data: [
                        10, 20, 16,
                        18, 12, 40,
                        35, 30, 33,
                        34, 45, 40,
                        60, 55, 70,
                        65, 75, 62
                    ]
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    intersect: false,
                    mode: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false,
                    labels: {
                        usePointStyle: false
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                hover: {
                    mode: 'index'
                },
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
                },

                elements: {
                    point: {
                        radius: 3,
                        borderWidth: 0,

                        hoverRadius: 8,
                        hoverBorderWidth: 2
                    }
                }
            }
        };

        var chart = new Chart(KTUtil.getByID('kt_chart_sales_stats'), config);
    }

    // Sales By KTUtillication Stats.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var salesByApps = function() {
        // Init chart instances
        _initSparklineChart($('#kt_chart_sales_by_apps_1_1'), [10, 20, -5, 8, -20, -2, -4, 15, 5, 8], KTApp.getStateColor('success'), 2);
        _initSparklineChart($('#kt_chart_sales_by_apps_1_2'), [2, 16, 0, 12, 22, 5, -10, 5, 15, 2], KTApp.getStateColor('danger'), 2);
        _initSparklineChart($('#kt_chart_sales_by_apps_1_3'), [15, 5, -10, 5, 16, 22, 6, -6, -12, 5], KTApp.getStateColor('success'), 2);
        _initSparklineChart($('#kt_chart_sales_by_apps_1_4'), [8, 18, -12, 12, 22, -2, -14, 16, 18, 2], KTApp.getStateColor('warning'), 2);

        _initSparklineChart($('#kt_chart_sales_by_apps_2_1'), [10, 20, -5, 8, -20, -2, -4, 15, 5, 8], KTApp.getStateColor('danger'), 2);
        _initSparklineChart($('#kt_chart_sales_by_apps_2_2'), [2, 16, 0, 12, 22, 5, -10, 5, 15, 2], KTApp.getStateColor('dark'), 2);
        _initSparklineChart($('#kt_chart_sales_by_apps_2_3'), [15, 5, -10, 5, 16, 22, 6, -6, -12, 5], KTApp.getStateColor('brand'), 2);
        _initSparklineChart($('#kt_chart_sales_by_apps_2_4'), [8, 18, -12, 12, 22, -2, -14, 16, 18, 2], KTApp.getStateColor('info'), 2);
    }

    // Latest Updates.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var latestUpdates = function() {
        if ($('#kt_chart_latest_updates').length == 0) {
            return;
        }

        var ctx = document.getElementById("kt_chart_latest_updates").getContext("2d");

        var config = {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
                datasets: [{
                    label: "Sales Stats",
                    backgroundColor: KTApp.getStateColor('danger'), // Put the gradient here as a fill color
                    borderColor: KTApp.getStateColor('danger'),
                    pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('success'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),

                    //fill: 'start',
                    data: [
                        10, 14, 12, 16, 9, 11, 13, 9, 13, 15
                    ]
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    intersect: false,
                    mode: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                hover: {
                    mode: 'index'
                },
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.0000001
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                }
            }
        };

        var chart = new Chart(ctx, config);
    }

    // Trends Stats.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var trendsStats = function() {
        if ($('#kt_chart_trends_stats').length == 0) {
            return;
        }

        var ctx = document.getElementById("kt_chart_trends_stats").getContext("2d");

        var gradient = ctx.createLinearGradient(0, 0, 0, 240);
        gradient.addColorStop(0, Chart.helpers.color('#00c5dc').alpha(0.7).rgbString());
        gradient.addColorStop(1, Chart.helpers.color('#f2feff').alpha(0).rgbString());

        var config = {
            type: 'line',
            data: {
                labels: [
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April"
                ],
                datasets: [{
                    label: "Sales Stats",
                    backgroundColor: gradient, // Put the gradient here as a fill color
                    borderColor: '#0dc8de',

                    pointBackgroundColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('danger'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.2).rgbString(),

                    //fill: 'start',
                    data: [
                        20, 10, 18, 15, 26, 18, 15, 22, 16, 12,
                        12, 13, 10, 18, 14, 24, 16, 12, 19, 21,
                        16, 14, 21, 21, 13, 15, 22, 24, 21, 11,
                        14, 19, 21, 17
                    ]
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    intersect: false,
                    mode: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                hover: {
                    mode: 'index'
                },
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.19
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 5,
                        bottom: 0
                    }
                }
            }
        };

        var chart = new Chart(ctx, config);
    }

    // Trends Stats 2.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var trendsStats2 = function() {
        if ($('#kt_chart_trends_stats_2').length == 0) {
            return;
        }

        var ctx = document.getElementById("kt_chart_trends_stats_2").getContext("2d");

        var config = {
            type: 'line',
            data: {
                labels: [
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April"
                ],
                datasets: [{
                    label: "Sales Stats",
                    backgroundColor: '#d2f5f9', // Put the gradient here as a fill color
                    borderColor: KTApp.getStateColor('brand'),

                    pointBackgroundColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('danger'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.2).rgbString(),

                    //fill: 'start',
                    data: [
                        20, 10, 18, 15, 32, 18, 15, 22, 8, 6,
                        12, 13, 10, 18, 14, 24, 16, 12, 19, 21,
                        16, 14, 24, 21, 13, 15, 27, 29, 21, 11,
                        14, 19, 21, 17
                    ]
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    intersect: false,
                    mode: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                hover: {
                    mode: 'index'
                },
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.19
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 5,
                        bottom: 0
                    }
                }
            }
        };

        var chart = new Chart(ctx, config);
    }

    // Trends Stats.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var latestTrendsMap = function() {
        if ($('#kt_chart_latest_trends_map').length == 0) {
            return;
        }

        try {
            var map = new GMaps({
                div: '#kt_chart_latest_trends_map',
                lat: -12.043333,
                lng: -77.028333
            });
        } catch (e) {
            console.log(e);
        }
    }

    // Revenue Change.
    // Based on Morris plugin - http://morrisjs.github.io/morris.js/
    var revenueChange = function() {
        if ($('#kt_chart_revenue_change').length == 0) {
            return;
        }

        Morris.Donut({
            element: 'kt_chart_revenue_change',
            data: [{
                    label: "New York",
                    value: 10
                },
                {
                    label: "London",
                    value: 7
                },
                {
                    label: "Paris",
                    value: 20
                }
            ],
            colors: [
                KTApp.getStateColor('success'),
                KTApp.getStateColor('danger'),
                KTApp.getStateColor('brand')
            ],
        });
    }

    // Support Tickets Chart.
    // Based on Morris plugin - http://morrisjs.github.io/morris.js/
    var supportCases = function() {
        if ($('#kt_chart_support_tickets').length == 0) {
            return;
        }

        Morris.Donut({
            element: 'kt_chart_support_tickets',
            data: [{
                    label: "Margins",
                    value: 20
                },
                {
                    label: "Profit",
                    value: 70
                },
                {
                    label: "Lost",
                    value: 10
                }
            ],
            labelColor: '#a7a7c2',
            colors: [
                KTApp.getStateColor('success'),
                KTApp.getStateColor('brand'),
                KTApp.getStateColor('danger')
            ]
            //formatter: function (x) { return x + "%"}
        });
    }

    // Support Tickets Chart.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var supportRequests = function() {
        var container = KTUtil.getByID('kt_chart_support_requests');

        if (!container) {
            return;
        }

        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
        };

        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        35, 30, 35
                    ],
                    backgroundColor: [
                        KTApp.getStateColor('success'),
                        KTApp.getStateColor('danger'),
                        KTApp.getStateColor('brand')
                    ]
                }],
                labels: [
                    'Angular',
                    'CSS',
                    'HTML'
                ]
            },
            options: {
                cutoutPercentage: 75,
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Technology'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                tooltips: {
                    enabled: true,
                    intersect: false,
                    mode: 'nearest',
                    bodySpacing: 5,
                    yPadding: 10,
                    xPadding: 10,
                    caretPadding: 0,
                    displayColors: false,
                    backgroundColor: KTApp.getStateColor('brand'),
                    titleFontColor: '#ffffff',
                    cornerRadius: 4,
                    footerSpacing: 0,
                    titleSpacing: 0
                }
            }
        };

        var ctx = container.getContext('2d');
        var myDoughnut = new Chart(ctx, config);
    }

    // Activities Charts.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var activitiesChart = function() {
        if ($('#kt_chart_activities').length == 0) {
            return;
        }

        var ctx = document.getElementById("kt_chart_activities").getContext("2d");

        var gradient = ctx.createLinearGradient(0, 0, 0, 240);
        gradient.addColorStop(0, Chart.helpers.color('#e14c86').alpha(1).rgbString());
        gradient.addColorStop(1, Chart.helpers.color('#e14c86').alpha(0.3).rgbString());

        var config = {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
                datasets: [{
                    label: "Sales Stats",
                    backgroundColor: Chart.helpers.color('#e14c86').alpha(1).rgbString(),  //gradient
                    borderColor: '#e13a58',

                    pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('light'),
                    pointHoverBorderColor: Chart.helpers.color('#ffffff').alpha(0.1).rgbString(),

                    //fill: 'start',
                    data: [
                        10, 14, 12, 16, 9, 11, 13, 9, 13, 15
                    ]
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    mode: 'nearest',
                    intersect: false,
                    position: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.0000001
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 10,
                        bottom: 0
                    }
                }
            }
        };

        var chart = new Chart(ctx, config);
    }

    // Bandwidth Charts 1.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var bandwidthChart1 = function() {
        if ($('#kt_chart_bandwidth1').length == 0) {
            return;
        }

        var ctx = document.getElementById("kt_chart_bandwidth1").getContext("2d");

        var gradient = ctx.createLinearGradient(0, 0, 0, 240);
        gradient.addColorStop(0, Chart.helpers.color('#d1f1ec').alpha(1).rgbString());
        gradient.addColorStop(1, Chart.helpers.color('#d1f1ec').alpha(0.3).rgbString());

        var config = {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
                datasets: [{
                    label: "Bandwidth Stats",
                    backgroundColor: gradient,
                    borderColor: KTApp.getStateColor('success'),

                    pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('danger'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),

                    //fill: 'start',
                    data: [
                        10, 14, 12, 16, 9, 11, 13, 9, 13, 15
                    ]
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    mode: 'nearest',
                    intersect: false,
                    position: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.0000001
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 10,
                        bottom: 0
                    }
                }
            }
        };

        var chart = new Chart(ctx, config);
    }

    // Bandwidth Charts 2.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var bandwidthChart2 = function() {
        if ($('#kt_chart_bandwidth2').length == 0) {
            return;
        }

        var ctx = document.getElementById("kt_chart_bandwidth2").getContext("2d");

        var gradient = ctx.createLinearGradient(0, 0, 0, 240);
        gradient.addColorStop(0, Chart.helpers.color('#ffefce').alpha(1).rgbString());
        gradient.addColorStop(1, Chart.helpers.color('#ffefce').alpha(0.3).rgbString());

        var config = {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
                datasets: [{
                    label: "Bandwidth Stats",
                    backgroundColor: gradient,
                    borderColor: KTApp.getStateColor('warning'),
                    pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('danger'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),

                    //fill: 'start',
                    data: [
                        10, 14, 12, 16, 9, 11, 13, 9, 13, 15
                    ]
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    mode: 'nearest',
                    intersect: false,
                    position: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.0000001
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 10,
                        bottom: 0
                    }
                }
            }
        };

        var chart = new Chart(ctx, config);
    }

    // Bandwidth Charts 2.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var adWordsStat = function() {
        if ($('#kt_chart_adwords_stats,#kt_chart_adwords_stats1').length == 0) {
            return;
        }

        var ctx = document.getElementById("kt_chart_adwords_stats").getContext("2d");
        var ctx1 = document.getElementById("kt_chart_adwords_stats1").getContext("2d");

        var gradient = ctx.createLinearGradient(0, 0, 0, 240);
        var gradient = ctx1.createLinearGradient(0, 0, 0, 240);
        gradient.addColorStop(0, Chart.helpers.color('#ffefce').alpha(1).rgbString());
        gradient.addColorStop(1, Chart.helpers.color('#ffefce').alpha(0.3).rgbString());

        var config = {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
                datasets: [{
                    label: "AdWord Clicks",
                    backgroundColor: KTApp.getStateColor('brand'),
                    borderColor: KTApp.getStateColor('brand'),

                    pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('danger'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),
                    data: [
                        12, 16, 9, 18, 13, 12, 18, 12, 15, 17
                    ]
                }, {
                    label: "AdWords Views",

                    backgroundColor: KTApp.getStateColor('success'),
                    borderColor: KTApp.getStateColor('success'),

                    pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('danger'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),
                    data: [
                        10, 14, 12, 16, 9, 11, 13, 9, 13, 15
                    ]
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    mode: 'nearest',
                    intersect: false,
                    position: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        stacked: true,
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.0000001
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 10,
                        bottom: 0
                    }
                }
            }
        };

        var chart = new Chart(ctx, config);
        var chart = new Chart(ctx1, config);
    }

    // Bandwidth Charts 2.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var financeSummary = function() {
        if ($('#kt_chart_finance_summary').length == 0) {
            return;
        }

        var ctx = document.getElementById("kt_chart_finance_summary").getContext("2d");
        var ctx1 = document.getElementById("kt_chart_finance_summary").getContext("2d");

        var config = {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
                datasets: [{
                    label: "AdWords Views",

                    backgroundColor: KTApp.getStateColor('success'),
                    borderColor: KTApp.getStateColor('success'),

                    pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('danger'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),
                    data: [
                        10, 14, 12, 16, 9, 11, 13, 9, 13, 15
                    ]
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    mode: 'nearest',
                    intersect: false,
                    position: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.0000001
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 10,
                        bottom: 0
                    }
                }
            }
        };

        var chart = new Chart(ctx, config);
        var chart = new Chart(ctx1, config);
    }

    // Order Statistics.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var orderStatistics = function() {
        var container = KTUtil.getByID('kt_chart_order_statistics');

        if (!container) {
            return;
        }

        var MONTHS = ['1 Jan', '2 Jan', '3 Jan', '4 Jan', '5 Jan', '6 Jan', '7 Jan'];

        var color = Chart.helpers.color;
        var barChartData = {
            labels: ['1 Jan', '2 Jan', '3 Jan', '4 Jan', '5 Jan', '6 Jan', '7 Jan'],
            datasets : [
				{
                    fill: true,
                    //borderWidth: 0,
                    backgroundColor: color(KTApp.getStateColor('brand')).alpha(0.6).rgbString(),
                    borderColor : color(KTApp.getStateColor('brand')).alpha(0).rgbString(),

                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 12,
                    pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('brand'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),

					data: [20, 30, 20, 40, 30, 60, 30]
				},
				{
                    fill: true,
                    //borderWidth: 0,
					backgroundColor : color(KTApp.getStateColor('brand')).alpha(0.2).rgbString(),
                    borderColor : color(KTApp.getStateColor('brand')).alpha(0).rgbString(),

                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 12,
                    pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('brand'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),

					data: [15, 40, 15, 30, 40, 30, 50]
				}
            ]
        };

        var ctx = container.getContext('2d');
        var ctx1 = container.getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: barChartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: false,
                scales: {
                    xAxes: [{
                        categoryPercentage: 0.35,
                        barPercentage: 0.70,
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Month'
                        },
                        gridLines: false,
                        ticks: {
                            display: true,
                            beginAtZero: true,
                            fontColor: KTApp.getBaseColor('shape', 3),
                            fontSize: 13,
                            padding: 10
                        }
                    }],
                    yAxes: [{
                        categoryPercentage: 0.35,
                        barPercentage: 0.70,
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Value'
                        },
                        gridLines: {
                            color: KTApp.getBaseColor('shape', 2),
                            drawBorder: false,
                            offsetGridLines: false,
                            drawTicks: false,
                            borderDash: [3, 4],
                            zeroLineWidth: 1,
                            zeroLineColor: KTApp.getBaseColor('shape', 2),
                            zeroLineBorderDash: [3, 4]
                        },
                        ticks: {
                            max: 70,
                            stepSize: 10,
                            display: true,
                            beginAtZero: true,
                            fontColor: KTApp.getBaseColor('shape', 3),
                            fontSize: 13,
                            padding: 10
                        }
                    }]
                },
                title: {
                    display: false
                },
                hover: {
                    mode: 'index'
                },
                tooltips: {
                    enabled: true,
                    intersect: false,
                    mode: 'nearest',
                    bodySpacing: 5,
                    yPadding: 10,
                    xPadding: 10,
                    caretPadding: 0,
                    displayColors: false,
                    backgroundColor: KTApp.getStateColor('brand'),
                    titleFontColor: '#ffffff',
                    cornerRadius: 4,
                    footerSpacing: 0,
                    titleSpacing: 0
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 5,
                        bottom: 5
                    }
                }
            }
        });
        var chart = new Chart(ctx1, {
            type: 'line',
            data: barChartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: false,
                scales: {
                    xAxes: [{
                        categoryPercentage: 0.35,
                        barPercentage: 0.70,
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Month'
                        },
                        gridLines: false,
                        ticks: {
                            display: true,
                            beginAtZero: true,
                            fontColor: KTApp.getBaseColor('shape', 3),
                            fontSize: 13,
                            padding: 10
                        }
                    }],
                    yAxes: [{
                        categoryPercentage: 0.35,
                        barPercentage: 0.70,
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Value'
                        },
                        gridLines: {
                            color: KTApp.getBaseColor('shape', 2),
                            drawBorder: false,
                            offsetGridLines: false,
                            drawTicks: false,
                            borderDash: [3, 4],
                            zeroLineWidth: 1,
                            zeroLineColor: KTApp.getBaseColor('shape', 2),
                            zeroLineBorderDash: [3, 4]
                        },
                        ticks: {
                            max: 70,
                            stepSize: 10,
                            display: true,
                            beginAtZero: true,
                            fontColor: KTApp.getBaseColor('shape', 3),
                            fontSize: 13,
                            padding: 10
                        }
                    }]
                },
                title: {
                    display: false
                },
                hover: {
                    mode: 'index'
                },
                tooltips: {
                    enabled: true,
                    intersect: false,
                    mode: 'nearest',
                    bodySpacing: 5,
                    yPadding: 10,
                    xPadding: 10,
                    caretPadding: 0,
                    displayColors: false,
                    backgroundColor: KTApp.getStateColor('brand'),
                    titleFontColor: '#ffffff',
                    cornerRadius: 4,
                    footerSpacing: 0,
                    titleSpacing: 0
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 5,
                        bottom: 5
                    }
                }
            }
        });
    }

    // Quick Stat Charts
    var quickStats = function() {
        _initSparklineChart($('#kt_chart_quick_stats_1'), [10, 14, 18, 11, 9, 12, 14, 17, 18, 14], KTApp.getStateColor('brand'), 3);
        _initSparklineChart($('#kt_chart_quick_stats_2'), [11, 12, 18, 13, 11, 12, 15, 13, 19, 15], KTApp.getStateColor('danger'), 3);
        _initSparklineChart($('#kt_chart_quick_stats_3'), [12, 12, 18, 11, 15, 12, 13, 16, 11, 18], KTApp.getStateColor('success'), 3);
        _initSparklineChart($('#kt_chart_quick_stats_4'), [11, 9, 13, 18, 13, 15, 14, 13, 18, 15], KTApp.getStateColor('success'), 3);
    }

    // Daterangepicker Init
    var daterangepickerInit = function() {
        if ($('#kt_dashboard_daterangepicker').length == 0) {
            return;
        }

        var picker = $('#kt_dashboard_daterangepicker');
        var start = moment();
        var end = moment();

        function cb(start, end, label) {
            var title = '';
            var range = '';

            if ((end - start) < 100 || label == 'Today') {
                title = 'Today:';
                range = start.format('MMM D');
            } else if (label == 'Yesterday') {
                title = 'Yesterday:';
                range = start.format('MMM D');
            } else {
                range = start.format('MMM D') + ' - ' + end.format('MMM D');
            }

            $('#kt_dashboard_daterangepicker_date').html(range);
            $('#kt_dashboard_daterangepicker_title').html(title);
        }

        picker.daterangepicker({
            direction: KTUtil.isRTL(),
            startDate: start,
            endDate: end,
            opens: 'left',
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end, '');
    }

    // Latest Orders
    var datatableLatestOrders = function() {
        if ($('#kt_datatable_latest_orders').length === 0) {
            return;
        }

        var dataJSONArray = [{"RecordID":1,"OrderID":"61715-075","Country":"China","ShipCountry":"CN","ShipCity":"Tieba","ShipName":"Collins, Dibbert and Hoeger","ShipAddress":"746 Pine View Junction","CompanyEmail":"nsailor0@livejournal.com","CompanyAgent":"Nixie Sailor","CompanyName":"Gleichner, Ziemann and Gutkowski","Currency":"CNY","Notes":"imperdiet nullam orci pede venenatis non sodales sed tincidunt eu felis fusce posuere felis sed lacus morbi","Department":"Outdoors","Website":"irs.gov","Latitude":35.0032213,"Longitude":102.913526,"ShipDate":"2/12/2018","PaymentDate":"2016-04-27 23:53:15","TimeZone":"Asia/Chongqing","TotalPayment":"$246154.65","Status":3,"Type":2,"Actions":null},
            {"RecordID":2,"OrderID":"63629-4697","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Cihaur","ShipName":"Prosacco-Breitenberg","ShipAddress":"01652 Fulton Trail","CompanyEmail":"egiraldez1@seattletimes.com","CompanyAgent":"Emelita Giraldez","CompanyName":"Rosenbaum-Reichel","Currency":"IDR","Notes":"adipiscing elit proin risus praesent lectus vestibulum quam sapien varius ut blandit non interdum","Department":"Toys","Website":"ameblo.jp","Latitude":-7.1221059,"Longitude":106.5701927,"ShipDate":"8/6/2017","PaymentDate":"2017-11-13 14:37:22","TimeZone":"Asia/Jakarta","TotalPayment":"$795849.41","Status":6,"Type":3,"Actions":null},
            {"RecordID":3,"OrderID":"68084-123","Country":"Argentina","ShipCountry":"AR","ShipCity":"Puerto Iguazú","ShipName":"Lebsack-Emard","ShipAddress":"2 Pine View Park","CompanyEmail":"uluckin2@state.gov","CompanyAgent":"Ula Luckin","CompanyName":"Kulas, Cassin and Batz","Currency":"ARS","Notes":"blandit ultrices enim lorem ipsum dolor sit amet consectetuer adipiscing elit proin","Department":"Electronics","Website":"pbs.org","Latitude":-25.6112339,"Longitude":-54.5515662,"ShipDate":"5/26/2016","PaymentDate":"2018-01-22 12:01:51","TimeZone":"America/Argentina/Cordoba","TotalPayment":"$830764.07","Status":1,"Type":2,"Actions":null},
            {"RecordID":4,"OrderID":"67457-428","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Talok","ShipName":"O'Conner, Lebsack and Romaguera","ShipAddress":"3050 Buell Terrace","CompanyEmail":"ecure3@trellian.com","CompanyAgent":"Evangeline Cure","CompanyName":"Pfannerstill-Treutel","Currency":"IDR","Notes":"erat curabitur gravida nisi at nibh in hac habitasse platea","Department":"Automotive","Website":"fastcompany.com","Latitude":1.05,"Longitude":118.8,"ShipDate":"7/2/2016","PaymentDate":"2017-05-26 08:31:15","TimeZone":"Asia/Jakarta","TotalPayment":"$777892.92","Status":1,"Type":3,"Actions":null},
            {"RecordID":5,"OrderID":"31722-529","Country":"Austria","ShipCountry":"AT","ShipCity":"Sankt Andrä-Höch","ShipName":"Stehr-Kunde","ShipAddress":"3038 Trailsway Junction","CompanyEmail":"tst4@msn.com","CompanyAgent":"Tierney St. Louis","CompanyName":"Dicki-Kling","Currency":"EUR","Notes":"felis fusce posuere felis sed lacus morbi sem mauris laoreet ut rhoncus aliquet pulvinar sed nisl nunc rhoncus dui","Department":"Health","Website":"jimdo.com","Latitude":46.791555,"Longitude":15.379192,"ShipDate":"5/20/2017","PaymentDate":"2016-02-17 10:53:48","TimeZone":"Europe/Vienna","TotalPayment":"$516467.41","Status":2,"Type":3,"Actions":null},
            {"RecordID":6,"OrderID":"64117-168","Country":"China","ShipCountry":"CN","ShipCity":"Rongkou","ShipName":"O'Hara LLC","ShipAddress":"023 South Way","CompanyEmail":"greinhard5@instagram.com","CompanyAgent":"Gerhard Reinhard","CompanyName":"Gleason, Kub and Marquardt","Currency":"CNY","Notes":"tempus sit amet sem fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi","Department":"Electronics","Website":"cocolog-nifty.com","Latitude":37.646108,"Longitude":120.477813,"ShipDate":"11/26/2016","PaymentDate":"2018-02-08 07:09:18","TimeZone":"Asia/Shanghai","TotalPayment":"$410062.16","Status":5,"Type":3,"Actions":null},
            {"RecordID":7,"OrderID":"43857-0331","Country":"China","ShipCountry":"CN","ShipCity":"Baiguo","ShipName":"Lebsack Group","ShipAddress":"56482 Fairfield Terrace","CompanyEmail":"eshelley6@pcworld.com","CompanyAgent":"Englebert Shelley","CompanyName":"Jenkins Inc","Currency":"CNY","Notes":"ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae duis faucibus accumsan odio curabitur convallis duis","Department":"Garden","Website":"cdc.gov","Latitude":26.006775,"Longitude":104.512603,"ShipDate":"6/28/2016","PaymentDate":"2017-10-01 05:29:08","TimeZone":"Asia/Chongqing","TotalPayment":"$210902.65","Status":2,"Type":3,"Actions":null},
            {"RecordID":8,"OrderID":"64980-196","Country":"Croatia","ShipCountry":"HR","ShipCity":"Vinica","ShipName":"Gutkowski LLC","ShipAddress":"0 Elka Street","CompanyEmail":"hkite7@epa.gov","CompanyAgent":"Hazlett Kite","CompanyName":"Streich LLC","Currency":"HRK","Notes":"fusce lacus purus aliquet at feugiat non pretium quis lectus suspendisse potenti in eleifend","Department":"Automotive","Website":"accuweather.com","Latitude":46.3395131,"Longitude":16.1537893,"ShipDate":"8/5/2016","PaymentDate":"2017-04-29 22:07:06","TimeZone":"Europe/Zagreb","TotalPayment":"$1162836.25","Status":6,"Type":1,"Actions":null},
            {"RecordID":9,"OrderID":"0404-0360","Country":"Colombia","ShipCountry":"CO","ShipCity":"San Carlos","ShipName":"Bartoletti, Howell and Jacobson","ShipAddress":"38099 Ilene Hill","CompanyEmail":"fmorby8@surveymonkey.com","CompanyAgent":"Freida Morby","CompanyName":"Haley, Schamberger and Durgan","Currency":"COP","Notes":"leo rhoncus sed vestibulum sit amet cursus id turpis integer aliquet","Department":"Garden","Website":"trellian.com","Latitude":8.797145,"Longitude":-75.698571,"ShipDate":"3/31/2017","PaymentDate":"2018-02-23 01:18:36","TimeZone":"America/Bogota","TotalPayment":"$124768.15","Status":2,"Type":1,"Actions":null},
            {"RecordID":10,"OrderID":"52125-267","Country":"Thailand","ShipCountry":"TH","ShipCity":"Maha Sarakham","ShipName":"Schroeder-Champlin","ShipAddress":"8696 Barby Pass","CompanyEmail":"ohelian9@usatoday.com","CompanyAgent":"Obed Helian","CompanyName":"Labadie, Predovic and Hammes","Currency":"THB","Notes":"elit proin interdum mauris non ligula pellentesque ultrices phasellus id sapien in","Department":"Kids","Website":"gizmodo.com","Latitude":16.1991156,"Longitude":103.2839975,"ShipDate":"1/26/2017","PaymentDate":"2016-01-17 18:58:57","TimeZone":"Asia/Bangkok","TotalPayment":"$531999.26","Status":1,"Type":3,"Actions":null},
            {"RecordID":11,"OrderID":"54092-515","Country":"Brazil","ShipCountry":"BR","ShipCity":"Canguaretama","ShipName":"Tromp-Murray","ShipAddress":"32461 Ridgeway Alley","CompanyEmail":"samya@earthlink.net","CompanyAgent":"Sibyl Amy","CompanyName":"Treutel-Ratke","Currency":"BRL","Notes":"cubilia curae nulla dapibus dolor vel est donec odio justo","Department":"Health","Website":"tamu.edu","Latitude":-6.3810573,"Longitude":-35.1301043,"ShipDate":"3/8/2017","PaymentDate":"2017-05-24 02:48:57","TimeZone":"America/Fortaleza","TotalPayment":"$942781.29","Status":4,"Type":2,"Actions":null},
            {"RecordID":12,"OrderID":"0185-0130","Country":"China","ShipCountry":"CN","ShipCity":"Jiamachi","ShipName":"Langosh Inc","ShipAddress":"23 Walton Pass","CompanyEmail":"nfoldesb@lycos.com","CompanyAgent":"Norri Foldes","CompanyName":"Strosin, Nitzsche and Wisozk","Currency":"CNY","Notes":"nunc proin at turpis a pede posuere nonummy integer non velit donec diam","Department":"Jewelery","Website":"springer.com","Latitude":29.503085,"Longitude":108.984759,"ShipDate":"4/2/2017","PaymentDate":"2016-08-05 06:19:54","TimeZone":"Asia/Chongqing","TotalPayment":"$1143125.96","Status":3,"Type":1,"Actions":null},
            {"RecordID":13,"OrderID":"21130-678","Country":"China","ShipCountry":"CN","ShipCity":"Qiaole","ShipName":"Jenkins-Haag","ShipAddress":"328 Glendale Hill","CompanyEmail":"morhtmannc@weibo.com","CompanyAgent":"Myrna Orhtmann","CompanyName":"Miller-Schiller","Currency":"CNY","Notes":"massa id lobortis convallis tortor risus dapibus augue vel accumsan","Department":"Books","Website":"washingtonpost.com","Latitude":28.643587,"Longitude":115.568583,"ShipDate":"6/7/2016","PaymentDate":"2017-02-02 05:24:00","TimeZone":"Asia/Shanghai","TotalPayment":"$159355.37","Status":3,"Type":1,"Actions":null},
            {"RecordID":14,"OrderID":"40076-953","Country":"Portugal","ShipCountry":"PT","ShipCity":"Burgau","ShipName":"Funk, Lindgren and Bradtke","ShipAddress":"52550 Crownhardt Court","CompanyEmail":"skneathd@bizjournals.com","CompanyAgent":"Sioux Kneath","CompanyName":"Rice, Cole and Spinka","Currency":"EUR","Notes":"felis donec semper sapien a libero nam dui proin leo odio porttitor id consequat in consequat ut","Department":"Books","Website":"sciencedirect.com","Latitude":37.0734616,"Longitude":-8.7751983,"ShipDate":"10/11/2017","PaymentDate":"2016-12-08 07:20:08","TimeZone":"Europe/Lisbon","TotalPayment":"$381148.49","Status":4,"Type":1,"Actions":null},
            {"RecordID":15,"OrderID":"36987-3005","Country":"Portugal","ShipCountry":"PT","ShipCity":"Bacelo","ShipName":"Wolf, Kreiger and Walker","ShipAddress":"548 Morrow Terrace","CompanyEmail":"cjacmare@google.pl","CompanyAgent":"Christa Jacmar","CompanyName":"Brakus-Hansen","Currency":"EUR","Notes":"nibh ligula nec sem duis aliquam convallis nunc proin at turpis a pede posuere nonummy integer non velit donec diam","Department":"Electronics","Website":"ifeng.com","Latitude":41.3121037,"Longitude":-8.1656088,"ShipDate":"8/17/2017","PaymentDate":"2018-05-04 00:10:14","TimeZone":"Europe/Lisbon","TotalPayment":"$839071.50","Status":1,"Type":2,"Actions":null},
            {"RecordID":16,"OrderID":"67510-0062","Country":"South Africa","ShipCountry":"ZA","ShipCity":"Pongola","ShipName":"Kutch and Sons","ShipAddress":"02534 Hauk Trail","CompanyEmail":"sgoraccif@thetimes.co.uk","CompanyAgent":"Shandee Goracci","CompanyName":"Bergnaum, Thiel and Schuppe","Currency":"ZAR","Notes":"quis justo maecenas rhoncus aliquam lacus morbi quis tortor id","Department":"Shoes","Website":"oaic.gov.au","Latitude":-33.7363181,"Longitude":25.3908518,"ShipDate":"7/24/2016","PaymentDate":"2016-12-12 08:20:58","TimeZone":"Africa/Johannesburg","TotalPayment":"$924771.59","Status":5,"Type":3,"Actions":null},
            {"RecordID":17,"OrderID":"36987-2542","Country":"Russia","ShipCountry":"RU","ShipCity":"Novokizhinginsk","ShipName":"Beatty LLC","ShipAddress":"19427 Sloan Road","CompanyEmail":"jcolvieg@mit.edu","CompanyAgent":"Jerrome Colvie","CompanyName":"Kreiger, Glover and Connelly","Currency":"RUB","Notes":"nulla eget eros elementum pellentesque quisque porta volutpat erat quisque erat eros viverra eget congue eget semper rutrum","Department":"Toys","Website":"imdb.com","Latitude":51.598999,"Longitude":109.580475,"ShipDate":"3/4/2016","PaymentDate":"2016-02-06 06:55:10","TimeZone":"Asia/Yakutsk","TotalPayment":"$708846.15","Status":3,"Type":1,"Actions":null},
            {"RecordID":18,"OrderID":"11673-479","Country":"Brazil","ShipCountry":"BR","ShipCity":"Conceição das Alagoas","ShipName":"Gleason Inc","ShipAddress":"191 Stone Corner Road","CompanyEmail":"mplenderleithh@globo.com","CompanyAgent":"Michaelina Plenderleith","CompanyName":"Legros-Gleichner","Currency":"BRL","Notes":"nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient","Department":"Grocery","Website":"netlog.com","Latitude":-19.9241693,"Longitude":-48.3811173,"ShipDate":"2/21/2018","PaymentDate":"2016-08-06 05:33:25","TimeZone":"America/Sao_Paulo","TotalPayment":"$1096683.96","Status":1,"Type":2,"Actions":null},
            {"RecordID":19,"OrderID":"47781-264","Country":"Ukraine","ShipCountry":"UA","ShipCity":"Yasinya","ShipName":"King, Thiel and Rolfson","ShipAddress":"1481 Sauthoff Place","CompanyEmail":"lluthwoodi@constantcontact.com","CompanyAgent":"Lombard Luthwood","CompanyName":"Haag LLC","Currency":"UAH","Notes":"amet nunc viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum ac tellus semper","Department":"Books","Website":"cnn.com","Latitude":48.2595628,"Longitude":24.3450737,"ShipDate":"1/21/2016","PaymentDate":"2018-05-20 02:37:25","TimeZone":"Europe/Uzhgorod","TotalPayment":"$810285.52","Status":1,"Type":2,"Actions":null},
            {"RecordID":20,"OrderID":"42291-712","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Kembang","ShipName":"Leuschke-Kihn","ShipAddress":"9029 Blackbird Point","CompanyEmail":"lchevinj@mapy.cz","CompanyAgent":"Leonora Chevin","CompanyName":"Mann LLC","Currency":"IDR","Notes":"mauris vulputate elementum nullam varius nulla facilisi cras non velit nec","Department":"Movies","Website":"purevolume.com","Latitude":-6.4712737,"Longitude":110.8171082,"ShipDate":"9/6/2017","PaymentDate":"2016-04-09 20:48:12","TimeZone":"Asia/Jakarta","TotalPayment":"$868444.96","Status":2,"Type":3,"Actions":null},
            {"RecordID":21,"OrderID":"64679-154","Country":"Mongolia","ShipCountry":"MN","ShipCity":"Sharga","ShipName":"Kiehn-Bernhard","ShipAddress":"102 Holmberg Park","CompanyEmail":"tseakesk@jigsy.com","CompanyAgent":"Tannie Seakes","CompanyName":"Blanda Group","Currency":"MNT","Notes":"molestie sed justo pellentesque viverra pede ac diam cras pellentesque volutpat dui maecenas tristique est","Department":"Kids","Website":"vimeo.com","Latitude":46.2686934,"Longitude":95.2732977,"ShipDate":"7/31/2016","PaymentDate":"2016-02-13 20:51:30","TimeZone":"Asia/Ulaanbaatar","TotalPayment":"$32940.02","Status":6,"Type":3,"Actions":null},
            {"RecordID":22,"OrderID":"49348-055","Country":"China","ShipCountry":"CN","ShipCity":"Guxi","ShipName":"Fadel Inc","ShipAddress":"45 Butterfield Street","CompanyEmail":"ywetherelll@webnode.com","CompanyAgent":"Yardley Wetherell","CompanyName":"Gerlach-Schultz","Currency":"CNY","Notes":"turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis nibh ligula nec sem duis aliquam","Department":"Shoes","Website":"baidu.com","Latitude":39.909969,"Longitude":116.459299,"ShipDate":"4/3/2017","PaymentDate":"2016-10-22 17:15:35","TimeZone":"Asia/Shanghai","TotalPayment":"$19446.54","Status":2,"Type":2,"Actions":null},
            {"RecordID":23,"OrderID":"47593-438","Country":"Portugal","ShipCountry":"PT","ShipCity":"Viso","ShipName":"Beier-Jones","ShipAddress":"97 Larry Center","CompanyEmail":"bpeascodm@devhub.com","CompanyAgent":"Bryn Peascod","CompanyName":"Larkin and Sons","Currency":"EUR","Notes":"orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus","Department":"Health","Website":"constantcontact.com","Latitude":-34.5006776,"Longitude":-58.8072561,"ShipDate":"5/22/2016","PaymentDate":"2016-09-23 21:49:11","TimeZone":"Europe/Lisbon","TotalPayment":"$324446.39","Status":6,"Type":1,"Actions":null},
            {"RecordID":24,"OrderID":"54569-0175","Country":"Japan","ShipCountry":"JP","ShipCity":"Minato","ShipName":"Bradtke Group","ShipAddress":"077 Hoffman Center","CompanyEmail":"cjeromsonn@ning.com","CompanyAgent":"Chrissie Jeromson","CompanyName":"Brakus-McCullough","Currency":"JPY","Notes":"nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo","Department":"Clothing","Website":"com.com","Latitude":35.6726588,"Longitude":139.7796498,"ShipDate":"11/26/2017","PaymentDate":"2018-02-03 15:23:53","TimeZone":"Asia/Tokyo","TotalPayment":"$425962.52","Status":2,"Type":1,"Actions":null},
            {"RecordID":25,"OrderID":"0093-1016","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Merdeka","ShipName":"Pfannerstill-Jenkins","ShipAddress":"3150 Cherokee Center","CompanyEmail":"gclampo@vistaprint.com","CompanyAgent":"Gusti Clamp","CompanyName":"Stokes Group","Currency":"IDR","Notes":"a ipsum integer a nibh in quis justo maecenas rhoncus","Department":"Grocery","Website":"nhs.uk","Latitude":-6.9136675,"Longitude":107.6200524,"ShipDate":"4/12/2018","PaymentDate":"2017-10-06 00:23:49","TimeZone":"Asia/Makassar","TotalPayment":"$158287.28","Status":6,"Type":2,"Actions":null},
            {"RecordID":26,"OrderID":"0093-5142","Country":"China","ShipCountry":"CN","ShipCity":"Jianggao","ShipName":"Romaguera-Greenholt","ShipAddress":"289 Badeau Alley","CompanyEmail":"ojobbinsp@w3.org","CompanyAgent":"Otis Jobbins","CompanyName":"Ruecker, Leffler and Abshire","Currency":"CNY","Notes":"aenean lectus pellentesque eget nunc donec quis orci eget orci vehicula condimentum curabitur in libero ut massa volutpat","Department":"Kids","Website":"mediafire.com","Latitude":23.2905,"Longitude":113.234549,"ShipDate":"3/6/2018","PaymentDate":"2016-01-01 18:08:34","TimeZone":"Asia/Chongqing","TotalPayment":"$429312.02","Status":4,"Type":2,"Actions":null},
            {"RecordID":27,"OrderID":"51523-026","Country":"Germany","ShipCountry":"DE","ShipCity":"Erfurt","ShipName":"Stanton Group","ShipAddress":"132 Chive Way","CompanyEmail":"lhaycoxq@samsung.com","CompanyAgent":"Lonnie Haycox","CompanyName":"Feest Group","Currency":"EUR","Notes":"lorem vitae mattis nibh ligula nec sem duis aliquam convallis nunc proin at turpis","Department":"Home","Website":"illinois.edu","Latitude":50.9977219,"Longitude":11.0137723,"ShipDate":"4/24/2018","PaymentDate":"2018-04-11 17:08:29","TimeZone":"Europe/Berlin","TotalPayment":"$219889.84","Status":1,"Type":3,"Actions":null},
            {"RecordID":28,"OrderID":"49035-522","Country":"Australia","ShipCountry":"AU","ShipCity":"Eastern Suburbs Mc","ShipName":"Gleichner-Lebsack","ShipAddress":"074 Algoma Drive","CompanyEmail":"hcastellir@nationalgeographic.com","CompanyAgent":"Heddi Castelli","CompanyName":"Kessler and Sons","Currency":"AUD","Notes":"arcu sed augue aliquam erat volutpat in congue etiam justo etiam pretium iaculis","Department":"Games","Website":"devhub.com","Latitude":-33.93274,"Longitude":151.188577,"ShipDate":"1/12/2017","PaymentDate":"2016-11-06 16:45:53","TimeZone":"Australia/Sydney","TotalPayment":"$149602.82","Status":5,"Type":1,"Actions":null},
            {"RecordID":29,"OrderID":"58411-198","Country":"Ethiopia","ShipCountry":"ET","ShipCity":"Kombolcha","ShipName":"Auer Group","ShipAddress":"91066 Amoth Court","CompanyEmail":"todowgaines@princeton.edu","CompanyAgent":"Tuck O'Dowgaine","CompanyName":"Simonis, Rowe and Davis","Currency":"ETB","Notes":"nullam varius nulla facilisi cras non velit nec nisi vulputate nonummy maecenas tincidunt","Department":"Shoes","Website":"wix.com","Latitude":11.0849336,"Longitude":39.7291837,"ShipDate":"5/6/2017","PaymentDate":"2017-05-06 01:25:56","TimeZone":"Africa/Addis_Ababa","TotalPayment":"$1019002.66","Status":1,"Type":1,"Actions":null},
            {"RecordID":30,"OrderID":"27495-006","Country":"Portugal","ShipCountry":"PT","ShipCity":"Arrifes","ShipName":"Von LLC","ShipAddress":"3 Fairfield Junction","CompanyEmail":"vcoshamt@simplemachines.org","CompanyAgent":"Vernon Cosham","CompanyName":"Kreiger-Nicolas","Currency":"EUR","Notes":"id ligula suspendisse ornare consequat lectus in est risus auctor sed tristique in tempus sit amet","Department":"Movies","Website":"jimdo.com","Latitude":37.760365,"Longitude":-25.7013016,"ShipDate":"2/8/2017","PaymentDate":"2017-07-22 18:32:31","TimeZone":"Africa/Accra","TotalPayment":"$179291.15","Status":4,"Type":2,"Actions":null},
            {"RecordID":31,"OrderID":"55154-8284","Country":"Philippines","ShipCountry":"PH","ShipCity":"Talisay","ShipName":"McCullough, Okuneva and Heidenreich","ShipAddress":"09 Sachtjen Junction","CompanyEmail":"bmaccrackenu@hostgator.com","CompanyAgent":"Bryna MacCracken","CompanyName":"Hyatt-Witting","Currency":"PHP","Notes":"rutrum nulla nunc purus phasellus in felis donec semper sapien a libero","Department":"Games","Website":"so-net.ne.jp","Latitude":14.5618599,"Longitude":121.0130439,"ShipDate":"7/22/2017","PaymentDate":"2017-09-03 22:56:12","TimeZone":"Asia/Manila","TotalPayment":"$26257.28","Status":2,"Type":1,"Actions":null},
            {"RecordID":32,"OrderID":"62678-207","Country":"Libya","ShipCountry":"LY","ShipCity":"Zuwārah","ShipName":"Boehm-Schaden","ShipAddress":"82 Thackeray Pass","CompanyEmail":"farnallv@vistaprint.com","CompanyAgent":"Freda Arnall","CompanyName":"Dicki, Morar and Stiedemann","Currency":"LYD","Notes":"cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam vel","Department":"Kids","Website":"vinaora.com","Latitude":32.9234588,"Longitude":12.0775411,"ShipDate":"7/22/2016","PaymentDate":"2017-02-12 23:45:54","TimeZone":"Africa/Tripoli","TotalPayment":"$249720.68","Status":3,"Type":3,"Actions":null},
            {"RecordID":33,"OrderID":"68428-725","Country":"China","ShipCountry":"CN","ShipCity":"Zhangcun","ShipName":"Ratke and Sons","ShipAddress":"3 Goodland Terrace","CompanyEmail":"pkringew@usatoday.com","CompanyAgent":"Pavel Kringe","CompanyName":"Goldner-Lehner","Currency":"CNY","Notes":"blandit lacinia erat vestibulum sed magna at nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia","Department":"Jewelery","Website":"rediff.com","Latitude":43.817071,"Longitude":125.323544,"ShipDate":"4/2/2017","PaymentDate":"2016-09-13 14:29:40","TimeZone":"Asia/Shanghai","TotalPayment":"$593538.58","Status":4,"Type":1,"Actions":null},
            {"RecordID":34,"OrderID":"0363-0724","Country":"Morocco","ShipCountry":"MA","ShipCity":"Temara","ShipName":"Hegmann, Gleason and Stehr","ShipAddress":"9550 Weeping Birch Crossing","CompanyEmail":"fnazaretx@si.edu","CompanyAgent":"Felix Nazaret","CompanyName":"Waters, Quigley and Keeling","Currency":"MAD","Notes":"amet erat nulla tempus vivamus in felis eu sapien cursus vestibulum proin eu mi nulla ac","Department":"Home","Website":"icio.us","Latitude":33.9278354,"Longitude":-6.9051819,"ShipDate":"6/4/2016","PaymentDate":"2016-06-13 16:43:18","TimeZone":"Africa/Casablanca","TotalPayment":"$285288.32","Status":5,"Type":3,"Actions":null},
            {"RecordID":35,"OrderID":"37000-102","Country":"Paraguay","ShipCountry":"PY","ShipCity":"Los Cedrales","ShipName":"Gulgowski, Wyman and Larson","ShipAddress":"1 Ridge Oak Way","CompanyEmail":"pallanbyy@discovery.com","CompanyAgent":"Penrod Allanby","CompanyName":"Rodriguez Group","Currency":"PYG","Notes":"non quam nec dui luctus rutrum nulla tellus in sagittis dui vel nisl duis ac nibh fusce lacus purus","Department":"Shoes","Website":"amazon.de","Latitude":-25.6707073,"Longitude":-54.7412036,"ShipDate":"3/5/2018","PaymentDate":"2016-04-08 12:12:36","TimeZone":"America/Argentina/Cordoba","TotalPayment":"$827488.58","Status":2,"Type":3,"Actions":null},
            {"RecordID":36,"OrderID":"55289-002","Country":"Philippines","ShipCountry":"PH","ShipCity":"Dologon","ShipName":"Prosacco-Bradtke","ShipAddress":"9 Vidon Terrace","CompanyEmail":"hpassbyz@wikimedia.org","CompanyAgent":"Hubey Passby","CompanyName":"Lemke-Hermiston","Currency":"PHP","Notes":"in hac habitasse platea dictumst maecenas ut massa quis augue luctus","Department":"Kids","Website":"ox.ac.uk","Latitude":7.7601925,"Longitude":125.0095225,"ShipDate":"6/29/2017","PaymentDate":"2017-10-04 13:26:41","TimeZone":"Asia/Manila","TotalPayment":"$293714.61","Status":2,"Type":3,"Actions":null},
            {"RecordID":37,"OrderID":"15127-874","Country":"Tanzania","ShipCountry":"TZ","ShipCity":"Nanganga","ShipName":"Kozey-Okuneva","ShipAddress":"33 Anniversary Parkway","CompanyEmail":"mrotlauf10@naver.com","CompanyAgent":"Magdaia Rotlauf","CompanyName":"Hettinger, Medhurst and Heaney","Currency":"TZS","Notes":"fermentum justo nec condimentum neque sapien placerat ante nulla justo aliquam quis turpis eget","Department":"Beauty","Website":"wikipedia.org","Latitude":-10.3931514,"Longitude":39.1361568,"ShipDate":"2/18/2018","PaymentDate":"2016-08-06 20:08:36","TimeZone":"Africa/Dar_es_Salaam","TotalPayment":"$290437.32","Status":3,"Type":1,"Actions":null},
            {"RecordID":38,"OrderID":"49349-123","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Pule","ShipName":"Kuphal Group","ShipAddress":"77292 Bonner Plaza","CompanyEmail":"alawrance11@un.org","CompanyAgent":"Alfonse Lawrance","CompanyName":"Schuppe-Harber","Currency":"IDR","Notes":"eu est congue elementum in hac habitasse platea dictumst morbi vestibulum velit id pretium iaculis diam erat fermentum justo","Department":"Grocery","Website":"washingtonpost.com","Latitude":-8.135667,"Longitude":111.5349059,"ShipDate":"4/14/2017","PaymentDate":"2016-04-22 18:11:42","TimeZone":"Asia/Jakarta","TotalPayment":"$722591.83","Status":1,"Type":3,"Actions":null},
            {"RecordID":39,"OrderID":"17089-415","Country":"Palestinian Territory","ShipCountry":"PS","ShipCity":"Za‘tarah","ShipName":"Ratke, Schoen and Mitchell","ShipAddress":"42806 Ridgeview Terrace","CompanyEmail":"kchettoe12@zdnet.com","CompanyAgent":"Kessiah Chettoe","CompanyName":"Mraz LLC","Currency":"ILS","Notes":"sit amet nulla quisque arcu libero rutrum ac lobortis vel dapibus at","Department":"Automotive","Website":"soundcloud.com","Latitude":"31.67361","Longitude":"35.25662","ShipDate":"3/4/2017","PaymentDate":"2016-06-10 04:20:27","TimeZone":"Asia/Hebron","TotalPayment":"$503984.70","Status":5,"Type":2,"Actions":null},
            {"RecordID":40,"OrderID":"51327-510","Country":"Philippines","ShipCountry":"PH","ShipCity":"Esperanza","ShipName":"Schneider-Weimann","ShipAddress":"4 Linden Court","CompanyEmail":"nfairbanks13@geocities.com","CompanyAgent":"Natka Fairbanks","CompanyName":"Mueller-Greenholt","Currency":"PHP","Notes":"faucibus orci luctus et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet","Department":"Health","Website":"is.gd","Latitude":14.7342524,"Longitude":121.0702642,"ShipDate":"6/21/2017","PaymentDate":"2016-02-21 01:30:35","TimeZone":"Asia/Manila","TotalPayment":"$89700.35","Status":3,"Type":3,"Actions":null},
            {"RecordID":41,"OrderID":"0187-2201","Country":"Brazil","ShipCountry":"BR","ShipCity":"Rio das Ostras","ShipName":"Leffler LLC","ShipAddress":"5722 Buhler Place","CompanyEmail":"spuvia14@alexa.com","CompanyAgent":"Shaw Puvia","CompanyName":"Veum LLC","Currency":"BRL","Notes":"donec diam neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices","Department":"Electronics","Website":"slate.com","Latitude":-22.4206096,"Longitude":-41.8625084,"ShipDate":"6/10/2017","PaymentDate":"2016-04-21 02:47:05","TimeZone":"America/Sao_Paulo","TotalPayment":"$340528.17","Status":3,"Type":2,"Actions":null},
            {"RecordID":42,"OrderID":"16590-890","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Krajan Gajahmati","ShipName":"Botsford-Bailey","ShipAddress":"54 Corry Street","CompanyEmail":"adingate15@furl.net","CompanyAgent":"Alden Dingate","CompanyName":"Heidenreich Inc","Currency":"IDR","Notes":"lorem quisque ut erat curabitur gravida nisi at nibh in hac habitasse platea dictumst aliquam augue quam sollicitudin vitae consectetuer","Department":"Sports","Website":"vinaora.com","Latitude":"-6.7618","Longitude":"111.046","ShipDate":"10/27/2016","PaymentDate":"2016-12-21 20:34:45","TimeZone":"Asia/Jakarta","TotalPayment":"$1018206.84","Status":5,"Type":1,"Actions":null},
            {"RecordID":43,"OrderID":"75862-001","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Pineleng","ShipName":"Yundt-Mohr","ShipAddress":"4 Messerschmidt Point","CompanyEmail":"cpeplay16@typepad.com","CompanyAgent":"Cherish Peplay","CompanyName":"McCullough-Gibson","Currency":"IDR","Notes":"molestie lorem quisque ut erat curabitur gravida nisi at nibh in hac habitasse","Department":"Baby","Website":"hp.com","Latitude":1.4162396,"Longitude":124.8072165,"ShipDate":"11/23/2017","PaymentDate":"2017-02-21 04:41:53","TimeZone":"Asia/Makassar","TotalPayment":"$808912.57","Status":2,"Type":2,"Actions":null},
            {"RecordID":44,"OrderID":"24559-091","Country":"Philippines","ShipCountry":"PH","ShipCity":"Amuñgan","ShipName":"Graham, Aufderhar and Mosciski","ShipAddress":"5470 Forest Parkway","CompanyEmail":"nswetman17@washington.edu","CompanyAgent":"Nedi Swetman","CompanyName":"Gerhold Inc","Currency":"PHP","Notes":"curabitur gravida nisi at nibh in hac habitasse platea dictumst aliquam augue","Department":"Electronics","Website":"moonfruit.com","Latitude":15.4004052,"Longitude":119.9303933,"ShipDate":"3/23/2017","PaymentDate":"2018-04-20 14:50:29","TimeZone":"Asia/Manila","TotalPayment":"$1059885.70","Status":5,"Type":1,"Actions":null},
            {"RecordID":45,"OrderID":"0007-3230","Country":"Russia","ShipCountry":"RU","ShipCity":"Bilyarsk","ShipName":"Kuhlman-Bosco","ShipAddress":"5899 Basil Place","CompanyEmail":"ablick18@pinterest.com","CompanyAgent":"Ashley Blick","CompanyName":"Cummings-Goodwin","Currency":"RUB","Notes":"porttitor id consequat in consequat ut nulla sed accumsan felis ut","Department":"Electronics","Website":"hubpages.com","Latitude":54.9794837,"Longitude":50.3850925,"ShipDate":"10/1/2016","PaymentDate":"2016-01-07 03:02:49","TimeZone":"Europe/Moscow","TotalPayment":"$902481.80","Status":4,"Type":2,"Actions":null},
            {"RecordID":46,"OrderID":"50184-1029","Country":"Peru","ShipCountry":"PE","ShipCity":"Chocope","ShipName":"Boyle Inc","ShipAddress":"65560 Daystar Center","CompanyEmail":"sharmant19@springer.com","CompanyAgent":"Saunders Harmant","CompanyName":"O'Kon-Wiegand","Currency":"PEN","Notes":"lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh in lectus pellentesque","Department":"Industrial","Website":"irs.gov","Latitude":-7.7911198,"Longitude":-79.2197376,"ShipDate":"11/7/2017","PaymentDate":"2016-06-30 20:59:52","TimeZone":"America/Lima","TotalPayment":"$43543.06","Status":3,"Type":2,"Actions":null},
            {"RecordID":47,"OrderID":"10819-6003","Country":"France","ShipCountry":"FR","ShipCity":"Rivesaltes","ShipName":"Stiedemann-Weissnat","ShipAddress":"4981 Springs Center","CompanyEmail":"mlaurencot1a@google.com","CompanyAgent":"Mellisa Laurencot","CompanyName":"Jacobs Group","Currency":"EUR","Notes":"vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae nulla dapibus dolor vel est","Department":"Movies","Website":"people.com.cn","Latitude":42.8271637,"Longitude":2.9134412,"ShipDate":"10/30/2017","PaymentDate":"2017-09-21 03:09:00","TimeZone":"Europe/Paris","TotalPayment":"$955141.22","Status":1,"Type":1,"Actions":null},
            {"RecordID":48,"OrderID":"62750-003","Country":"Mongolia","ShipCountry":"MN","ShipCity":"Jargalant","ShipName":"Corkery LLC","ShipAddress":"94 Rutledge Way","CompanyEmail":"omyderscough1b@printfriendly.com","CompanyAgent":"Orland Myderscough","CompanyName":"Gutkowski Inc","Currency":"MNT","Notes":"mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et","Department":"Tools","Website":"globo.com","Latitude":48.7277622,"Longitude":100.7724281,"ShipDate":"11/2/2016","PaymentDate":"2017-10-07 16:51:28","TimeZone":"Asia/Ulaanbaatar","TotalPayment":"$1153329.47","Status":5,"Type":3,"Actions":null},
            {"RecordID":49,"OrderID":"68647-122","Country":"Philippines","ShipCountry":"PH","ShipCity":"Cardona","ShipName":"Von and Sons","ShipAddress":"4765 Service Hill","CompanyEmail":"diglesias1c@usa.gov","CompanyAgent":"Devi Iglesias","CompanyName":"Ullrich-Dibbert","Currency":"PHP","Notes":"ac enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem","Department":"Books","Website":"youtu.be","Latitude":14.5716986,"Longitude":121.026941,"ShipDate":"7/21/2016","PaymentDate":"2016-01-27 19:47:42","TimeZone":"Asia/Manila","TotalPayment":"$709598.48","Status":1,"Type":1,"Actions":null},
            {"RecordID":50,"OrderID":"36987-3093","Country":"China","ShipCountry":"CN","ShipCity":"Jiantou","ShipName":"Gusikowski-Kunze","ShipAddress":"373 Northwestern Plaza","CompanyEmail":"btummasutti1d@google.es","CompanyAgent":"Bliss Tummasutti","CompanyName":"Legros-Cummings","Currency":"CNY","Notes":"praesent lectus vestibulum quam sapien varius ut blandit non interdum in ante vestibulum ante ipsum primis in faucibus orci","Department":"Sports","Website":"dagondesign.com","Latitude":24.052487,"Longitude":114.701871,"ShipDate":"11/27/2017","PaymentDate":"2017-10-02 09:08:03","TimeZone":"Asia/Chongqing","TotalPayment":"$504721.84","Status":5,"Type":1,"Actions":null},
            {"RecordID":51,"OrderID":"37808-467","Country":"United States","ShipCountry":"US","ShipCity":"Aurora","ShipName":"Pouros-Durgan","ShipAddress":"524 Northview Center","CompanyEmail":"mhostan1e@army.mil","CompanyAgent":"Modesty Hostan","CompanyName":"Kunde-Bernhard","Currency":"USD","Notes":"sit amet diam in magna bibendum imperdiet nullam orci pede venenatis non","Department":"Sports","Website":"economist.com","Latitude":39.6599999,"Longitude":-104.84,"ShipDate":"11/14/2017","PaymentDate":"2017-11-27 04:56:44","TimeZone":"America/Denver","TotalPayment":"$1050201.62","Status":1,"Type":3,"Actions":null},
            {"RecordID":52,"OrderID":"64679-172","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Kimaam","ShipName":"D'Amore, DuBuque and Koepp","ShipAddress":"2945 Crest Line Place","CompanyEmail":"cmickan1f@ihg.com","CompanyAgent":"Caroljean Mickan","CompanyName":"Steuber-Johnston","Currency":"IDR","Notes":"sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent blandit","Department":"Shoes","Website":"google.es","Latitude":-7.9613539,"Longitude":138.7995122,"ShipDate":"9/8/2016","PaymentDate":"2017-06-01 16:35:54","TimeZone":"Pacific/Port_Moresby","TotalPayment":"$55079.08","Status":5,"Type":3,"Actions":null},
            {"RecordID":53,"OrderID":"50633-210","Country":"China","ShipCountry":"CN","ShipCity":"Jishigang","ShipName":"Paucek, Predovic and Kuhlman","ShipAddress":"2931 Sherman Road","CompanyEmail":"tcunney1g@hibu.com","CompanyAgent":"Ted Cunney","CompanyName":"Kessler LLC","Currency":"CNY","Notes":"non mauris morbi non lectus aliquam sit amet diam in magna bibendum imperdiet nullam orci","Department":"Clothing","Website":"quantcast.com","Latitude":29.861346,"Longitude":121.448134,"ShipDate":"4/7/2016","PaymentDate":"2017-11-08 21:45:58","TimeZone":"Asia/Shanghai","TotalPayment":"$793647.86","Status":6,"Type":3,"Actions":null},
            {"RecordID":54,"OrderID":"0409-2687","Country":"Colombia","ShipCountry":"CO","ShipCity":"Sabaneta","ShipName":"Bogisich, Kohler and Kessler","ShipAddress":"462 Pepper Wood Crossing","CompanyEmail":"nenriquez1h@baidu.com","CompanyAgent":"Nicolea Enriquez","CompanyName":"Tillman-Satterfield","Currency":"COP","Notes":"nisi volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla rhoncus mauris enim","Department":"Toys","Website":"amazon.de","Latitude":6.1307505,"Longitude":-75.6033497,"ShipDate":"7/17/2017","PaymentDate":"2017-11-27 23:10:40","TimeZone":"America/Bogota","TotalPayment":"$209228.99","Status":2,"Type":2,"Actions":null},
            {"RecordID":55,"OrderID":"59800-0107","Country":"South Africa","ShipCountry":"ZA","ShipCity":"Orkney","ShipName":"Jast Inc","ShipAddress":"9411 Hauk Junction","CompanyEmail":"plamie1i@sbwire.com","CompanyAgent":"Prisca L'Amie","CompanyName":"Gerlach-Schmitt","Currency":"ZAR","Notes":"enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis nibh","Department":"Shoes","Website":"biblegateway.com","Latitude":-26.99776,"Longitude":26.67672,"ShipDate":"7/24/2017","PaymentDate":"2016-06-08 06:15:16","TimeZone":"Africa/Johannesburg","TotalPayment":"$190329.43","Status":4,"Type":2,"Actions":null},
            {"RecordID":56,"OrderID":"41163-367","Country":"Brazil","ShipCountry":"BR","ShipCity":"Jardim do Seridó","ShipName":"Mann, Johns and Kirlin","ShipAddress":"942 Marquette Trail","CompanyEmail":"mchazelle1j@weather.com","CompanyAgent":"Mavis Chazelle","CompanyName":"Rodriguez, Berge and Rempel","Currency":"BRL","Notes":"luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien","Department":"Computers","Website":"sitemeter.com","Latitude":-6.5843262,"Longitude":-36.7731681,"ShipDate":"2/6/2017","PaymentDate":"2017-01-26 11:16:40","TimeZone":"America/Fortaleza","TotalPayment":"$781154.52","Status":1,"Type":2,"Actions":null},
            {"RecordID":57,"OrderID":"42291-236","Country":"Eritrea","ShipCountry":"ER","ShipCity":"Massawa","ShipName":"Kris-Wiegand","ShipAddress":"2 Artisan Place","CompanyEmail":"ncelier1k@bluehost.com","CompanyAgent":"Nikki Celier","CompanyName":"Kuphal Inc","Currency":"ERN","Notes":"curae nulla dapibus dolor vel est donec odio justo sollicitudin ut suscipit a feugiat et eros vestibulum","Department":"Garden","Website":"spotify.com","Latitude":15.607875,"Longitude":39.4553839,"ShipDate":"12/12/2016","PaymentDate":"2016-02-03 09:28:11","TimeZone":"Africa/Asmara","TotalPayment":"$1149458.13","Status":5,"Type":2,"Actions":null},
            {"RecordID":58,"OrderID":"63029-455","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Kotabaru","ShipName":"Zulauf-Jakubowski","ShipAddress":"91 Hanover Alley","CompanyEmail":"dtremoille1l@goo.ne.jp","CompanyAgent":"Dennison Tremoille","CompanyName":"Hermiston LLC","Currency":"IDR","Notes":"a suscipit nulla elit ac nulla sed vel enim sit amet nunc viverra","Department":"Kids","Website":"google.nl","Latitude":-3.0029841,"Longitude":115.9467997,"ShipDate":"11/28/2016","PaymentDate":"2016-08-10 15:18:56","TimeZone":"Asia/Makassar","TotalPayment":"$285980.44","Status":2,"Type":1,"Actions":null},
            {"RecordID":59,"OrderID":"68084-505","Country":"Poland","ShipCountry":"PL","ShipCity":"Łukowa","ShipName":"Harber-Kilback","ShipAddress":"633 Shasta Point","CompanyEmail":"tbelli1m@a8.net","CompanyAgent":"Tamar Belli","CompanyName":"McGlynn, Schuster and Streich","Currency":"PLN","Notes":"sapien dignissim vestibulum vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae nulla dapibus","Department":"Electronics","Website":"state.tx.us","Latitude":50.4011293,"Longitude":22.904714,"ShipDate":"2/15/2017","PaymentDate":"2017-07-11 08:24:34","TimeZone":"Europe/Warsaw","TotalPayment":"$381565.45","Status":2,"Type":2,"Actions":null},
            {"RecordID":60,"OrderID":"76394-3812","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Karangpari","ShipName":"Greenfelder-Skiles","ShipAddress":"49 Monica Pass","CompanyEmail":"erosier1n@about.me","CompanyAgent":"Edy Rosier","CompanyName":"Spencer LLC","Currency":"IDR","Notes":"ultrices phasellus id sapien in sapien iaculis congue vivamus metus arcu adipiscing molestie hendrerit at vulputate vitae nisl aenean","Department":"Electronics","Website":"feedburner.com","Latitude":-7.2489098,"Longitude":108.48102,"ShipDate":"4/2/2016","PaymentDate":"2016-05-01 12:43:08","TimeZone":"Asia/Jakarta","TotalPayment":"$565829.97","Status":3,"Type":1,"Actions":null},
            {"RecordID":61,"OrderID":"62011-0239","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Aegela","ShipName":"Oberbrunner-Wisozk","ShipAddress":"3 Thackeray Street","CompanyEmail":"jde1o@intel.com","CompanyAgent":"Jonathon De Witt","CompanyName":"Kovacek-Breitenberg","Currency":"IDR","Notes":"vitae nisl aenean lectus pellentesque eget nunc donec quis orci eget orci vehicula condimentum curabitur","Department":"Health","Website":"skyrock.com","Latitude":-6.2568393,"Longitude":106.855853,"ShipDate":"3/28/2018","PaymentDate":"2016-12-28 06:44:39","TimeZone":"Asia/Makassar","TotalPayment":"$1047127.54","Status":5,"Type":2,"Actions":null},
            {"RecordID":62,"OrderID":"52686-331","Country":"Portugal","ShipCountry":"PT","ShipCity":"Azurva","ShipName":"Halvorson Group","ShipAddress":"2006 Kedzie Trail","CompanyEmail":"bbahl1p@tamu.edu","CompanyAgent":"Brietta Bahl","CompanyName":"Hyatt, Johns and Murphy","Currency":"EUR","Notes":"phasellus sit amet erat nulla tempus vivamus in felis eu sapien","Department":"Clothing","Website":"yellowbook.com","Latitude":40.6390928,"Longitude":-8.5992965,"ShipDate":"6/29/2017","PaymentDate":"2017-01-19 10:55:35","TimeZone":"Europe/Lisbon","TotalPayment":"$931885.06","Status":5,"Type":3,"Actions":null},
            {"RecordID":63,"OrderID":"67457-303","Country":"Sweden","ShipCountry":"SE","ShipCity":"Värnamo","ShipName":"Kemmer-Luettgen","ShipAddress":"3580 Utah Street","CompanyEmail":"jstather1q@shutterfly.com","CompanyAgent":"Joete Stather","CompanyName":"Hane Group","Currency":"SEK","Notes":"etiam faucibus cursus urna ut tellus nulla ut erat id","Department":"Games","Website":"google.fr","Latitude":57.1734042,"Longitude":14.0299287,"ShipDate":"7/18/2017","PaymentDate":"2016-06-21 14:46:57","TimeZone":"Europe/Stockholm","TotalPayment":"$571015.84","Status":3,"Type":3,"Actions":null},
            {"RecordID":64,"OrderID":"76439-104","Country":"Poland","ShipCountry":"PL","ShipCity":"Ostaszewo","ShipName":"Turcotte, Runte and Smitham","ShipAddress":"2 2nd Crossing","CompanyEmail":"adartnall1r@homestead.com","CompanyAgent":"Alaster Dartnall","CompanyName":"Botsford Inc","Currency":"PLN","Notes":"nunc rhoncus dui vel sem sed sagittis nam congue risus semper porta volutpat","Department":"Beauty","Website":"sitemeter.com","Latitude":54.2207765,"Longitude":18.9709477,"ShipDate":"7/8/2016","PaymentDate":"2016-11-28 06:49:43","TimeZone":"Europe/Warsaw","TotalPayment":"$240722.57","Status":4,"Type":2,"Actions":null},
            {"RecordID":65,"OrderID":"57520-0268","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Wirodayan","ShipName":"Ondricka and Sons","ShipAddress":"522 Glacier Hill Drive","CompanyEmail":"lcubin1s@hp.com","CompanyAgent":"Luci Cubin","CompanyName":"Kshlerin Group","Currency":"IDR","Notes":"curabitur convallis duis consequat dui nec nisi volutpat eleifend donec ut dolor morbi","Department":"Automotive","Website":"csmonitor.com","Latitude":"-8.2133","Longitude":"114.3701","ShipDate":"5/20/2016","PaymentDate":"2017-11-05 18:47:26","TimeZone":"Asia/Makassar","TotalPayment":"$335708.77","Status":4,"Type":3,"Actions":null},
            {"RecordID":66,"OrderID":"11673-873","Country":"Philippines","ShipCountry":"PH","ShipCity":"Guinsang-an","ShipName":"Bergnaum, Erdman and Kreiger","ShipAddress":"608 Anthes Court","CompanyEmail":"fhame1t@tinyurl.com","CompanyAgent":"Florian Hame","CompanyName":"Waelchi, Emmerich and Mann","Currency":"PHP","Notes":"sapien cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam vel augue vestibulum rutrum rutrum","Department":"Electronics","Website":"dailymotion.com","Latitude":6.4791846,"Longitude":124.6644348,"ShipDate":"2/2/2017","PaymentDate":"2018-01-08 10:16:06","TimeZone":"Asia/Manila","TotalPayment":"$262431.14","Status":1,"Type":1,"Actions":null},
            {"RecordID":67,"OrderID":"0378-2537","Country":"China","ShipCountry":"CN","ShipCity":"Xinpo","ShipName":"Stanton LLC","ShipAddress":"875 Coleman Street","CompanyEmail":"cjordin1u@1688.com","CompanyAgent":"Consalve Jordin","CompanyName":"Crona Group","Currency":"CNY","Notes":"suscipit nulla elit ac nulla sed vel enim sit amet nunc","Department":"Garden","Website":"icio.us","Latitude":29.536212,"Longitude":104.189955,"ShipDate":"4/25/2017","PaymentDate":"2017-07-09 07:22:31","TimeZone":"Asia/Chongqing","TotalPayment":"$811111.63","Status":6,"Type":2,"Actions":null},
            {"RecordID":68,"OrderID":"68745-2016","Country":"China","ShipCountry":"CN","ShipCity":"Shahe","ShipName":"Lebsack Inc","ShipAddress":"3 Sutherland Drive","CompanyEmail":"ccheetham1v@fc2.com","CompanyAgent":"Carmencita Cheetham","CompanyName":"Kreiger, Donnelly and Doyle","Currency":"CNY","Notes":"nulla suscipit ligula in lacus curabitur at ipsum ac tellus semper interdum mauris ullamcorper purus sit","Department":"Tools","Website":"shutterfly.com","Latitude":36.854929,"Longitude":114.503339,"ShipDate":"11/11/2017","PaymentDate":"2018-05-30 10:59:21","TimeZone":"Asia/Chongqing","TotalPayment":"$341571.37","Status":1,"Type":1,"Actions":null},
            {"RecordID":69,"OrderID":"30142-341","Country":"France","ShipCountry":"FR","ShipCity":"Moulins","ShipName":"Hauck-Yundt","ShipAddress":"54 Hoffman Trail","CompanyEmail":"hstatton1w@about.me","CompanyAgent":"Helaina Statton","CompanyName":"Schneider, Ullrich and Schmitt","Currency":"EUR","Notes":"in hac habitasse platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat","Department":"Jewelery","Website":"psu.edu","Latitude":43.6164958,"Longitude":3.8308136,"ShipDate":"1/9/2018","PaymentDate":"2016-06-15 20:55:14","TimeZone":"Europe/Paris","TotalPayment":"$870418.71","Status":5,"Type":3,"Actions":null},
            {"RecordID":70,"OrderID":"65121-001","Country":"Philippines","ShipCountry":"PH","ShipCity":"Tarragona","ShipName":"Abernathy, O'Conner and Toy","ShipAddress":"44 South Avenue","CompanyEmail":"olambal1x@hc360.com","CompanyAgent":"Olia Lambal","CompanyName":"Hills, Hyatt and Weber","Currency":"PHP","Notes":"blandit ultrices enim lorem ipsum dolor sit amet consectetuer adipiscing elit proin interdum mauris","Department":"Games","Website":"odnoklassniki.ru","Latitude":7.0389957,"Longitude":126.4497814,"ShipDate":"6/14/2017","PaymentDate":"2017-05-31 02:05:39","TimeZone":"Asia/Manila","TotalPayment":"$599553.31","Status":5,"Type":2,"Actions":null},
            {"RecordID":71,"OrderID":"37000-613","Country":"Tanzania","ShipCountry":"TZ","ShipCity":"Kabanga","ShipName":"Reynolds, Rosenbaum and Donnelly","ShipAddress":"13 Lindbergh Alley","CompanyEmail":"kkeele1y@google.com.hk","CompanyAgent":"Kippy Keele","CompanyName":"Stark, Nader and Dare","Currency":"TZS","Notes":"ultrices enim lorem ipsum dolor sit amet consectetuer adipiscing elit proin interdum mauris","Department":"Electronics","Website":"netlog.com","Latitude":-2.6382189,"Longitude":30.4674459,"ShipDate":"9/11/2017","PaymentDate":"2017-08-17 19:31:33","TimeZone":"Africa/Dar_es_Salaam","TotalPayment":"$568939.41","Status":3,"Type":2,"Actions":null},
            {"RecordID":72,"OrderID":"54868-2390","Country":"Colombia","ShipCountry":"CO","ShipCity":"Montenegro","ShipName":"Windler Group","ShipAddress":"33570 1st Place","CompanyEmail":"jpunchard1z@biglobe.ne.jp","CompanyAgent":"Justin Punchard","CompanyName":"Bartoletti LLC","Currency":"COP","Notes":"vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae duis faucibus accumsan odio curabitur convallis duis","Department":"Clothing","Website":"comsenz.com","Latitude":4.566637,"Longitude":-75.75012,"ShipDate":"4/30/2016","PaymentDate":"2017-05-30 09:39:06","TimeZone":"America/Bogota","TotalPayment":"$240016.26","Status":3,"Type":3,"Actions":null},
            {"RecordID":73,"OrderID":"25225-014","Country":"Portugal","ShipCountry":"PT","ShipCity":"Recarei","ShipName":"Daniel-Gutkowski","ShipAddress":"46 Ludington Plaza","CompanyEmail":"mprendiville20@sciencedirect.com","CompanyAgent":"Madalena Prendiville","CompanyName":"Kunde, Ratke and Von","Currency":"EUR","Notes":"odio curabitur convallis duis consequat dui nec nisi volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla","Department":"Tools","Website":"newyorker.com","Latitude":41.1572852,"Longitude":-8.434873,"ShipDate":"5/21/2017","PaymentDate":"2016-01-18 05:02:24","TimeZone":"Europe/Lisbon","TotalPayment":"$565335.30","Status":5,"Type":2,"Actions":null},
            {"RecordID":74,"OrderID":"57344-123","Country":"Greece","ShipCountry":"GR","ShipCity":"Kérkyra","ShipName":"Daniel-Schaden","ShipAddress":"549 Acker Alley","CompanyEmail":"zwalework21@hud.gov","CompanyAgent":"Zita Walework","CompanyName":"Von, Stanton and Zieme","Currency":"EUR","Notes":"lobortis convallis tortor risus dapibus augue vel accumsan tellus nisi eu orci mauris lacinia sapien quis","Department":"Games","Website":"japanpost.jp","Latitude":39.6242621,"Longitude":19.9216777,"ShipDate":"2/18/2018","PaymentDate":"2017-05-27 06:45:19","TimeZone":"Europe/Athens","TotalPayment":"$568880.03","Status":3,"Type":3,"Actions":null},
            {"RecordID":75,"OrderID":"57955-5851","Country":"France","ShipCountry":"FR","ShipCity":"Maisons-Alfort","ShipName":"McClure, Stoltenberg and Schuster","ShipAddress":"8 Bluejay Drive","CompanyEmail":"cwisedale22@skype.com","CompanyAgent":"Chick Wisedale","CompanyName":"Jacobson-Yundt","Currency":"EUR","Notes":"pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla","Department":"Music","Website":"theatlantic.com","Latitude":48.8039832,"Longitude":2.4347009,"ShipDate":"8/12/2017","PaymentDate":"2016-09-11 12:10:25","TimeZone":"Europe/Paris","TotalPayment":"$995039.87","Status":2,"Type":1,"Actions":null},
            {"RecordID":76,"OrderID":"0781-1345","Country":"East Timor","ShipCountry":"TL","ShipCity":"Maliana","ShipName":"Swaniawski, Carter and Hirthe","ShipAddress":"45504 Canary Plaza","CompanyEmail":"efeldman23@mapy.cz","CompanyAgent":"Eleni Feldman","CompanyName":"Osinski LLC","Currency":"USD","Notes":"mattis pulvinar nulla pede ullamcorper augue a suscipit nulla elit ac nulla sed vel enim sit","Department":"Tools","Website":"wikimedia.org","Latitude":-8.9837384,"Longitude":125.2203419,"ShipDate":"3/15/2016","PaymentDate":"2016-08-04 13:29:49","TimeZone":"Asia/Makassar","TotalPayment":"$604222.07","Status":2,"Type":2,"Actions":null},
            {"RecordID":77,"OrderID":"67877-159","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Tolomango","ShipName":"Prohaska, Mosciski and Berge","ShipAddress":"52 Onsgard Street","CompanyEmail":"salonso24@google.de","CompanyAgent":"Shalom Alonso","CompanyName":"Maggio Inc","Currency":"IDR","Notes":"a pede posuere nonummy integer non velit donec diam neque","Department":"Tools","Website":"macromedia.com","Latitude":"-8.5052","Longitude":"118.6133","ShipDate":"10/23/2017","PaymentDate":"2016-06-17 17:51:39","TimeZone":"Asia/Makassar","TotalPayment":"$539307.17","Status":5,"Type":2,"Actions":null},
            {"RecordID":78,"OrderID":"64536-5471","Country":"Brazil","ShipCountry":"BR","ShipCity":"Jaboticabal","ShipName":"Schuppe, Botsford and Hahn","ShipAddress":"599 Hagan Road","CompanyEmail":"tbaskett25@surveymonkey.com","CompanyAgent":"Tammy Baskett","CompanyName":"Ward LLC","Currency":"BRL","Notes":"primis in faucibus orci luctus et ultrices posuere cubilia curae","Department":"Grocery","Website":"dot.gov","Latitude":-21.2525138,"Longitude":-48.3256762,"ShipDate":"6/19/2016","PaymentDate":"2016-09-24 07:36:56","TimeZone":"America/Sao_Paulo","TotalPayment":"$901657.14","Status":4,"Type":1,"Actions":null},
            {"RecordID":79,"OrderID":"0093-7172","Country":"Philippines","ShipCountry":"PH","ShipCity":"Tapas","ShipName":"Kris LLC","ShipAddress":"89 Brickson Park Way","CompanyEmail":"ggeindre26@privacy.gov.au","CompanyAgent":"Gillie Geindre","CompanyName":"Schroeder LLC","Currency":"PHP","Notes":"aliquam non mauris morbi non lectus aliquam sit amet diam in magna bibendum","Department":"Automotive","Website":"phoca.cz","Latitude":10.305562,"Longitude":123.897862,"ShipDate":"1/31/2017","PaymentDate":"2017-05-11 00:44:08","TimeZone":"Asia/Manila","TotalPayment":"$1116807.51","Status":2,"Type":2,"Actions":null},
            {"RecordID":80,"OrderID":"76159-001","Country":"Poland","ShipCountry":"PL","ShipCity":"Osiedle-Nowiny","ShipName":"O'Kon Inc","ShipAddress":"608 Shopko Parkway","CompanyEmail":"eaxell27@weather.com","CompanyAgent":"Enoch Axell","CompanyName":"Friesen-Beahan","Currency":"PLN","Notes":"posuere metus vitae ipsum aliquam non mauris morbi non lectus aliquam sit amet","Department":"Music","Website":"instagram.com","Latitude":50.6992259,"Longitude":21.896691,"ShipDate":"4/15/2017","PaymentDate":"2017-10-24 06:43:00","TimeZone":"Europe/Warsaw","TotalPayment":"$226029.57","Status":3,"Type":2,"Actions":null},
            {"RecordID":81,"OrderID":"67596-001","Country":"Belarus","ShipCountry":"BY","ShipCity":"Horad Rechytsa","ShipName":"Strosin-Kozey","ShipAddress":"15 Towne Way","CompanyEmail":"bscorey28@shinystat.com","CompanyAgent":"Byrle Scorey","CompanyName":"Cassin, Renner and Jerde","Currency":"BYR","Notes":"quam a odio in hac habitasse platea dictumst maecenas ut massa quis augue luctus","Department":"Clothing","Website":"who.int","Latitude":"52.36389","Longitude":"30.39472","ShipDate":"12/30/2016","PaymentDate":"2016-02-13 13:10:13","TimeZone":"Europe/Minsk","TotalPayment":"$1091673.47","Status":1,"Type":3,"Actions":null},
            {"RecordID":82,"OrderID":"51346-214","Country":"Russia","ShipCountry":"RU","ShipCity":"Temyasovo","ShipName":"Cummerata Group","ShipAddress":"19379 Dwight Alley","CompanyEmail":"cashlin29@loc.gov","CompanyAgent":"Cecilia Ashlin","CompanyName":"Hackett LLC","Currency":"RUB","Notes":"nulla mollis molestie lorem quisque ut erat curabitur gravida nisi at nibh in hac habitasse platea","Department":"Books","Website":"sogou.com","Latitude":52.9850842,"Longitude":58.1242712,"ShipDate":"5/15/2017","PaymentDate":"2016-08-30 04:15:29","TimeZone":"Asia/Yekaterinburg","TotalPayment":"$104888.90","Status":2,"Type":1,"Actions":null},
            {"RecordID":83,"OrderID":"58232-0030","Country":"Armenia","ShipCountry":"AM","ShipCity":"Norashen","ShipName":"Wisoky, Willms and Romaguera","ShipAddress":"7 Northridge Pass","CompanyEmail":"hcouronne2a@yelp.com","CompanyAgent":"Hyacinthe Couronne","CompanyName":"Mertz-Kessler","Currency":"AMD","Notes":"elementum pellentesque quisque porta volutpat erat quisque erat eros viverra eget congue eget","Department":"Health","Website":"wordpress.org","Latitude":40.6573682,"Longitude":44.0769342,"ShipDate":"10/30/2016","PaymentDate":"2017-05-29 02:13:31","TimeZone":"Asia/Yerevan","TotalPayment":"$235345.18","Status":2,"Type":1,"Actions":null},
            {"RecordID":84,"OrderID":"57525-016","Country":"Greece","ShipCountry":"GR","ShipCity":"Íos","ShipName":"Emmerich Group","ShipAddress":"1 Northport Drive","CompanyEmail":"adomerque2b@twitpic.com","CompanyAgent":"Aveline Domerque","CompanyName":"Wyman, Mayert and Weimann","Currency":"EUR","Notes":"erat nulla tempus vivamus in felis eu sapien cursus vestibulum proin eu","Department":"Home","Website":"businesswire.com","Latitude":36.7225782,"Longitude":25.2825598,"ShipDate":"4/30/2017","PaymentDate":"2016-10-09 08:13:07","TimeZone":"Europe/Athens","TotalPayment":"$347681.65","Status":5,"Type":3,"Actions":null},
            {"RecordID":85,"OrderID":"55670-122","Country":"Panama","ShipCountry":"PA","ShipCity":"Aguadulce","ShipName":"Quitzon LLC","ShipAddress":"3335 Fieldstone Place","CompanyEmail":"ldinnington2c@nymag.com","CompanyAgent":"Lynnett Dinnington","CompanyName":"Mitchell Group","Currency":"PAB","Notes":"amet nunc viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum ac tellus semper","Department":"Books","Website":"nyu.edu","Latitude":8.2301756,"Longitude":-80.5549561,"ShipDate":"2/13/2017","PaymentDate":"2016-05-30 20:02:05","TimeZone":"America/Panama","TotalPayment":"$731590.06","Status":6,"Type":1,"Actions":null},
            {"RecordID":86,"OrderID":"64578-0062","Country":"Mexico","ShipCountry":"MX","ShipCity":"San Isidro","ShipName":"Buckridge, Ondricka and Kautzer","ShipAddress":"81 Judy Park","CompanyEmail":"jandrez2d@yandex.ru","CompanyAgent":"Josephine Andrez","CompanyName":"Hagenes, Ledner and Marks","Currency":"MXN","Notes":"nulla elit ac nulla sed vel enim sit amet nunc","Department":"Clothing","Website":"discovery.com","Latitude":19.482042,"Longitude":-99.1985584,"ShipDate":"9/8/2017","PaymentDate":"2018-01-16 02:58:59","TimeZone":"America/Mexico_City","TotalPayment":"$669313.23","Status":6,"Type":1,"Actions":null},
            {"RecordID":87,"OrderID":"68382-178","Country":"Sweden","ShipCountry":"SE","ShipCity":"Lidingö","ShipName":"Toy, Goldner and Hodkiewicz","ShipAddress":"47844 Fulton Junction","CompanyEmail":"kstones2e@godaddy.com","CompanyAgent":"Kala Stones","CompanyName":"Hermiston-Abshire","Currency":"SEK","Notes":"ut nunc vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae mauris viverra diam vitae","Department":"Baby","Website":"google.co.uk","Latitude":59.3536649,"Longitude":18.1354296,"ShipDate":"1/30/2018","PaymentDate":"2016-11-11 09:52:23","TimeZone":"Europe/Stockholm","TotalPayment":"$846505.08","Status":2,"Type":1,"Actions":null},
            {"RecordID":88,"OrderID":"0007-4142","Country":"Haiti","ShipCountry":"HT","ShipCity":"Chantal","ShipName":"Gutmann, Kessler and Jast","ShipAddress":"1142 Alpine Pass","CompanyEmail":"hsisley2f@twitpic.com","CompanyAgent":"Hubie Sisley","CompanyName":"Koch, Wiza and MacGyver","Currency":"HTG","Notes":"habitasse platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat id mauris vulputate","Department":"Outdoors","Website":"mozilla.com","Latitude":18.2028605,"Longitude":-73.8874799,"ShipDate":"11/28/2017","PaymentDate":"2017-07-15 00:12:08","TimeZone":"America/Port-au-Prince","TotalPayment":"$664270.87","Status":5,"Type":2,"Actions":null},
            {"RecordID":89,"OrderID":"68745-2021","Country":"China","ShipCountry":"CN","ShipCity":"Anhai","ShipName":"Keebler Group","ShipAddress":"640 Bowman Park","CompanyEmail":"jprobey2g@theglobeandmail.com","CompanyAgent":"Joice Probey","CompanyName":"Swaniawski-Tromp","Currency":"CNY","Notes":"metus sapien ut nunc vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere","Department":"Games","Website":"xinhuanet.com","Latitude":24.716803,"Longitude":118.476341,"ShipDate":"2/3/2016","PaymentDate":"2016-07-03 06:04:39","TimeZone":"Asia/Shanghai","TotalPayment":"$797898.31","Status":4,"Type":2,"Actions":null},
            {"RecordID":90,"OrderID":"59779-330","Country":"Cuba","ShipCountry":"CU","ShipCity":"Centro Habana","ShipName":"Corwin LLC","ShipAddress":"152 Sycamore Circle","CompanyEmail":"imcaster2h@pagesperso-orange.fr","CompanyAgent":"Issi McAster","CompanyName":"Price, McGlynn and Reichert","Currency":"CUP","Notes":"proin eu mi nulla ac enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis","Department":"Health","Website":"sfgate.com","Latitude":23.1351485,"Longitude":-82.3695988,"ShipDate":"9/15/2017","PaymentDate":"2016-10-01 09:29:09","TimeZone":"America/Havana","TotalPayment":"$926354.07","Status":6,"Type":3,"Actions":null},
            {"RecordID":91,"OrderID":"33261-070","Country":"China","ShipCountry":"CN","ShipCity":"Chongwen","ShipName":"Harvey LLC","ShipAddress":"16 Dwight Street","CompanyEmail":"chaig2i@google.com.hk","CompanyAgent":"Codee Haig","CompanyName":"Prosacco, Cruickshank and Stoltenberg","Currency":"CNY","Notes":"amet cursus id turpis integer aliquet massa id lobortis convallis tortor","Department":"Clothing","Website":"abc.net.au","Latitude":39.896949,"Longitude":116.414961,"ShipDate":"8/30/2016","PaymentDate":"2017-09-28 23:07:28","TimeZone":"Asia/Chongqing","TotalPayment":"$147373.41","Status":5,"Type":1,"Actions":null},
            {"RecordID":92,"OrderID":"0409-1894","Country":"France","ShipCountry":"FR","ShipCity":"Saint-Priest-en-Jarez","ShipName":"Block-Schulist","ShipAddress":"7 Banding Plaza","CompanyEmail":"bdawid2j@devhub.com","CompanyAgent":"Bil Dawid","CompanyName":"Herman, Halvorson and Champlin","Currency":"EUR","Notes":"semper est quam pharetra magna ac consequat metus sapien ut","Department":"Industrial","Website":"qq.com","Latitude":45.4726625,"Longitude":4.3812793,"ShipDate":"6/23/2017","PaymentDate":"2016-02-16 11:43:11","TimeZone":"Europe/Paris","TotalPayment":"$728288.10","Status":3,"Type":3,"Actions":null},
            {"RecordID":93,"OrderID":"37000-761","Country":"South Africa","ShipCountry":"ZA","ShipCity":"Botshabelo","ShipName":"Kris, Zulauf and Gleichner","ShipAddress":"97484 Bellgrove Lane","CompanyEmail":"aluxford2k@sakura.ne.jp","CompanyAgent":"Aigneis Luxford","CompanyName":"Labadie Inc","Currency":"ZAR","Notes":"eros suspendisse accumsan tortor quis turpis sed ante vivamus tortor duis mattis","Department":"Computers","Website":"apple.com","Latitude":-25.692754,"Longitude":29.4306557,"ShipDate":"6/24/2016","PaymentDate":"2017-09-04 14:13:56","TimeZone":"Africa/Johannesburg","TotalPayment":"$187742.69","Status":1,"Type":3,"Actions":null},
            {"RecordID":94,"OrderID":"41250-498","Country":"Ukraine","ShipCountry":"UA","ShipCity":"Merefa","ShipName":"Brown-Gutkowski","ShipAddress":"04 Lukken Court","CompanyEmail":"chandrek2l@mayoclinic.com","CompanyAgent":"Courtney Handrek","CompanyName":"Runte-Bogan","Currency":"UAH","Notes":"justo pellentesque viverra pede ac diam cras pellentesque volutpat dui maecenas tristique","Department":"Health","Website":"boston.com","Latitude":49.8060262,"Longitude":36.0503448,"ShipDate":"5/11/2018","PaymentDate":"2017-05-25 04:29:20","TimeZone":"Europe/Zaporozhye","TotalPayment":"$761394.48","Status":5,"Type":2,"Actions":null},
            {"RecordID":95,"OrderID":"54973-2909","Country":"Czech Republic","ShipCountry":"CZ","ShipCity":"Brloh","ShipName":"Oberbrunner, Anderson and Steuber","ShipAddress":"16 Becker Road","CompanyEmail":"gmartel2m@networksolutions.com","CompanyAgent":"Geraldine Martel","CompanyName":"Franecki and Sons","Currency":"CZK","Notes":"posuere metus vitae ipsum aliquam non mauris morbi non lectus aliquam sit amet diam in magna bibendum imperdiet","Department":"Toys","Website":"economist.com","Latitude":50.0005878,"Longitude":15.5572849,"ShipDate":"7/5/2016","PaymentDate":"2017-11-07 19:43:31","TimeZone":"Europe/Prague","TotalPayment":"$258546.43","Status":4,"Type":2,"Actions":null},
            {"RecordID":96,"OrderID":"54868-5736","Country":"Argentina","ShipCountry":"AR","ShipCity":"Chamical","ShipName":"Schuster, Morissette and Wolf","ShipAddress":"1710 Kingsford Street","CompanyEmail":"bheiss2n@irs.gov","CompanyAgent":"Bamby Heiss","CompanyName":"Ruecker and Sons","Currency":"ARS","Notes":"amet consectetuer adipiscing elit proin interdum mauris non ligula pellentesque ultrices","Department":"Health","Website":"nbcnews.com","Latitude":-31.4411018,"Longitude":-64.1257463,"ShipDate":"10/17/2016","PaymentDate":"2017-09-20 12:33:54","TimeZone":"America/Argentina/La_Rioja","TotalPayment":"$914974.23","Status":6,"Type":1,"Actions":null},
            {"RecordID":97,"OrderID":"51334-161","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Busungbiu","ShipName":"Kuhic-Shanahan","ShipAddress":"9888 Cardinal Place","CompanyEmail":"nflarity2o@unicef.org","CompanyAgent":"Norina Flarity","CompanyName":"Jenkins-Rau","Currency":"IDR","Notes":"felis ut at dolor quis odio consequat varius integer ac leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices","Department":"Jewelery","Website":"simplemachines.org","Latitude":-8.3262486,"Longitude":114.9279547,"ShipDate":"5/2/2016","PaymentDate":"2018-03-31 22:47:23","TimeZone":"Asia/Makassar","TotalPayment":"$975497.09","Status":1,"Type":2,"Actions":null},
            {"RecordID":98,"OrderID":"69190-111","Country":"Japan","ShipCountry":"JP","ShipCity":"Hobaramachi","ShipName":"Gerhold and Sons","ShipAddress":"8838 Buell Avenue","CompanyEmail":"sriccardi2p@flavors.me","CompanyAgent":"Shep Riccardi","CompanyName":"Ankunding-Funk","Currency":"JPY","Notes":"sapien quis libero nullam sit amet turpis elementum ligula vehicula consequat morbi","Department":"Baby","Website":"ameblo.jp","Latitude":37.8199686,"Longitude":140.5540146,"ShipDate":"9/27/2016","PaymentDate":"2016-10-18 12:36:23","TimeZone":"Asia/Tokyo","TotalPayment":"$611589.58","Status":4,"Type":1,"Actions":null},
            {"RecordID":99,"OrderID":"59779-012","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Pamotan","ShipName":"Hilll-Schoen","ShipAddress":"16 Hanson Crossing","CompanyEmail":"dmenichi2q@lycos.com","CompanyAgent":"Devonna Menichi","CompanyName":"Wehner-Tillman","Currency":"IDR","Notes":"lectus aliquam sit amet diam in magna bibendum imperdiet nullam orci pede venenatis non sodales sed tincidunt eu","Department":"Games","Website":"gizmodo.com","Latitude":-6.761747,"Longitude":111.486801,"ShipDate":"3/22/2018","PaymentDate":"2017-06-26 20:44:03","TimeZone":"Asia/Jakarta","TotalPayment":"$666422.99","Status":3,"Type":3,"Actions":null},
            {"RecordID":100,"OrderID":"16590-338","Country":"Portugal","ShipCountry":"PT","ShipCity":"Alvide","ShipName":"Altenwerth, Kub and Durgan","ShipAddress":"1 Coleman Park","CompanyEmail":"lemlyn2r@cyberchimps.com","CompanyAgent":"Lannie Emlyn","CompanyName":"Jacobson-Medhurst","Currency":"EUR","Notes":"adipiscing elit proin risus praesent lectus vestibulum quam sapien varius ut blandit non interdum in","Department":"Industrial","Website":"oakley.com","Latitude":38.7204364,"Longitude":-9.425542,"ShipDate":"5/1/2017","PaymentDate":"2018-04-05 21:11:45","TimeZone":"Europe/Lisbon","TotalPayment":"$195576.87","Status":3,"Type":2,"Actions":null},
            {"RecordID":101,"OrderID":"0372-0004","Country":"Ecuador","ShipCountry":"EC","ShipCity":"Gualaceo","ShipName":"Deckow, Heaney and Olson","ShipAddress":"50 Fremont Point","CompanyEmail":"hdarrell2s@soundcloud.com","CompanyAgent":"Hunfredo Darrell","CompanyName":"Stroman-Howe","Currency":"USD","Notes":"in porttitor pede justo eu massa donec dapibus duis at velit","Department":"Computers","Website":"weather.com","Latitude":-2.886385,"Longitude":-78.7759559,"ShipDate":"8/18/2017","PaymentDate":"2016-07-14 14:26:43","TimeZone":"America/Guayaquil","TotalPayment":"$1059027.32","Status":4,"Type":2,"Actions":null},
            {"RecordID":102,"OrderID":"49701-3000","Country":"China","ShipCountry":"CN","ShipCity":"Longwu","ShipName":"Bogan-Rowe","ShipAddress":"55 Lake View Point","CompanyEmail":"vbrosch2t@senate.gov","CompanyAgent":"Valentin Brosch","CompanyName":"Hahn-VonRueden","Currency":"CNY","Notes":"lacinia aenean sit amet justo morbi ut odio cras mi pede malesuada in imperdiet et commodo vulputate","Department":"Movies","Website":"ning.com","Latitude":22.63964,"Longitude":114.020922,"ShipDate":"5/10/2016","PaymentDate":"2016-11-21 07:10:36","TimeZone":"Asia/Chongqing","TotalPayment":"$517646.80","Status":2,"Type":3,"Actions":null},
            {"RecordID":103,"OrderID":"52380-1721","Country":"Philippines","ShipCountry":"PH","ShipCity":"Damawato","ShipName":"Thiel LLC","ShipAddress":"3 Continental Lane","CompanyEmail":"claible2u@jimdo.com","CompanyAgent":"Curtis Laible","CompanyName":"Friesen, Schneider and McCullough","Currency":"PHP","Notes":"non lectus aliquam sit amet diam in magna bibendum imperdiet nullam orci","Department":"Clothing","Website":"amazon.co.uk","Latitude":6.7885037,"Longitude":124.8730516,"ShipDate":"4/11/2018","PaymentDate":"2017-02-17 18:47:35","TimeZone":"Asia/Manila","TotalPayment":"$831377.51","Status":5,"Type":1,"Actions":null},
            {"RecordID":104,"OrderID":"0062-0165","Country":"Portugal","ShipCountry":"PT","ShipCity":"Sobreda","ShipName":"Nienow-Smith","ShipAddress":"20 Lake View Junction","CompanyEmail":"hantonucci2v@dot.gov","CompanyAgent":"Haley Antonucci","CompanyName":"Koelpin, Fritsch and Walker","Currency":"EUR","Notes":"dictumst maecenas ut massa quis augue luctus tincidunt nulla mollis molestie lorem quisque","Department":"Outdoors","Website":"sbwire.com","Latitude":38.652683,"Longitude":-9.1861498,"ShipDate":"6/20/2016","PaymentDate":"2017-02-04 06:36:03","TimeZone":"Europe/Lisbon","TotalPayment":"$394821.03","Status":3,"Type":1,"Actions":null},
            {"RecordID":105,"OrderID":"54868-4972","Country":"Palestinian Territory","ShipCountry":"PS","ShipCity":"Arţās","ShipName":"Howe, Hills and Leffler","ShipAddress":"6 Dryden Way","CompanyEmail":"smcconville2w@cisco.com","CompanyAgent":"Shawna McConville","CompanyName":"Hills, Lindgren and Gleichner","Currency":"ILS","Notes":"sem duis aliquam convallis nunc proin at turpis a pede posuere nonummy integer non velit donec","Department":"Electronics","Website":"marketwatch.com","Latitude":31.689957,"Longitude":35.188236,"ShipDate":"6/4/2017","PaymentDate":"2016-10-16 16:04:37","TimeZone":"Asia/Hebron","TotalPayment":"$913024.13","Status":5,"Type":2,"Actions":null},
            {"RecordID":106,"OrderID":"0185-0139","Country":"Philippines","ShipCountry":"PH","ShipCity":"San Pedro One","ShipName":"Pouros, McGlynn and Rempel","ShipAddress":"010 Burning Wood Parkway","CompanyEmail":"apersicke2x@wix.com","CompanyAgent":"Annice Persicke","CompanyName":"Osinski, Bauch and Emard","Currency":"PHP","Notes":"maecenas ut massa quis augue luctus tincidunt nulla mollis molestie lorem quisque ut erat curabitur gravida nisi","Department":"Industrial","Website":"sakura.ne.jp","Latitude":14.0875558,"Longitude":121.1774182,"ShipDate":"6/12/2016","PaymentDate":"2016-12-20 10:26:51","TimeZone":"Asia/Manila","TotalPayment":"$374654.19","Status":5,"Type":2,"Actions":null},
            {"RecordID":107,"OrderID":"65044-1061","Country":"Morocco","ShipCountry":"MA","ShipCity":"Tabia","ShipName":"Mills, Hintz and Windler","ShipAddress":"0 Miller Way","CompanyEmail":"lcallaby2y@nhs.uk","CompanyAgent":"Levy Callaby","CompanyName":"Orn Inc","Currency":"MAD","Notes":"arcu adipiscing molestie hendrerit at vulputate vitae nisl aenean lectus pellentesque eget nunc donec quis orci","Department":"Sports","Website":"dion.ne.jp","Latitude":32.0302286,"Longitude":-6.7969224,"ShipDate":"2/15/2018","PaymentDate":"2017-02-21 08:25:46","TimeZone":"Africa/Casablanca","TotalPayment":"$1145379.03","Status":3,"Type":2,"Actions":null},
            {"RecordID":108,"OrderID":"13537-493","Country":"China","ShipCountry":"CN","ShipCity":"Shiquanhe","ShipName":"Rutherford-Stoltenberg","ShipAddress":"92553 Anthes Alley","CompanyEmail":"hobrallaghan2z@ihg.com","CompanyAgent":"Helsa O'Brallaghan","CompanyName":"Kling-Spinka","Currency":"CNY","Notes":"ac neque duis bibendum morbi non quam nec dui luctus","Department":"Outdoors","Website":"reverbnation.com","Latitude":32.493989,"Longitude":80.101607,"ShipDate":"5/26/2016","PaymentDate":"2016-02-02 12:24:06","TimeZone":"Asia/Kolkata","TotalPayment":"$406126.54","Status":4,"Type":3,"Actions":null},
            {"RecordID":109,"OrderID":"49288-0589","Country":"China","ShipCountry":"CN","ShipCity":"Shichuan","ShipName":"Feest, Mitchell and Anderson","ShipAddress":"7 Pawling Plaza","CompanyEmail":"smoggie30@youtu.be","CompanyAgent":"Sean Moggie","CompanyName":"Ledner LLC","Currency":"CNY","Notes":"mattis nibh ligula nec sem duis aliquam convallis nunc proin at turpis","Department":"Industrial","Website":"netlog.com","Latitude":30.2638032,"Longitude":102.8054753,"ShipDate":"12/12/2017","PaymentDate":"2016-11-23 16:21:09","TimeZone":"Asia/Chongqing","TotalPayment":"$810305.15","Status":4,"Type":2,"Actions":null},
            {"RecordID":110,"OrderID":"59779-460","Country":"Sweden","ShipCountry":"SE","ShipCity":"Ånge","ShipName":"Haley, Lang and Blick","ShipAddress":"0754 Pond Trail","CompanyEmail":"dlingfoot31@1und1.de","CompanyAgent":"Dominique Lingfoot","CompanyName":"Stark-Sauer","Currency":"SEK","Notes":"varius ut blandit non interdum in ante vestibulum ante ipsum primis in faucibus orci luctus","Department":"Grocery","Website":"ovh.net","Latitude":62.1865035,"Longitude":15.6532841,"ShipDate":"11/6/2016","PaymentDate":"2017-08-18 23:38:27","TimeZone":"Europe/Stockholm","TotalPayment":"$505437.25","Status":1,"Type":1,"Actions":null},
            {"RecordID":111,"OrderID":"36987-1495","Country":"Liechtenstein","ShipCountry":"LI","ShipCity":"Schellenberg","ShipName":"Dickens-Schimmel","ShipAddress":"578 Lakewood Hill","CompanyEmail":"btallach32@japanpost.jp","CompanyAgent":"Ber Tallach","CompanyName":"Kunze Group","Currency":"CHF","Notes":"ac diam cras pellentesque volutpat dui maecenas tristique est et tempus semper est quam pharetra magna ac consequat metus sapien","Department":"Movies","Website":"sphinn.com","Latitude":47.2391802,"Longitude":9.5572045,"ShipDate":"4/30/2016","PaymentDate":"2017-11-29 20:36:37","TimeZone":"Europe/Vienna","TotalPayment":"$149734.10","Status":4,"Type":1,"Actions":null},
            {"RecordID":112,"OrderID":"43538-171","Country":"Argentina","ShipCountry":"AR","ShipCity":"Oberá","ShipName":"Mueller, Keeling and Mann","ShipAddress":"79213 Orin Street","CompanyEmail":"kgusticke33@wikia.com","CompanyAgent":"Kalli Gusticke","CompanyName":"Hegmann-Nitzsche","Currency":"ARS","Notes":"nonummy maecenas tincidunt lacus at velit vivamus vel nulla eget eros elementum pellentesque quisque porta volutpat erat quisque","Department":"Books","Website":"ebay.com","Latitude":-27.3869255,"Longitude":-55.9145502,"ShipDate":"10/26/2016","PaymentDate":"2018-05-18 20:34:34","TimeZone":"America/Argentina/Cordoba","TotalPayment":"$271425.67","Status":2,"Type":2,"Actions":null},
            {"RecordID":113,"OrderID":"51801-009","Country":"Poland","ShipCountry":"PL","ShipCity":"Szczecinek","ShipName":"Kessler Inc","ShipAddress":"77 Sunnyside Plaza","CompanyEmail":"ggreeson34@blogger.com","CompanyAgent":"Giorgia Greeson","CompanyName":"Conn Inc","Currency":"PLN","Notes":"eget congue eget semper rutrum nulla nunc purus phasellus in felis donec semper sapien","Department":"Games","Website":"pagesperso-orange.fr","Latitude":53.6936156,"Longitude":16.7047258,"ShipDate":"6/9/2016","PaymentDate":"2018-01-10 21:56:42","TimeZone":"Europe/Warsaw","TotalPayment":"$535458.50","Status":2,"Type":2,"Actions":null},
            {"RecordID":114,"OrderID":"54868-4243","Country":"United States","ShipCountry":"US","ShipCity":"Des Moines","ShipName":"Ward, Mertz and Haag","ShipAddress":"58 Holmberg Park","CompanyEmail":"kcaraher35@wisc.edu","CompanyAgent":"Kaitlyn Caraher","CompanyName":"Denesik-Goodwin","Currency":"USD","Notes":"ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae mauris viverra diam vitae quam","Department":"Industrial","Website":"blogs.com","Latitude":41.6,"Longitude":-93.61,"ShipDate":"6/12/2017","PaymentDate":"2018-01-13 21:44:01","TimeZone":"America/Chicago","TotalPayment":"$39630.89","Status":1,"Type":1,"Actions":null},
            {"RecordID":115,"OrderID":"48951-1065","Country":"France","ShipCountry":"FR","ShipCity":"Saint-Quentin-en-Yvelines","ShipName":"Reilly, Haag and Gorczany","ShipAddress":"250 Shoshone Street","CompanyEmail":"rknibbs36@bravesites.com","CompanyAgent":"Rachael Knibbs","CompanyName":"Walsh, Padberg and Rempel","Currency":"EUR","Notes":"convallis morbi odio odio elementum eu interdum eu tincidunt in leo","Department":"Outdoors","Website":"wikimedia.org","Latitude":48.799627,"Longitude":2.1415644,"ShipDate":"2/5/2018","PaymentDate":"2017-10-22 11:07:41","TimeZone":"Europe/Paris","TotalPayment":"$1101923.42","Status":6,"Type":3,"Actions":null},
            {"RecordID":116,"OrderID":"0143-1172","Country":"Portugal","ShipCountry":"PT","ShipCity":"Pomar","ShipName":"Bailey, Gislason and Abshire","ShipAddress":"56 Colorado Junction","CompanyEmail":"ipotier37@blinklist.com","CompanyAgent":"Ilario Potier","CompanyName":"Stokes-Greenholt","Currency":"EUR","Notes":"justo morbi ut odio cras mi pede malesuada in imperdiet et commodo vulputate justo in blandit","Department":"Music","Website":"webnode.com","Latitude":42.046011,"Longitude":-8.4825685,"ShipDate":"10/14/2016","PaymentDate":"2016-01-17 10:22:25","TimeZone":"Europe/Madrid","TotalPayment":"$927090.44","Status":3,"Type":2,"Actions":null},
            {"RecordID":117,"OrderID":"36987-1467","Country":"Cape Verde","ShipCountry":"CV","ShipCity":"Tarrafal de São Nicolau","ShipName":"Cummings LLC","ShipAddress":"97 Hansons Court","CompanyEmail":"mtenney38@netvibes.com","CompanyAgent":"Margeaux Tenney","CompanyName":"Gislason-Ondricka","Currency":"CVE","Notes":"eget orci vehicula condimentum curabitur in libero ut massa volutpat convallis morbi odio odio elementum eu interdum","Department":"Toys","Website":"amazon.co.uk","Latitude":16.5636498,"Longitude":-24.354942,"ShipDate":"2/28/2017","PaymentDate":"2017-01-08 09:12:28","TimeZone":"Atlantic/Cape_Verde","TotalPayment":"$601901.23","Status":5,"Type":1,"Actions":null},
            {"RecordID":118,"OrderID":"49288-0648","Country":"Venezuela","ShipCountry":"VE","ShipCity":"Farriar","ShipName":"Gerlach, Rau and Kris","ShipAddress":"10835 Swallow Way","CompanyEmail":"gfaich39@arstechnica.com","CompanyAgent":"Glennis Faich","CompanyName":"Wolff-Smitham","Currency":"VEF","Notes":"scelerisque quam turpis adipiscing lorem vitae mattis nibh ligula nec sem duis aliquam convallis nunc proin at turpis a","Department":"Books","Website":"soup.io","Latitude":10.4675987,"Longitude":-68.5575062,"ShipDate":"11/16/2016","PaymentDate":"2017-06-03 09:12:35","TimeZone":"America/Caracas","TotalPayment":"$76931.74","Status":1,"Type":3,"Actions":null},
            {"RecordID":119,"OrderID":"35356-515","Country":"Philippines","ShipCountry":"PH","ShipCity":"Mambulo","ShipName":"Hermann LLC","ShipAddress":"25 Waubesa Circle","CompanyEmail":"dedgerley3a@zdnet.com","CompanyAgent":"Donnie Edgerley","CompanyName":"Bradtke Inc","Currency":"PHP","Notes":"turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis nibh ligula nec sem duis aliquam","Department":"Automotive","Website":"nyu.edu","Latitude":13.6315513,"Longitude":123.0424788,"ShipDate":"11/17/2016","PaymentDate":"2016-11-09 21:14:33","TimeZone":"Asia/Manila","TotalPayment":"$636789.52","Status":3,"Type":1,"Actions":null},
            {"RecordID":120,"OrderID":"0409-9558","Country":"Paraguay","ShipCountry":"PY","ShipCity":"Benjamín Aceval","ShipName":"Lemke-Koss","ShipAddress":"77 Blue Bill Park Place","CompanyEmail":"ngoadbie3b@marketplace.net","CompanyAgent":"Nertie Goadbie","CompanyName":"Altenwerth-Weimann","Currency":"PYG","Notes":"maecenas pulvinar lobortis est phasellus sit amet erat nulla tempus vivamus in felis eu sapien cursus vestibulum proin","Department":"Books","Website":"businessweek.com","Latitude":-24.9670799,"Longitude":-57.5476145,"ShipDate":"9/3/2016","PaymentDate":"2017-03-28 21:57:12","TimeZone":"America/Asuncion","TotalPayment":"$96716.21","Status":1,"Type":2,"Actions":null},
            {"RecordID":121,"OrderID":"0517-2064","Country":"Nauru","ShipCountry":"NR","ShipCity":"Anabar","ShipName":"Weissnat and Sons","ShipAddress":"309 Coleman Terrace","CompanyEmail":"ccullrford3c@reference.com","CompanyAgent":"Camilla Cullrford","CompanyName":"Witting-Eichmann","Currency":"AUD","Notes":"nunc donec quis orci eget orci vehicula condimentum curabitur in libero ut","Department":"Shoes","Website":"xinhuanet.com","Latitude":-0.5133517,"Longitude":166.9484624,"ShipDate":"3/5/2017","PaymentDate":"2017-10-17 03:47:05","TimeZone":"Pacific/Nauru","TotalPayment":"$416325.53","Status":2,"Type":1,"Actions":null},
            {"RecordID":122,"OrderID":"76088-300","Country":"Somalia","ShipCountry":"SO","ShipCity":"Buur Gaabo","ShipName":"Reinger-Stracke","ShipAddress":"91 Schurz Lane","CompanyEmail":"babrams3d@kickstarter.com","CompanyAgent":"Brandea Abrams","CompanyName":"Stroman, Lang and Koch","Currency":"SOS","Notes":"imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed","Department":"Automotive","Website":"tinyurl.com","Latitude":2.7991084,"Longitude":44.0793911,"ShipDate":"8/21/2016","PaymentDate":"2018-02-06 22:34:29","TimeZone":"Africa/Mogadishu","TotalPayment":"$268675.89","Status":2,"Type":3,"Actions":null},
            {"RecordID":123,"OrderID":"36987-1631","Country":"Spain","ShipCountry":"ES","ShipCity":"Pamplona/Iruña","ShipName":"Hammes Inc","ShipAddress":"1934 Clove Crossing","CompanyEmail":"tbruinemann3e@sina.com.cn","CompanyAgent":"Teresa Bruinemann","CompanyName":"Terry and Sons","Currency":"EUR","Notes":"cubilia curae mauris viverra diam vitae quam suspendisse potenti nullam porttitor lacus at","Department":"Sports","Website":"topsy.com","Latitude":42.8045028,"Longitude":-1.6432837,"ShipDate":"2/26/2018","PaymentDate":"2017-03-08 05:22:06","TimeZone":"Europe/Madrid","TotalPayment":"$33389.86","Status":1,"Type":3,"Actions":null},
            {"RecordID":124,"OrderID":"65923-978","Country":"Sweden","ShipCountry":"SE","ShipCity":"Stockholm","ShipName":"Jenkins, Ernser and Gutmann","ShipAddress":"86 2nd Street","CompanyEmail":"csiddele3f@youku.com","CompanyAgent":"Cinderella Siddele","CompanyName":"Grant, Jakubowski and Hegmann","Currency":"SEK","Notes":"pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras","Department":"Kids","Website":"dagondesign.com","Latitude":59.3326658,"Longitude":18.056792,"ShipDate":"3/9/2016","PaymentDate":"2016-09-08 23:53:58","TimeZone":"Europe/Stockholm","TotalPayment":"$347004.88","Status":2,"Type":3,"Actions":null},
            {"RecordID":125,"OrderID":"41520-440","Country":"Ghana","ShipCountry":"GH","ShipCity":"Kete Krachi","ShipName":"Yost and Sons","ShipAddress":"003 Aberg Drive","CompanyEmail":"lpesselt3g@home.pl","CompanyAgent":"Leon Pesselt","CompanyName":"Rippin, Wisozk and Goldner","Currency":"GHS","Notes":"pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient","Department":"Music","Website":"columbia.edu","Latitude":7.8014452,"Longitude":-0.0513246,"ShipDate":"4/10/2016","PaymentDate":"2018-05-09 00:38:55","TimeZone":"Africa/Lome","TotalPayment":"$464572.44","Status":2,"Type":1,"Actions":null},
            {"RecordID":126,"OrderID":"0093-5378","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Sukaratu","ShipName":"Satterfield and Sons","ShipAddress":"916 Bobwhite Center","CompanyEmail":"sswanwick3h@wordpress.org","CompanyAgent":"Sidney Swanwick","CompanyName":"Jakubowski and Sons","Currency":"IDR","Notes":"in quis justo maecenas rhoncus aliquam lacus morbi quis tortor id nulla ultrices","Department":"Games","Website":"pbs.org","Latitude":-7.2739902,"Longitude":108.1250791,"ShipDate":"1/15/2017","PaymentDate":"2017-11-24 08:55:52","TimeZone":"Asia/Jakarta","TotalPayment":"$79222.88","Status":5,"Type":1,"Actions":null},
            {"RecordID":127,"OrderID":"62750-051","Country":"Sweden","ShipCountry":"SE","ShipCity":"Nora","ShipName":"Durgan, Koch and Mayert","ShipAddress":"58 Summer Ridge Center","CompanyEmail":"vdevereux3i@nbcnews.com","CompanyAgent":"Violetta Devereux","CompanyName":"Yundt, Keebler and Heathcote","Currency":"SEK","Notes":"purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis","Department":"Automotive","Website":"php.net","Latitude":59.3453304,"Longitude":14.5678141,"ShipDate":"4/1/2017","PaymentDate":"2016-08-18 20:01:23","TimeZone":"Europe/Stockholm","TotalPayment":"$939118.48","Status":5,"Type":3,"Actions":null},
            {"RecordID":128,"OrderID":"42751-1070","Country":"Poland","ShipCountry":"PL","ShipCity":"Gromnik","ShipName":"Hermann Group","ShipAddress":"46 Autumn Leaf Avenue","CompanyEmail":"lhaxell3j@aboutads.info","CompanyAgent":"Lyndsie Haxell","CompanyName":"Lakin-Kreiger","Currency":"PLN","Notes":"consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo","Department":"Kids","Website":"wufoo.com","Latitude":49.8381802,"Longitude":20.9789037,"ShipDate":"3/25/2018","PaymentDate":"2017-01-21 00:32:50","TimeZone":"Europe/Warsaw","TotalPayment":"$562272.78","Status":4,"Type":3,"Actions":null},
            {"RecordID":129,"OrderID":"35356-723","Country":"Iran","ShipCountry":"IR","ShipCity":"Marāveh Tappeh","ShipName":"Goodwin and Sons","ShipAddress":"5 South Park","CompanyEmail":"cwoods3k@feedburner.com","CompanyAgent":"Cassandra Woods","CompanyName":"Hamill Inc","Currency":"IRR","Notes":"diam erat fermentum justo nec condimentum neque sapien placerat ante nulla justo aliquam quis turpis eget elit sodales scelerisque","Department":"Automotive","Website":"loc.gov","Latitude":37.9022064,"Longitude":55.95535,"ShipDate":"5/7/2016","PaymentDate":"2016-03-11 23:10:10","TimeZone":"Asia/Tehran","TotalPayment":"$799109.76","Status":3,"Type":3,"Actions":null},
            {"RecordID":130,"OrderID":"36987-1185","Country":"Hungary","ShipCountry":"HU","ShipCity":"Kecskemét","ShipName":"Lehner-Harvey","ShipAddress":"7889 Red Cloud Court","CompanyEmail":"bfoale3l@1688.com","CompanyAgent":"Burr Foale","CompanyName":"Marquardt Group","Currency":"HUF","Notes":"justo sit amet sapien dignissim vestibulum vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae","Department":"Electronics","Website":"sakura.ne.jp","Latitude":46.9067373,"Longitude":19.691788,"ShipDate":"2/9/2018","PaymentDate":"2017-06-20 12:23:42","TimeZone":"Europe/Budapest","TotalPayment":"$167492.43","Status":3,"Type":1,"Actions":null},
            {"RecordID":131,"OrderID":"44119-002","Country":"Nicaragua","ShipCountry":"NI","ShipCity":"Diriá","ShipName":"Dibbert-Langosh","ShipAddress":"84 Mccormick Avenue","CompanyEmail":"rtrodden3m@jugem.jp","CompanyAgent":"Reinhold Trodden","CompanyName":"Deckow-Konopelski","Currency":"NIO","Notes":"quam pharetra magna ac consequat metus sapien ut nunc vestibulum ante ipsum primis in faucibus","Department":"Outdoors","Website":"opensource.org","Latitude":11.8859782,"Longitude":-86.054235,"ShipDate":"5/30/2017","PaymentDate":"2016-07-16 04:17:11","TimeZone":"America/Managua","TotalPayment":"$714317.47","Status":3,"Type":1,"Actions":null},
            {"RecordID":132,"OrderID":"36987-1050","Country":"Jamaica","ShipCountry":"JM","ShipCity":"Williamsfield","ShipName":"Skiles, Flatley and Langosh","ShipAddress":"181 Mifflin Junction","CompanyEmail":"gpeggrem3n@mlb.com","CompanyAgent":"Gabriell Peggrem","CompanyName":"Kihn-O'Hara","Currency":"JMD","Notes":"id ornare imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed augue aliquam erat volutpat in","Department":"Computers","Website":"house.gov","Latitude":18.0651384,"Longitude":-77.4658948,"ShipDate":"1/2/2018","PaymentDate":"2017-09-13 09:48:19","TimeZone":"America/Jamaica","TotalPayment":"$691413.78","Status":4,"Type":1,"Actions":null},
            {"RecordID":133,"OrderID":"52674-544","Country":"Sierra Leone","ShipCountry":"SL","ShipCity":"Kambia","ShipName":"Streich and Sons","ShipAddress":"22 Kedzie Circle","CompanyEmail":"tglasser3o@washington.edu","CompanyAgent":"Tremayne Glasser","CompanyName":"Crona-Moen","Currency":"SLL","Notes":"et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit","Department":"Sports","Website":"geocities.com","Latitude":9.1261664,"Longitude":-12.9176518,"ShipDate":"2/22/2016","PaymentDate":"2016-08-06 00:20:16","TimeZone":"Africa/Freetown","TotalPayment":"$912857.79","Status":5,"Type":2,"Actions":null},
            {"RecordID":134,"OrderID":"42254-214","Country":"Afghanistan","ShipCountry":"AF","ShipCity":"Mazār-e Sharīf","ShipName":"Smith, Mertz and Hartmann","ShipAddress":"4 Huxley Avenue","CompanyEmail":"omaccari3p@psu.edu","CompanyAgent":"Omar Maccari","CompanyName":"Aufderhar Group","Currency":"AFN","Notes":"euismod scelerisque quam turpis adipiscing lorem vitae mattis nibh ligula nec sem duis aliquam convallis nunc","Department":"Sports","Website":"homestead.com","Latitude":36.6926167,"Longitude":67.1179511,"ShipDate":"7/24/2016","PaymentDate":"2017-03-01 22:22:41","TimeZone":"Asia/Kabul","TotalPayment":"$1164394.28","Status":6,"Type":3,"Actions":null},
            {"RecordID":135,"OrderID":"68180-520","Country":"Turkey","ShipCountry":"TR","ShipCity":"Yeniköy","ShipName":"Torp Inc","ShipAddress":"64 Westport Place","CompanyEmail":"oclewley3q@diigo.com","CompanyAgent":"Ottilie Clewley","CompanyName":"Moen, Stiedemann and Stanton","Currency":"TRY","Notes":"sit amet sapien dignissim vestibulum vestibulum ante ipsum primis in faucibus orci","Department":"Outdoors","Website":"princeton.edu","Latitude":38.408587,"Longitude":28.385948,"ShipDate":"9/23/2017","PaymentDate":"2017-10-08 19:04:34","TimeZone":"Europe/Istanbul","TotalPayment":"$99982.45","Status":2,"Type":2,"Actions":null},
            {"RecordID":136,"OrderID":"64942-1272","Country":"France","ShipCountry":"FR","ShipCity":"Les Sables-d'Olonne","ShipName":"Sporer-Abbott","ShipAddress":"98 Fair Oaks Plaza","CompanyEmail":"jtwitchings3r@wikia.com","CompanyAgent":"Justine Twitchings","CompanyName":"Smith and Sons","Currency":"EUR","Notes":"maecenas tristique est et tempus semper est quam pharetra magna ac","Department":"Electronics","Website":"cbc.ca","Latitude":46.4846074,"Longitude":-1.7557702,"ShipDate":"5/20/2018","PaymentDate":"2016-06-03 20:12:35","TimeZone":"Europe/Paris","TotalPayment":"$419291.49","Status":2,"Type":3,"Actions":null},
            {"RecordID":137,"OrderID":"10158-003","Country":"Pakistan","ShipCountry":"PK","ShipCity":"Mehmand Chak","ShipName":"Johns, Beier and Turcotte","ShipAddress":"43820 Vera Alley","CompanyEmail":"ktrenouth3s@amazon.com","CompanyAgent":"Kara Trenouth","CompanyName":"Bernier-Ratke","Currency":"PKR","Notes":"eget elit sodales scelerisque mauris sit amet eros suspendisse accumsan","Department":"Games","Website":"yellowpages.com","Latitude":32.7894701,"Longitude":73.8236143,"ShipDate":"2/24/2017","PaymentDate":"2017-09-21 17:44:09","TimeZone":"Asia/Karachi","TotalPayment":"$312997.04","Status":6,"Type":1,"Actions":null},
            {"RecordID":138,"OrderID":"58232-9910","Country":"China","ShipCountry":"CN","ShipCity":"Gaoleshan","ShipName":"Maggio and Sons","ShipAddress":"81 Goodland Center","CompanyEmail":"shouseley3t@arstechnica.com","CompanyAgent":"Shirline Houseley","CompanyName":"Bode, Dach and Will","Currency":"CNY","Notes":"ac enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem","Department":"Outdoors","Website":"networksolutions.com","Latitude":29.67832,"Longitude":109.144929,"ShipDate":"1/14/2016","PaymentDate":"2017-02-10 04:15:18","TimeZone":"Asia/Chongqing","TotalPayment":"$170391.79","Status":5,"Type":2,"Actions":null},
            {"RecordID":139,"OrderID":"42291-802","Country":"China","ShipCountry":"CN","ShipCity":"Rixi","ShipName":"D'Amore and Sons","ShipAddress":"9 Dwight Point","CompanyEmail":"hcurrell3u@baidu.com","CompanyAgent":"Hanan Currell","CompanyName":"Rodriguez, McDermott and Koelpin","Currency":"CNY","Notes":"suscipit a feugiat et eros vestibulum ac est lacinia nisi venenatis tristique","Department":"Grocery","Website":"accuweather.com","Latitude":28.856082,"Longitude":93.388853,"ShipDate":"10/7/2017","PaymentDate":"2017-01-08 06:56:12","TimeZone":"Asia/Shanghai","TotalPayment":"$859090.81","Status":1,"Type":1,"Actions":null},
            {"RecordID":140,"OrderID":"0268-0925","Country":"Philippines","ShipCountry":"PH","ShipCity":"Tigpalay","ShipName":"Heaney Inc","ShipAddress":"12 Southridge Trail","CompanyEmail":"astrognell3v@google.fr","CompanyAgent":"Alidia Strognell","CompanyName":"Willms, Hane and Lemke","Currency":"PHP","Notes":"nulla justo aliquam quis turpis eget elit sodales scelerisque mauris sit amet eros","Department":"Automotive","Website":"spiegel.de","Latitude":7.4854917,"Longitude":122.3399664,"ShipDate":"12/9/2016","PaymentDate":"2016-07-09 04:54:02","TimeZone":"Asia/Manila","TotalPayment":"$223441.39","Status":2,"Type":2,"Actions":null},
            {"RecordID":141,"OrderID":"55050-0011","Country":"Ghana","ShipCountry":"GH","ShipCity":"Kasoa","ShipName":"Predovic Inc","ShipAddress":"0926 American Drive","CompanyEmail":"crambaut3w@salon.com","CompanyAgent":"Candice Rambaut","CompanyName":"Skiles-Dicki","Currency":"GHS","Notes":"ligula in lacus curabitur at ipsum ac tellus semper interdum mauris ullamcorper purus sit","Department":"Toys","Website":"privacy.gov.au","Latitude":5.5300711,"Longitude":-0.4408037,"ShipDate":"3/25/2018","PaymentDate":"2017-07-31 08:09:34","TimeZone":"Africa/Accra","TotalPayment":"$425816.50","Status":3,"Type":2,"Actions":null},
            {"RecordID":142,"OrderID":"10702-007","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Padas","ShipName":"Watsica Group","ShipAddress":"1 Annamark Center","CompanyEmail":"aevennett3x@slate.com","CompanyAgent":"Anthia Evennett","CompanyName":"Davis, Prosacco and Dooley","Currency":"IDR","Notes":"mauris lacinia sapien quis libero nullam sit amet turpis elementum ligula vehicula consequat morbi a","Department":"Home","Website":"ucoz.ru","Latitude":-2.576499,"Longitude":112.542,"ShipDate":"7/1/2016","PaymentDate":"2016-12-30 00:22:19","TimeZone":"Asia/Jakarta","TotalPayment":"$552930.34","Status":2,"Type":3,"Actions":null},
            {"RecordID":143,"OrderID":"52815-125","Country":"Mexico","ShipCountry":"MX","ShipCity":"Guadalupe","ShipName":"Stanton-Koepp","ShipAddress":"23692 Everett Crossing","CompanyEmail":"froscow3y@stanford.edu","CompanyAgent":"Fedora Roscow","CompanyName":"Brakus Inc","Currency":"MXN","Notes":"donec ut mauris eget massa tempor convallis nulla neque libero convallis eget","Department":"Movies","Website":"webeden.co.uk","Latitude":25.6775595,"Longitude":-100.2596935,"ShipDate":"12/31/2016","PaymentDate":"2017-07-22 22:58:08","TimeZone":"America/Mexico_City","TotalPayment":"$1067809.38","Status":4,"Type":2,"Actions":null},
            {"RecordID":144,"OrderID":"63981-915","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Karangpeton","ShipName":"Koss and Sons","ShipAddress":"85 Huxley Avenue","CompanyEmail":"pshenfisch3z@webs.com","CompanyAgent":"Pryce Shenfisch","CompanyName":"Crona-Ebert","Currency":"IDR","Notes":"sapien quis libero nullam sit amet turpis elementum ligula vehicula consequat morbi a ipsum integer a nibh in quis","Department":"Music","Website":"cbc.ca","Latitude":-8.1001586,"Longitude":113.8436013,"ShipDate":"4/12/2018","PaymentDate":"2016-07-13 11:48:15","TimeZone":"Asia/Jakarta","TotalPayment":"$526846.16","Status":6,"Type":2,"Actions":null},
            {"RecordID":145,"OrderID":"14550-517","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Gisiliba","ShipName":"Williamson Group","ShipAddress":"23 Hanover Plaza","CompanyEmail":"kwearne40@posterous.com","CompanyAgent":"Kalinda Wearne","CompanyName":"Schaefer-Rath","Currency":"IDR","Notes":"metus aenean fermentum donec ut mauris eget massa tempor convallis nulla neque libero","Department":"Games","Website":"google.es","Latitude":"-8.83126","Longitude":"121.05243","ShipDate":"6/17/2016","PaymentDate":"2017-07-13 01:28:10","TimeZone":"Asia/Makassar","TotalPayment":"$423971.17","Status":6,"Type":2,"Actions":null},
            {"RecordID":146,"OrderID":"51079-146","Country":"Ukraine","ShipCountry":"UA","ShipCity":"Toshkivka","ShipName":"Schneider-Lakin","ShipAddress":"06883 Marcy Road","CompanyEmail":"cpoxon41@plala.or.jp","CompanyAgent":"Camey Poxon","CompanyName":"Weimann, Champlin and Walsh","Currency":"UAH","Notes":"faucibus orci luctus et ultrices posuere cubilia curae mauris viverra diam vitae","Department":"Outdoors","Website":"newyorker.com","Latitude":48.7790663,"Longitude":38.564841,"ShipDate":"8/5/2016","PaymentDate":"2016-03-22 06:02:37","TimeZone":"Europe/Zaporozhye","TotalPayment":"$578250.52","Status":4,"Type":2,"Actions":null},
            {"RecordID":147,"OrderID":"42352-2001","Country":"Vietnam","ShipCountry":"VN","ShipCity":"Thị Trấn Ngải Giao","ShipName":"Klocko, Gislason and Bernier","ShipAddress":"01 Eagan Crossing","CompanyEmail":"tkeitch42@hhs.gov","CompanyAgent":"Tailor Keitch","CompanyName":"Schroeder and Sons","Currency":"VND","Notes":"dapibus augue vel accumsan tellus nisi eu orci mauris lacinia sapien quis libero nullam sit amet turpis elementum ligula","Department":"Garden","Website":"oracle.com","Latitude":10.6559243,"Longitude":107.2370874,"ShipDate":"5/3/2018","PaymentDate":"2018-04-10 11:04:51","TimeZone":"Asia/Ho_Chi_Minh","TotalPayment":"$971043.69","Status":1,"Type":1,"Actions":null},
            {"RecordID":148,"OrderID":"52125-636","Country":"Greece","ShipCountry":"GR","ShipCity":"Lakkíon","ShipName":"Krajcik Inc","ShipAddress":"9898 Little Fleur Street","CompanyEmail":"hboleyn43@weebly.com","CompanyAgent":"Hernando Boleyn","CompanyName":"Yundt, Bayer and Medhurst","Currency":"EUR","Notes":"augue quam sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum","Department":"Industrial","Website":"bandcamp.com","Latitude":37.1321706,"Longitude":26.8529432,"ShipDate":"2/15/2017","PaymentDate":"2016-11-26 23:41:10","TimeZone":"Europe/Istanbul","TotalPayment":"$672114.66","Status":1,"Type":3,"Actions":null},
            {"RecordID":149,"OrderID":"68645-478","Country":"Kuwait","ShipCountry":"KW","ShipCity":"Al Jahrā’","ShipName":"Willms-Jenkins","ShipAddress":"349 Service Court","CompanyEmail":"ebenzie44@zimbio.com","CompanyAgent":"Euphemia Benzie","CompanyName":"Pacocha-Beatty","Currency":"KWD","Notes":"dapibus duis at velit eu est congue elementum in hac habitasse platea dictumst morbi vestibulum velit id pretium iaculis","Department":"Baby","Website":"salon.com","Latitude":29.3365728,"Longitude":47.6755291,"ShipDate":"3/4/2016","PaymentDate":"2016-04-04 08:52:48","TimeZone":"Asia/Kuwait","TotalPayment":"$397866.21","Status":6,"Type":1,"Actions":null},
            {"RecordID":150,"OrderID":"68814-128","Country":"Colombia","ShipCountry":"CO","ShipCity":"Guayabetal","ShipName":"Pagac LLC","ShipAddress":"59 Steensland Point","CompanyEmail":"ametherell45@squidoo.com","CompanyAgent":"Arvy Metherell","CompanyName":"Wuckert, Kuhn and Kshlerin","Currency":"COP","Notes":"vestibulum sit amet cursus id turpis integer aliquet massa id lobortis convallis tortor risus dapibus augue vel accumsan tellus","Department":"Books","Website":"dedecms.com","Latitude":4.2157,"Longitude":-73.81476,"ShipDate":"8/24/2017","PaymentDate":"2017-02-23 12:47:37","TimeZone":"America/Bogota","TotalPayment":"$31448.59","Status":3,"Type":2,"Actions":null},
            {"RecordID":151,"OrderID":"0268-1504","Country":"Philippines","ShipCountry":"PH","ShipCity":"Caibiran","ShipName":"Schaden, Bode and Miller","ShipAddress":"9709 Rockefeller Avenue","CompanyEmail":"djocelyn46@wix.com","CompanyAgent":"Dewain Jocelyn","CompanyName":"Metz, White and Spencer","Currency":"PHP","Notes":"sem praesent id massa id nisl venenatis lacinia aenean sit amet justo morbi ut odio cras","Department":"Automotive","Website":"infoseek.co.jp","Latitude":11.57256,"Longitude":124.574799,"ShipDate":"9/13/2016","PaymentDate":"2016-10-09 10:10:46","TimeZone":"Asia/Manila","TotalPayment":"$412911.92","Status":4,"Type":1,"Actions":null},
            {"RecordID":152,"OrderID":"51452-010","Country":"Comoros","ShipCountry":"KM","ShipCity":"Hajoho","ShipName":"Fritsch-Tromp","ShipAddress":"325 Hoard Trail","CompanyEmail":"mundrill47@hexun.com","CompanyAgent":"Mozes Undrill","CompanyName":"Larson-Marquardt","Currency":"KMF","Notes":"donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer ac","Department":"Computers","Website":"amazon.co.jp","Latitude":-12.1227634,"Longitude":44.4883576,"ShipDate":"6/19/2017","PaymentDate":"2016-09-17 01:38:34","TimeZone":"Indian/Comoro","TotalPayment":"$153092.98","Status":5,"Type":3,"Actions":null},
            {"RecordID":153,"OrderID":"0409-7138","Country":"Thailand","ShipCountry":"TH","ShipCity":"Ra-ngae","ShipName":"Mayer, Emmerich and Schaden","ShipAddress":"01 Bluejay Way","CompanyEmail":"jstickney48@histats.com","CompanyAgent":"Joyan Stickney","CompanyName":"Steuber, Koch and Bins","Currency":"THB","Notes":"tempor turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis nibh ligula nec sem duis aliquam convallis nunc proin","Department":"Books","Website":"cam.ac.uk","Latitude":6.2958736,"Longitude":101.7296049,"ShipDate":"7/7/2016","PaymentDate":"2016-06-30 09:54:31","TimeZone":"Asia/Bangkok","TotalPayment":"$811131.55","Status":6,"Type":2,"Actions":null},
            {"RecordID":154,"OrderID":"49349-545","Country":"Russia","ShipCountry":"RU","ShipCity":"Novyye Kuz’minki","ShipName":"Boyle, Gislason and Collier","ShipAddress":"17892 Sullivan Avenue","CompanyEmail":"kcraney49@artisteer.com","CompanyAgent":"Kirbie Craney","CompanyName":"Kunde, Kihn and Stoltenberg","Currency":"RUB","Notes":"duis at velit eu est congue elementum in hac habitasse platea dictumst morbi vestibulum velit id pretium","Department":"Outdoors","Website":"qq.com","Latitude":"55.7","Longitude":"37.75","ShipDate":"2/7/2017","PaymentDate":"2016-07-17 15:14:55","TimeZone":"Europe/Moscow","TotalPayment":"$97377.15","Status":3,"Type":1,"Actions":null},
            {"RecordID":155,"OrderID":"65044-1208","Country":"Portugal","ShipCountry":"PT","ShipCity":"Memória","ShipName":"Erdman, Heaney and Champlin","ShipAddress":"8 Pond Road","CompanyEmail":"qadamo4a@irs.gov","CompanyAgent":"Querida Adamo","CompanyName":"Murazik-Dietrich","Currency":"EUR","Notes":"nulla elit ac nulla sed vel enim sit amet nunc viverra dapibus nulla suscipit ligula in lacus curabitur at","Department":"Books","Website":"icq.com","Latitude":39.7847567,"Longitude":-8.6496676,"ShipDate":"1/18/2018","PaymentDate":"2016-10-07 06:57:16","TimeZone":"Europe/Lisbon","TotalPayment":"$885940.41","Status":6,"Type":3,"Actions":null},
            {"RecordID":156,"OrderID":"33261-495","Country":"China","ShipCountry":"CN","ShipCity":"Gande","ShipName":"Harris LLC","ShipAddress":"29 Crownhardt Circle","CompanyEmail":"sdauber4b@reddit.com","CompanyAgent":"Sally Dauber","CompanyName":"Ryan-Hilpert","Currency":"CNY","Notes":"turpis enim blandit mi in porttitor pede justo eu massa donec dapibus duis at","Department":"Home","Website":"hud.gov","Latitude":33.969218,"Longitude":99.900904,"ShipDate":"4/19/2017","PaymentDate":"2018-01-18 07:46:15","TimeZone":"Asia/Shanghai","TotalPayment":"$840018.61","Status":6,"Type":2,"Actions":null},
            {"RecordID":157,"OrderID":"0781-5206","Country":"China","ShipCountry":"CN","ShipCity":"Damatou","ShipName":"Walsh Group","ShipAddress":"20 Fair Oaks Hill","CompanyEmail":"bbayliss4c@craigslist.org","CompanyAgent":"Bertine Bayliss","CompanyName":"Rau LLC","Currency":"CNY","Notes":"phasellus sit amet erat nulla tempus vivamus in felis eu sapien cursus","Department":"Toys","Website":"cbc.ca","Latitude":34.429066,"Longitude":117.609916,"ShipDate":"2/10/2017","PaymentDate":"2016-07-10 16:59:38","TimeZone":"Asia/Chongqing","TotalPayment":"$734613.11","Status":6,"Type":1,"Actions":null},
            {"RecordID":158,"OrderID":"0363-0563","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Kraton","ShipName":"Bogisich-Howell","ShipAddress":"4605 Ilene Way","CompanyEmail":"sportugal4d@instagram.com","CompanyAgent":"Sidoney Portugal","CompanyName":"West-Dietrich","Currency":"IDR","Notes":"ac est lacinia nisi venenatis tristique fusce congue diam id ornare imperdiet sapien urna","Department":"Automotive","Website":"harvard.edu","Latitude":-7.8090256,"Longitude":110.363649,"ShipDate":"1/28/2017","PaymentDate":"2017-10-27 08:40:53","TimeZone":"Asia/Jakarta","TotalPayment":"$141268.54","Status":2,"Type":2,"Actions":null},
            {"RecordID":159,"OrderID":"54505-328","Country":"China","ShipCountry":"CN","ShipCity":"Raofeng","ShipName":"Runte, Corkery and Keeling","ShipAddress":"4 Continental Place","CompanyEmail":"bpaley4e@oakley.com","CompanyAgent":"Bordy Paley","CompanyName":"Quitzon, Morissette and Feil","Currency":"CNY","Notes":"sapien varius ut blandit non interdum in ante vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere","Department":"Games","Website":"state.tx.us","Latitude":28.953503,"Longitude":116.822083,"ShipDate":"11/5/2016","PaymentDate":"2017-08-14 16:51:50","TimeZone":"Asia/Shanghai","TotalPayment":"$722606.37","Status":2,"Type":1,"Actions":null},
            {"RecordID":160,"OrderID":"49999-266","Country":"China","ShipCountry":"CN","ShipCity":"Luowan","ShipName":"Wisozk-Larson","ShipAddress":"9715 Arkansas Plaza","CompanyEmail":"ajorat4f@jigsy.com","CompanyAgent":"Auguste Jorat","CompanyName":"Bruen-Frami","Currency":"CNY","Notes":"justo sollicitudin ut suscipit a feugiat et eros vestibulum ac","Department":"Tools","Website":"zimbio.com","Latitude":28.1905018,"Longitude":112.999502,"ShipDate":"1/15/2018","PaymentDate":"2016-08-09 19:26:51","TimeZone":"Asia/Shanghai","TotalPayment":"$228489.36","Status":1,"Type":1,"Actions":null},
            {"RecordID":161,"OrderID":"62670-4759","Country":"Philippines","ShipCountry":"PH","ShipCity":"Salvacion","ShipName":"Hackett, Watsica and Kuphal","ShipAddress":"76 Utah Lane","CompanyEmail":"smicheau4g@amazon.co.uk","CompanyAgent":"Sher Micheau","CompanyName":"Champlin-Wintheiser","Currency":"PHP","Notes":"dui proin leo odio porttitor id consequat in consequat ut nulla sed accumsan felis","Department":"Clothing","Website":"pagesperso-orange.fr","Latitude":"12.6151","Longitude":"125.039","ShipDate":"10/23/2016","PaymentDate":"2017-05-03 12:42:58","TimeZone":"Asia/Manila","TotalPayment":"$81431.40","Status":6,"Type":2,"Actions":null},
            {"RecordID":162,"OrderID":"0024-5851","Country":"Brazil","ShipCountry":"BR","ShipCity":"Parobé","ShipName":"Abbott, Muller and Kunze","ShipAddress":"2914 Nevada Drive","CompanyEmail":"mlethbury4h@marketwatch.com","CompanyAgent":"Myriam Lethbury","CompanyName":"Weimann, Barrows and Mohr","Currency":"BRL","Notes":"amet diam in magna bibendum imperdiet nullam orci pede venenatis non","Department":"Baby","Website":"prlog.org","Latitude":-29.6247579,"Longitude":-50.8316868,"ShipDate":"4/10/2018","PaymentDate":"2018-01-28 14:48:44","TimeZone":"America/Sao_Paulo","TotalPayment":"$1133374.87","Status":6,"Type":2,"Actions":null},
            {"RecordID":163,"OrderID":"67938-2008","Country":"Mongolia","ShipCountry":"MN","ShipCity":"Suugaant","ShipName":"Ankunding and Sons","ShipAddress":"67843 Arkansas Drive","CompanyEmail":"equye4i@people.com.cn","CompanyAgent":"Elmore Quye","CompanyName":"Langworth Inc","Currency":"MNT","Notes":"nulla sed vel enim sit amet nunc viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum ac","Department":"Garden","Website":"w3.org","Latitude":"45.53257","Longitude":"107.04546","ShipDate":"6/2/2017","PaymentDate":"2016-12-26 16:47:52","TimeZone":"Asia/Ulaanbaatar","TotalPayment":"$1026071.10","Status":6,"Type":1,"Actions":null},
            {"RecordID":164,"OrderID":"57520-0620","Country":"Thailand","ShipCountry":"TH","ShipCity":"Tan Sum","ShipName":"Ankunding and Sons","ShipAddress":"0 Buell Crossing","CompanyEmail":"mrenehan4j@multiply.com","CompanyAgent":"Mikael Renehan","CompanyName":"Stracke-Connelly","Currency":"THB","Notes":"nulla sed vel enim sit amet nunc viverra dapibus nulla suscipit ligula","Department":"Electronics","Website":"harvard.edu","Latitude":15.3947065,"Longitude":105.1726816,"ShipDate":"7/9/2017","PaymentDate":"2018-04-20 15:49:45","TimeZone":"Asia/Bangkok","TotalPayment":"$1015071.09","Status":1,"Type":2,"Actions":null},
            {"RecordID":165,"OrderID":"34666-060","Country":"Malaysia","ShipCountry":"MY","ShipCity":"Sandakan","ShipName":"Jenkins-Mohr","ShipAddress":"1 Petterle Point","CompanyEmail":"svanderson4k@digg.com","CompanyAgent":"Shae Vanderson","CompanyName":"Wilkinson, Watsica and Steuber","Currency":"MYR","Notes":"felis donec semper sapien a libero nam dui proin leo","Department":"Clothing","Website":"si.edu","Latitude":5.83864,"Longitude":118.116958,"ShipDate":"8/16/2017","PaymentDate":"2017-09-26 05:20:08","TimeZone":"Asia/Kuching","TotalPayment":"$1183508.45","Status":1,"Type":2,"Actions":null},
            {"RecordID":166,"OrderID":"0603-3969","Country":"Kazakhstan","ShipCountry":"KZ","ShipCity":"Oral","ShipName":"Little-Hackett","ShipAddress":"2272 Eggendart Lane","CompanyEmail":"ysharratt4l@aboutads.info","CompanyAgent":"Yelena Sharratt","CompanyName":"Keeling and Sons","Currency":"KZT","Notes":"pellentesque eget nunc donec quis orci eget orci vehicula condimentum curabitur in libero","Department":"Jewelery","Website":"bbc.co.uk","Latitude":51.227821,"Longitude":51.3865431,"ShipDate":"2/5/2016","PaymentDate":"2016-11-08 21:56:42","TimeZone":"Asia/Oral","TotalPayment":"$1155219.64","Status":5,"Type":3,"Actions":null},
            {"RecordID":167,"OrderID":"24236-624","Country":"China","ShipCountry":"CN","ShipCity":"Qingshui","ShipName":"Orn-Friesen","ShipAddress":"57 Green Drive","CompanyEmail":"elambrook4m@rediff.com","CompanyAgent":"Ealasaid Lambrook","CompanyName":"Rau-Smith","Currency":"CNY","Notes":"suscipit ligula in lacus curabitur at ipsum ac tellus semper interdum mauris ullamcorper purus sit","Department":"Kids","Website":"prlog.org","Latitude":34.749864,"Longitude":106.137293,"ShipDate":"6/18/2017","PaymentDate":"2016-02-13 18:34:41","TimeZone":"Asia/Shanghai","TotalPayment":"$152549.61","Status":1,"Type":3,"Actions":null},
            {"RecordID":168,"OrderID":"76485-1010","Country":"Rwanda","ShipCountry":"RW","ShipCity":"Nzega","ShipName":"Cremin-Mueller","ShipAddress":"3147 Atwood Avenue","CompanyEmail":"asakins4n@creativecommons.org","CompanyAgent":"Allene Sakins","CompanyName":"Emard-Gaylord","Currency":"RWF","Notes":"in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit amet cursus id","Department":"Shoes","Website":"umich.edu","Latitude":"-2.479","Longitude":"29.5564","ShipDate":"10/11/2016","PaymentDate":"2018-01-19 14:55:38","TimeZone":"Africa/Kigali","TotalPayment":"$916265.57","Status":1,"Type":1,"Actions":null},
            {"RecordID":169,"OrderID":"29300-117","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Singgugu","ShipName":"Altenwerth, Dietrich and Effertz","ShipAddress":"84 Twin Pines Drive","CompanyEmail":"smartill4o@si.edu","CompanyAgent":"Sheela Martill","CompanyName":"Leffler, Wuckert and Schiller","Currency":"IDR","Notes":"diam vitae quam suspendisse potenti nullam porttitor lacus at turpis donec posuere metus vitae ipsum","Department":"Outdoors","Website":"acquirethisname.com","Latitude":"-7.1398","Longitude":"108.3549","ShipDate":"3/29/2017","PaymentDate":"2016-02-17 09:44:33","TimeZone":"Asia/Jakarta","TotalPayment":"$868367.93","Status":5,"Type":3,"Actions":null},
            {"RecordID":170,"OrderID":"43857-0115","Country":"Argentina","ShipCountry":"AR","ShipCity":"Capitán Sarmiento","ShipName":"Lowe, Becker and Larkin","ShipAddress":"50 Kingsford Way","CompanyEmail":"jclibbery4p@mit.edu","CompanyAgent":"Jeana Clibbery","CompanyName":"Daugherty-Denesik","Currency":"ARS","Notes":"venenatis turpis enim blandit mi in porttitor pede justo eu massa donec dapibus duis at","Department":"Outdoors","Website":"amazon.co.jp","Latitude":-34.6066162,"Longitude":-58.4052178,"ShipDate":"5/30/2018","PaymentDate":"2016-03-02 03:39:31","TimeZone":"America/Argentina/Buenos_Aires","TotalPayment":"$193211.16","Status":1,"Type":1,"Actions":null},
            {"RecordID":171,"OrderID":"0220-9343","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Citeluk","ShipName":"Hagenes, Murphy and Kunde","ShipAddress":"130 Blackbird Circle","CompanyEmail":"igaylard4q@toplist.cz","CompanyAgent":"Isadora Gaylard","CompanyName":"Dach Group","Currency":"IDR","Notes":"in congue etiam justo etiam pretium iaculis justo in hac habitasse platea dictumst","Department":"Industrial","Website":"youtu.be","Latitude":-6.8083456,"Longitude":105.6735131,"ShipDate":"4/6/2017","PaymentDate":"2016-08-05 06:29:00","TimeZone":"Asia/Jakarta","TotalPayment":"$561124.99","Status":1,"Type":2,"Actions":null},
            {"RecordID":172,"OrderID":"67046-139","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Wonosari","ShipName":"McLaughlin, Bahringer and Kshlerin","ShipAddress":"898 New Castle Pass","CompanyEmail":"wlorinez4r@indiegogo.com","CompanyAgent":"Wilhelmina Lorinez","CompanyName":"Cole-Willms","Currency":"IDR","Notes":"et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien","Department":"Kids","Website":"cnbc.com","Latitude":-7.9655412,"Longitude":110.6008827,"ShipDate":"9/10/2016","PaymentDate":"2018-03-30 19:05:53","TimeZone":"Asia/Jakarta","TotalPayment":"$1092130.27","Status":5,"Type":3,"Actions":null},
            {"RecordID":173,"OrderID":"0722-7121","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Ciketak","ShipName":"Ritchie Group","ShipAddress":"845 Declaration Parkway","CompanyEmail":"wlaidlow4s@amazonaws.com","CompanyAgent":"Wallie Laidlow","CompanyName":"Dare, Tremblay and Kris","Currency":"IDR","Notes":"sagittis dui vel nisl duis ac nibh fusce lacus purus aliquet at feugiat non pretium","Department":"Computers","Website":"tripadvisor.com","Latitude":-7.0112331,"Longitude":108.4595045,"ShipDate":"2/23/2017","PaymentDate":"2017-07-09 01:28:29","TimeZone":"Asia/Jakarta","TotalPayment":"$951223.88","Status":1,"Type":2,"Actions":null},
            {"RecordID":174,"OrderID":"12488-0600","Country":"China","ShipCountry":"CN","ShipCity":"Lecheng","ShipName":"Trantow-Brakus","ShipAddress":"53177 Linden Alley","CompanyEmail":"ejudson4t@google.cn","CompanyAgent":"Evie Judson","CompanyName":"Jast-Gutmann","Currency":"CNY","Notes":"justo nec condimentum neque sapien placerat ante nulla justo aliquam quis","Department":"Kids","Website":"jugem.jp","Latitude":23.35329,"Longitude":112.339444,"ShipDate":"2/1/2018","PaymentDate":"2018-04-24 13:30:44","TimeZone":"Asia/Chongqing","TotalPayment":"$982022.76","Status":2,"Type":2,"Actions":null},
            {"RecordID":175,"OrderID":"55154-2416","Country":"Philippines","ShipCountry":"PH","ShipCity":"Lemery","ShipName":"Stark, Beier and Purdy","ShipAddress":"421 Schlimgen Junction","CompanyEmail":"theggison4u@theguardian.com","CompanyAgent":"Towny Heggison","CompanyName":"Gislason, Huel and Weber","Currency":"PHP","Notes":"in sapien iaculis congue vivamus metus arcu adipiscing molestie hendrerit at vulputate vitae nisl","Department":"Toys","Website":"cbc.ca","Latitude":14.5665991,"Longitude":121.0022623,"ShipDate":"1/15/2018","PaymentDate":"2016-01-24 09:46:57","TimeZone":"Asia/Manila","TotalPayment":"$1117682.39","Status":1,"Type":3,"Actions":null},
            {"RecordID":176,"OrderID":"41163-272","Country":"Kenya","ShipCountry":"KE","ShipCity":"Thika","ShipName":"Carroll Group","ShipAddress":"36159 8th Hill","CompanyEmail":"smc4v@wisc.edu","CompanyAgent":"Sybil Mc Gee","CompanyName":"Romaguera-Parker","Currency":"KES","Notes":"turpis donec posuere metus vitae ipsum aliquam non mauris morbi non lectus aliquam sit amet diam in magna","Department":"Home","Website":"answers.com","Latitude":-1.0387569,"Longitude":37.0833753,"ShipDate":"2/4/2016","PaymentDate":"2017-08-22 10:40:22","TimeZone":"Africa/Nairobi","TotalPayment":"$576429.88","Status":2,"Type":3,"Actions":null},
            {"RecordID":177,"OrderID":"60512-0050","Country":"Czech Republic","ShipCountry":"CZ","ShipCity":"Batelov","ShipName":"Hackett-Pacocha","ShipAddress":"8141 Sunfield Plaza","CompanyEmail":"ctortis4w@vk.com","CompanyAgent":"Cathe Tortis","CompanyName":"Fisher and Sons","Currency":"CZK","Notes":"lacus morbi sem mauris laoreet ut rhoncus aliquet pulvinar sed nisl nunc rhoncus dui vel sem","Department":"Sports","Website":"feedburner.com","Latitude":49.3142554,"Longitude":15.3946577,"ShipDate":"5/27/2018","PaymentDate":"2016-02-25 15:48:56","TimeZone":"Europe/Prague","TotalPayment":"$80913.95","Status":1,"Type":2,"Actions":null},
            {"RecordID":178,"OrderID":"36800-866","Country":"Philippines","ShipCountry":"PH","ShipCity":"Mamburao","ShipName":"Batz-Keebler","ShipAddress":"022 Loeprich Place","CompanyEmail":"psandeson4x@amazon.com","CompanyAgent":"Patrizio Sandeson","CompanyName":"Hamill-Barton","Currency":"PHP","Notes":"quam sapien varius ut blandit non interdum in ante vestibulum ante ipsum primis in faucibus orci luctus","Department":"Books","Website":"webmd.com","Latitude":13.274365,"Longitude":120.618416,"ShipDate":"2/20/2018","PaymentDate":"2016-04-28 09:52:00","TimeZone":"Asia/Manila","TotalPayment":"$635402.74","Status":3,"Type":3,"Actions":null},
            {"RecordID":179,"OrderID":"43269-904","Country":"Brazil","ShipCountry":"BR","ShipCity":"Itambé","ShipName":"Cartwright, Reynolds and Cremin","ShipAddress":"559 Algoma Avenue","CompanyEmail":"jwrighton4y@addthis.com","CompanyAgent":"Jasper Wrighton","CompanyName":"Roob-Balistreri","Currency":"BRL","Notes":"etiam faucibus cursus urna ut tellus nulla ut erat id mauris vulputate elementum nullam varius nulla facilisi cras non velit","Department":"Home","Website":"geocities.jp","Latitude":-7.4443035,"Longitude":-35.148879,"ShipDate":"4/3/2016","PaymentDate":"2017-11-20 08:09:19","TimeZone":"America/Bahia","TotalPayment":"$259516.34","Status":4,"Type":3,"Actions":null},
            {"RecordID":180,"OrderID":"41167-0640","Country":"Cuba","ShipCountry":"CU","ShipCity":"San Luis","ShipName":"Olson-Pagac","ShipAddress":"82443 Meadow Vale Place","CompanyEmail":"adominetti4z@mozilla.com","CompanyAgent":"Agustin Dominetti","CompanyName":"Jones LLC","Currency":"CUP","Notes":"mauris sit amet eros suspendisse accumsan tortor quis turpis sed ante vivamus tortor duis mattis egestas metus","Department":"Electronics","Website":"nba.com","Latitude":20.1871897,"Longitude":-75.8475853,"ShipDate":"3/26/2016","PaymentDate":"2017-11-03 12:37:44","TimeZone":"America/Havana","TotalPayment":"$562603.97","Status":2,"Type":3,"Actions":null},
            {"RecordID":181,"OrderID":"0832-1212","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Pagelaran","ShipName":"Hand Group","ShipAddress":"123 Heath Place","CompanyEmail":"lmoneypenny50@bluehost.com","CompanyAgent":"Layne Moneypenny","CompanyName":"Dickinson, Doyle and Bahringer","Currency":"IDR","Notes":"a libero nam dui proin leo odio porttitor id consequat in consequat ut","Department":"Beauty","Website":"t-online.de","Latitude":-8.197451,"Longitude":112.6079459,"ShipDate":"3/14/2016","PaymentDate":"2018-05-26 21:26:57","TimeZone":"Asia/Jakarta","TotalPayment":"$429235.57","Status":1,"Type":2,"Actions":null},
            {"RecordID":182,"OrderID":"42255-587","Country":"Thailand","ShipCountry":"TH","ShipCity":"Bangkok","ShipName":"Gibson and Sons","ShipAddress":"3 Spaight Crossing","CompanyEmail":"mtrahmel51@hatena.ne.jp","CompanyAgent":"Mildred Trahmel","CompanyName":"Schmeler and Sons","Currency":"THB","Notes":"molestie lorem quisque ut erat curabitur gravida nisi at nibh in","Department":"Automotive","Website":"comsenz.com","Latitude":13.8135951,"Longitude":100.4227992,"ShipDate":"10/8/2016","PaymentDate":"2016-09-02 21:28:47","TimeZone":"Asia/Bangkok","TotalPayment":"$702919.41","Status":2,"Type":2,"Actions":null},
            {"RecordID":183,"OrderID":"43853-0010","Country":"Belarus","ShipCountry":"BY","ShipCity":"Shchuchin","ShipName":"Romaguera, Cruickshank and Kuhn","ShipAddress":"378 Fairview Terrace","CompanyEmail":"ncary52@twitter.com","CompanyAgent":"Nadine Cary","CompanyName":"Ebert, Dickinson and Koelpin","Currency":"BYR","Notes":"sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque","Department":"Grocery","Website":"geocities.com","Latitude":53.6040518,"Longitude":24.741899,"ShipDate":"7/23/2017","PaymentDate":"2016-07-27 23:52:58","TimeZone":"Europe/Minsk","TotalPayment":"$498289.59","Status":4,"Type":2,"Actions":null},
            {"RecordID":184,"OrderID":"61077-127","Country":"Portugal","ShipCountry":"PT","ShipCity":"Mourelos","ShipName":"Reilly-Mohr","ShipAddress":"94801 Cascade Place","CompanyEmail":"araund53@lycos.com","CompanyAgent":"Analiese Raund","CompanyName":"Howe, Mueller and Douglas","Currency":"EUR","Notes":"convallis nulla neque libero convallis eget eleifend luctus ultricies eu nibh quisque id justo sit amet sapien dignissim","Department":"Automotive","Website":"imageshack.us","Latitude":40.2766272,"Longitude":-8.4903311,"ShipDate":"5/22/2017","PaymentDate":"2016-12-23 14:20:24","TimeZone":"Europe/Lisbon","TotalPayment":"$69863.53","Status":3,"Type":1,"Actions":null},
            {"RecordID":185,"OrderID":"10889-301","Country":"China","ShipCountry":"CN","ShipCity":"Daijiaba","ShipName":"Kuphal LLC","ShipAddress":"30061 Garrison Place","CompanyEmail":"qjagels54@shutterfly.com","CompanyAgent":"Quinlan Jagels","CompanyName":"Okuneva Group","Currency":"CNY","Notes":"sit amet cursus id turpis integer aliquet massa id lobortis convallis tortor","Department":"Toys","Website":"guardian.co.uk","Latitude":33.010035,"Longitude":106.179842,"ShipDate":"11/7/2016","PaymentDate":"2016-09-25 22:54:49","TimeZone":"Asia/Chongqing","TotalPayment":"$821082.61","Status":1,"Type":3,"Actions":null},
            {"RecordID":186,"OrderID":"64893-903","Country":"Bangladesh","ShipCountry":"BD","ShipCity":"Pirojpur","ShipName":"Olson, Bayer and Kling","ShipAddress":"40 Magdeline Trail","CompanyEmail":"gmarrow55@delicious.com","CompanyAgent":"Gabbie Marrow","CompanyName":"Balistreri LLC","Currency":"BDT","Notes":"in tempus sit amet sem fusce consequat nulla nisl nunc nisl","Department":"Industrial","Website":"ocn.ne.jp","Latitude":22.4217587,"Longitude":89.0445636,"ShipDate":"9/29/2016","PaymentDate":"2017-06-04 21:48:45","TimeZone":"Asia/Dhaka","TotalPayment":"$907390.78","Status":5,"Type":2,"Actions":null},
            {"RecordID":187,"OrderID":"0093-2046","Country":"Portugal","ShipCountry":"PT","ShipCity":"Luso","ShipName":"Russel, Harber and Hamill","ShipAddress":"00 Dawn Center","CompanyEmail":"bgarman56@cbsnews.com","CompanyAgent":"Barton Garman","CompanyName":"Lockman Inc","Currency":"EUR","Notes":"est risus auctor sed tristique in tempus sit amet sem fusce consequat nulla nisl","Department":"Shoes","Website":"alibaba.com","Latitude":40.3853464,"Longitude":-8.380125,"ShipDate":"4/8/2018","PaymentDate":"2016-11-14 09:26:29","TimeZone":"Europe/Lisbon","TotalPayment":"$792909.90","Status":6,"Type":3,"Actions":null},
            {"RecordID":188,"OrderID":"35356-767","Country":"Mali","ShipCountry":"ML","ShipCity":"Bla","ShipName":"Goodwin, Rempel and Champlin","ShipAddress":"25483 Arrowood Crossing","CompanyEmail":"ygagie57@surveymonkey.com","CompanyAgent":"Yard Gagie","CompanyName":"Hagenes and Sons","Currency":"XOF","Notes":"at velit eu est congue elementum in hac habitasse platea dictumst","Department":"Beauty","Website":"rediff.com","Latitude":12.9549865,"Longitude":-5.7563151,"ShipDate":"1/12/2017","PaymentDate":"2016-11-07 11:17:42","TimeZone":"Africa/Bamako","TotalPayment":"$767036.01","Status":4,"Type":3,"Actions":null},
            {"RecordID":189,"OrderID":"61957-1841","Country":"Pakistan","ShipCountry":"PK","ShipCity":"Kambar","ShipName":"Collins, Kulas and Cruickshank","ShipAddress":"7 Redwing Hill","CompanyEmail":"oszantho58@gov.uk","CompanyAgent":"Orsola Szantho","CompanyName":"Swaniawski, Goyette and Schamberger","Currency":"PKR","Notes":"imperdiet nullam orci pede venenatis non sodales sed tincidunt eu felis fusce posuere felis sed lacus morbi sem","Department":"Games","Website":"examiner.com","Latitude":27.8084474,"Longitude":67.9277909,"ShipDate":"9/23/2017","PaymentDate":"2017-02-10 04:52:00","TimeZone":"Asia/Karachi","TotalPayment":"$613550.94","Status":5,"Type":3,"Actions":null},
            {"RecordID":190,"OrderID":"64942-1215","Country":"Indonesia","ShipCountry":"ID","ShipCity":"Walenrang","ShipName":"Howell, Larkin and Collins","ShipAddress":"6 Redwing Court","CompanyEmail":"lpittendreigh59@zdnet.com","CompanyAgent":"Lib Pittendreigh","CompanyName":"Kemmer, Thiel and Hauck","Currency":"IDR","Notes":"justo nec condimentum neque sapien placerat ante nulla justo aliquam quis turpis","Department":"Toys","Website":"wikispaces.com","Latitude":-2.8800399,"Longitude":120.1242853,"ShipDate":"3/8/2018","PaymentDate":"2017-06-26 19:55:31","TimeZone":"Asia/Makassar","TotalPayment":"$841066.25","Status":5,"Type":1,"Actions":null},
            {"RecordID":191,"OrderID":"60429-617","Country":"Brazil","ShipCountry":"BR","ShipCity":"Simão Dias","ShipName":"Bayer, Blanda and Cummings","ShipAddress":"3090 Nobel Way","CompanyEmail":"atrevain5a@over-blog.com","CompanyAgent":"Aguste Trevain","CompanyName":"Farrell-Collins","Currency":"BRL","Notes":"nunc rhoncus dui vel sem sed sagittis nam congue risus semper porta volutpat quam pede","Department":"Garden","Website":"51.la","Latitude":-10.7397921,"Longitude":-37.809338,"ShipDate":"3/9/2016","PaymentDate":"2017-01-31 15:20:45","TimeZone":"America/Maceio","TotalPayment":"$779396.08","Status":3,"Type":2,"Actions":null},
            {"RecordID":192,"OrderID":"65862-706","Country":"Portugal","ShipCountry":"PT","ShipCity":"Maia","ShipName":"Hoppe-Heaney","ShipAddress":"724 Vera Hill","CompanyEmail":"chardwell5b@sitemeter.com","CompanyAgent":"Cthrine Hardwell","CompanyName":"Robel and Sons","Currency":"EUR","Notes":"lacus morbi quis tortor id nulla ultrices aliquet maecenas leo","Department":"Music","Website":"phpbb.com","Latitude":41.2022247,"Longitude":-8.5597719,"ShipDate":"10/1/2017","PaymentDate":"2017-05-03 03:37:08","TimeZone":"Europe/Lisbon","TotalPayment":"$688114.12","Status":3,"Type":3,"Actions":null},
            {"RecordID":193,"OrderID":"0074-2278","Country":"South Africa","ShipCountry":"ZA","ShipCity":"Ulundi","ShipName":"Swaniawski, Murray and Powlowski","ShipAddress":"683 Barnett Hill","CompanyEmail":"vackers5c@ibm.com","CompanyAgent":"Vallie Ackers","CompanyName":"Blick, Zemlak and Douglas","Currency":"ZAR","Notes":"cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam","Department":"Games","Website":"1und1.de","Latitude":-28.3307679,"Longitude":31.4256183,"ShipDate":"11/30/2016","PaymentDate":"2017-02-11 20:21:06","TimeZone":"Africa/Johannesburg","TotalPayment":"$884722.01","Status":4,"Type":2,"Actions":null},
            {"RecordID":194,"OrderID":"0268-1333","Country":"Mongolia","ShipCountry":"MN","ShipCity":"Saynshand","ShipName":"Schowalter Inc","ShipAddress":"24 Oneill Lane","CompanyEmail":"ijopp5d@washingtonpost.com","CompanyAgent":"Isabel Jopp","CompanyName":"Wiegand-Schoen","Currency":"MNT","Notes":"vestibulum velit id pretium iaculis diam erat fermentum justo nec condimentum neque","Department":"Games","Website":"123-reg.co.uk","Latitude":44.8990915,"Longitude":110.1065717,"ShipDate":"8/5/2016","PaymentDate":"2016-10-10 06:31:09","TimeZone":"Asia/Ulaanbaatar","TotalPayment":"$1022216.65","Status":5,"Type":2,"Actions":null},
            {"RecordID":195,"OrderID":"36987-1902","Country":"Armenia","ShipCountry":"AM","ShipCity":"Aghavnadzor","ShipName":"Hilll and Sons","ShipAddress":"1722 Acker Pass","CompanyEmail":"nmanton5e@comsenz.com","CompanyAgent":"Niall Manton","CompanyName":"Kirlin and Sons","Currency":"AMD","Notes":"eu interdum eu tincidunt in leo maecenas pulvinar lobortis est phasellus sit amet erat","Department":"Computers","Website":"a8.net","Latitude":40.5784827,"Longitude":44.6998779,"ShipDate":"12/24/2017","PaymentDate":"2016-03-03 02:25:13","TimeZone":"Asia/Yerevan","TotalPayment":"$188699.58","Status":5,"Type":1,"Actions":null},
            {"RecordID":196,"OrderID":"0143-9869","Country":"Malaysia","ShipCountry":"MY","ShipCity":"Nusajaya","ShipName":"Feil and Sons","ShipAddress":"8 Judy Park","CompanyEmail":"jcahey5f@geocities.jp","CompanyAgent":"Jayme Cahey","CompanyName":"Shanahan, Donnelly and Bernhard","Currency":"MYR","Notes":"orci luctus et ultrices posuere cubilia curae duis faucibus accumsan","Department":"Home","Website":"exblog.jp","Latitude":1.424768,"Longitude":103.6487041,"ShipDate":"3/16/2017","PaymentDate":"2016-07-30 12:02:51","TimeZone":"Asia/Kuala_Lumpur","TotalPayment":"$609555.76","Status":3,"Type":3,"Actions":null},
            {"RecordID":197,"OrderID":"49288-0913","Country":"South Africa","ShipCountry":"ZA","ShipCity":"Burgersfort","ShipName":"Farrell, Kunze and Schuppe","ShipAddress":"72 Spaight Lane","CompanyEmail":"dhirjak5g@google.de","CompanyAgent":"Debra Hirjak","CompanyName":"Thiel, Crooks and Hintz","Currency":"ZAR","Notes":"lorem ipsum dolor sit amet consectetuer adipiscing elit proin risus praesent lectus","Department":"Computers","Website":"archive.org","Latitude":-25.7394696,"Longitude":28.3508883,"ShipDate":"9/29/2016","PaymentDate":"2016-04-26 11:17:08","TimeZone":"Africa/Johannesburg","TotalPayment":"$540131.46","Status":3,"Type":3,"Actions":null},
            {"RecordID":198,"OrderID":"58930-038","Country":"Brazil","ShipCountry":"BR","ShipCity":"Bariri","ShipName":"Flatley-Prosacco","ShipAddress":"199 Quincy Alley","CompanyEmail":"bcolliss5h@bluehost.com","CompanyAgent":"Blake Colliss","CompanyName":"Williamson-Hills","Currency":"BRL","Notes":"pulvinar lobortis est phasellus sit amet erat nulla tempus vivamus in felis eu sapien cursus","Department":"Garden","Website":"woothemes.com","Latitude":-22.075317,"Longitude":-48.7417603,"ShipDate":"11/23/2016","PaymentDate":"2018-01-09 23:19:10","TimeZone":"America/Sao_Paulo","TotalPayment":"$243536.01","Status":5,"Type":2,"Actions":null},
            {"RecordID":199,"OrderID":"65121-883","Country":"Russia","ShipCountry":"RU","ShipCity":"Antipino","ShipName":"Mitchell Inc","ShipAddress":"69291 Leroy Hill","CompanyEmail":"phaimes5i@usa.gov","CompanyAgent":"Paddy Haimes","CompanyName":"Larkin and Sons","Currency":"RUB","Notes":"neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante","Department":"Clothing","Website":"twitter.com","Latitude":58.9918209,"Longitude":55.1890813,"ShipDate":"3/13/2018","PaymentDate":"2016-04-16 08:18:58","TimeZone":"Asia/Yekaterinburg","TotalPayment":"$481960.81","Status":2,"Type":2,"Actions":null},
            {"RecordID":200,"OrderID":"51672-4144","Country":"Russia","ShipCountry":"RU","ShipCity":"Navashino","ShipName":"Monahan and Sons","ShipAddress":"44114 Autumn Leaf Street","CompanyEmail":"blambourn5j@google.com","CompanyAgent":"Byram Lambourn","CompanyName":"Huel and Sons","Currency":"RUB","Notes":"eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus","Department":"Electronics","Website":"china.com.cn","Latitude":55.5292,"Longitude":42.2003001,"ShipDate":"1/13/2016","PaymentDate":"2017-09-29 11:36:18","TimeZone":"Europe/Moscow","TotalPayment":"$240701.63","Status":4,"Type":3,"Actions":null}];

        var datatable = $('.kt-datatable').KTDatatable({
            data: {
                type: 'local',
                source: dataJSONArray,
                pageSize: 10,
                saveState: {
                    cookie: false,
                    webstorage: true
                },
                serverPaging: false,
                serverFiltering: false,
                serverSorting: false
            },

            layout: {
                scroll: true,
                height: 500,
                footer: false
            },

            sortable: true,

            filterable: false,

            pagination: true,

            columns: [{
                field: "RecordID",
                title: "#",
                sortable: false,
                width: 40,
                selector: {
                    class: 'kt-checkbox--solid'
                },
                textAlign: 'center'
            }, {
                field: "ShipName",
                title: "Company",
                width: 'auto',
                autoHide: false,
                // callback function support for column rendering
                template: function(data, i) {
                  var number = i + 1;
                  while (number > 5) {
                    number = number - 3;
                  }
                    var img = number + '.png';

                    var skills = [
                        'Angular, React',
                        'Vue, Kendo',
                        '.NET, Oracle, MySQL',
                        'Node, SASS, Webpack',
                        'MangoDB, Java',
                        'HTML5, jQuery, CSS3'
                    ];

                    var output = '\
                        <div class="kt-user-card-v2">\
                            <div class="kt-user-card-v2__pic">\
                                <img src="assets/media/client-logos/logo' + img + '" alt="photo">\
                            </div>\
                            <div class="kt-user-card-v2__details">\
                                <a href="#" class="kt-user-card-v2__name">' + data.CompanyName + '</a>\
                                <span class="kt-user-card-v2__email">' +
                                skills[number - 1] + '</span>\
                            </div>\
                        </div>';

                    return output;
                }
            }, {
                field: "ShipDate",
                title: "Date",
                width: 100,
                template: function(data) {
                    return '<span class="kt-font-bold">' + data.ShipDate + '</span>';
                }
            }, {
                field: "Status",
                title: "Status",
                width: 100,
                // callback function support for column rendering
                template: function(row) {
                    var status = {
                        1: {
                            'title': 'Pending',
                            'class': ' btn-label-brand'
                        },
                        2: {
                            'title': 'Processing',
                            'class': ' btn-label-danger'
                        },
                        3: {
                            'title': 'Success',
                            'class': ' btn-label-success'
                        },
                        4: {
                            'title': 'Delivered',
                            'class': ' btn-label-success'
                        },
                        5: {
                            'title': 'Canceled',
                            'class': ' btn-label-warning'
                        },
                        6: {
                            'title': 'Done',
                            'class': ' btn-label-danger'
                        },
                        7: {
                            'title': 'On Hold',
                            'class': ' btn-label-warning'
                        }
                    };
                    return '<span class="btn btn-bold btn-sm btn-font-sm ' + status[row.Status].class + '">' + status[row.Status].title + '</span>';
                }
            }, {
                field: "Type",
                title: "Managed By",
                width: 200,
                // callback function support for column rendering
                template: function(data, i) {
                    var number = 4 + i;
                    while (number > 12) {
                        number = number - 3;
                    }
                    var user_img = '100_' + number + '.jpg';

                    var pos = KTUtil.getRandomInt(0, 5);
                    var position = [
                        'Developer',
                        'Designer',
                        'CEO',
                        'Manager',
                        'Architect',
                        'Sales'
                    ];

					var output = '';
					if (number > 5) {
						output = '<div class="kt-user-card-v2">\
							<div class="kt-user-card-v2__pic">\
								<img src="assets/media/users/' + user_img + '" alt="photo">\
							</div>\
							<div class="kt-user-card-v2__details">\
								<a href="#" class="kt-user-card-v2__name">' + data.CompanyAgent + '</a>\
								<span class="kt-user-card-v2__desc">' + position[pos] + '</span>\
							</div>\
						</div>';
					}
					else {
						var stateNo = KTUtil.getRandomInt(0, 6);
						var states = [
							'success',
							'brand',
							'danger',
							'success',
							'warning',
							'primary',
							'info'];
						var state = states[stateNo];

						output = '<div class="kt-user-card-v2">\
							<div class="kt-user-card-v2__pic">\
								<div class="kt-badge kt-badge--xl kt-badge--' + state + '">' + data.CompanyAgent.substring(0, 1) + '</div>\
							</div>\
							<div class="kt-user-card-v2__details">\
								<a href="#" class="kt-user-card-v2__name">' + data.CompanyAgent + '</a>\
								<span class="kt-user-card-v2__desc">' + position[pos] + '</span>\
							</div>\
						</div>';
					}

					return output;
                }
            }, {
                field: "Actions",
                width: 80,
                title: "Actions",
                sortable: false,
                autoHide: false,
                overflow: 'visible',
                template: function() {
                    return '\
                        <div class="dropdown">\
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\
                                <i class="flaticon-more-1"></i>\
                            </a>\
                            <div class="dropdown-menu dropdown-menu-right">\
                                <ul class="kt-nav">\
                                    <li class="kt-nav__item">\
                                        <a href="#" class="kt-nav__link">\
                                            <i class="kt-nav__link-icon flaticon2-expand"></i>\
                                            <span class="kt-nav__link-text">View</span>\
                                        </a>\
                                    </li>\
                                    <li class="kt-nav__item">\
                                        <a href="#" class="kt-nav__link">\
                                            <i class="kt-nav__link-icon flaticon2-contract"></i>\
                                            <span class="kt-nav__link-text">Edit</span>\
                                        </a>\
                                    </li>\
                                    <li class="kt-nav__item">\
                                        <a href="#" class="kt-nav__link">\
                                            <i class="kt-nav__link-icon flaticon2-trash"></i>\
                                            <span class="kt-nav__link-text">Delete</span>\
                                        </a>\
                                    </li>\
                                    <li class="kt-nav__item">\
                                        <a href="#" class="kt-nav__link">\
                                            <i class="kt-nav__link-icon flaticon2-mail-1"></i>\
                                            <span class="kt-nav__link-text">Export</span>\
                                        </a>\
                                    </li>\
                                </ul>\
                            </div>\
                        </div>\
                    ';
                }
            }]
        });
    }

    // Calendar Init
    var calendarInit = function() {
        if ($('#kt_calendar').length === 0) {
            return;
        }

        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

        $('#kt_calendar').fullCalendar({
            isRTL: KTUtil.isRTL(),
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            navLinks: true,
            defaultDate: moment('2017-09-15'),
            events: [
                {
                    title: 'Meeting',
                    start: moment('2017-08-28'),
                    description: 'Lorem ipsum dolor sit incid idunt ut',
                    className: "fc-event-light fc-event-solid-warning"
                },
                {
                    title: 'Conference',
                    description: 'Lorem ipsum dolor incid idunt ut labore',
                    start: moment('2017-08-29T13:30:00'),
                    end: moment('2017-08-29T17:30:00'),
                    className: "fc-event-success"
                },
                {
                    title: 'Dinner',
                    start: moment('2017-08-30'),
                    description: 'Lorem ipsum dolor sit tempor incid',
                    className: "fc-event-light  fc-event-solid-danger"
                },
                {
                    title: 'All Day Event',
                    start: moment('2017-09-01'),
                    description: 'Lorem ipsum dolor sit incid idunt ut',
                    className: "fc-event-danger fc-event-solid-focus"
                },
                {
                    title: 'Reporting',
                    description: 'Lorem ipsum dolor incid idunt ut labore',
                    start: moment('2017-09-03T13:30:00'),
                    end: moment('2017-09-04T17:30:00'),
                    className: "fc-event-success"
                },
                {
                    title: 'Company Trip',
                    start: moment('2017-09-05'),
                    end: moment('2017-09-07'),
                    description: 'Lorem ipsum dolor sit tempor incid',
                    className: "fc-event-primary"
                },
                {
                    title: 'ICT Expo 2017 - Product Release',
                    start: moment('2017-09-09'),
                    description: 'Lorem ipsum dolor sit tempor inci',
                    className: "fc-event-light fc-event-solid-primary"
                },
                {
                    title: 'Dinner',
                    start: moment('2017-09-12'),
                    description: 'Lorem ipsum dolor sit amet, conse ctetur'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: moment('2017-09-15T16:00:00'),
                    description: 'Lorem ipsum dolor sit ncididunt ut labore',
                    className: "fc-event-danger"
                },
                {
                    id: 1000,
                    title: 'Repeating Event',
                    description: 'Lorem ipsum dolor sit amet, labore',
                    start: moment('2017-09-18T19:00:00'),
                },
                {
                    title: 'Conference',
                    start: moment('2017-09-20T13:00:00'),
                    end: moment('2017-09-21T19:00:00'),
                    description: 'Lorem ipsum dolor eius mod tempor labore',
                    className: "fc-event-success"
                },
                {
                    title: 'Meeting',
                    start: moment('2017-09-11'),
                    description: 'Lorem ipsum dolor eiu idunt ut labore'
                },
                {
                    title: 'Lunch',
                    start: moment('2017-09-18'),
                    className: "fc-event-info fc-event-solid-success",
                    description: 'Lorem ipsum dolor sit amet, ut labore'
                },
                {
                    title: 'Meeting',
                    start: moment('2017-09-24'),
                    className: "fc-event-warning",
                    description: 'Lorem ipsum conse ctetur adipi scing'
                },
                {
                    title: 'Happy Hour',
                    start: moment('2017-09-24'),
                    className: "fc-event-light fc-event-solid-focus",
                    description: 'Lorem ipsum dolor sit amet, conse ctetur'
                },
                {
                    title: 'Dinner',
                    start: moment('2017-09-24'),
                    className: "fc-event-solid-focus fc-event-light",
                    description: 'Lorem ipsum dolor sit ctetur adipi scing'
                },
                {
                    title: 'Birthday Party',
                    start: moment('2017-09-24'),
                    className: "fc-event-primary",
                    description: 'Lorem ipsum dolor sit amet, scing'
                },
                {
                    title: 'Company Event',
                    start: moment('2017-09-24'),
                    className: "fc-event-danger",
                    description: 'Lorem ipsum dolor sit amet, scing'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: moment('2017-09-26'),
                    className: "fc-event-solid-info fc-event-light",
                    description: 'Lorem ipsum dolor sit amet, labore'
                }
            ],

            eventRender: function(event, element) {
                if (element.hasClass('fc-day-grid-event')) {
                    element.data('content', event.description);
                    element.data('placement', 'top');
                    KTApp.initPopover(element);
                } else if (element.hasClass('fc-time-grid-event')) {
                    element.find('.fc-title').append('<div class="fc-description">' + event.description + '</div>');
                } else if (element.find('.fc-list-item-title').lenght !== 0) {
                    element.find('.fc-list-item-title').append('<div class="fc-description">' + event.description + '</div>');
                }
            }
        });
    }

    // Earnings Sliders
    var earningsSlide = function() {
        var carousel1 = $('#kt_earnings_widget .kt-widget30__head .owl-carousel');
        var carousel2 = $('#kt_earnings_widget .kt-widget30__body .owl-carousel');

        carousel1.find('.carousel').each( function( index ) {
            $(this).attr( 'data-position', index );
        });

        carousel1.owlCarousel({
            rtl: KTUtil.isRTL(),
            center: true,
            loop: true,
            items: 2
        });

        carousel2.owlCarousel({
            rtl: KTUtil.isRTL(),
            items: 1,
            animateIn: 'fadeIn(100)',
            loop: true
        });

        $(document).on('click', '.carousel', function() {
            var index = $(this).attr( 'data-position' );
            if (index) {
                carousel1.trigger('to.owl.carousel', index );
                carousel2.trigger('to.owl.carousel', index );
            }
        });

        carousel1.on('changed.owl.carousel', function () {
            var index = $(this).find('.owl-item.active.center').find('.carousel').attr('data-position');
            if (index) {
                carousel2.trigger('to.owl.carousel', index);
            }
        });

        carousel2.on('changed.owl.carousel', function () {
            var index = $(this).find('.owl-item.active.center').find('.carousel').attr('data-position');
            if (index){
                carousel1.trigger('to.owl.carousel', index);
            }
        });
    }

    return {
        // Init demos
        init: function() {
            // init charts
            dailySales();
            profitShare();
            salesStats();
            salesByApps();
            latestUpdates();
            trendsStats();
            trendsStats2();
            latestTrendsMap();
            revenueChange();
            supportCases();
            supportRequests();
            activitiesChart();
            bandwidthChart1();
            bandwidthChart2();
            adWordsStat();
            financeSummary();
            quickStats();
            orderStatistics();

            // init daterangepicker
            daterangepickerInit();

            // datatables
            datatableLatestOrders();

            // calendar
            calendarInit();

            // earnings slide
            earningsSlide();


            // demo loading
            var loading = new KTDialog({'type': 'loader', 'placement': 'top center', 'message': 'Loading ...'});
            loading.show();

            setTimeout(function() {
                loading.hide();
            }, 3000);
        }
    };
}();

// Class initialization on page load
jQuery(document).ready(function() {
    KTDashboard.init();
});

$(document).ready(function(){
  // Show Color Option
  $('.gear-check').click(function() {
    $('.color-option').fadeToggle();
  });

  $('.option-box .color-option ul li:nth-child(1)').click(function() {
    $('#kt_header, .kt-aside__brand, .kt-asid, .kt-aside-menu, .kt-aside-menu-wrapper').toggleClass('bg1').removeClass('bg2 bg3 bg4 bg5');
  });
  $('.option-box .color-option ul li:nth-child(2)').click(function() {
    $('#kt_header, .kt-aside__brand, .kt-asid, .kt-aside-menu, .kt-aside-menu-wrapper').toggleClass('bg2') .removeClass('bg1 bg3 bg4 bg5');
  });
  $('.option-box .color-option ul li:nth-child(3)').click(function() {
    $('#kt_header, .kt-aside__brand, .kt-asid, .kt-aside-menu, .kt-aside-menu-wrapper').toggleClass('bg3').removeClass('bg2 bg1 bg4 bg5');
  });
  $('.option-box .color-option ul li:nth-child(4)').click(function() {
    $('#kt_header, .kt-aside__brand, .kt-asid, .kt-aside-menu, .kt-aside-menu-wrapper').toggleClass('bg4').removeClass('bg2 bg3 bg1 bg5');
  });
  $('.option-box .color-option ul li:nth-child(5)').click(function() {
    $('#kt_header, .kt-aside__brand, .kt-asid, .kt-aside-menu, .kt-aside-menu-wrapper').toggleClass('bg5').removeClass('bg2 bg3 bg4 bg1');
  });


  // hide loader After Time
  //$(".box-loader").fadeOut(1000)
});

/*!
 * Datepicker for Bootstrap v1.9.0 (https://github.com/uxsolutions/bootstrap-datepicker)
 *
 * Licensed under the Apache License v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 */

!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports?require("jquery"):jQuery)}(function(a,b){function c(){return new Date(Date.UTC.apply(Date,arguments))}function d(){var a=new Date;return c(a.getFullYear(),a.getMonth(),a.getDate())}function e(a,b){return a.getUTCFullYear()===b.getUTCFullYear()&&a.getUTCMonth()===b.getUTCMonth()&&a.getUTCDate()===b.getUTCDate()}function f(c,d){return function(){return d!==b&&a.fn.datepicker.deprecated(d),this[c].apply(this,arguments)}}function g(a){return a&&!isNaN(a.getTime())}function h(b,c){function d(a,b){return b.toLowerCase()}var e,f=a(b).data(),g={},h=new RegExp("^"+c.toLowerCase()+"([A-Z])");c=new RegExp("^"+c.toLowerCase());for(var i in f)c.test(i)&&(e=i.replace(h,d),g[e]=f[i]);return g}function i(b){var c={};if(q[b]||(b=b.split("-")[0],q[b])){var d=q[b];return a.each(p,function(a,b){b in d&&(c[b]=d[b])}),c}}var j=function(){var b={get:function(a){return this.slice(a)[0]},contains:function(a){for(var b=a&&a.valueOf(),c=0,d=this.length;c<d;c++)if(0<=this[c].valueOf()-b&&this[c].valueOf()-b<864e5)return c;return-1},remove:function(a){this.splice(a,1)},replace:function(b){b&&(a.isArray(b)||(b=[b]),this.clear(),this.push.apply(this,b))},clear:function(){this.length=0},copy:function(){var a=new j;return a.replace(this),a}};return function(){var c=[];return c.push.apply(c,arguments),a.extend(c,b),c}}(),k=function(b,c){a.data(b,"datepicker",this),this._events=[],this._secondaryEvents=[],this._process_options(c),this.dates=new j,this.viewDate=this.o.defaultViewDate,this.focusDate=null,this.element=a(b),this.isInput=this.element.is("input"),this.inputField=this.isInput?this.element:this.element.find("input"),this.component=!!this.element.hasClass("date")&&this.element.find(".add-on, .input-group-addon, .input-group-append, .input-group-prepend, .btn"),this.component&&0===this.component.length&&(this.component=!1),this.isInline=!this.component&&this.element.is("div"),this.picker=a(r.template),this._check_template(this.o.templates.leftArrow)&&this.picker.find(".prev").html(this.o.templates.leftArrow),this._check_template(this.o.templates.rightArrow)&&this.picker.find(".next").html(this.o.templates.rightArrow),this._buildEvents(),this._attachEvents(),this.isInline?this.picker.addClass("datepicker-inline").appendTo(this.element):this.picker.addClass("datepicker-dropdown dropdown-menu"),this.o.rtl&&this.picker.addClass("datepicker-rtl"),this.o.calendarWeeks&&this.picker.find(".datepicker-days .datepicker-switch, thead .datepicker-title, tfoot .today, tfoot .clear").attr("colspan",function(a,b){return Number(b)+1}),this._process_options({startDate:this._o.startDate,endDate:this._o.endDate,daysOfWeekDisabled:this.o.daysOfWeekDisabled,daysOfWeekHighlighted:this.o.daysOfWeekHighlighted,datesDisabled:this.o.datesDisabled}),this._allow_update=!1,this.setViewMode(this.o.startView),this._allow_update=!0,this.fillDow(),this.fillMonths(),this.update(),this.isInline&&this.show()};k.prototype={constructor:k,_resolveViewName:function(b){return a.each(r.viewModes,function(c,d){if(b===c||-1!==a.inArray(b,d.names))return b=c,!1}),b},_resolveDaysOfWeek:function(b){return a.isArray(b)||(b=b.split(/[,\s]*/)),a.map(b,Number)},_check_template:function(c){try{if(c===b||""===c)return!1;if((c.match(/[<>]/g)||[]).length<=0)return!0;return a(c).length>0}catch(a){return!1}},_process_options:function(b){this._o=a.extend({},this._o,b);var e=this.o=a.extend({},this._o),f=e.language;q[f]||(f=f.split("-")[0],q[f]||(f=o.language)),e.language=f,e.startView=this._resolveViewName(e.startView),e.minViewMode=this._resolveViewName(e.minViewMode),e.maxViewMode=this._resolveViewName(e.maxViewMode),e.startView=Math.max(this.o.minViewMode,Math.min(this.o.maxViewMode,e.startView)),!0!==e.multidate&&(e.multidate=Number(e.multidate)||!1,!1!==e.multidate&&(e.multidate=Math.max(0,e.multidate))),e.multidateSeparator=String(e.multidateSeparator),e.weekStart%=7,e.weekEnd=(e.weekStart+6)%7;var g=r.parseFormat(e.format);e.startDate!==-1/0&&(e.startDate?e.startDate instanceof Date?e.startDate=this._local_to_utc(this._zero_time(e.startDate)):e.startDate=r.parseDate(e.startDate,g,e.language,e.assumeNearbyYear):e.startDate=-1/0),e.endDate!==1/0&&(e.endDate?e.endDate instanceof Date?e.endDate=this._local_to_utc(this._zero_time(e.endDate)):e.endDate=r.parseDate(e.endDate,g,e.language,e.assumeNearbyYear):e.endDate=1/0),e.daysOfWeekDisabled=this._resolveDaysOfWeek(e.daysOfWeekDisabled||[]),e.daysOfWeekHighlighted=this._resolveDaysOfWeek(e.daysOfWeekHighlighted||[]),e.datesDisabled=e.datesDisabled||[],a.isArray(e.datesDisabled)||(e.datesDisabled=e.datesDisabled.split(",")),e.datesDisabled=a.map(e.datesDisabled,function(a){return r.parseDate(a,g,e.language,e.assumeNearbyYear)});var h=String(e.orientation).toLowerCase().split(/\s+/g),i=e.orientation.toLowerCase();if(h=a.grep(h,function(a){return/^auto|left|right|top|bottom$/.test(a)}),e.orientation={x:"auto",y:"auto"},i&&"auto"!==i)if(1===h.length)switch(h[0]){case"top":case"bottom":e.orientation.y=h[0];break;case"left":case"right":e.orientation.x=h[0]}else i=a.grep(h,function(a){return/^left|right$/.test(a)}),e.orientation.x=i[0]||"auto",i=a.grep(h,function(a){return/^top|bottom$/.test(a)}),e.orientation.y=i[0]||"auto";else;if(e.defaultViewDate instanceof Date||"string"==typeof e.defaultViewDate)e.defaultViewDate=r.parseDate(e.defaultViewDate,g,e.language,e.assumeNearbyYear);else if(e.defaultViewDate){var j=e.defaultViewDate.year||(new Date).getFullYear(),k=e.defaultViewDate.month||0,l=e.defaultViewDate.day||1;e.defaultViewDate=c(j,k,l)}else e.defaultViewDate=d()},_applyEvents:function(a){for(var c,d,e,f=0;f<a.length;f++)c=a[f][0],2===a[f].length?(d=b,e=a[f][1]):3===a[f].length&&(d=a[f][1],e=a[f][2]),c.on(e,d)},_unapplyEvents:function(a){for(var c,d,e,f=0;f<a.length;f++)c=a[f][0],2===a[f].length?(e=b,d=a[f][1]):3===a[f].length&&(e=a[f][1],d=a[f][2]),c.off(d,e)},_buildEvents:function(){var b={keyup:a.proxy(function(b){-1===a.inArray(b.keyCode,[27,37,39,38,40,32,13,9])&&this.update()},this),keydown:a.proxy(this.keydown,this),paste:a.proxy(this.paste,this)};!0===this.o.showOnFocus&&(b.focus=a.proxy(this.show,this)),this.isInput?this._events=[[this.element,b]]:this.component&&this.inputField.length?this._events=[[this.inputField,b],[this.component,{click:a.proxy(this.show,this)}]]:this._events=[[this.element,{click:a.proxy(this.show,this),keydown:a.proxy(this.keydown,this)}]],this._events.push([this.element,"*",{blur:a.proxy(function(a){this._focused_from=a.target},this)}],[this.element,{blur:a.proxy(function(a){this._focused_from=a.target},this)}]),this.o.immediateUpdates&&this._events.push([this.element,{"changeYear changeMonth":a.proxy(function(a){this.update(a.date)},this)}]),this._secondaryEvents=[[this.picker,{click:a.proxy(this.click,this)}],[this.picker,".prev, .next",{click:a.proxy(this.navArrowsClick,this)}],[this.picker,".day:not(.disabled)",{click:a.proxy(this.dayCellClick,this)}],[a(window),{resize:a.proxy(this.place,this)}],[a(document),{"mousedown touchstart":a.proxy(function(a){this.element.is(a.target)||this.element.find(a.target).length||this.picker.is(a.target)||this.picker.find(a.target).length||this.isInline||this.hide()},this)}]]},_attachEvents:function(){this._detachEvents(),this._applyEvents(this._events)},_detachEvents:function(){this._unapplyEvents(this._events)},_attachSecondaryEvents:function(){this._detachSecondaryEvents(),this._applyEvents(this._secondaryEvents)},_detachSecondaryEvents:function(){this._unapplyEvents(this._secondaryEvents)},_trigger:function(b,c){var d=c||this.dates.get(-1),e=this._utc_to_local(d);this.element.trigger({type:b,date:e,viewMode:this.viewMode,dates:a.map(this.dates,this._utc_to_local),format:a.proxy(function(a,b){0===arguments.length?(a=this.dates.length-1,b=this.o.format):"string"==typeof a&&(b=a,a=this.dates.length-1),b=b||this.o.format;var c=this.dates.get(a);return r.formatDate(c,b,this.o.language)},this)})},show:function(){if(!(this.inputField.is(":disabled")||this.inputField.prop("readonly")&&!1===this.o.enableOnReadonly))return this.isInline||this.picker.appendTo(this.o.container),this.place(),this.picker.show(),this._attachSecondaryEvents(),this._trigger("show"),(window.navigator.msMaxTouchPoints||"ontouchstart"in document)&&this.o.disableTouchKeyboard&&a(this.element).blur(),this},hide:function(){return this.isInline||!this.picker.is(":visible")?this:(this.focusDate=null,this.picker.hide().detach(),this._detachSecondaryEvents(),this.setViewMode(this.o.startView),this.o.forceParse&&this.inputField.val()&&this.setValue(),this._trigger("hide"),this)},destroy:function(){return this.hide(),this._detachEvents(),this._detachSecondaryEvents(),this.picker.remove(),delete this.element.data().datepicker,this.isInput||delete this.element.data().date,this},paste:function(b){var c;if(b.originalEvent.clipboardData&&b.originalEvent.clipboardData.types&&-1!==a.inArray("text/plain",b.originalEvent.clipboardData.types))c=b.originalEvent.clipboardData.getData("text/plain");else{if(!window.clipboardData)return;c=window.clipboardData.getData("Text")}this.setDate(c),this.update(),b.preventDefault()},_utc_to_local:function(a){if(!a)return a;var b=new Date(a.getTime()+6e4*a.getTimezoneOffset());return b.getTimezoneOffset()!==a.getTimezoneOffset()&&(b=new Date(a.getTime()+6e4*b.getTimezoneOffset())),b},_local_to_utc:function(a){return a&&new Date(a.getTime()-6e4*a.getTimezoneOffset())},_zero_time:function(a){return a&&new Date(a.getFullYear(),a.getMonth(),a.getDate())},_zero_utc_time:function(a){return a&&c(a.getUTCFullYear(),a.getUTCMonth(),a.getUTCDate())},getDates:function(){return a.map(this.dates,this._utc_to_local)},getUTCDates:function(){return a.map(this.dates,function(a){return new Date(a)})},getDate:function(){return this._utc_to_local(this.getUTCDate())},getUTCDate:function(){var a=this.dates.get(-1);return a!==b?new Date(a):null},clearDates:function(){this.inputField.val(""),this.update(),this._trigger("changeDate"),this.o.autoclose&&this.hide()},setDates:function(){var b=a.isArray(arguments[0])?arguments[0]:arguments;return this.update.apply(this,b),this._trigger("changeDate"),this.setValue(),this},setUTCDates:function(){var b=a.isArray(arguments[0])?arguments[0]:arguments;return this.setDates.apply(this,a.map(b,this._utc_to_local)),this},setDate:f("setDates"),setUTCDate:f("setUTCDates"),remove:f("destroy","Method `remove` is deprecated and will be removed in version 2.0. Use `destroy` instead"),setValue:function(){var a=this.getFormattedDate();return this.inputField.val(a),this},getFormattedDate:function(c){c===b&&(c=this.o.format);var d=this.o.language;return a.map(this.dates,function(a){return r.formatDate(a,c,d)}).join(this.o.multidateSeparator)},getStartDate:function(){return this.o.startDate},setStartDate:function(a){return this._process_options({startDate:a}),this.update(),this.updateNavArrows(),this},getEndDate:function(){return this.o.endDate},setEndDate:function(a){return this._process_options({endDate:a}),this.update(),this.updateNavArrows(),this},setDaysOfWeekDisabled:function(a){return this._process_options({daysOfWeekDisabled:a}),this.update(),this},setDaysOfWeekHighlighted:function(a){return this._process_options({daysOfWeekHighlighted:a}),this.update(),this},setDatesDisabled:function(a){return this._process_options({datesDisabled:a}),this.update(),this},place:function(){if(this.isInline)return this;var b=this.picker.outerWidth(),c=this.picker.outerHeight(),d=a(this.o.container),e=d.width(),f="body"===this.o.container?a(document).scrollTop():d.scrollTop(),g=d.offset(),h=[0];this.element.parents().each(function(){var b=a(this).css("z-index");"auto"!==b&&0!==Number(b)&&h.push(Number(b))});var i=Math.max.apply(Math,h)+this.o.zIndexOffset,j=this.component?this.component.parent().offset():this.element.offset(),k=this.component?this.component.outerHeight(!0):this.element.outerHeight(!1),l=this.component?this.component.outerWidth(!0):this.element.outerWidth(!1),m=j.left-g.left,n=j.top-g.top;"body"!==this.o.container&&(n+=f),this.picker.removeClass("datepicker-orient-top datepicker-orient-bottom datepicker-orient-right datepicker-orient-left"),"auto"!==this.o.orientation.x?(this.picker.addClass("datepicker-orient-"+this.o.orientation.x),"right"===this.o.orientation.x&&(m-=b-l)):j.left<0?(this.picker.addClass("datepicker-orient-left"),m-=j.left-10):m+b>e?(this.picker.addClass("datepicker-orient-right"),m+=l-b):this.o.rtl?this.picker.addClass("datepicker-orient-right"):this.picker.addClass("datepicker-orient-left");var o,p=this.o.orientation.y;if("auto"===p&&(o=-f+n-c,p=o<0?"bottom":"top"),this.picker.addClass("datepicker-orient-"+p),"top"===p?n-=c+parseInt(this.picker.css("padding-top")):n+=k,this.o.rtl){var q=e-(m+l);this.picker.css({top:n,right:q,zIndex:i})}else this.picker.css({top:n,left:m,zIndex:i});return this},_allow_update:!0,update:function(){if(!this._allow_update)return this;var b=this.dates.copy(),c=[],d=!1;return arguments.length?(a.each(arguments,a.proxy(function(a,b){b instanceof Date&&(b=this._local_to_utc(b)),c.push(b)},this)),d=!0):(c=this.isInput?this.element.val():this.element.data("date")||this.inputField.val(),c=c&&this.o.multidate?c.split(this.o.multidateSeparator):[c],delete this.element.data().date),c=a.map(c,a.proxy(function(a){return r.parseDate(a,this.o.format,this.o.language,this.o.assumeNearbyYear)},this)),c=a.grep(c,a.proxy(function(a){return!this.dateWithinRange(a)||!a},this),!0),this.dates.replace(c),this.o.updateViewDate&&(this.dates.length?this.viewDate=new Date(this.dates.get(-1)):this.viewDate<this.o.startDate?this.viewDate=new Date(this.o.startDate):this.viewDate>this.o.endDate?this.viewDate=new Date(this.o.endDate):this.viewDate=this.o.defaultViewDate),d?(this.setValue(),this.element.change()):this.dates.length&&String(b)!==String(this.dates)&&d&&(this._trigger("changeDate"),this.element.change()),!this.dates.length&&b.length&&(this._trigger("clearDate"),this.element.change()),this.fill(),this},fillDow:function(){if(this.o.showWeekDays){var b=this.o.weekStart,c="<tr>";for(this.o.calendarWeeks&&(c+='<th class="cw">&#160;</th>');b<this.o.weekStart+7;)c+='<th class="dow',-1!==a.inArray(b,this.o.daysOfWeekDisabled)&&(c+=" disabled"),c+='">'+q[this.o.language].daysMin[b++%7]+"</th>";c+="</tr>",this.picker.find(".datepicker-days thead").append(c)}},fillMonths:function(){for(var a,b=this._utc_to_local(this.viewDate),c="",d=0;d<12;d++)a=b&&b.getMonth()===d?" focused":"",c+='<span class="month'+a+'">'+q[this.o.language].monthsShort[d]+"</span>";this.picker.find(".datepicker-months td").html(c)},setRange:function(b){b&&b.length?this.range=a.map(b,function(a){return a.valueOf()}):delete this.range,this.fill()},getClassNames:function(b){var c=[],f=this.viewDate.getUTCFullYear(),g=this.viewDate.getUTCMonth(),h=d();return b.getUTCFullYear()<f||b.getUTCFullYear()===f&&b.getUTCMonth()<g?c.push("old"):(b.getUTCFullYear()>f||b.getUTCFullYear()===f&&b.getUTCMonth()>g)&&c.push("new"),this.focusDate&&b.valueOf()===this.focusDate.valueOf()&&c.push("focused"),this.o.todayHighlight&&e(b,h)&&c.push("today"),-1!==this.dates.contains(b)&&c.push("active"),this.dateWithinRange(b)||c.push("disabled"),this.dateIsDisabled(b)&&c.push("disabled","disabled-date"),-1!==a.inArray(b.getUTCDay(),this.o.daysOfWeekHighlighted)&&c.push("highlighted"),this.range&&(b>this.range[0]&&b<this.range[this.range.length-1]&&c.push("range"),-1!==a.inArray(b.valueOf(),this.range)&&c.push("selected"),b.valueOf()===this.range[0]&&c.push("range-start"),b.valueOf()===this.range[this.range.length-1]&&c.push("range-end")),c},_fill_yearsView:function(c,d,e,f,g,h,i){for(var j,k,l,m="",n=e/10,o=this.picker.find(c),p=Math.floor(f/e)*e,q=p+9*n,r=Math.floor(this.viewDate.getFullYear()/n)*n,s=a.map(this.dates,function(a){return Math.floor(a.getUTCFullYear()/n)*n}),t=p-n;t<=q+n;t+=n)j=[d],k=null,t===p-n?j.push("old"):t===q+n&&j.push("new"),-1!==a.inArray(t,s)&&j.push("active"),(t<g||t>h)&&j.push("disabled"),t===r&&j.push("focused"),i!==a.noop&&(l=i(new Date(t,0,1)),l===b?l={}:"boolean"==typeof l?l={enabled:l}:"string"==typeof l&&(l={classes:l}),!1===l.enabled&&j.push("disabled"),l.classes&&(j=j.concat(l.classes.split(/\s+/))),l.tooltip&&(k=l.tooltip)),m+='<span class="'+j.join(" ")+'"'+(k?' title="'+k+'"':"")+">"+t+"</span>";o.find(".datepicker-switch").text(p+"-"+q),o.find("td").html(m)},fill:function(){var e,f,g=new Date(this.viewDate),h=g.getUTCFullYear(),i=g.getUTCMonth(),j=this.o.startDate!==-1/0?this.o.startDate.getUTCFullYear():-1/0,k=this.o.startDate!==-1/0?this.o.startDate.getUTCMonth():-1/0,l=this.o.endDate!==1/0?this.o.endDate.getUTCFullYear():1/0,m=this.o.endDate!==1/0?this.o.endDate.getUTCMonth():1/0,n=q[this.o.language].today||q.en.today||"",o=q[this.o.language].clear||q.en.clear||"",p=q[this.o.language].titleFormat||q.en.titleFormat,s=d(),t=(!0===this.o.todayBtn||"linked"===this.o.todayBtn)&&s>=this.o.startDate&&s<=this.o.endDate&&!this.weekOfDateIsDisabled(s);if(!isNaN(h)&&!isNaN(i)){this.picker.find(".datepicker-days .datepicker-switch").text(r.formatDate(g,p,this.o.language)),this.picker.find("tfoot .today").text(n).css("display",t?"table-cell":"none"),this.picker.find("tfoot .clear").text(o).css("display",!0===this.o.clearBtn?"table-cell":"none"),this.picker.find("thead .datepicker-title").text(this.o.title).css("display","string"==typeof this.o.title&&""!==this.o.title?"table-cell":"none"),this.updateNavArrows(),this.fillMonths();var u=c(h,i,0),v=u.getUTCDate();u.setUTCDate(v-(u.getUTCDay()-this.o.weekStart+7)%7);var w=new Date(u);u.getUTCFullYear()<100&&w.setUTCFullYear(u.getUTCFullYear()),w.setUTCDate(w.getUTCDate()+42),w=w.valueOf();for(var x,y,z=[];u.valueOf()<w;){if((x=u.getUTCDay())===this.o.weekStart&&(z.push("<tr>"),this.o.calendarWeeks)){var A=new Date(+u+(this.o.weekStart-x-7)%7*864e5),B=new Date(Number(A)+(11-A.getUTCDay())%7*864e5),C=new Date(Number(C=c(B.getUTCFullYear(),0,1))+(11-C.getUTCDay())%7*864e5),D=(B-C)/864e5/7+1;z.push('<td class="cw">'+D+"</td>")}y=this.getClassNames(u),y.push("day");var E=u.getUTCDate();this.o.beforeShowDay!==a.noop&&(f=this.o.beforeShowDay(this._utc_to_local(u)),f===b?f={}:"boolean"==typeof f?f={enabled:f}:"string"==typeof f&&(f={classes:f}),!1===f.enabled&&y.push("disabled"),f.classes&&(y=y.concat(f.classes.split(/\s+/))),f.tooltip&&(e=f.tooltip),f.content&&(E=f.content)),y=a.isFunction(a.uniqueSort)?a.uniqueSort(y):a.unique(y),z.push('<td class="'+y.join(" ")+'"'+(e?' title="'+e+'"':"")+' data-date="'+u.getTime().toString()+'">'+E+"</td>"),e=null,x===this.o.weekEnd&&z.push("</tr>"),u.setUTCDate(u.getUTCDate()+1)}this.picker.find(".datepicker-days tbody").html(z.join(""));var F=q[this.o.language].monthsTitle||q.en.monthsTitle||"Months",G=this.picker.find(".datepicker-months").find(".datepicker-switch").text(this.o.maxViewMode<2?F:h).end().find("tbody span").removeClass("active");if(a.each(this.dates,function(a,b){b.getUTCFullYear()===h&&G.eq(b.getUTCMonth()).addClass("active")}),(h<j||h>l)&&G.addClass("disabled"),h===j&&G.slice(0,k).addClass("disabled"),h===l&&G.slice(m+1).addClass("disabled"),this.o.beforeShowMonth!==a.noop){var H=this;a.each(G,function(c,d){var e=new Date(h,c,1),f=H.o.beforeShowMonth(e);f===b?f={}:"boolean"==typeof f?f={enabled:f}:"string"==typeof f&&(f={classes:f}),!1!==f.enabled||a(d).hasClass("disabled")||a(d).addClass("disabled"),f.classes&&a(d).addClass(f.classes),f.tooltip&&a(d).prop("title",f.tooltip)})}this._fill_yearsView(".datepicker-years","year",10,h,j,l,this.o.beforeShowYear),this._fill_yearsView(".datepicker-decades","decade",100,h,j,l,this.o.beforeShowDecade),this._fill_yearsView(".datepicker-centuries","century",1e3,h,j,l,this.o.beforeShowCentury)}},updateNavArrows:function(){if(this._allow_update){var a,b,c=new Date(this.viewDate),d=c.getUTCFullYear(),e=c.getUTCMonth(),f=this.o.startDate!==-1/0?this.o.startDate.getUTCFullYear():-1/0,g=this.o.startDate!==-1/0?this.o.startDate.getUTCMonth():-1/0,h=this.o.endDate!==1/0?this.o.endDate.getUTCFullYear():1/0,i=this.o.endDate!==1/0?this.o.endDate.getUTCMonth():1/0,j=1;switch(this.viewMode){case 4:j*=10;case 3:j*=10;case 2:j*=10;case 1:a=Math.floor(d/j)*j<=f,b=Math.floor(d/j)*j+j>h;break;case 0:a=d<=f&&e<=g,b=d>=h&&e>=i}this.picker.find(".prev").toggleClass("disabled",a),this.picker.find(".next").toggleClass("disabled",b)}},click:function(b){b.preventDefault(),b.stopPropagation();var e,f,g,h;e=a(b.target),e.hasClass("datepicker-switch")&&this.viewMode!==this.o.maxViewMode&&this.setViewMode(this.viewMode+1),e.hasClass("today")&&!e.hasClass("day")&&(this.setViewMode(0),this._setDate(d(),"linked"===this.o.todayBtn?null:"view")),e.hasClass("clear")&&this.clearDates(),e.hasClass("disabled")||(e.hasClass("month")||e.hasClass("year")||e.hasClass("decade")||e.hasClass("century"))&&(this.viewDate.setUTCDate(1),f=1,1===this.viewMode?(h=e.parent().find("span").index(e),g=this.viewDate.getUTCFullYear(),this.viewDate.setUTCMonth(h)):(h=0,g=Number(e.text()),this.viewDate.setUTCFullYear(g)),this._trigger(r.viewModes[this.viewMode-1].e,this.viewDate),this.viewMode===this.o.minViewMode?this._setDate(c(g,h,f)):(this.setViewMode(this.viewMode-1),this.fill())),this.picker.is(":visible")&&this._focused_from&&this._focused_from.focus(),delete this._focused_from},dayCellClick:function(b){var c=a(b.currentTarget),d=c.data("date"),e=new Date(d);this.o.updateViewDate&&(e.getUTCFullYear()!==this.viewDate.getUTCFullYear()&&this._trigger("changeYear",this.viewDate),e.getUTCMonth()!==this.viewDate.getUTCMonth()&&this._trigger("changeMonth",this.viewDate)),this._setDate(e)},navArrowsClick:function(b){var c=a(b.currentTarget),d=c.hasClass("prev")?-1:1;0!==this.viewMode&&(d*=12*r.viewModes[this.viewMode].navStep),this.viewDate=this.moveMonth(this.viewDate,d),this._trigger(r.viewModes[this.viewMode].e,this.viewDate),this.fill()},_toggle_multidate:function(a){var b=this.dates.contains(a);if(a||this.dates.clear(),-1!==b?(!0===this.o.multidate||this.o.multidate>1||this.o.toggleActive)&&this.dates.remove(b):!1===this.o.multidate?(this.dates.clear(),this.dates.push(a)):this.dates.push(a),"number"==typeof this.o.multidate)for(;this.dates.length>this.o.multidate;)this.dates.remove(0)},_setDate:function(a,b){b&&"date"!==b||this._toggle_multidate(a&&new Date(a)),(!b&&this.o.updateViewDate||"view"===b)&&(this.viewDate=a&&new Date(a)),this.fill(),this.setValue(),b&&"view"===b||this._trigger("changeDate"),this.inputField.trigger("change"),!this.o.autoclose||b&&"date"!==b||this.hide()},moveDay:function(a,b){var c=new Date(a);return c.setUTCDate(a.getUTCDate()+b),c},moveWeek:function(a,b){return this.moveDay(a,7*b)},moveMonth:function(a,b){if(!g(a))return this.o.defaultViewDate;if(!b)return a;var c,d,e=new Date(a.valueOf()),f=e.getUTCDate(),h=e.getUTCMonth(),i=Math.abs(b);if(b=b>0?1:-1,1===i)d=-1===b?function(){return e.getUTCMonth()===h}:function(){return e.getUTCMonth()!==c},c=h+b,e.setUTCMonth(c),c=(c+12)%12;else{for(var j=0;j<i;j++)e=this.moveMonth(e,b);c=e.getUTCMonth(),e.setUTCDate(f),d=function(){return c!==e.getUTCMonth()}}for(;d();)e.setUTCDate(--f),e.setUTCMonth(c);return e},moveYear:function(a,b){return this.moveMonth(a,12*b)},moveAvailableDate:function(a,b,c){do{if(a=this[c](a,b),!this.dateWithinRange(a))return!1;c="moveDay"}while(this.dateIsDisabled(a));return a},weekOfDateIsDisabled:function(b){return-1!==a.inArray(b.getUTCDay(),this.o.daysOfWeekDisabled)},dateIsDisabled:function(b){return this.weekOfDateIsDisabled(b)||a.grep(this.o.datesDisabled,function(a){return e(b,a)}).length>0},dateWithinRange:function(a){return a>=this.o.startDate&&a<=this.o.endDate},keydown:function(a){if(!this.picker.is(":visible"))return void(40!==a.keyCode&&27!==a.keyCode||(this.show(),a.stopPropagation()));var b,c,d=!1,e=this.focusDate||this.viewDate;switch(a.keyCode){case 27:this.focusDate?(this.focusDate=null,this.viewDate=this.dates.get(-1)||this.viewDate,this.fill()):this.hide(),a.preventDefault(),a.stopPropagation();break;case 37:case 38:case 39:case 40:if(!this.o.keyboardNavigation||7===this.o.daysOfWeekDisabled.length)break;b=37===a.keyCode||38===a.keyCode?-1:1,0===this.viewMode?a.ctrlKey?(c=this.moveAvailableDate(e,b,"moveYear"))&&this._trigger("changeYear",this.viewDate):a.shiftKey?(c=this.moveAvailableDate(e,b,"moveMonth"))&&this._trigger("changeMonth",this.viewDate):37===a.keyCode||39===a.keyCode?c=this.moveAvailableDate(e,b,"moveDay"):this.weekOfDateIsDisabled(e)||(c=this.moveAvailableDate(e,b,"moveWeek")):1===this.viewMode?(38!==a.keyCode&&40!==a.keyCode||(b*=4),c=this.moveAvailableDate(e,b,"moveMonth")):2===this.viewMode&&(38!==a.keyCode&&40!==a.keyCode||(b*=4),c=this.moveAvailableDate(e,b,"moveYear")),c&&(this.focusDate=this.viewDate=c,this.setValue(),this.fill(),a.preventDefault());break;case 13:if(!this.o.forceParse)break;e=this.focusDate||this.dates.get(-1)||this.viewDate,this.o.keyboardNavigation&&(this._toggle_multidate(e),d=!0),this.focusDate=null,this.viewDate=this.dates.get(-1)||this.viewDate,this.setValue(),this.fill(),this.picker.is(":visible")&&(a.preventDefault(),a.stopPropagation(),this.o.autoclose&&this.hide());break;case 9:this.focusDate=null,this.viewDate=this.dates.get(-1)||this.viewDate,this.fill(),this.hide()}d&&(this.dates.length?this._trigger("changeDate"):this._trigger("clearDate"),this.inputField.trigger("change"))},setViewMode:function(a){this.viewMode=a,this.picker.children("div").hide().filter(".datepicker-"+r.viewModes[this.viewMode].clsName).show(),this.updateNavArrows(),this._trigger("changeViewMode",new Date(this.viewDate))}};var l=function(b,c){a.data(b,"datepicker",this),this.element=a(b),this.inputs=a.map(c.inputs,function(a){return a.jquery?a[0]:a}),delete c.inputs,this.keepEmptyValues=c.keepEmptyValues,delete c.keepEmptyValues,n.call(a(this.inputs),c).on("changeDate",a.proxy(this.dateUpdated,this)),this.pickers=a.map(this.inputs,function(b){return a.data(b,"datepicker")}),this.updateDates()};l.prototype={updateDates:function(){this.dates=a.map(this.pickers,function(a){return a.getUTCDate()}),this.updateRanges()},updateRanges:function(){var b=a.map(this.dates,function(a){return a.valueOf()});a.each(this.pickers,function(a,c){c.setRange(b)})},clearDates:function(){a.each(this.pickers,function(a,b){b.clearDates()})},dateUpdated:function(c){if(!this.updating){this.updating=!0;var d=a.data(c.target,"datepicker");if(d!==b){var e=d.getUTCDate(),f=this.keepEmptyValues,g=a.inArray(c.target,this.inputs),h=g-1,i=g+1,j=this.inputs.length;if(-1!==g){if(a.each(this.pickers,function(a,b){b.getUTCDate()||b!==d&&f||b.setUTCDate(e)}),e<this.dates[h])for(;h>=0&&e<this.dates[h];)this.pickers[h--].setUTCDate(e);else if(e>this.dates[i])for(;i<j&&e>this.dates[i];)this.pickers[i++].setUTCDate(e);this.updateDates(),delete this.updating}}}},destroy:function(){a.map(this.pickers,function(a){a.destroy()}),a(this.inputs).off("changeDate",this.dateUpdated),delete this.element.data().datepicker},remove:f("destroy","Method `remove` is deprecated and will be removed in version 2.0. Use `destroy` instead")};var m=a.fn.datepicker,n=function(c){var d=Array.apply(null,arguments);d.shift();var e;if(this.each(function(){var b=a(this),f=b.data("datepicker"),g="object"==typeof c&&c;if(!f){var j=h(this,"date"),m=a.extend({},o,j,g),n=i(m.language),p=a.extend({},o,n,j,g);b.hasClass("input-daterange")||p.inputs?(a.extend(p,{inputs:p.inputs||b.find("input").toArray()}),f=new l(this,p)):f=new k(this,p),b.data("datepicker",f)}"string"==typeof c&&"function"==typeof f[c]&&(e=f[c].apply(f,d))}),e===b||e instanceof k||e instanceof l)return this;if(this.length>1)throw new Error("Using only allowed for the collection of a single element ("+c+" function)");return e};a.fn.datepicker=n;var o=a.fn.datepicker.defaults={assumeNearbyYear:!1,autoclose:!1,beforeShowDay:a.noop,beforeShowMonth:a.noop,beforeShowYear:a.noop,beforeShowDecade:a.noop,beforeShowCentury:a.noop,calendarWeeks:!1,clearBtn:!1,toggleActive:!1,daysOfWeekDisabled:[],daysOfWeekHighlighted:[],datesDisabled:[],endDate:1/0,forceParse:!0,format:"mm/dd/yyyy",keepEmptyValues:!1,keyboardNavigation:!0,language:"en",minViewMode:0,maxViewMode:4,multidate:!1,multidateSeparator:",",orientation:"auto",rtl:!1,startDate:-1/0,startView:0,todayBtn:!1,todayHighlight:!1,updateViewDate:!0,weekStart:0,disableTouchKeyboard:!1,enableOnReadonly:!0,showOnFocus:!0,zIndexOffset:10,container:"body",immediateUpdates:!1,title:"",templates:{leftArrow:"&#x00AB;",rightArrow:"&#x00BB;"},showWeekDays:!0},p=a.fn.datepicker.locale_opts=["format","rtl","weekStart"];a.fn.datepicker.Constructor=k;var q=a.fn.datepicker.dates={en:{days:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],daysShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],daysMin:["Su","Mo","Tu","We","Th","Fr","Sa"],months:["January","February","March","April","May","June","July","August","September","October","November","December"],monthsShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],today:"Today",clear:"Clear",titleFormat:"MM yyyy"}},r={viewModes:[{names:["days","month"],clsName:"days",e:"changeMonth"},{names:["months","year"],clsName:"months",e:"changeYear",navStep:1},{names:["years","decade"],clsName:"years",e:"changeDecade",navStep:10},{names:["decades","century"],clsName:"decades",e:"changeCentury",navStep:100},{names:["centuries","millennium"],clsName:"centuries",e:"changeMillennium",navStep:1e3}],validParts:/dd?|DD?|mm?|MM?|yy(?:yy)?/g,nonpunctuation:/[^ -\/:-@\u5e74\u6708\u65e5\[-`{-~\t\n\r]+/g,parseFormat:function(a){if("function"==typeof a.toValue&&"function"==typeof a.toDisplay)return a;var b=a.replace(this.validParts,"\0").split("\0"),c=a.match(this.validParts);if(!b||!b.length||!c||0===c.length)throw new Error("Invalid date format.");return{separators:b,parts:c}},parseDate:function(c,e,f,g){function h(a,b){return!0===b&&(b=10),a<100&&(a+=2e3)>(new Date).getFullYear()+b&&(a-=100),a}function i(){var a=this.slice(0,j[n].length),b=j[n].slice(0,a.length);return a.toLowerCase()===b.toLowerCase()}if(!c)return b;if(c instanceof Date)return c;if("string"==typeof e&&(e=r.parseFormat(e)),e.toValue)return e.toValue(c,e,f);var j,l,m,n,o,p={d:"moveDay",m:"moveMonth",w:"moveWeek",y:"moveYear"},s={yesterday:"-1d",today:"+0d",tomorrow:"+1d"};if(c in s&&(c=s[c]),/^[\-+]\d+[dmwy]([\s,]+[\-+]\d+[dmwy])*$/i.test(c)){for(j=c.match(/([\-+]\d+)([dmwy])/gi),c=new Date,n=0;n<j.length;n++)l=j[n].match(/([\-+]\d+)([dmwy])/i),m=Number(l[1]),o=p[l[2].toLowerCase()],c=k.prototype[o](c,m);return k.prototype._zero_utc_time(c)}j=c&&c.match(this.nonpunctuation)||[];var t,u,v={},w=["yyyy","yy","M","MM","m","mm","d","dd"],x={yyyy:function(a,b){return a.setUTCFullYear(g?h(b,g):b)},m:function(a,b){if(isNaN(a))return a;for(b-=1;b<0;)b+=12;for(b%=12,a.setUTCMonth(b);a.getUTCMonth()!==b;)a.setUTCDate(a.getUTCDate()-1);return a},d:function(a,b){return a.setUTCDate(b)}};x.yy=x.yyyy,x.M=x.MM=x.mm=x.m,x.dd=x.d,c=d();var y=e.parts.slice();if(j.length!==y.length&&(y=a(y).filter(function(b,c){return-1!==a.inArray(c,w)}).toArray()),j.length===y.length){var z;for(n=0,z=y.length;n<z;n++){if(t=parseInt(j[n],10),l=y[n],isNaN(t))switch(l){case"MM":u=a(q[f].months).filter(i),t=a.inArray(u[0],q[f].months)+1;break;case"M":u=a(q[f].monthsShort).filter(i),t=a.inArray(u[0],q[f].monthsShort)+1}v[l]=t}var A,B;for(n=0;n<w.length;n++)(B=w[n])in v&&!isNaN(v[B])&&(A=new Date(c),x[B](A,v[B]),isNaN(A)||(c=A))}return c},formatDate:function(b,c,d){if(!b)return"";if("string"==typeof c&&(c=r.parseFormat(c)),c.toDisplay)return c.toDisplay(b,c,d);var e={d:b.getUTCDate(),D:q[d].daysShort[b.getUTCDay()],DD:q[d].days[b.getUTCDay()],m:b.getUTCMonth()+1,M:q[d].monthsShort[b.getUTCMonth()],MM:q[d].months[b.getUTCMonth()],yy:b.getUTCFullYear().toString().substring(2),yyyy:b.getUTCFullYear()};e.dd=(e.d<10?"0":"")+e.d,e.mm=(e.m<10?"0":"")+e.m,b=[];for(var f=a.extend([],c.separators),g=0,h=c.parts.length;g<=h;g++)f.length&&b.push(f.shift()),b.push(e[c.parts[g]]);return b.join("")},
headTemplate:'<thead><tr><th colspan="7" class="datepicker-title"></th></tr><tr><th class="prev">'+o.templates.leftArrow+'</th><th colspan="5" class="datepicker-switch"></th><th class="next">'+o.templates.rightArrow+"</th></tr></thead>",contTemplate:'<tbody><tr><td colspan="7"></td></tr></tbody>',footTemplate:'<tfoot><tr><th colspan="7" class="today"></th></tr><tr><th colspan="7" class="clear"></th></tr></tfoot>'};r.template='<div class="datepicker"><div class="datepicker-days"><table class="table-condensed">'+r.headTemplate+"<tbody></tbody>"+r.footTemplate+'</table></div><div class="datepicker-months"><table class="table-condensed">'+r.headTemplate+r.contTemplate+r.footTemplate+'</table></div><div class="datepicker-years"><table class="table-condensed">'+r.headTemplate+r.contTemplate+r.footTemplate+'</table></div><div class="datepicker-decades"><table class="table-condensed">'+r.headTemplate+r.contTemplate+r.footTemplate+'</table></div><div class="datepicker-centuries"><table class="table-condensed">'+r.headTemplate+r.contTemplate+r.footTemplate+"</table></div></div>",a.fn.datepicker.DPGlobal=r,a.fn.datepicker.noConflict=function(){return a.fn.datepicker=m,this},a.fn.datepicker.version="1.9.0",a.fn.datepicker.deprecated=function(a){var b=window.console;b&&b.warn&&b.warn("DEPRECATED: "+a)},a(document).on("focus.datepicker.data-api click.datepicker.data-api",'[data-provide="datepicker"]',function(b){var c=a(this);c.data("datepicker")||(b.preventDefault(),n.call(c,"show"))}),a(function(){n.call(a('[data-provide="datepicker-inline"]'))})});
"use strict";
$.fn.datepicker.defaults.zIndexOffset = 10;
(function(a){if(typeof define==="function"&&define.amd){define(["jquery"],a)}else{if(typeof exports==="object"){a(require("jquery"))}else{a(jQuery)}}}(function(d,f){if(!("indexOf" in Array.prototype)){Array.prototype.indexOf=function(k,j){if(j===f){j=0}if(j<0){j+=this.length}if(j<0){j=0}for(var l=this.length;j<l;j++){if(j in this&&this[j]===k){return j}}return -1}}function a(){var q,k,p,l,j,n,m,o;k=(new Date()).toString();p=((m=k.split("(")[1])!=null?m.slice(0,-1):0)||k.split(" ");if(p instanceof Array){n=[];for(var l=0,j=p.length;l<j;l++){o=p[l];if((q=(m=o.match(/\b[A-Z]+\b/))!==null)?m[0]:0){n.push(q)}}p=n.pop()}return p}function h(){return new Date(Date.UTC.apply(Date,arguments))}var g=function(k,j){var m=this;this.element=d(k);this.container=j.container||"body";this.language=j.language||this.element.data("date-language")||"en";this.language=this.language in e?this.language:this.language.split("-")[0];this.language=this.language in e?this.language:"en";this.isRTL=e[this.language].rtl||false;this.formatType=j.formatType||this.element.data("format-type")||"standard";this.format=c.parseFormat(j.format||this.element.data("date-format")||e[this.language].format||c.getDefaultFormat(this.formatType,"input"),this.formatType);this.isInline=false;this.isVisible=false;this.isInput=this.element.is("input");this.fontAwesome=j.fontAwesome||this.element.data("font-awesome")||false;this.bootcssVer=j.bootcssVer||(this.isInput?(this.element.is(".form-control")?3:2):(this.bootcssVer=this.element.is(".input-group")?3:2));this.component=this.element.is(".date")?(this.bootcssVer===3?this.element.find(".input-group-addon .glyphicon-th, .input-group-addon .glyphicon-time, .input-group-addon .glyphicon-remove, .input-group-addon .glyphicon-calendar, .input-group-addon .fa-calendar, .input-group-addon .fa-clock-o").parent():this.element.find(".add-on .icon-th, .add-on .icon-time, .add-on .icon-calendar, .add-on .fa-calendar, .add-on .fa-clock-o").parent()):false;this.componentReset=this.element.is(".date")?(this.bootcssVer===3?this.element.find(".input-group-addon .glyphicon-remove, .input-group-addon .fa-times").parent():this.element.find(".add-on .icon-remove, .add-on .fa-times").parent()):false;this.hasInput=this.component&&this.element.find("input").length;if(this.component&&this.component.length===0){this.component=false}this.linkField=j.linkField||this.element.data("link-field")||false;this.linkFormat=c.parseFormat(j.linkFormat||this.element.data("link-format")||c.getDefaultFormat(this.formatType,"link"),this.formatType);this.minuteStep=j.minuteStep||this.element.data("minute-step")||5;this.pickerPosition=j.pickerPosition||this.element.data("picker-position")||"bottom-right";this.showMeridian=j.showMeridian||this.element.data("show-meridian")||false;this.initialDate=j.initialDate||new Date();this.zIndex=j.zIndex||this.element.data("z-index")||f;this.title=typeof j.title==="undefined"?false:j.title;this.timezone=j.timezone||a();this.icons={leftArrow:this.fontAwesome?"fa-arrow-left":(this.bootcssVer===3?"glyphicon-arrow-left":"icon-arrow-left"),rightArrow:this.fontAwesome?"fa-arrow-right":(this.bootcssVer===3?"glyphicon-arrow-right":"icon-arrow-right")};this.icontype=this.fontAwesome?"fa":"glyphicon";this._attachEvents();this.clickedOutside=function(n){if(d(n.target).closest(".datetimepicker").length===0){m.hide()}};this.formatViewType="datetime";if("formatViewType" in j){this.formatViewType=j.formatViewType}else{if("formatViewType" in this.element.data()){this.formatViewType=this.element.data("formatViewType")}}this.minView=0;if("minView" in j){this.minView=j.minView}else{if("minView" in this.element.data()){this.minView=this.element.data("min-view")}}this.minView=c.convertViewMode(this.minView);this.maxView=c.modes.length-1;if("maxView" in j){this.maxView=j.maxView}else{if("maxView" in this.element.data()){this.maxView=this.element.data("max-view")}}this.maxView=c.convertViewMode(this.maxView);this.wheelViewModeNavigation=false;if("wheelViewModeNavigation" in j){this.wheelViewModeNavigation=j.wheelViewModeNavigation}else{if("wheelViewModeNavigation" in this.element.data()){this.wheelViewModeNavigation=this.element.data("view-mode-wheel-navigation")}}this.wheelViewModeNavigationInverseDirection=false;if("wheelViewModeNavigationInverseDirection" in j){this.wheelViewModeNavigationInverseDirection=j.wheelViewModeNavigationInverseDirection}else{if("wheelViewModeNavigationInverseDirection" in this.element.data()){this.wheelViewModeNavigationInverseDirection=this.element.data("view-mode-wheel-navigation-inverse-dir")}}this.wheelViewModeNavigationDelay=100;if("wheelViewModeNavigationDelay" in j){this.wheelViewModeNavigationDelay=j.wheelViewModeNavigationDelay}else{if("wheelViewModeNavigationDelay" in this.element.data()){this.wheelViewModeNavigationDelay=this.element.data("view-mode-wheel-navigation-delay")}}this.startViewMode=2;if("startView" in j){this.startViewMode=j.startView}else{if("startView" in this.element.data()){this.startViewMode=this.element.data("start-view")}}this.startViewMode=c.convertViewMode(this.startViewMode);this.viewMode=this.startViewMode;this.viewSelect=this.minView;if("viewSelect" in j){this.viewSelect=j.viewSelect}else{if("viewSelect" in this.element.data()){this.viewSelect=this.element.data("view-select")}}this.viewSelect=c.convertViewMode(this.viewSelect);this.forceParse=true;if("forceParse" in j){this.forceParse=j.forceParse}else{if("dateForceParse" in this.element.data()){this.forceParse=this.element.data("date-force-parse")}}var l=this.bootcssVer===3?c.templateV3:c.template;while(l.indexOf("{iconType}")!==-1){l=l.replace("{iconType}",this.icontype)}while(l.indexOf("{leftArrow}")!==-1){l=l.replace("{leftArrow}",this.icons.leftArrow)}while(l.indexOf("{rightArrow}")!==-1){l=l.replace("{rightArrow}",this.icons.rightArrow)}this.picker=d(l).appendTo(this.isInline?this.element:this.container).on({click:d.proxy(this.click,this),mousedown:d.proxy(this.mousedown,this)});if(this.wheelViewModeNavigation){if(d.fn.mousewheel){this.picker.on({mousewheel:d.proxy(this.mousewheel,this)})}else{console.log("Mouse Wheel event is not supported. Please include the jQuery Mouse Wheel plugin before enabling this option")}}if(this.isInline){this.picker.addClass("datetimepicker-inline")}else{this.picker.addClass("datetimepicker-dropdown-"+this.pickerPosition+" dropdown-menu")}if(this.isRTL){this.picker.addClass("datetimepicker-rtl");var i=this.bootcssVer===3?".prev span, .next span":".prev i, .next i";this.picker.find(i).toggleClass(this.icons.leftArrow+" "+this.icons.rightArrow)}d(document).on("mousedown touchend",this.clickedOutside);this.autoclose=false;if("autoclose" in j){this.autoclose=j.autoclose}else{if("dateAutoclose" in this.element.data()){this.autoclose=this.element.data("date-autoclose")}}this.keyboardNavigation=true;if("keyboardNavigation" in j){this.keyboardNavigation=j.keyboardNavigation}else{if("dateKeyboardNavigation" in this.element.data()){this.keyboardNavigation=this.element.data("date-keyboard-navigation")}}this.todayBtn=(j.todayBtn||this.element.data("date-today-btn")||false);this.clearBtn=(j.clearBtn||this.element.data("date-clear-btn")||false);this.todayHighlight=(j.todayHighlight||this.element.data("date-today-highlight")||false);this.weekStart=0;if(typeof j.weekStart!=="undefined"){this.weekStart=j.weekStart}else{if(typeof this.element.data("date-weekstart")!=="undefined"){this.weekStart=this.element.data("date-weekstart")}else{if(typeof e[this.language].weekStart!=="undefined"){this.weekStart=e[this.language].weekStart}}}this.weekStart=this.weekStart%7;this.weekEnd=((this.weekStart+6)%7);this.onRenderDay=function(n){var p=(j.onRenderDay||function(){return[]})(n);if(typeof p==="string"){p=[p]}var o=["day"];return o.concat((p?p:[]))};this.onRenderHour=function(n){var p=(j.onRenderHour||function(){return[]})(n);var o=["hour"];if(typeof p==="string"){p=[p]}return o.concat((p?p:[]))};this.onRenderMinute=function(n){var p=(j.onRenderMinute||function(){return[]})(n);var o=["minute"];if(typeof p==="string"){p=[p]}if(n<this.startDate||n>this.endDate){o.push("disabled")}else{if(Math.floor(this.date.getUTCMinutes()/this.minuteStep)===Math.floor(n.getUTCMinutes()/this.minuteStep)){o.push("active")}}return o.concat((p?p:[]))};this.onRenderYear=function(o){var q=(j.onRenderYear||function(){return[]})(o);var p=["year"];if(typeof q==="string"){q=[q]}if(this.date.getUTCFullYear()===o.getUTCFullYear()){p.push("active")}var n=o.getUTCFullYear();var r=this.endDate.getUTCFullYear();if(o<this.startDate||n>r){p.push("disabled")}return p.concat((q?q:[]))};this.onRenderMonth=function(n){var p=(j.onRenderMonth||function(){return[]})(n);var o=["month"];if(typeof p==="string"){p=[p]}return o.concat((p?p:[]))};this.startDate=new Date(-8639968443048000);this.endDate=new Date(8639968443048000);this.datesDisabled=[];this.daysOfWeekDisabled=[];this.setStartDate(j.startDate||this.element.data("date-startdate"));this.setEndDate(j.endDate||this.element.data("date-enddate"));this.setDatesDisabled(j.datesDisabled||this.element.data("date-dates-disabled"));this.setDaysOfWeekDisabled(j.daysOfWeekDisabled||this.element.data("date-days-of-week-disabled"));this.setMinutesDisabled(j.minutesDisabled||this.element.data("date-minute-disabled"));this.setHoursDisabled(j.hoursDisabled||this.element.data("date-hour-disabled"));this.fillDow();this.fillMonths();this.update();this.showMode();if(this.isInline){this.show()}};g.prototype={constructor:g,_events:[],_attachEvents:function(){this._detachEvents();if(this.isInput){this._events=[[this.element,{focus:d.proxy(this.show,this),keyup:d.proxy(this.update,this),keydown:d.proxy(this.keydown,this)}]]}else{if(this.component&&this.hasInput){this._events=[[this.element.find("input"),{focus:d.proxy(this.show,this),keyup:d.proxy(this.update,this),keydown:d.proxy(this.keydown,this)}],[this.component,{click:d.proxy(this.show,this)}]];if(this.componentReset){this._events.push([this.componentReset,{click:d.proxy(this.reset,this)}])}}else{if(this.element.is("div")){this.isInline=true}else{this._events=[[this.element,{click:d.proxy(this.show,this)}]]}}}for(var j=0,k,l;j<this._events.length;j++){k=this._events[j][0];l=this._events[j][1];k.on(l)}},_detachEvents:function(){for(var j=0,k,l;j<this._events.length;j++){k=this._events[j][0];l=this._events[j][1];k.off(l)}this._events=[]},show:function(i){this.picker.show();this.height=this.component?this.component.outerHeight():this.element.outerHeight();if(this.forceParse){this.update()}this.place();d(window).on("resize",d.proxy(this.place,this));if(i){i.stopPropagation();i.preventDefault()}this.isVisible=true;this.element.trigger({type:"show",date:this.date})},hide:function(){if(!this.isVisible){return}if(this.isInline){return}this.picker.hide();d(window).off("resize",this.place);this.viewMode=this.startViewMode;this.showMode();if(!this.isInput){d(document).off("mousedown",this.hide)}if(this.forceParse&&(this.isInput&&this.element.val()||this.hasInput&&this.element.find("input").val())){this.setValue()}this.isVisible=false;this.element.trigger({type:"hide",date:this.date})},remove:function(){this._detachEvents();d(document).off("mousedown",this.clickedOutside);this.picker.remove();delete this.picker;delete this.element.data().datetimepicker},getDate:function(){var i=this.getUTCDate();if(i===null){return null}return new Date(i.getTime()+(i.getTimezoneOffset()*60000))},getUTCDate:function(){return this.date},getInitialDate:function(){return this.initialDate},setInitialDate:function(i){this.initialDate=i},setDate:function(i){this.setUTCDate(new Date(i.getTime()-(i.getTimezoneOffset()*60000)))},setUTCDate:function(i){if(i>=this.startDate&&i<=this.endDate){this.date=i;this.setValue();this.viewDate=this.date;this.fill()}else{this.element.trigger({type:"outOfRange",date:i,startDate:this.startDate,endDate:this.endDate})}},setFormat:function(j){this.format=c.parseFormat(j,this.formatType);var i;if(this.isInput){i=this.element}else{if(this.component){i=this.element.find("input")}}if(i&&i.val()){this.setValue()}},setValue:function(){var i=this.getFormattedDate();if(!this.isInput){if(this.component){this.element.find("input").val(i)}this.element.data("date",i)}else{this.element.val(i)}if(this.linkField){d("#"+this.linkField).val(this.getFormattedDate(this.linkFormat))}},getFormattedDate:function(i){i=i||this.format;return c.formatDate(this.date,i,this.language,this.formatType,this.timezone)},setStartDate:function(i){this.startDate=i||this.startDate;if(this.startDate.valueOf()!==8639968443048000){this.startDate=c.parseDate(this.startDate,this.format,this.language,this.formatType,this.timezone)}this.update();this.updateNavArrows()},setEndDate:function(i){this.endDate=i||this.endDate;if(this.endDate.valueOf()!==8639968443048000){this.endDate=c.parseDate(this.endDate,this.format,this.language,this.formatType,this.timezone)}this.update();this.updateNavArrows()},setDatesDisabled:function(j){this.datesDisabled=j||[];if(!d.isArray(this.datesDisabled)){this.datesDisabled=this.datesDisabled.split(/,\s*/)}var i=this;this.datesDisabled=d.map(this.datesDisabled,function(k){return c.parseDate(k,i.format,i.language,i.formatType,i.timezone).toDateString()});this.update();this.updateNavArrows()},setTitle:function(i,j){return this.picker.find(i).find("th:eq(1)").text(this.title===false?j:this.title)},setDaysOfWeekDisabled:function(i){this.daysOfWeekDisabled=i||[];if(!d.isArray(this.daysOfWeekDisabled)){this.daysOfWeekDisabled=this.daysOfWeekDisabled.split(/,\s*/)}this.daysOfWeekDisabled=d.map(this.daysOfWeekDisabled,function(j){return parseInt(j,10)});this.update();this.updateNavArrows()},setMinutesDisabled:function(i){this.minutesDisabled=i||[];if(!d.isArray(this.minutesDisabled)){this.minutesDisabled=this.minutesDisabled.split(/,\s*/)}this.minutesDisabled=d.map(this.minutesDisabled,function(j){return parseInt(j,10)});this.update();this.updateNavArrows()},setHoursDisabled:function(i){this.hoursDisabled=i||[];if(!d.isArray(this.hoursDisabled)){this.hoursDisabled=this.hoursDisabled.split(/,\s*/)}this.hoursDisabled=d.map(this.hoursDisabled,function(j){return parseInt(j,10)});this.update();this.updateNavArrows()},place:function(){if(this.isInline){return}if(!this.zIndex){var j=0;d("div").each(function(){var o=parseInt(d(this).css("zIndex"),10);if(o>j){j=o}});this.zIndex=j+10}var n,m,l,k;if(this.container instanceof d){k=this.container.offset()}else{k=d(this.container).offset()}if(this.component){n=this.component.offset();l=n.left;if(this.pickerPosition==="bottom-left"||this.pickerPosition==="top-left"){l+=this.component.outerWidth()-this.picker.outerWidth()}}else{n=this.element.offset();l=n.left;if(this.pickerPosition==="bottom-left"||this.pickerPosition==="top-left"){l+=this.element.outerWidth()-this.picker.outerWidth()}}var i=document.body.clientWidth||window.innerWidth;if(l+220>i){l=i-220}if(this.pickerPosition==="top-left"||this.pickerPosition==="top-right"){m=n.top-this.picker.outerHeight()}else{m=n.top+this.height}m=m-k.top;l=l-k.left;this.picker.css({top:m,left:l,zIndex:this.zIndex})},hour_minute:"^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]",update:function(){var i,j=false;if(arguments&&arguments.length&&(typeof arguments[0]==="string"||arguments[0] instanceof Date)){i=arguments[0];j=true}else{i=(this.isInput?this.element.val():this.element.find("input").val())||this.element.data("date")||this.initialDate;if(typeof i==="string"){i=i.replace(/^\s+|\s+$/g,"")}}if(!i){i=new Date();j=false}if(typeof i==="string"){if(new RegExp(this.hour_minute).test(i)||new RegExp(this.hour_minute+":[0-5][0-9]").test(i)){i=this.getDate()}}this.date=c.parseDate(i,this.format,this.language,this.formatType,this.timezone);if(j){this.setValue()}if(this.date<this.startDate){this.viewDate=new Date(this.startDate)}else{if(this.date>this.endDate){this.viewDate=new Date(this.endDate)}else{this.viewDate=new Date(this.date)}}this.fill()},fillDow:function(){var i=this.weekStart,j="<tr>";while(i<this.weekStart+7){j+='<th class="dow">'+e[this.language].daysMin[(i++)%7]+"</th>"}j+="</tr>";this.picker.find(".datetimepicker-days thead").append(j)},fillMonths:function(){var l="";var m=new Date(this.viewDate);for(var k=0;k<12;k++){m.setUTCMonth(k);var j=this.onRenderMonth(m);l+='<span class="'+j.join(" ")+'">'+e[this.language].monthsShort[k]+"</span>"}this.picker.find(".datetimepicker-months td").html(l)},fill:function(){if(!this.date||!this.viewDate){return}var E=new Date(this.viewDate),t=E.getUTCFullYear(),G=E.getUTCMonth(),n=E.getUTCDate(),A=E.getUTCHours(),w=this.startDate.getUTCFullYear(),B=this.startDate.getUTCMonth(),p=this.endDate.getUTCFullYear(),x=this.endDate.getUTCMonth()+1,q=(new h(this.date.getUTCFullYear(),this.date.getUTCMonth(),this.date.getUTCDate())).valueOf(),D=new Date();this.setTitle(".datetimepicker-days",e[this.language].months[G]+" "+t);if(this.formatViewType==="time"){var k=this.getFormattedDate();this.setTitle(".datetimepicker-hours",k);this.setTitle(".datetimepicker-minutes",k)}else{this.setTitle(".datetimepicker-hours",n+" "+e[this.language].months[G]+" "+t);this.setTitle(".datetimepicker-minutes",n+" "+e[this.language].months[G]+" "+t)}this.picker.find("tfoot th.today").text(e[this.language].today||e.en.today).toggle(this.todayBtn!==false);this.picker.find("tfoot th.clear").text(e[this.language].clear||e.en.clear).toggle(this.clearBtn!==false);this.updateNavArrows();this.fillMonths();var I=h(t,G-1,28,0,0,0,0),z=c.getDaysInMonth(I.getUTCFullYear(),I.getUTCMonth());I.setUTCDate(z);I.setUTCDate(z-(I.getUTCDay()-this.weekStart+7)%7);var j=new Date(I);j.setUTCDate(j.getUTCDate()+42);j=j.valueOf();var r=[];var F;while(I.valueOf()<j){if(I.getUTCDay()===this.weekStart){r.push("<tr>")}F=this.onRenderDay(I);if(I.getUTCFullYear()<t||(I.getUTCFullYear()===t&&I.getUTCMonth()<G)){F.push("old")}else{if(I.getUTCFullYear()>t||(I.getUTCFullYear()===t&&I.getUTCMonth()>G)){F.push("new")}}if(this.todayHighlight&&I.getUTCFullYear()===D.getFullYear()&&I.getUTCMonth()===D.getMonth()&&I.getUTCDate()===D.getDate()){F.push("today")}if(I.valueOf()===q){F.push("active")}if((I.valueOf()+86400000)<=this.startDate||I.valueOf()>this.endDate||d.inArray(I.getUTCDay(),this.daysOfWeekDisabled)!==-1||d.inArray(I.toDateString(),this.datesDisabled)!==-1){F.push("disabled")}r.push('<td class="'+F.join(" ")+'">'+I.getUTCDate()+"</td>");if(I.getUTCDay()===this.weekEnd){r.push("</tr>")}I.setUTCDate(I.getUTCDate()+1)}this.picker.find(".datetimepicker-days tbody").empty().append(r.join(""));r=[];var u="",C="",s="";var l=this.hoursDisabled||[];E=new Date(this.viewDate);for(var y=0;y<24;y++){E.setUTCHours(y);F=this.onRenderHour(E);if(l.indexOf(y)!==-1){F.push("disabled")}var v=h(t,G,n,y);if((v.valueOf()+3600000)<=this.startDate||v.valueOf()>this.endDate){F.push("disabled")}else{if(A===y){F.push("active")}}if(this.showMeridian&&e[this.language].meridiem.length===2){C=(y<12?e[this.language].meridiem[0]:e[this.language].meridiem[1]);if(C!==s){if(s!==""){r.push("</fieldset>")}r.push('<fieldset class="hour"><legend>'+C.toUpperCase()+"</legend>")}s=C;u=(y%12?y%12:12);if(y<12){F.push("hour_am")}else{F.push("hour_pm")}r.push('<span class="'+F.join(" ")+'">'+u+"</span>");if(y===23){r.push("</fieldset>")}}else{u=y+":00";r.push('<span class="'+F.join(" ")+'">'+u+"</span>")}}this.picker.find(".datetimepicker-hours td").html(r.join(""));r=[];u="";C="";s="";var m=this.minutesDisabled||[];E=new Date(this.viewDate);for(var y=0;y<60;y+=this.minuteStep){if(m.indexOf(y)!==-1){continue}E.setUTCMinutes(y);E.setUTCSeconds(0);F=this.onRenderMinute(E);if(this.showMeridian&&e[this.language].meridiem.length===2){C=(A<12?e[this.language].meridiem[0]:e[this.language].meridiem[1]);if(C!==s){if(s!==""){r.push("</fieldset>")}r.push('<fieldset class="minute"><legend>'+C.toUpperCase()+"</legend>")}s=C;u=(A%12?A%12:12);r.push('<span class="'+F.join(" ")+'">'+u+":"+(y<10?"0"+y:y)+"</span>");if(y===59){r.push("</fieldset>")}}else{u=y+":00";r.push('<span class="'+F.join(" ")+'">'+A+":"+(y<10?"0"+y:y)+"</span>")}}this.picker.find(".datetimepicker-minutes td").html(r.join(""));var J=this.date.getUTCFullYear();var o=this.setTitle(".datetimepicker-months",t).end().find(".month").removeClass("active");if(J===t){o.eq(this.date.getUTCMonth()).addClass("active")}if(t<w||t>p){o.addClass("disabled")}if(t===w){o.slice(0,B).addClass("disabled")}if(t===p){o.slice(x).addClass("disabled")}r="";t=parseInt(t/10,10)*10;var H=this.setTitle(".datetimepicker-years",t+"-"+(t+9)).end().find("td");t-=1;E=new Date(this.viewDate);for(var y=-1;y<11;y++){E.setUTCFullYear(t);F=this.onRenderYear(E);if(y===-1||y===10){F.push(b)}r+='<span class="'+F.join(" ")+'">'+t+"</span>";t+=1}H.html(r);this.place()},updateNavArrows:function(){var m=new Date(this.viewDate),k=m.getUTCFullYear(),l=m.getUTCMonth(),j=m.getUTCDate(),i=m.getUTCHours();switch(this.viewMode){case 0:if(k<=this.startDate.getUTCFullYear()&&l<=this.startDate.getUTCMonth()&&j<=this.startDate.getUTCDate()&&i<=this.startDate.getUTCHours()){this.picker.find(".prev").css({visibility:"hidden"})}else{this.picker.find(".prev").css({visibility:"visible"})}if(k>=this.endDate.getUTCFullYear()&&l>=this.endDate.getUTCMonth()&&j>=this.endDate.getUTCDate()&&i>=this.endDate.getUTCHours()){this.picker.find(".next").css({visibility:"hidden"})}else{this.picker.find(".next").css({visibility:"visible"})}break;case 1:if(k<=this.startDate.getUTCFullYear()&&l<=this.startDate.getUTCMonth()&&j<=this.startDate.getUTCDate()){this.picker.find(".prev").css({visibility:"hidden"})}else{this.picker.find(".prev").css({visibility:"visible"})}if(k>=this.endDate.getUTCFullYear()&&l>=this.endDate.getUTCMonth()&&j>=this.endDate.getUTCDate()){this.picker.find(".next").css({visibility:"hidden"})}else{this.picker.find(".next").css({visibility:"visible"})}break;case 2:if(k<=this.startDate.getUTCFullYear()&&l<=this.startDate.getUTCMonth()){this.picker.find(".prev").css({visibility:"hidden"})}else{this.picker.find(".prev").css({visibility:"visible"})}if(k>=this.endDate.getUTCFullYear()&&l>=this.endDate.getUTCMonth()){this.picker.find(".next").css({visibility:"hidden"})}else{this.picker.find(".next").css({visibility:"visible"})}break;case 3:case 4:if(k<=this.startDate.getUTCFullYear()){this.picker.find(".prev").css({visibility:"hidden"})}else{this.picker.find(".prev").css({visibility:"visible"})}if(k>=this.endDate.getUTCFullYear()){this.picker.find(".next").css({visibility:"hidden"})}else{this.picker.find(".next").css({visibility:"visible"})}break}},mousewheel:function(j){j.preventDefault();j.stopPropagation();if(this.wheelPause){return}this.wheelPause=true;var i=j.originalEvent;var l=i.wheelDelta;var k=l>0?1:(l===0)?0:-1;if(this.wheelViewModeNavigationInverseDirection){k=-k}this.showMode(k);setTimeout(d.proxy(function(){this.wheelPause=false},this),this.wheelViewModeNavigationDelay)},click:function(m){m.stopPropagation();m.preventDefault();var n=d(m.target).closest("span, td, th, legend");if(n.is("."+this.icontype)){n=d(n).parent().closest("span, td, th, legend")}if(n.length===1){if(n.is(".disabled")){this.element.trigger({type:"outOfRange",date:this.viewDate,startDate:this.startDate,endDate:this.endDate});return}switch(n[0].nodeName.toLowerCase()){case"th":switch(n[0].className){case"switch":this.showMode(1);break;case"prev":case"next":var i=c.modes[this.viewMode].navStep*(n[0].className==="prev"?-1:1);switch(this.viewMode){case 0:this.viewDate=this.moveHour(this.viewDate,i);break;case 1:this.viewDate=this.moveDate(this.viewDate,i);break;case 2:this.viewDate=this.moveMonth(this.viewDate,i);break;case 3:case 4:this.viewDate=this.moveYear(this.viewDate,i);break}this.fill();this.element.trigger({type:n[0].className+":"+this.convertViewModeText(this.viewMode),date:this.viewDate,startDate:this.startDate,endDate:this.endDate});break;case"clear":this.reset();if(this.autoclose){this.hide()}break;case"today":var j=new Date();j=h(j.getFullYear(),j.getMonth(),j.getDate(),j.getHours(),j.getMinutes(),j.getSeconds(),0);if(j<this.startDate){j=this.startDate}else{if(j>this.endDate){j=this.endDate}}this.viewMode=this.startViewMode;this.showMode(0);this._setDate(j);this.fill();if(this.autoclose){this.hide()}break}break;case"span":if(!n.is(".disabled")){var p=this.viewDate.getUTCFullYear(),o=this.viewDate.getUTCMonth(),q=this.viewDate.getUTCDate(),r=this.viewDate.getUTCHours(),k=this.viewDate.getUTCMinutes(),s=this.viewDate.getUTCSeconds();if(n.is(".month")){this.viewDate.setUTCDate(1);o=n.parent().find("span").index(n);q=this.viewDate.getUTCDate();this.viewDate.setUTCMonth(o);this.element.trigger({type:"changeMonth",date:this.viewDate});if(this.viewSelect>=3){this._setDate(h(p,o,q,r,k,s,0))}}else{if(n.is(".year")){this.viewDate.setUTCDate(1);p=parseInt(n.text(),10)||0;this.viewDate.setUTCFullYear(p);this.element.trigger({type:"changeYear",date:this.viewDate});if(this.viewSelect>=4){this._setDate(h(p,o,q,r,k,s,0))}}else{if(n.is(".hour")){r=parseInt(n.text(),10)||0;if(n.hasClass("hour_am")||n.hasClass("hour_pm")){if(r===12&&n.hasClass("hour_am")){r=0}else{if(r!==12&&n.hasClass("hour_pm")){r+=12}}}this.viewDate.setUTCHours(r);this.element.trigger({type:"changeHour",date:this.viewDate});if(this.viewSelect>=1){this._setDate(h(p,o,q,r,k,s,0))}}else{if(n.is(".minute")){k=parseInt(n.text().substr(n.text().indexOf(":")+1),10)||0;this.viewDate.setUTCMinutes(k);this.element.trigger({type:"changeMinute",date:this.viewDate});if(this.viewSelect>=0){this._setDate(h(p,o,q,r,k,s,0))}}}}}if(this.viewMode!==0){var l=this.viewMode;this.showMode(-1);this.fill();if(l===this.viewMode&&this.autoclose){this.hide()}}else{this.fill();if(this.autoclose){this.hide()}}}break;case"td":if(n.is(".day")&&!n.is(".disabled")){var q=parseInt(n.text(),10)||1;var p=this.viewDate.getUTCFullYear(),o=this.viewDate.getUTCMonth(),r=this.viewDate.getUTCHours(),k=this.viewDate.getUTCMinutes(),s=this.viewDate.getUTCSeconds();if(n.is(".old")){if(o===0){o=11;p-=1}else{o-=1}}else{if(n.is(".new")){if(o===11){o=0;p+=1}else{o+=1}}}this.viewDate.setUTCFullYear(p);this.viewDate.setUTCMonth(o,q);this.element.trigger({type:"changeDay",date:this.viewDate});if(this.viewSelect>=2){this._setDate(h(p,o,q,r,k,s,0))}}var l=this.viewMode;this.showMode(-1);this.fill();if(l===this.viewMode&&this.autoclose){this.hide()}break}}},_setDate:function(i,k){if(!k||k==="date"){this.date=i}if(!k||k==="view"){this.viewDate=i}this.fill();this.setValue();var j;if(this.isInput){j=this.element}else{if(this.component){j=this.element.find("input")}}if(j){j.change()}this.element.trigger({type:"changeDate",date:this.getDate()});if(i===null){this.date=this.viewDate}},moveMinute:function(j,i){if(!i){return j}var k=new Date(j.valueOf());k.setUTCMinutes(k.getUTCMinutes()+(i*this.minuteStep));return k},moveHour:function(j,i){if(!i){return j}var k=new Date(j.valueOf());k.setUTCHours(k.getUTCHours()+i);return k},moveDate:function(j,i){if(!i){return j}var k=new Date(j.valueOf());k.setUTCDate(k.getUTCDate()+i);return k},moveMonth:function(j,k){if(!k){return j}var n=new Date(j.valueOf()),r=n.getUTCDate(),o=n.getUTCMonth(),m=Math.abs(k),q,p;k=k>0?1:-1;if(m===1){p=k===-1?function(){return n.getUTCMonth()===o}:function(){return n.getUTCMonth()!==q};q=o+k;n.setUTCMonth(q);if(q<0||q>11){q=(q+12)%12}}else{for(var l=0;l<m;l++){n=this.moveMonth(n,k)}q=n.getUTCMonth();n.setUTCDate(r);p=function(){return q!==n.getUTCMonth()}}while(p()){n.setUTCDate(--r);n.setUTCMonth(q)}return n},moveYear:function(j,i){return this.moveMonth(j,i*12)},dateWithinRange:function(i){return i>=this.startDate&&i<=this.endDate},keydown:function(o){if(this.picker.is(":not(:visible)")){if(o.keyCode===27){this.show()}return}var k=false,j,i,n;switch(o.keyCode){case 27:this.hide();o.preventDefault();break;case 37:case 39:if(!this.keyboardNavigation){break}j=o.keyCode===37?-1:1;var m=this.viewMode;if(o.ctrlKey){m+=2}else{if(o.shiftKey){m+=1}}if(m===4){i=this.moveYear(this.date,j);n=this.moveYear(this.viewDate,j)}else{if(m===3){i=this.moveMonth(this.date,j);n=this.moveMonth(this.viewDate,j)}else{if(m===2){i=this.moveDate(this.date,j);n=this.moveDate(this.viewDate,j)}else{if(m===1){i=this.moveHour(this.date,j);n=this.moveHour(this.viewDate,j)}else{if(m===0){i=this.moveMinute(this.date,j);n=this.moveMinute(this.viewDate,j)}}}}}if(this.dateWithinRange(i)){this.date=i;this.viewDate=n;this.setValue();this.update();o.preventDefault();k=true}break;case 38:case 40:if(!this.keyboardNavigation){break}j=o.keyCode===38?-1:1;m=this.viewMode;if(o.ctrlKey){m+=2}else{if(o.shiftKey){m+=1}}if(m===4){i=this.moveYear(this.date,j);n=this.moveYear(this.viewDate,j)}else{if(m===3){i=this.moveMonth(this.date,j);n=this.moveMonth(this.viewDate,j)}else{if(m===2){i=this.moveDate(this.date,j*7);n=this.moveDate(this.viewDate,j*7)}else{if(m===1){if(this.showMeridian){i=this.moveHour(this.date,j*6);n=this.moveHour(this.viewDate,j*6)}else{i=this.moveHour(this.date,j*4);n=this.moveHour(this.viewDate,j*4)}}else{if(m===0){i=this.moveMinute(this.date,j*4);n=this.moveMinute(this.viewDate,j*4)}}}}}if(this.dateWithinRange(i)){this.date=i;this.viewDate=n;this.setValue();this.update();o.preventDefault();k=true}break;case 13:if(this.viewMode!==0){var p=this.viewMode;this.showMode(-1);this.fill();if(p===this.viewMode&&this.autoclose){this.hide()}}else{this.fill();if(this.autoclose){this.hide()}}o.preventDefault();break;case 9:this.hide();break}if(k){var l;if(this.isInput){l=this.element}else{if(this.component){l=this.element.find("input")}}if(l){l.change()}this.element.trigger({type:"changeDate",date:this.getDate()})}},showMode:function(i){if(i){var j=Math.max(0,Math.min(c.modes.length-1,this.viewMode+i));if(j>=this.minView&&j<=this.maxView){this.element.trigger({type:"changeMode",date:this.viewDate,oldViewMode:this.viewMode,newViewMode:j});this.viewMode=j}}this.picker.find(">div").hide().filter(".datetimepicker-"+c.modes[this.viewMode].clsName).css("display","block");this.updateNavArrows()},reset:function(){this._setDate(null,"date")},convertViewModeText:function(i){switch(i){case 4:return"decade";case 3:return"year";case 2:return"month";case 1:return"day";case 0:return"hour"}}};var b=d.fn.datetimepicker;d.fn.datetimepicker=function(k){var i=Array.apply(null,arguments);i.shift();var j;this.each(function(){var n=d(this),m=n.data("datetimepicker"),l=typeof k==="object"&&k;if(!m){n.data("datetimepicker",(m=new g(this,d.extend({},d.fn.datetimepicker.defaults,l))))}if(typeof k==="string"&&typeof m[k]==="function"){j=m[k].apply(m,i);if(j!==f){return false}}});if(j!==f){return j}else{return this}};d.fn.datetimepicker.defaults={};d.fn.datetimepicker.Constructor=g;var e=d.fn.datetimepicker.dates={en:{days:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],daysShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun"],daysMin:["Su","Mo","Tu","We","Th","Fr","Sa","Su"],months:["January","February","March","April","May","June","July","August","September","October","November","December"],monthsShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],meridiem:["am","pm"],suffix:["st","nd","rd","th"],today:"Today",clear:"Clear"}};var c={modes:[{clsName:"minutes",navFnc:"Hours",navStep:1},{clsName:"hours",navFnc:"Date",navStep:1},{clsName:"days",navFnc:"Month",navStep:1},{clsName:"months",navFnc:"FullYear",navStep:1},{clsName:"years",navFnc:"FullYear",navStep:10}],isLeapYear:function(i){return(((i%4===0)&&(i%100!==0))||(i%400===0))},getDaysInMonth:function(i,j){return[31,(c.isLeapYear(i)?29:28),31,30,31,30,31,31,30,31,30,31][j]},getDefaultFormat:function(i,j){if(i==="standard"){if(j==="input"){return"yyyy-mm-dd hh:ii"}else{return"yyyy-mm-dd hh:ii:ss"}}else{if(i==="php"){if(j==="input"){return"Y-m-d H:i"}else{return"Y-m-d H:i:s"}}else{throw new Error("Invalid format type.")}}},validParts:function(i){if(i==="standard"){return/t|hh?|HH?|p|P|z|Z|ii?|ss?|dd?|DD?|mm?|MM?|yy(?:yy)?/g}else{if(i==="php"){return/[dDjlNwzFmMnStyYaABgGhHis]/g}else{throw new Error("Invalid format type.")}}},nonpunctuation:/[^ -\/:-@\[-`{-~\t\n\rTZ]+/g,parseFormat:function(l,j){var i=l.replace(this.validParts(j),"\0").split("\0"),k=l.match(this.validParts(j));if(!i||!i.length||!k||k.length===0){throw new Error("Invalid date format.")}return{separators:i,parts:k}},parseDate:function(A,y,v,j,r){if(A instanceof Date){var u=new Date(A.valueOf()-A.getTimezoneOffset()*60000);u.setMilliseconds(0);return u}if(/^\d{4}\-\d{1,2}\-\d{1,2}$/.test(A)){y=this.parseFormat("yyyy-mm-dd",j)}if(/^\d{4}\-\d{1,2}\-\d{1,2}[T ]\d{1,2}\:\d{1,2}$/.test(A)){y=this.parseFormat("yyyy-mm-dd hh:ii",j)}if(/^\d{4}\-\d{1,2}\-\d{1,2}[T ]\d{1,2}\:\d{1,2}\:\d{1,2}[Z]{0,1}$/.test(A)){y=this.parseFormat("yyyy-mm-dd hh:ii:ss",j)}if(/^[-+]\d+[dmwy]([\s,]+[-+]\d+[dmwy])*$/.test(A)){var l=/([-+]\d+)([dmwy])/,q=A.match(/([-+]\d+)([dmwy])/g),t,p;A=new Date();for(var x=0;x<q.length;x++){t=l.exec(q[x]);p=parseInt(t[1]);switch(t[2]){case"d":A.setUTCDate(A.getUTCDate()+p);break;case"m":A=g.prototype.moveMonth.call(g.prototype,A,p);break;case"w":A.setUTCDate(A.getUTCDate()+p*7);break;case"y":A=g.prototype.moveYear.call(g.prototype,A,p);break}}return h(A.getUTCFullYear(),A.getUTCMonth(),A.getUTCDate(),A.getUTCHours(),A.getUTCMinutes(),A.getUTCSeconds(),0)}var q=A&&A.toString().match(this.nonpunctuation)||[],A=new Date(0,0,0,0,0,0,0),m={},z=["hh","h","ii","i","ss","s","yyyy","yy","M","MM","m","mm","D","DD","d","dd","H","HH","p","P","z","Z"],o={hh:function(s,i){return s.setUTCHours(i)},h:function(s,i){return s.setUTCHours(i)},HH:function(s,i){return s.setUTCHours(i===12?0:i)},H:function(s,i){return s.setUTCHours(i===12?0:i)},ii:function(s,i){return s.setUTCMinutes(i)},i:function(s,i){return s.setUTCMinutes(i)},ss:function(s,i){return s.setUTCSeconds(i)},s:function(s,i){return s.setUTCSeconds(i)},yyyy:function(s,i){return s.setUTCFullYear(i)},yy:function(s,i){return s.setUTCFullYear(2000+i)},m:function(s,i){i-=1;while(i<0){i+=12}i%=12;s.setUTCMonth(i);while(s.getUTCMonth()!==i){if(isNaN(s.getUTCMonth())){return s}else{s.setUTCDate(s.getUTCDate()-1)}}return s},d:function(s,i){return s.setUTCDate(i)},p:function(s,i){return s.setUTCHours(i===1?s.getUTCHours()+12:s.getUTCHours())},z:function(){return r}},B,k,t;o.M=o.MM=o.mm=o.m;o.dd=o.d;o.P=o.p;o.Z=o.z;A=h(A.getFullYear(),A.getMonth(),A.getDate(),A.getHours(),A.getMinutes(),A.getSeconds());if(q.length===y.parts.length){for(var x=0,w=y.parts.length;x<w;x++){B=parseInt(q[x],10);t=y.parts[x];if(isNaN(B)){switch(t){case"MM":k=d(e[v].months).filter(function(){var i=this.slice(0,q[x].length),s=q[x].slice(0,i.length);return i===s});B=d.inArray(k[0],e[v].months)+1;break;case"M":k=d(e[v].monthsShort).filter(function(){var i=this.slice(0,q[x].length),s=q[x].slice(0,i.length);return i.toLowerCase()===s.toLowerCase()});B=d.inArray(k[0],e[v].monthsShort)+1;break;case"p":case"P":B=d.inArray(q[x].toLowerCase(),e[v].meridiem);break;case"z":case"Z":r;break}}m[t]=B}for(var x=0,n;x<z.length;x++){n=z[x];if(n in m&&!isNaN(m[n])){o[n](A,m[n])}}}return A},formatDate:function(l,q,m,p,o){if(l===null){return""}var k;if(p==="standard"){k={t:l.getTime(),yy:l.getUTCFullYear().toString().substring(2),yyyy:l.getUTCFullYear(),m:l.getUTCMonth()+1,M:e[m].monthsShort[l.getUTCMonth()],MM:e[m].months[l.getUTCMonth()],d:l.getUTCDate(),D:e[m].daysShort[l.getUTCDay()],DD:e[m].days[l.getUTCDay()],p:(e[m].meridiem.length===2?e[m].meridiem[l.getUTCHours()<12?0:1]:""),h:l.getUTCHours(),i:l.getUTCMinutes(),s:l.getUTCSeconds(),z:o};if(e[m].meridiem.length===2){k.H=(k.h%12===0?12:k.h%12)}else{k.H=k.h}k.HH=(k.H<10?"0":"")+k.H;k.P=k.p.toUpperCase();k.Z=k.z;k.hh=(k.h<10?"0":"")+k.h;k.ii=(k.i<10?"0":"")+k.i;k.ss=(k.s<10?"0":"")+k.s;k.dd=(k.d<10?"0":"")+k.d;k.mm=(k.m<10?"0":"")+k.m}else{if(p==="php"){k={y:l.getUTCFullYear().toString().substring(2),Y:l.getUTCFullYear(),F:e[m].months[l.getUTCMonth()],M:e[m].monthsShort[l.getUTCMonth()],n:l.getUTCMonth()+1,t:c.getDaysInMonth(l.getUTCFullYear(),l.getUTCMonth()),j:l.getUTCDate(),l:e[m].days[l.getUTCDay()],D:e[m].daysShort[l.getUTCDay()],w:l.getUTCDay(),N:(l.getUTCDay()===0?7:l.getUTCDay()),S:(l.getUTCDate()%10<=e[m].suffix.length?e[m].suffix[l.getUTCDate()%10-1]:""),a:(e[m].meridiem.length===2?e[m].meridiem[l.getUTCHours()<12?0:1]:""),g:(l.getUTCHours()%12===0?12:l.getUTCHours()%12),G:l.getUTCHours(),i:l.getUTCMinutes(),s:l.getUTCSeconds()};k.m=(k.n<10?"0":"")+k.n;k.d=(k.j<10?"0":"")+k.j;k.A=k.a.toString().toUpperCase();k.h=(k.g<10?"0":"")+k.g;k.H=(k.G<10?"0":"")+k.G;k.i=(k.i<10?"0":"")+k.i;k.s=(k.s<10?"0":"")+k.s}else{throw new Error("Invalid format type.")}}var l=[],r=d.extend([],q.separators);for(var n=0,j=q.parts.length;n<j;n++){if(r.length){l.push(r.shift())}l.push(k[q.parts[n]])}if(r.length){l.push(r.shift())}return l.join("")},convertViewMode:function(i){switch(i){case 4:case"decade":i=4;break;case 3:case"year":i=3;break;case 2:case"month":i=2;break;case 1:case"day":i=1;break;case 0:case"hour":i=0;break}return i},headTemplate:'<thead><tr><th class="prev"><i class="{iconType} {leftArrow}"/></th><th colspan="5" class="switch"></th><th class="next"><i class="{iconType} {rightArrow}"/></th></tr></thead>',headTemplateV3:'<thead><tr><th class="prev"><span class="{iconType} {leftArrow}"></span> </th><th colspan="5" class="switch"></th><th class="next"><span class="{iconType} {rightArrow}"></span> </th></tr></thead>',contTemplate:'<tbody><tr><td colspan="7"></td></tr></tbody>',footTemplate:'<tfoot><tr><th colspan="7" class="today"></th></tr><tr><th colspan="7" class="clear"></th></tr></tfoot>'};c.template='<div class="datetimepicker"><div class="datetimepicker-minutes"><table class=" table-condensed">'+c.headTemplate+c.contTemplate+c.footTemplate+'</table></div><div class="datetimepicker-hours"><table class=" table-condensed">'+c.headTemplate+c.contTemplate+c.footTemplate+'</table></div><div class="datetimepicker-days"><table class=" table-condensed">'+c.headTemplate+"<tbody></tbody>"+c.footTemplate+'</table></div><div class="datetimepicker-months"><table class="table-condensed">'+c.headTemplate+c.contTemplate+c.footTemplate+'</table></div><div class="datetimepicker-years"><table class="table-condensed">'+c.headTemplate+c.contTemplate+c.footTemplate+"</table></div></div>";c.templateV3='<div class="datetimepicker"><div class="datetimepicker-minutes"><table class=" table-condensed">'+c.headTemplateV3+c.contTemplate+c.footTemplate+'</table></div><div class="datetimepicker-hours"><table class=" table-condensed">'+c.headTemplateV3+c.contTemplate+c.footTemplate+'</table></div><div class="datetimepicker-days"><table class=" table-condensed">'+c.headTemplateV3+"<tbody></tbody>"+c.footTemplate+'</table></div><div class="datetimepicker-months"><table class="table-condensed">'+c.headTemplateV3+c.contTemplate+c.footTemplate+'</table></div><div class="datetimepicker-years"><table class="table-condensed">'+c.headTemplateV3+c.contTemplate+c.footTemplate+"</table></div></div>";d.fn.datetimepicker.DPGlobal=c;d.fn.datetimepicker.noConflict=function(){d.fn.datetimepicker=b;return this};d(document).on("focus.datetimepicker.data-api click.datetimepicker.data-api",'[data-provide="datetimepicker"]',function(j){var i=d(this);if(i.data("datetimepicker")){return}j.preventDefault();i.datetimepicker("show")});d(function(){d('[data-provide="datetimepicker-inline"]').datetimepicker()})}));
// Class definition

var KTBootstrapDatepicker = function () {

    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }

    // Private functions
    var demos = function () {
        // minimum setup
        $('.datepicker-custome').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: 'yyyy-mm-dd',
			autoclose: true,
			clearBtn: true,
			 todayBtn: "linked",
			
        });

        // minimum setup for modal demo
        $('#kt_datepicker_1_modal').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows
        });

        // input group layout
        $('#kt_datepicker_2, #kt_datepicker_2_validate').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows
        });

        // input group layout for modal demo
        $('#kt_datepicker_2_modal').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows
        });

        // enable clear button
        $('#kt_datepicker_3, #kt_datepicker_3_validate').datepicker({
            rtl: KTUtil.isRTL(),
            todayBtn: "linked",
            clearBtn: true,
            todayHighlight: true,
            templates: arrows
        });

        // enable clear button for modal demo
        $('#kt_datepicker_3_modal').datepicker({
            rtl: KTUtil.isRTL(),
            todayBtn: "linked",
            clearBtn: true,
            todayHighlight: true,
            templates: arrows
        });

        // orientation
        $('#kt_datepicker_4_1').datepicker({
            rtl: KTUtil.isRTL(),
            orientation: "top left",
            todayHighlight: true,
            templates: arrows
        });

        $('#kt_datepicker_4_2').datepicker({
            rtl: KTUtil.isRTL(),
            orientation: "top right",
            todayHighlight: true,
            templates: arrows
        });

        $('#kt_datepicker_4_3').datepicker({
            rtl: KTUtil.isRTL(),
            orientation: "bottom left",
            todayHighlight: true,
            templates: arrows
        });

        $('#kt_datepicker_4_4').datepicker({
            rtl: KTUtil.isRTL(),
            orientation: "bottom right",
            todayHighlight: true,
            templates: arrows
        });

        // range picker
        $('#kt_datepicker_5').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            templates: arrows
        });

         // inline picker
        $('#kt_datepicker_6').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            templates: arrows
        });
    }

    return {
        // public functions
        init: function() {
            demos();
        }
    };
}();

jQuery(document).ready(function() {
    KTBootstrapDatepicker.init();
});
