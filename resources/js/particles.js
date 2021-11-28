require('particles.js/particles');

if($('#particles-js')){
    window.particlesJS.load('particles-js','js/particlesjs-config.json', () =>
        console.log('callback - particles-js config loaded')
    );
}
