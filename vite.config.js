const path = require("path");
const fs = require("fs");

import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        host: "bookswap.local",
        port: 5173,
        cors: true,
        watch: {
            usePolling: true,
        },
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        {
            name: "blade-css-rebuild",
            handleHotUpdate({ file, server }) {
                if (file.endsWith(".blade.php")) {
                    const cssFile = path.resolve("./resources/css/app.css");
                    const time = Date.now() / 1000;
                    fs.utimesSync(cssFile, time, time);
                    server.ws.send({
                        type: "full-reload",
                        path: "*",
                    });
                }
            },
        },
    ],
});
