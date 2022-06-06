module.exports = { 
    content: [ 
        "./resources/views/dashboard/*.blade.php",    
        "./resources/views/dashboard/**/*.blade.php",    
        "./resources/views/components/*.blade.php",  
        "./resources/js/dashboard/*.js",  
        "./resources/js/dashboard/**/*.js",  
    ],
    theme: { 
        extend: {
            colors : {
                primary : '#1a73e8',
                primarydark : '#1160c8',
            },
            spacing: {
                // '119': '29.75rem',
                // '320': '80rem',
            }
        },
    },
    plugins: [
        // require('@tailwindcss/forms'),
    ],
}