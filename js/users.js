class kwusers {

constructor(uid, pid, bid, mid, fid) { 
    const self = this;
    window.onload = function() {  self.main(uid, pid, bid, mid, fid);   }
    
}

main(uid, pid, bid, mid, fid) {
// window.onload = function() {
    let   uo = false;
    if (typeof KWUINIT !== 'undefined') uo = KWUINIT;
    const cnt = uo.ucnt;
    const une = byid(uid);
    
    this.uid = uid;

    if (une) une.maxLength = uo.maxunamel;
    
    if (uo.msg) innm(uo.msg);

    if (cnt === 0) byid(pid).autocomplete = 'new-password';

    const lib = byid(bid);
    
    const self = this;
    
    if (lib) lib.onclick = function() { 
	
	self.status = 'credTransit';
	
	innm('checking...');
	
	const so = {};
	[uid, pid].forEach(function(f) { 
	    const e= byid(f);
	    so[f] = e.value;
	});
	so.action = 'login';
	self.userSend(so);
    }
    
    const credf = byid(fid);
     if  (credf) credf.onsubmit = function(event) {
	event.preventDefault();
	return false;
    }

    if (une)
	une.oninput = une.onblur = function(ev) { 
	    unprocess(une, ev.type);
	}
        
		// } // window.onload
} // constructor

userSend(obin) { send(window.location.href, obin, this.handleNetResponse); }

handleNetResponse() {
    const res = this.responseText;
    let   msg = 'unknown error';
    if (!res) msg = 'blank server response';
    let json = '';
    try {
	json = JSON.parse(this.responseText);
    } catch(err) { msg = this.responseText; }
    
    if (!json || !json.msg) { innm(msg); return; }
    
    if (json.action && json.action === 'uck' 
	    && KWUO.status === 'credTransit')  return; 
    
    innm(json.msg);
    
    const jid = json.id;
    let ue = false;
    
    if (jid && jid === 'uname') ue = byid(KWUO.uid);
      
    if (jid && json.invalid && ue) ue.setCustomValidity(json.msg);

    if (json.redto) window.location = json.redto;
    
    KWUO.status = 'transitDone';
}



} // class
function unprocess(une, etype) {
    une.required = 'required';
    une.pattern = dangerousCharRE();
    une.setCustomValidity('');
        
    if (une.checkValidity()) testun(une.value, etype);
}

function logout() { KWUO.userSend({'action' : 'logout'}); }

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
	KWUO.userSend(o);
     }
    
}



