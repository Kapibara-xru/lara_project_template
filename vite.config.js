import { defineConfig, loadEnv } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueJsx from '@vitejs/plugin-vue-jsx'
import VueDevTools from 'vite-plugin-vue-devtools'
import laravel from 'laravel-vite-plugin'
import commonjs from 'vite-plugin-commonjs'
import babel from 'vite-plugin-babel'
import path from 'path'

export default ({ mode }) => {
    const env = loadEnv(mode, process.cwd(), '')

    return defineConfig({
        define: {
            'process.env': env
        },
        resolve: {
            alias: {
                '@': path.resolve(__dirname, './resources/js')
            }
        },
        plugins: [
            vue(),
            laravel({
                input: ['resources/scss/style.scss', 'resources/js/app.js'],
                refresh: true
            }),
            vueJsx(),
            VueDevTools(),
            commonjs(),
            babel({
                babelConfig: {
                    presets: ['@babel/preset-env'],
                    plugins: [['@babel/plugin-transform-runtime']],
                },
            })
        ],
        optimizeDeps: {
            esbuildOptions: {
                target: 'es2021',
            },
        },
        build: {
            target: 'es2021',
        },
        server: {
            hmr: {
                host: 'localhost',
                clientPort: env.VITE_PORT,
                protocol: 'ws'
            },
            watch: {
                usePolling: true
            }
        },
    })
}
