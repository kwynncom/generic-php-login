window.onload = function() {
    let   uo = false;
    if (typeof KWUINIT !== 'undefined') uo = KWUINIT;
    const cnt = uo.ucnt;
    const une = byid('uname');   

    if (une) une.maxLength = uo.maxunamel;
    
    if (uo.msg) innm(uo.msg);
    
    // byid('uinfo').innerHTML = cnt + ' users in the system';
    const crfs = ['unamel', 'pwdl'];
    
    if (cnt === 0) {
	crfs.forEach(function(f) { 
	    const e     = byid(f);
	    const ih    = e.innerHTML;
	    e.innerHTML = 'create ' + ih;
	    byid('loginbtn').innerHTML = 'create user';
	    byid('pwd').autocomplete = 'new-password';
	});
    }
    
    const lib = byid('loginbtn');
    
    if (lib) lib.onclick = function() { 
	const so = {};
	['uname', 'pwd'].forEach(function(f) { 
	    const e= byid(f);
	    so[f] = e.value;
	});
	so.action = 'login';
	send(so);
    }
    
    const credf = byid('credform');
     if  (credf)byid('credform').onsubmit = function(event) {
	event.preventDefault();
	return false;
    }

    if (une)
	une.oninput = une.onblur = function(ev) { 
	    unprocess(une, ev.type);
	}
        
}

function unprocess(une, etype) {
    une.required = 'required';
    une.pattern = dangerousCharRE();
    une.setCustomValidity('');
    
    if (une.checkValidity()) testun(une.value, etype);
}

function logout() { send({'action' : 'logout'}); }