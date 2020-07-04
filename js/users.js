window.onload = function() {
    let   uo = false;
    if (typeof KWUINIT !== 'undefined') uo = KWUINIT;
    const cnt = uo.ucnt;
    const une = byid('uname');   

    if (une) une.maxLength = uo.maxunamel;
    
    if (uo.msg) innm(uo.msg);

    if (cnt === 0) byid('pwd').autocomplete = 'new-password';

    const lib = byid('loginbtn');
    
    if (lib) lib.onclick = function() { 
	const so = {};
	['uname', 'pwd'].forEach(function(f) { 
	    const e= byid(f);
	    so[f] = e.value;
	});
	so.action = 'login';
	userSend(so);
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

function logout() { userSend({'action' : 'logout'}); }

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

class sendun {
     
     constructor(vin) {
	const o = {};
	o.uname = vin;
	o.action = 'checkun';
	userSend(o);
     }
    
}

function userSend(obin) { send(window.location.href, obin, handleNetResponse); }

function handleNetResponse() {
    const res = this.responseText;
    let   msg = 'unknown error';
    if (!res) msg = 'blank server response';
    let json = '';
    try {
	json = JSON.parse(this.responseText);
    } catch(err) { msg = this.responseText; }
    
    if (!json || !json.msg) { innm(msg); return; }
    
    innm(json.msg);
    
    if (json.id && json.invalid) byid(json.id).setCustomValidity(json.msg);

    if (json.redto) window.location = json.redto;
}
