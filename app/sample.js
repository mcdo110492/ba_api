//This is only for normal options

var table = document.getElementById("table-elem");
var tbody = table.tBodies;

var count = tbody[0].childNodes.length;

var elemArr = [];

for (var i = 0; i < count; i++) {
    var order = tbody[0].childNodes[i].cells[0].childNodes[3].value;
    //var label = tbody[0].childNodes[i].cells[2].childNodes[0].value;
    var label = tbody[0].childNodes[i].cells[3].childNodes[1].value; //For swatch

    elemArr.push({ label: label, order: order });
}


var sortedArr = elemArr.sort(function (a1, b1) {
    var x = a1.label.toLowerCase();
    var y = b1.label.toLowerCase();
    if (x < y) { return -1; }
    if (x > y) { return 1; }
    return 0;
});

var orderedArrElem = [];

for (var x = 0; x < count; x++) {
    var strLabel = sortedArr[x].label;
    orderedArrElem[strLabel] = x;
}

for (var y = 0; y < count; y++) {
    var elemLabel = tbody[0].childNodes[y].cells[2].childNodes[0].value;

    tbody[0].childNodes[y].cells[0].childNodes[3].value = orderedArrElem[elemLabel];
}