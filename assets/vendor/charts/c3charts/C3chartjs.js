(function(window, document, $, undefined) {
    "use strict";
    $(function() {

        if ($('#c3chart_donut').length) {
            var chart = c3.generate({
                bindto: "#c3chart_donut",
                data: {
                    columns: [
                        ["Aprobado", 2],
                        ["Rechazado", 2],
                        ["Pendiente", 1],
                    ],
                    type: 'donut',
                    onclick: function(d, i) { console.log("onclick", d, i); },
                    onmouseover: function(d, i) { console.log("onmouseover", d, i); },
                    onmouseout: function(d, i) { console.log("onmouseout", d, i); },
                },
                donut: {
                    title: "Vacaciones"
                }

            });
        }

    });

})(window, document, window.jQuery);