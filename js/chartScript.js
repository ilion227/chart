var data = new Array();

var options = {
    segmentShowStroke: true,
    segmentStrokeColor: "#fff",
    segmentStrokeWidth: 2,
    animationEasing: "easeInCircle",
    animationSteps: 45,
    animateRotate: true,
};

var ctx = $("#myChart").get(0).getContext("2d");
pieChart = new Chart(ctx).Doughnut(data, options);