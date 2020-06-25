function send(obin) {
    
    const burl = 'users.php';
    const XHR = new XMLHttpRequest(); 
    
    XHR.open('POST', burl + '?' + serialize(obin));
    
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
    };
    
    XHR.send();
}

serialize = function(obj) { // see StackOverflow credits below
  let str = [], p;
  for (p in obj) {
    if (obj.hasOwnProperty(p)) {
      const k = "[" + p + "]",       v = obj[p];
      str.push((v !== null && typeof v === "object") ?
        serialize(v, k) :
        encodeURIComponent(k) + "=" + encodeURIComponent(v));
    }
  }
  return str.join("&");
}

/* I (Kwynn) started "serialize()" from:
 * https://stackoverflow.com/questions/1714786/query-string-encoding-of-a-javascript-object
 * edited Mar 5 '18 at 13:08
 * user187291
 * https://stackoverflow.com/users/187291/user187291  */
