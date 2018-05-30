var a = [50,75,150,50,100,50];

(function() {
    // BACKGROUND
    var background = document.getElementById('background');
    if (background.getContext){
        var b = background.getContext('2d');

        // Line graph
        b.lineWidth = 1;
        b.strokeStyle = '#024';
        b.beginPath();
        b.moveTo(0,25);
        b.lineTo(600,25);
        b.moveTo(0,50);
        b.lineTo(600,50);
        b.moveTo(0,75);
        b.lineTo(600,75);
        b.moveTo(0,100);
        b.lineTo(600,100);
        b.moveTo(0,125);
        b.lineTo(600,125);
        b.moveTo(0,150);
        b.lineTo(600,150);
        b.moveTo(0,175);
        b.lineTo(600,175);
        b.moveTo(0,200);
        b.lineTo(600,200);
        b.moveTo(0,225);
        b.lineTo(600,225);
        b.moveTo(0,250);
        b.lineTo(600,250);
        b.moveTo(0,275);
        b.lineTo(600,275);
        b.stroke();
    }

    // LINE GRAPH
    var graph = document.getElementById('canvas');
    if (graph.getContext){
        var g = graph.getContext('2d');

        g.lineWidth = 2;
        g.strokeStyle = '#ff0';
        g.shadowColor = '#ff0';
        g.shadowOffsetX = 0;
        g.shadowOffsetY = 0;
        g.shadowBlur = 20;

        g.beginPath();
        g.moveTo(0,100);

        for (var i = 0, l = a.length; i < l; i++) {
            g.lineTo((i + 1) * 35,a[i]);
        }
        g.stroke();
    }
})();
