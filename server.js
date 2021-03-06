// server.js

// set up ======================================================================
// get all the tools we need
var express  = require('express');
var path  = require('path');
var app      = express();
var port     = process.env.PORT || 8080;
var mongoose = require('mongoose');
var passport = require('passport');
var flash    = require('connect-flash');
var multer    =   require( 'multer' );
var upload    =   multer( { dest: 'uploads/' } );
var sizeOf    =   require( 'image-size' );
require( 'string.prototype.startswith' );

var morgan       = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser   = require('body-parser');
var session      = require('express-session');

var configDB = require('./config/database.js');

// configuration ===============================================================
mongoose.connect(configDB.url); // connect to our database

require('./config/passport')(passport); // pass passport for configuration

// set up our express application
app.use(morgan('dev')); // log every request to the console
app.use(cookieParser()); // read cookies (needed for auth)
app.use(bodyParser.json()); // get information from html forms
app.use(bodyParser.urlencoded({ extended: true }));
app.use('/public', express.static(path.join(__dirname + '/public')));
app.use('/images', express.static(__dirname + '/assets'));
app.use('/bootstrap/js', express.static(__dirname + '/assets'));
app.use('/bootstrap', express.static(__dirname + '/assets'));
app.use('/bootstrap/css', express.static(__dirname + '/assets'));
app.use('/bower_components', express.static(path.join(__dirname + '/bower_components')));

app.set('view engine', 'ejs'); // set up ejs for templating

// required for passport
app.use(session({
    secret: 'ibmwatsonimagerecognition', // session secret
    resave: true,
    saveUninitialized: true
}));

app.post( '/upload', upload.single( 'file' ), function( req, res, next ) {

    if ( !req.file.mimetype.startsWith( 'image/' ) ) {
        return res.status( 422 ).json( {
            error : 'The uploaded file must be an image'
        } );
    }

    var dimensions = sizeOf( req.file.path );

    if ( ( dimensions.width < 640 ) || ( dimensions.height < 480 ) ) {
        return res.status( 422 ).json( {
            error : 'The image must be at least 640 x 480px'
        } );
    }
    console.log(req.file);
    return res.status( 200 ).send( req.file );
});
app.use(passport.initialize());
app.use(passport.session()); // persistent login sessions
app.use(flash()); // use connect-flash for flash messages stored in session

// routes ======================================================================
require('./app/routes.js')(app, passport); // load our routes and pass in our app and fully configured passport

// launch ======================================================================
app.listen(port);
console.log('The magic happens on port ' + port);
