const browsersync = require("browser-sync");
const gulp = require("gulp");
const phpConnect = require('gulp-connect-php');
const sass = require("gulp-sass");
const sourcemaps = require('gulp-sourcemaps');

function connectsync() {
  phpConnect.server({
    port: 8000,
    keepalive: true,
    base: "src"
  }, function() {
    browsersync({
      proxy: '127.0.0.1:8000'
    });
  });
}

function browserSyncReload(done) {
  browsersync.reload();
  done();
}

function watchFiles() {
  gulp.watch("src/**/*.php", browserSyncReload);
  gulp.watch("src/**/*.html", browserSyncReload);
  gulp.watch("src/assets/scss/**", css);
  gulp.watch('src/assets/scss/**/*.scss').on('change', browsersync.reload);
  gulp.watch('src/assets/js/**/*.js').on('change', browsersync.reload);
}

//compile scss into css
function css() {
  //1.where is my scss
  return gulp
    .src("src/assets/scss/**/*.scss")
    //2. init source maps
    .pipe(sourcemaps.init())
    //3. pass that file through sass compiler
    .pipe(sass().on('error', sass.logError))
    //4. write source maps
    .pipe(sourcemaps.write('../maps'))
    //5. where do I save the compiled css file
    .pipe(gulp.dest('src/assets/css'))
    //6. stream change to all browsers
    .pipe(browsersync.stream());
}

const watch = gulp.parallel([watchFiles, connectsync]);

exports.default = watch;