jQuery(document).ready(function($) {
    // Function to start the fireworks effect.
    function startFireworks() {
        particlesJS('fireworks-container', {
            // Configuration for the particles.js fireworks effect.
            // Customize the properties as needed.
            particles: { 
                number: {
                    value: 100,
                    density: {
                        enable: true,
                        value_area: 800,
                    },
                },
        color: {
            value: diviFireworks.particleColors,
        },

        shape: {
            type: 'circle',
        },
        opacity: {
            value: parseFloat(diviFireworks.particleOpacity),
        },
        size: {
            value: parseFloat(diviFireworks.particleSize),
        },
        line_linked: {
        enable: false,
        },
        move: {
            speed: parseFloat(diviFireworks.particleSpeed),
    },
},
            },
            retina_detect: true,
        });
    }

    // Function to stop the fireworks effect.
    function stopFireworks() {
        if (window.pJSDom && window.pJSDom.length > 0) {
            window.pJSDom[0].pJS.fn.vendors.destroypJS();
            window.pJSDom = [];
        }
    }

    // Add a click event listener to the fireworks button.
    $('.fireworks-button .et_pb_button').on('click', function(e) {
        e.preventDefault();

        // Start the fireworks effect.
        startFireworks();

        // Stop the fireworks effect after 3 seconds.
        setTimeout(() => {
            stopFireworks();
        }, 3000);
    });
});
