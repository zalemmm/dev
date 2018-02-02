var gulp         = require( 'gulp' );
var browserSync  = require( 'browser-sync' ).create();

// Start browserSync & watch php changes

gulp.task( 'watch', function() {
    browserSync.init({
      injectChanges: true,
      proxy: "http://127.0.0.1/wordpress",
      port: 8000
    });
    gulp.watch( '*.php' ).on( 'change', browserSync.reload );
});

gulp.task( 'default', ['watch']);
