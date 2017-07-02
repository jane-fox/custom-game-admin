
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
var js_dir = [
	"js/navigation.js",
	"js/skip-link-focus-fix.js",
	"js/bootstrap.min.js",
	"js/parallax.min.js",
	"js/spinhex.js",
	"js/lightbox.js"

];

var js_output = "js/scripts.js";

// this {} will select both types of files
//var css_dir = "css/**/*.{scss,css}";
var sass_dir = [
	"sass/**/*.scss"
];

// For the output of our sass
var css_dir = "css";


var template_dir = "templates/**/*.html";




gulp.task('default', ["sass", "scripts"]);
//gulp.task('default', ["scripts", "sass"]);


//Watch each folder and update only relevant code
gulp.task('watch', function() {

	gulp.watch(js_dir, ['scripts']);
	gulp.watch(sass_dir, ['sass']);
	//gulp.watch(template_dir, ['html']);

});


gulp.task('scripts', function() {

    return gulp.src(js_dir)
		.pipe(sourcemaps.init())
        .pipe(concat(js_output))
        .pipe(uglify())
		.pipe(sourcemaps.write('./'))
        .pipe(gulp.dest("./"))
	;

});


gulp.task('sass', function () {

	return gulp.src(sass_dir)
		.pipe(sass({ style: "compressed" }).on('error', sass.logError))
		.pipe(minify())
		.pipe(gulp.dest(css_dir))
	;

});


// Combine template files
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
