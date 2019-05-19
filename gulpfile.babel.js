/**
 * for development : gulp
 * for build : gulp build --prod
 * to reset build: gulp clean
 */

/* Set the path to the theme running on localhost */
const localurl = "http://localhost/projects/yeezydrops/";

import gulp from 'gulp';
import {
    src,
    dest,
    watch,
    series,
    parallel
} from 'gulp';
import yargs from 'yargs';
import sass from 'gulp-sass';
import cleanCss from 'gulp-clean-css';
import gulpif from 'gulp-if';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'autoprefixer';
import imagemin from 'gulp-imagemin';
import del from 'del';
import browserSync from 'browser-sync';
import zip from "gulp-zip";
import info from "./package.json";
import webpack from "webpack-stream";
import named from 'vinyl-named';

// Call with --prod to use production mode
const PRODUCTION = yargs.argv.prod;

/**
 * Compiles Sass files to bundle.css
 * If prod -> minify & prefix
 * If !prod > set sourcemap
 */
export const styles = () => {
    return src(['src/scss/bundle.scss'])
        .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
        .pipe(sass().on('error', sass.logError))
        .pipe(gulpif(PRODUCTION, postcss([autoprefixer])))
        .pipe(gulpif(PRODUCTION, cleanCss({
            compatibility: 'ie8'
        })))
        .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
        .pipe(dest('dist/css'))
        .pipe(server.stream());
}

/**
 * Compress images
 * Only works in production mode
 */
export const images = () => {
    return src('src/images/**/*.{jpg,jpeg,png,svg,gif}')
        .pipe(gulpif(PRODUCTION, imagemin()))
        .pipe(dest('dist/images'));
}

/**
 * Copy all files and folders exept for images and css
 */
export const copy = () => {
    return src(['src/**/*', '!src/{images,js,scss}', '!src/{images,js,scss}/**/*'])
        .pipe(dest('dist'));
}

/* Write all js files to dist */
export const scripts = () => {
    return src('src/js/bundle.js')
        .pipe(webpack({
            module: {
                rules: [{
                    test: /\.js$/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: []
                        }
                    }
                }]
            },
            mode: PRODUCTION ? 'production' : 'development',
            devtool: !PRODUCTION ? 'inline-source-map' : false,
            output: {
                filename: 'bundle.js'
            },
        }))
        .pipe(dest('dist/js'));
}

/**
 * Deletes content of dist folder
 * Needed if things in src get deleted
 */
export const clean = () => del(['dist']);

/**
 * Start browsersync server
 */
const server = browserSync.create();
export const serve = done => {
    server.init({
        proxy: localurl
    });
    done();
};

/**
 * Reload live server
 */
export const reload = done => {
    server.reload();
    done();
};

/**
 * Zip the theme
 */
export const compress = () => {
    return src([
            "**/*",
            "!node_modules{,/**}",
            "!bundled{,/**}",
            "!src{,/**}",
            "!.babelrc",
            "!.gitignore",
            "!gulpfile.babel.js",
            "!package.json",
            "!package-lock.json",
        ])
        .pipe(zip(`${info.name}.zip`))
        .pipe(dest('bundled'));
};

export const watchForChanges = () => {
    watch('src/scss/**/*.scss', series(styles)); // No reload needed because of stream in styles function
    watch('src/images/**/*.{jpg,jpeg,png,svg,gif}', series(images, reload));
    watch(['src/**/*', '!src/{images,js,scss}', '!src/{images,js,scss}/**/*'], series(copy, reload));
    watch('src/js/**/*.js', series(scripts, reload));
    watch("**/*.php", reload);
}

// First clean dist -> compile sass, compres images, copy the rest -> Start browsersync -> Watch for changes
export const dev = series(clean, parallel(styles, images, copy, scripts), serve, watchForChanges);

// First clean dist -> compile sass, compres images, copy the rest -> Put all files in zip file
export const build = series(clean, parallel(styles, images, copy, scripts), compress);

export default dev;