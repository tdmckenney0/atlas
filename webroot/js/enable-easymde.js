window.addEventListener('DOMContentLoaded', docReady => {
    document.querySelectorAll('textarea').forEach(function(v, k, o) {
        v.EasyMDE = new EasyMDE({
            element: v,
            autoDownloadFontAwesome: false
        });
    });
});
