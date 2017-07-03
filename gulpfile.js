
// Packages we're using. Installs with 'npm install'
var gulp = require('gulp');
var sass = require('gulp-sass');
var minify = require('gulp-csso');
var watch = require('gulp-watch');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var sourcemaps = require('gulp-sourcemaps');



// the /**/ will include current and all subdirectories
//var js_dir = "js/**/*.js";
var js_dir = "assets/js/*";
var css_dir = "assets/css";

// this {} will select both types of files
//var css_dir = "css/**/*.{scss,css}";
var sass_dir = "assets/sass/**/*.scss";


var js_output = "assets/scripts.min.js";
var css_output = "assets/styles.min.css";



gulp.task('default', ["sass", "scripts"]);


//Watch each folder and update only relevant code
gulp.task('watch', function() {

	gulp.watch(js_dir, ['scripts']);
	gulp.watch(sass_dir, ['sass']);
	//gulp.watch(template_dir, ['html']);

});


gulp.task('scripts', function() {

    return gulp.src(js_dir)

		// Add sourcemap
		.pipe(sourcemaps.init())

		// Combine files into one
        .pipe(concat(js_output))

		// Minify
        .pipe(uglify())

		// Output
		.pipe(sourcemaps.write('./'))
        .pipe(gulp.dest("./"))
	;

});


gulp.task('sass', function () {

	return gulp.src(sass_dir)
		.pipe(sass({ style: "compressed" }).on('error', sass.logError))
		.pipe(minify())
		.pipe(gulp.dest(css_output))
	;

});


// for combining handlebars templates
gulp.task('html', function() {

	return gulp.src([
			"templates/header.html",
			"templates/navbar.html",
			"templates/hbars.html",
			"templates/footer.html"
		])
		.pipe(concat('index.html'))
		.pipe(gulp.dest("./"))
	;

});
