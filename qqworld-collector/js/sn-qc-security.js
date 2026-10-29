/* 管理员页面的旧版 AJAX、REST 和表单使用当前会话 nonce。 */
(function (config, $) {
    "use strict";
    if (!config) return;
    var ajaxURL = new URL(config.ajax, location.href);
    var restURL = new URL(config.rest, location.href);
    function isRest(url) {
        return url.origin === location.origin &&
            (url.pathname.indexOf(restURL.pathname) === 0 || url.searchParams.has("rest_route"));
    }
    $.ajaxPrefilter(function (options, original, xhr) {
        try {
            var url = new URL(options.url, location.href);
            if (url.origin === ajaxURL.origin && url.pathname === ajaxURL.pathname) {
                xhr.setRequestHeader("X-QC-Admin-Nonce", config.nonce);
            }
            if (isRest(url)) xhr.setRequestHeader("X-WP-Nonce", config.restNonce);
        } catch (error) {}
    });
    function addField(form, name, value) {
        if (form.querySelector('input[name="' + name + '"]')) return;
        var input = document.createElement("input");
        input.type = "hidden"; input.name = name; input.value = value;
        form.appendChild(input);
    }
    $(function () {
        document.querySelectorAll("form").forEach(function (form) {
            try {
                var url = new URL(form.action || location.href, location.href);
                if (url.origin !== location.origin) return;
                addField(form, "qc_admin_nonce", config.nonce);
                if (isRest(url)) addField(form, "_wpnonce", config.restNonce);
            } catch (error) {}
        });
    });
    document.addEventListener("click", function (event) {
        var link = event.target.closest && event.target.closest("a[href]");
        if (!link) return;
        try {
            var url = new URL(link.href, location.href);
            if (isRest(url)) {
                url.searchParams.set("_wpnonce", config.restNonce);
                link.href = url.href;
            }
        } catch (error) {}
    }, true);
})(window.SN_QC_ADMIN, jQuery);
