/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primaryColor: "#165dff",
                primaryHover: "#0a4edf",
            },
        },
    },
    plugins: [],
};
