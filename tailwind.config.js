/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                dark: {
                    DEFAULT: '#0F172A',
                    accent: '#1E293B',
                    // lightAccent: '#5A5B61',
                },
                light: {
                    DEFAULT: '#C1C1C1',
                },
                secondary: {
                    DEFAULT: '#FED504',
                    hover: '#CBAA03',
                    active: '#D5BB35',
                },
                primary: {
                    DEFAULT: '#6C4DE6',
                    hover: '#8971EB',
                    active: '#6E5ABC',
                },
                success: {
                    DEFAULT: '#44C247',
                    hover: '#369B39',
                    active: '#5EAF61',
                },
                danger: {
                    DEFAULT: '#AA070C',
                    hover: '#88060A',
                    active: '#941F23',
                },
                warning: '#FCAD1D',
            },
        },
    },
    plugins: [],
};
