function innm(t) { inn('msgs', 'error: ' + ' ' + t); }

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

 
}