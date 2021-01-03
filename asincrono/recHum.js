console.log("hola RRHH");
$.get('/C.S.J.O.bo/RRHH/1').done(function (datos) {
var nombre=[];
var data=[];
var t=2006;
var e=50;
var u=90;
    console.log(data);
    datos.map(function (elem) {
        // nombre.push({nombre:elem.nombre,id:elem.id});
        t += 1; e+=15;u+=30;
        data.push({y:t.toString(),a:e,b:u});
    }) ;
    console.log(data);
    morrisLine.setData(data);
}).fail();
var morrisLine=new Morris.Line({
    element: 'morrisLine',
    data: [
        { y: '2006', a: 50, b: 90 },
        { y: '2007', a: 75,  b: 65 },
        { y: '2008', a: 50,  b: 40 },
        { y: '2009', a: 25,  b: 65 },
        { y: '2010', a: 50,  b: 40 },
        { y: '2011', a: 75,  b: 65 },
        { y: '2012', a: 50, b: 90 }
    ],
    xkey: 'y',
    ykeys: ['a', 'b'],
    labels: ['Series A', 'Series B'],
    lineColors: ['#3db9af', '#7A92A3'],
});
var morris1= new Morris.Line({
    // ID of the element in which to draw the chart.
    element: 'morrisArea',
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    data: [
        { year: '2014', value: 35,  value2:10 },
        { year: '2015', value: 13,  value2:20 },
        { year: '2016', value: 10,  value2:30},
        { year: '2017', value: 8,   value2:40 },
        { year: '2018', value: 7,   value2:50 }
    ],
    // The name of the data record attribute that contains x-values.
    xkey: 'year',
    // A list of names of data record attributes that contain y-values.
    ykeys: ['value','value2'],
    lineWidth:1,
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['coca-cola','pepsi'],
    resize:true,
    lineColors:['#C14D9F','#2CB4AC']
});
