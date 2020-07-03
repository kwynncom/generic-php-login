function send(obin) {
    const burl = 'index.php';
    const XHR = new XMLHttpRequest();
    XHR.addEventListener('loadend', handleNetResponse);
    XHR.open('post', burl);
    var formData = new FormData(); 
    for (const [k, v] of Object.entries(obin)) formData.append(k,v);   
    formData.append('XDEBUG_SESSION_START', 'netbeans-xdebug');
    XHR.send(formData);
}
