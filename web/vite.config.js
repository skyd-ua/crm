import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import path from 'path';
import fs from 'fs';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [ react() ],
    root: __dirname,
    server: {
        host: 'web',
        port: 3456,
        hmr: {
            host: 'crm.nbfx.tech',
        },
        watch: {
            usePolling: true,
        },
        https: {
            key: fs.readFileSync(`/crm/web/ssl/private.key`),
            cert: fs.readFileSync(`/crm/web/ssl/certificate.crt`),
        },
        proxy: {
            '/api': {
                target: 'https://crm.nbfx.tech',
                changeOrigin: true,
            },
        },
    },
});
