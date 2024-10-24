import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    "./vendor/mattlibera/livewire-flash/src/publish/livewire-flash.php",
    "./vendor/mattlibera/livewire-flash/src/views/livewire/*.blade.php",
  ],

  theme: {
    screens: {
      'sm': '480px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1200px',
      '2xl': '1400px',
    },
    container: {
      center: true,
      padding: {
        'DEFAULT': '1rem',
        'xl': '2rem',
      }
    },
    extend: {
      fontFamily: {
        base: ['Poppins', ...defaultTheme.fontFamily.sans],
        header: ['Oswald', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        background: colors.white,
        foreground: colors.gray[800],
        muted: {DEFAULT: colors.gray[400], background: colors.gray[200]},
        info: 'rgba(32,181,229, <alpha-value>)',
        secondary: {DEFAULT: colors.orange[600], foreground: colors.gray[50] ,...colors.orange}
      }
    },
  },

  plugins: [forms],
};
