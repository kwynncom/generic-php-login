function send(obin) {
    
    const burl = 'index.php';
    const XHR = new XMLHttpRequest(); 
    
    /*
    XHR.onreadystatechange = function() {
	try {
	    if (this.readyState === 4 && this.status === 200) {
	    }
	    if (this.status !== 200) {
		// byid('msgs').innerHTML = XHR.response;
	    }
	}    catch(err) {
	// byid('msgs').innerHTML = err + XHR.response;
	}
    }; */
    
    XHR.open('post', burl);
    var formData = new FormData(); 
    for (const [k, v] of Object.entries(obin)) formData.append(k,v);   
    formData.append('XDEBUG_SESSION_START', 'netbeans-xdebug');
    XHR.send(formData);
}




serialize = function(obj, prefix) { // see StackOverflow credits below; Kwynn v726
  var str = [],
    p;
  for (p in obj) {
    if (obj.hasOwnProperty(p)) {
      var k = prefix ? prefix + "[" + p + "]" : p,
        v = obj[p];
      str.push((v !== null && typeof v === "object") ?
        serialize(v, k) :
        encodeURIComponent(k) + "=" + encodeURIComponent(v));
    }
  }
  return str.join("&");
}

/* "serialize()" from:
 * https://stackoverflow.com/questions/1714786/query-string-encoding-of-a-javascript-object
 * edited Mar 5 '18 at 13:08
 * user187291
 * https://stackoverflow.com/users/187291/user187291  */
