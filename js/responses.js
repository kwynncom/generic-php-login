function innm(t) { inn('msgs', t); }

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

    if (/* json.action === 'created' && json.status === 'OK' && */ json.redto) window.location = json.redto;
    // if (json.redto) 
    
    /*
    if (json.userisavail) {
	byid('pwdl'  ).innerHTML = 'create password:';
	byid('unamel').innerHTML = 'create username:';
	byid('loginbtn').innerHTML = 'create and login';
    } */
 
}