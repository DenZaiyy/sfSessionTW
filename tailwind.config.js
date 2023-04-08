/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./assets/styles/*.css",
        "./assets/**/*.js",
        "./templates/**/*.html.twig",
    ],
    theme: {
        extend: {},
    },
    plugins: [require("@tailwindcss/forms")],
};
