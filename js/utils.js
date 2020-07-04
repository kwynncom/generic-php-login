byid = function(id ) { return document.getElementById(id); }
kwl  = function(sin) { console.log(sin); }
dangerousCharRE = function (sin) {
    const sp = '\\[\\]\\(\\);<>\\\\=/\\{\\}&\'\"#';
    const re = [
	'\\s*',
	'[^',
	'\\s',
	sp,
	']+',
	'([^',
	sp,
	'])*'
    ];

    return re.join('');    
}
die = function (msg) { throw new Error(msg); }
function inn(id, t) {
    const e = byid(id);
    if (!e) return;
    e.innerHTML = t;
}

function innm(t) { inn('msgs', t); }

function send(url, obin, handler) {
    const XHR = new XMLHttpRequest();
    XHR.addEventListener('loadend', handler);
    XHR.open('post', url);
    var formData = new FormData(); 
    for (const [k, v] of Object.entries(obin)) formData.append(k,v);   
    // formData.append('XDEBUG_SESSION_START', 'netbeans-xdebug');
    XHR.send(formData);
}
