window.onload = function() {
    const uo  = KWUINIT;
    const cnt = uo.ucnt;
    byid('uinfo').innerHTML = cnt + ' users in the system';
    
    if (cnt === 0) {
	['unamel', 'pwdl'].forEach(function(f) { 
	    const e     = byid(f);
	    const ih    = e.innerHTML;
	    e.innerHTML = 'create ' + ih;
	});
	
    }
}