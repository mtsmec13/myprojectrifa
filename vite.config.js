import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
    // =========================================================================
    // CORREÇÃO APLICADA AQUI
    // Esta configuração diz ao Vite para NÃO vigiar as pastas 'vendor' e 'node_modules',
    // resolvendo o erro "ENOSPC: System limit for number of file watchers reached".
    // =========================================================================
    server: {
        watch: {
            ignored: [
                '**/node_modules/**',
                '**/vendor/**',
            ],
        },
    },
});


