/**
 * lp.js
 *
 * @author IS OBS DEV Team
 * @copyright 2017 Interspace Co.,Ltd. All rights reserved.
 */

const LP_UNIX_TIME_0_IN_GMT = "Thu, 01 Jan 1970 00:00:00 GMT";
const LP_UNIX_TIME_MAX_SIGNED_32BIT_INTEGER_IN_GMT = "Tue, 19 Jan 2038 03:14:07 GMT";

/*\
 |*|
 |*|  :: cookies.js ::
 |*|
 |*|  A complete cookies reader/writer framework with full unicode support.
 |*|
 |*|  https://developer.mozilla.org/en-US/docs/DOM/document.cookie
 |*|
 |*|  Syntaxes:
 |*|
 |*|  * docCookies.setItem(name, value[, end[, path[, domain[, secure]]]])
 |*|  * docCookies.getItem(name)
 |*|  * docCookies.removeItem(name[, path])
 |*|  * docCookies.hasItem(name)
 |*|  * docCookies.keys()
 |*|
 \*/

 var docCookies = {
    getItem: function (sKey) {
      if (!sKey || !this.hasItem(sKey)) { return null; }
      return unescape(document.cookie.replace(new RegExp("(?:^|.*;\\s*)" + escape(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*((?:[^;](?!;))*[^;]?).*"), "$1"));
    },
    setItem: function (sKey, sValue, vEnd, sPath, sDomain, bSecure) {
      if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) { return; }
      var sExpires = "";
      if (vEnd) {
        switch (vEnd.constructor) {
          case Number:
            sExpires = vEnd === Infinity ? "; expires=" + LP_UNIX_TIME_MAX_SIGNED_32BIT_INTEGER_IN_GMT : "; max-age=" + vEnd;
            break;
          case String:
            sExpires = "; expires=" + vEnd;
            break;
          case Date:
            sExpires = "; expires=" + vEnd.toGMTString();
            break;
        }
      }
      document.cookie = escape(sKey) + "=" + escape(sValue) + sExpires + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "") + (bSecure ? "; secure" : "");
    },
    removeItem: function (sKey, sPath) {
      if (!sKey || !this.hasItem(sKey)) { return; }
      document.cookie = escape(sKey) + "=; expires=" + LP_UNIX_TIME_0_IN_GMT + (sPath ? "; path=" + sPath : "");
    },
    hasItem: function (sKey) {
      return (new RegExp("(?:^|;\\s*)" + escape(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=")).test(document.cookie);
    },
    keys: /* optional method: you can safely remove it! */ function () {
      var aKeys = document.cookie.replace(/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, "").split(/\s*(?:\=[^;]*)?;\s*/);
      for (var nIdx = 0; nIdx < aKeys.length; nIdx++) { aKeys[nIdx] = unescape(aKeys[nIdx]); }
      return aKeys;
    }
  };

function hasITP(userAgent) {
    var ua = userAgent.toLowerCase();
    if ((ua.indexOf('macintosh') !== -1 || ua.indexOf('iphone') !== -1 || ua.indexOf('ipad') !== -1) &&
        ua.indexOf('safari') !== -1 &&
        ua.indexOf('version') !== -1 &&
        ua.indexOf('chrome') === -1 &&
        ua.indexOf('edge') === -1) {
        var iosVersion = ua.match(/os (\d{2})_/);
        if (iosVersion !== null && +iosVersion[1] >= 11) {
            return true;
        }
        var macVersion = ua.match(/mac os x 10_(\d{2})/);
        if (macVersion !== null && +macVersion[1] >= 13) {
            return true;
        }
    }
    return false;
}
function getParams(query) {
    var params = query.split('&');
    var obj = {};
    for(var kv in params) {
        var pair = params[kv].split('=');
        var key = decodeURIComponent(pair[0]);
		if (key == 'atnct') {
            var atncts = decodeURIComponent(pair[1]).split('_');
			obj['tag'] = atncts[0];
			obj['rk'] = atncts[1];
        }
    }
    return obj;
}
function nextYear(dt) {
    var dt = new Date();
    dt.setFullYear(dt.getFullYear() + 1);
    return dt;
}
function storeRkInCookie(tag, rk, hostname) {
    var expiredAt = nextYear();
    if (docCookies.hasItem('_atnct')) {
        // if Cookies has been saved already and available, we're going to use saved hostname as domain.
        var ck = JSON.parse(docCookies.getItem('_atnct'));
        var hsname = ck._hostname || hostname;
        ck[tag] = rk;
        docCookies.setItem('_atnct', JSON.stringify(ck), expiredAt, '/', '.' + hsname, false);
    } else {

        // In order to separate sub-domain, we have to ref with TLD list but it will make the script is much more bigger
        // so we just separate domain into formats like this: www.interspace.ne.jp -> jp, ne.jp, interspace.ne.jp
        // and set them to Cookie as above order.
        // Loop until Cookie is set.
        var ck = {};
        ck[tag] = rk;
        var x = hostname.split('.');
        for (var i = 1; i <= x.length && !docCookies.hasItem('_atnct'); i++) {
            var hsname = x.slice(-i).join('.');
            ck['_hostname'] = hsname;
            docCookies.setItem('_atnct', JSON.stringify(ck), expiredAt, '/', '.' + hsname, false);
        }
    }
}
function storeRkInLocalStorage(tag, rk) {
    var ls = JSON.parse(localStorage.getItem('_atnct')) || {};
    ls[tag] = rk;
    localStorage.setItem('_atnct', JSON.stringify(ls));
}
(function() {
    if (hasITP(navigator.userAgent)) {
        var params = getParams(location.search.substring(1));
        var hostname = location.hostname;
        if (params.tag && params.rk) {
            storeRkInLocalStorage(params.tag, params.rk);
            storeRkInCookie(params.tag, params.rk, hostname);
        }
    }
})();
