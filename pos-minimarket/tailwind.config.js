import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    corePlugins: {
        preflight: false,  // Nonaktifkan preflight agar tidak menimpa gaya adminLTE
    },

    plugins: [
        forms,
        typography,
    ],

    // Menambahkan namespace agar kelas Tailwind tidak bercampur dengan AdminLTE
    safelist: [
        'dataTable', 'paginate_button', 'dataTables_length', 'dataTables_filter', 'dataTables_info',
    ],

    // // Menggunakan namespace untuk kelas Tailwind CSS
    // prefix: 'tw-',  // Menggunakan prefix 'tw-' untuk semua kelas Tailwind
};
