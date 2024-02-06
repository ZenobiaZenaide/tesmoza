/** @type {import('tailwindcss').Config} */
export default {
  content: ["./src/**/*.{html,js}",
  './resources/**/*.blade.php',
  './resources/**/*.js',
  './resources/**/*.vue',
  './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

