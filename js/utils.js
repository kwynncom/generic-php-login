byid = function(id ) { return document.getElementById(id); }
kwl  = function(sin) { console.log(sin); }
dangerousCharRE = function (sin) {
    const sp = '\\[\\]\\(\\);<>\\\\=/\\{\\}&';
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
