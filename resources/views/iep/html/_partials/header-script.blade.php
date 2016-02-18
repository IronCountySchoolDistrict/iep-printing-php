<script type="text/javascript">
    function header() {
        var vars = {};
        var x = window.location.search.substring(1).split('&');
        for (var i in x) {
            var z = x[i].split('=', 2);
            vars[z[0]] = unescape(z[1]);
        }

        var x = ['frompage', 'topage', 'page', 'webpage', 'section', 'subsection', 'subsubsection'];
        for (var i in x) {
            var y = document.getElementsByClassName(x[i]);
            if (vars.page === '1') {
                var header = document.getElementById('header');
                header.parentNode.removeChild(header);
            } else {
                for (var j = 0; j < y.length; ++j) {
                    y[j].textContent = vars[x[i]];
                }
            }
        }
    }
</script>
