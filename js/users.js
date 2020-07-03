window.onload = function() {
    const uo  = KWUINIT;
    const cnt = uo.ucnt;
    const une = byid('uname');   

    une.maxLength = uo.maxunamel;
    
    if (uo.msg) innm(uo.msg);
    
    byid('uinfo').innerHTML = cnt + ' users in the system';
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
    
    byid('loginbtn').onclick = function() { 
	const so = {};
	['uname', 'pwd'].forEach(function(f) { 
	    const e= byid(f);
	    so[f] = e.value;
	});
	so.action = 'create';
	send(so);
    }
    
    byid('credform').onsubmit = function(event) {
	event.preventDefault();
	return false;
    }

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
