window.onload = function() {
    const uo  = KWUINIT;
    const cnt = uo.ucnt;
    byid('uinfo').innerHTML = cnt + ' users in the system';
    const crfs = ['unamel', 'pwdl'];
    
    if (cnt === 0) {
	crfs.forEach(function(f) { 
	    const e     = byid(f);
	    const ih    = e.innerHTML;
	    e.innerHTML = 'create ' + ih;
	    byid('loginbtn').innerHTML = 'create user';
	});
    }
    
    byid('loginbtn').onclick = function() { 
	const so = {};
	['uname', 'pwd'].forEach(function(f) { 
	    const e= byid(f);
	    so[f] = e.value;
	});
	
	kwl('here 427');
	
	const sso = serialize(so);
	const x = 2;
    }
}