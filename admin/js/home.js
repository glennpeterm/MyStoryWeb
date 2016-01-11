




RowChartWidth = $('#dashboard-user-chart').width() - 20;
var dateFormat = d3.time.format("%Y-%m-%d");
var numberFormat = d3.format(".2f");
var monthNameFormat = d3.time.format("%d-%b-%y");
data.forEach(function (e) {
    e.dd = dateFormat.parse(e.date);
    e.week = d3.time.week(e.dd); // pre-calculate month for better performance
    e.month = d3.time.month(e.dd); // pre-calculate month for better performance
});

var moveChartUser = dc.lineChart('#monthly-user-move-chart');
var moveChartSelfie = dc.lineChart('#monthly-selfie-move-chart');


var MaxDate = d3.max(data, function (d) {
    return dateFormat.parse(d.date);
});

var MinDate = d3.min(data, function (d) {
    return dateFormat.parse(d.date);
});

var MaxDatePlusAmonth = new Date(MaxDate);
MaxDatePlusAmonth.setDate(MaxDatePlusAmonth.getDate() + 1);

var MinDateMinusAmonth = new Date(MinDate);
MinDateMinusAmonth.setDate(MinDateMinusAmonth.getDate() - 1);


var ndx = crossfilter(data);
var moveMonths = ndx.dimension(function (d) {
        return d.dd;
    });

 var userCountGroup = moveMonths.group();


 userCountGroup = moveMonths.group().reduceSum(function (d) {
    if(d.type=='user')
    {
    
        return d.count;
    }
    
    });


datAry = userCountGroup.all();
var MaxValue = d3.max(datAry, function (d) {
   return d.value;
});

var timediff = Math.abs(MaxDate.getTime() - MinDate.getTime());
diffDays = Math.ceil(timediff / (1000 * 3600 * 24));

   moveChartUser
        .renderArea(false)
        .width(RowChartWidth)
        .yAxisPadding("10%")
        .height(200)
        .transitionDuration(1000)
        .margins({top: 30, right: 50, bottom: 35, left: 50})
        .dimension(moveMonths)
        .mouseZoomable(true)
        .x(d3.time.scale().domain([MinDateMinusAmonth, MaxDatePlusAmonth]))
        .round(d3.time.month.round)
        .xUnits(d3.time.months)
        .elasticY(true)
        .yAxisLabel('User Count')
        .renderHorizontalGridLines(true)
        .brushOn(false)
        .group(userCountGroup, 'Count')
        .title(function (d) {
            var value =  d.value;
            
            return dateFormat(d.key) + '\n' + "Count : "+value;
        });


       
if(MaxValue<10)
    ticks = MaxValue;
else
    ticks = 6;

moveChartUser.yAxis().ticks(ticks);


if(diffDays>6)
{
    moveChartUser.xAxis().tickFormat(function (v)
    {
        return monthName = monthNameFormat(v);
    });
}
else
{

    moveChartUser.xAxis().ticks(3).tickFormat(function (v)
    {
        return monthName = monthNameFormat(v);
    });

}

moveChartUser.renderlet(function (chart) {
    chart.selectAll("g.x text")
            .attr('dx', '-28')
            .attr('dy', '0')
            .attr('transform', "rotate(-25)")
            .attr('fill', "black");

});


//for selfie chart

 
 selfieData.forEach(function (e) {
    e.dd = dateFormat.parse(e.date);
    e.week = d3.time.week(e.dd); // pre-calculate month for better performance
    e.month = d3.time.month(e.dd); // pre-calculate month for better performance
});
 
var selfieMaxDate = d3.max(selfieData, function (d) {
    return dateFormat.parse(d.date);
});

var selfieMinDate = d3.min(selfieData, function (d) {
    return dateFormat.parse(d.date);
});

var selfieMaxDatePlusAmonth = new Date(selfieMaxDate);
selfieMaxDatePlusAmonth.setDate(selfieMaxDatePlusAmonth.getDate() + 1);

var selfieMinDateMinusAmonth = new Date(selfieMinDate);
selfieMinDateMinusAmonth.setDate(selfieMinDateMinusAmonth.getDate() - 1);


var ndxselfie = crossfilter(selfieData);
var moveMonthsselfie = ndxselfie.dimension(function (d) {
        return d.dd;
    });

 var selfieCountGroup = moveMonthsselfie.group();


 selfieCountGroup = moveMonthsselfie.group();


selfieDatary = selfieCountGroup.all();
var selfieMaxValue = d3.max(selfieDatary, function (d) {
   return d.value;
});

var selfietimediff = Math.abs(selfieMaxDate.getTime() - selfieMinDate.getTime());
selfiediffDays = Math.ceil(selfietimediff / (1000 * 3600 * 24));

   moveChartSelfie
        .renderArea(false)
        .width(RowChartWidth)
        .yAxisPadding("10%")
        .height(200)
        .transitionDuration(1000)
        .margins({top: 30, right: 50, bottom: 35, left: 50})
        .dimension(moveMonthsselfie)
        .mouseZoomable(true)
        .x(d3.time.scale().domain([selfieMinDateMinusAmonth, selfieMaxDatePlusAmonth]))
        .round(d3.time.month.round)
        .xUnits(d3.time.months)
        .yAxisLabel('Selfie Count')
        .elasticY(true)
        .renderHorizontalGridLines(true)
        .brushOn(false)
        .group(selfieCountGroup, 'Count')
        .title(function (d) {
            var value =  d.value;
            
            return dateFormat(d.key) + '\n' + "Count : "+value;
        });


       
if(selfieMaxValue<10)
    selfieticks = selfieMaxValue;
else
    selfieticks = 6;

moveChartSelfie.yAxis().ticks(selfieticks);


if(selfiediffDays>6)
{
    moveChartSelfie.xAxis().tickFormat(function (v)
    {
        return selfiemonthName = monthNameFormat(v);
    });
}
else
{

    moveChartSelfie.xAxis().ticks(3).tickFormat(function (v)
    {
        return selfiemonthName = monthNameFormat(v);
    });

}

moveChartSelfie.renderlet(function (chart) {
    chart.selectAll("g.x text")
            .attr('dx', '-28')
            .attr('dy', '0')
            .attr('transform', "rotate(-25)")
            .attr('fill', "black");

});

dc.renderAll();


function resizeCharts(moveChartUserWidth,moveChartSelfieWidth) {

    moveChartUser.width(moveChartUserWidth).rescale();
    moveChartSelfie.width(moveChartSelfieWidth).rescale();
       dc.renderAll();
    dc.redrawAll();
}
window.onresize = function () {
    moveChartUserWidth = $('#dashboard-user-chart').width() - 20;
    moveChartSelfieWidth = $('#dashboard-user-chart').width() - 20;
    resizeCharts(moveChartUserWidth,moveChartSelfieWidth);
};