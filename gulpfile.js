/* projetWeb/csiangleur
 *
 * /gulpfile.js - gulp tasks
 *
 * Coded by Mathieu Claessens
 * started at 28/11/2016
*/

// Définition des dépendance dont on a besoin pour exécuter les taches.
var
    gulp = require( 'gulp' ),
    imagemin = require( 'gulp-imagemin' ),
    newer = require( 'gulp-newer' ),
    size = require( 'gulp-size' ),
    destClean = require( 'gulp-dest-clean' ),
    imacss = require( 'gulp-imacss' ),
    sass = require( 'gulp-sass' ),
    preprocess = require( 'gulp-preprocess' ),
    pkg = require( './package.json' ),
    htmlClean = require( 'gulp-htmlclean' ),
    browserSync = require( 'browser-sync' ),
    del = require( 'del' ),
    pump = require( 'pump' ),
    uglify = require( 'gulp-uglify' ),
    autoprefixer = require('gulp-autoprefixer');

// Définition de quelques variables générales pour notre gulpfile.
var
    devBuild = ( ( process.env.NODE_ENV || 'development' ).trim().toLowerCase() !== 'production' ),
    sSource = 'laravel/resources/assets/',
    sDest = 'laravel/public/';

// Définition de quelques variables liées à nos taches (options de taches).
var
    oImagesOpts = {
        // *.* => "expression régulière quelque chose . quelque chose"
        in: sSource + 'img//**/*.*',
        out: sDest + 'img/',
        watch: sSource + 'img/**'
    },
    oImageUriOpts = {
        in: sSource + 'img/inline/*.*',
        out: sSource + 'scss/images/',
        filename: '_datauri.scss',
        namespace: 'img'
    },
    oCss = {
        in: sSource + 'sass/styles.scss',
        watch: [sSource + 'sass/**/*'],
        out: sDest + 'css/',
        oSassOpts: {
            outputStyle: 'nested',
            precision: 3,
            errLogToConsole: true
        }
    },
    oJs = {
        in: sSource + 'js/*',
        watch: [sSource + 'js/*'],
        out: sDest + 'js/'
    },
    oHtml = {
        in: sSource + '*.html',
        watch: [sSource + '*.html', sSource + 'template/**/*'],
        out: sDest,
        oContext: {
            devBuild: devBuild,
            author: pkg.author,
            version: pkg.version
        }
    },
    oSyncOpts = {
        server: {
            baseDir: sDest,
            index: 'index.php'
        },
        open: false,
        notify: true
    };

// Définition des taches.
gulp.task( 'clean', function(){
    del( [sDest + '*'] )
} )

gulp.task( 'images', function(){
    return gulp.src( oImagesOpts.in )
        .pipe( destClean( oImagesOpts.out ) )
        // pipe() permet d'enchainer les actions l'une à la suite de l'autre.
        // permet de ne faire que ce qui n'est pas encore fait sans recommencer depuis le début.
        .pipe( newer( oImagesOpts.out ) )
        .pipe( size( {title: 'Images size before compression: ', showFiles: true} ) )
        .pipe( imagemin() )
        .pipe( size( {title: 'Images size after compression: ', showFiles: true} ) )
        .pipe( gulp.dest( oImagesOpts.out ) );
} )

gulp.task( 'imageuri', function(){
    return gulp.src( oImageUriOpts.in )
        .pipe( imagemin() )
        .pipe( imacss( oImageUriOpts.filename, oImageUriOpts.namespace ) )
        .pipe( gulp.dest( oImageUriOpts.out ) );
} )

gulp.task( 'html', function(){
    var page = gulp.src( oHtml.in ).pipe( preprocess( {context: oHtml.oContext} ) )
    if (!devBuild) {
        page = page
            .pipe( size( {title:'HTML avant minification: '} ) )
            .pipe( htmlClean() )
            .pipe( size( {title:'HTML après minification: '} ) );
    }

    return page.pipe( gulp.dest( oHtml.out ) );
} )

gulp.task( 'browsersync', function(){
    browserSync( oSyncOpts );
} )

gulp.task( 'sass', function(){
    return gulp.src( oCss.in )
        .pipe(sass().on('error', sass.logError))
        // .pipe(sass( oCss.oSassOpts ))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe( gulp.dest(oCss.out) )
        .pipe( browserSync.reload( {stream: true} ) );
} )

gulp.task('js', function (cb) {
  pump([
        gulp.src( oJs.in ),
        uglify(),
        gulp.dest( oJs.out )
    ],
    cb
  );
});

// Tache par défault exécuté lorsqu'on tape juste gulp dans le terminal.
gulp.task('default', ['images', 'sass', 'js'], function(){
    gulp.watch( oHtml.watch, ['html', browserSync.reload] );
    gulp.watch( oImagesOpts.watch, ['images'] );
    gulp.watch( oCss.watch, ['sass'] );
    gulp.watch( oJs.watch, [ 'js' ] );
});
