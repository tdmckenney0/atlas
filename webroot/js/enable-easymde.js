document.addEventListener('readystatechange', docReady => {
    if (event.target.readyState === 'complete') {
        document.querySelectorAll('textarea').forEach(function(v, k, o) {
            v.EasyMDE = new EasyMDE({
                element: v
            });
        });
    }
});
