function byid(id ) { return document.getElementById(id); }
function kwl (sin) { console.log(sin); }
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
