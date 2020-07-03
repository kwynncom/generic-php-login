function testun(vin, etype) {
    delayun(vin, etype);
}

var KWUNDTAV = false;

function delayun(vin, etype) {
    if (KWUNDTAV) clearTimeout(KWUNDTAV);
    let delay = 600;
    if (etype === 'blur') delay = 0;
    KWUNDTAV = setTimeout(function() {  new sendun(vin); }, delay);
}
