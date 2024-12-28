import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        port: 5174, // update the port number
        //host: '103.56.148.122', // set to allow connections from all interfaces
        host: 'localhost',
        https: false,
        open: false,
      },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 
                'resources/js/app.js',
                'node_modules/ajaxable/dist/ajaxable.min.js'
            ],
            refresh: true,
        }),
    ],
});
