function loadScripts(scripts, callback) {
    let loaded = 0;

    function onLoad() {
        loaded++;
        if (loaded === scripts.length && typeof callback === "function") {
            callback();
        }
    }

    scripts.forEach(src => {
        const script = document.createElement('script');
        script.src = src;
        script.defer = true;
        script.onload = onLoad;
        document.head.appendChild(script);
    });
}

const scriptFiles = [
    /**Register module file here */
];

loadScripts(scriptFiles, function () {
    console.log("All scripts loaded successfully.");
});
