/** @type {import('tailwindcss').Config} */
export default {
    content: ['./resources/**/*.blade.php','./resources/**/*.js'],
    theme: {
        container: {
            padding: {
                DEFAULT: '1rem',
                sm: '2rem',
                lg: '4rem',
                xl: '5rem',
                '2xl': '6rem',
            },
        },
        extend: {},
    },
    plugins: [require("daisyui")],
    daisyui: {
        themes: ["light", "cupcake"], // Встановлює тільки світлу тему
    },
    darkMode: false, // Вимикає підтримку темного режиму
}
