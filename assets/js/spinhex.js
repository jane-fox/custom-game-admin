

var size = 200;
var spacing = 0;
var thickness = 30;
var color = '#5a555f';
var color_accent = '#6050f0';
//Var color = "#5a555f";
//var color = "#e8624c";



// Start script on page load
document.addEventListener( 'DOMContentLoaded', function( event ) {

	console.log( 'Loaded!' );

	var canvas = document.getElementById( 'hex-canvas' );

	if ( canvas ) {
		//Make a new gif and set its target
		var new_gif = new js_gif({ target: 'hex-canvas' });

	}

});

function js_gif( options ) {


	//Set defaults for options
	options = options || {};
	options.target = options.target || {};


	//Setup variables
	//var encoder = new GIFEncoder();
	var canvas = document.getElementById( 'hex-canvas' );
	var ctx = canvas.getContext( '2d' );
	var width = window.innerWidth + 400;
	var height = 800;
	//Var height = window.innerHeight;

	canvas.width = width;
	canvas.height = height;

	var bg_color = '#409';

	// A canvas to draw our hexagon on, to re-use in tiling
	var hex_canvas = document.createElement( 'canvas' );
	hex_canvas.width = size * 5;
	hex_canvas.height = size * 5;
	var hex_ctx = hex_canvas.getContext( '2d' );

	// Default line style
	hex_ctx.strokeStyle = color;
	hex_ctx.fillStyle = color;
	hex_ctx.lineCap = 'round';
	hex_ctx.lineWidth = thickness;

	var angles = [];
	var points = [];
	angles[0] = new angle( size, 0 );
	angles[1] = new angle( size, 2 );
	angles[2] = new angle( size, 4 );

	var frame = 0;
	var speed = 0.5;
	var total_frames = 73;
	var compile_gif = false;
	var gif_done = false;

	var init = function() {

		//Encoder.start();

		//Set up drawing path
		for ( var i = 0; i < 6; i++ ) {

			//Var angle = 2 * Math.PI / 6 * (i +.5);
			var angle = 2 * Math.PI / 6 * i;

			//Center + size + cos(angle)
			var line_x = hex_canvas.width / 2 + size * Math.cos( angle );
			var line_y = hex_canvas.width / 2 + size * Math.sin( angle );

			// Corner coordinates for hexagons
			points.push({ x: line_x, y: line_y });

		}//Path

		// Start the animation
		animation_step();

		//Console.log(angles);

	};

	var animation_step = function() {

		frame += 1;

		//speed = Math.cos(frame/100)/10;
		var change = Math.sin(frame / 60) ;
		//var change =1;

		// Not actually sure how this part works, but it makes the point go round in a circle
		var circular = Math.PI / 180;

		speed = Math.PI / 180;
		console.log(change);


		ctx.clearRect( 0, 0, canvas.width, canvas.height );
		hex_ctx.clearRect( 0, 0, hex_canvas.width, hex_canvas.height );




		// The hexagons are made of 3 parts that connect together
		// Rotating canvas in place is a bit difficult, so just redraw the parts
		hex_ctx.beginPath();


		///1st seciton
		var new_x_1 = points[1].x + size * Math.cos( ( frame - 60 ) * circular + change );
		var new_y_1 = points[1].y + size * Math.sin( ( frame - 60  ) * circular + change  );

		hex_ctx.moveTo( points[1].x, points[1].y );
		hex_ctx.lineTo( new_x_1, new_y_1);


		///2nd seciton
		var new_x_2 = points[3].x + size * Math.cos( ( frame + 60  ) * circular + change  );
		var new_y_2 = points[3].y + size * Math.sin( ( frame + 60  ) * circular + change  );

		hex_ctx.moveTo( points[3].x, points[3].y );
		hex_ctx.lineTo( new_x_2, new_y_2 );


		///3rd seciton
		var new_x_3 = points[5].x + size * Math.cos( ( frame - 180 ) * circular + change  );
		var new_y_3 = points[5].y + size * Math.sin( ( frame - 180  ) * circular + change  );

		hex_ctx.moveTo( points[5].x, points[5].y );
		hex_ctx.lineTo( new_x_3, new_y_3 );

		// finish main hexgon section
		hex_ctx.stroke();
		hex_ctx.closePath();


		hex_ctx.fillStyle = color;

		// Circle tips at the end of the line
		hex_ctx.beginPath();
		hex_ctx.arc(new_x_3, new_y_3, thickness, 0, Math.PI*2);
		hex_ctx.fill();
		hex_ctx.closePath();

		// Each must begin and close seperately or it will fill the space between
		hex_ctx.beginPath();
		hex_ctx.arc(new_x_1, new_y_1, thickness, 0, Math.PI*2);
		hex_ctx.fill();
		hex_ctx.closePath();

		hex_ctx.beginPath();
		hex_ctx.arc(new_x_2, new_y_2, thickness, 0, Math.PI*2);
		hex_ctx.fill();
		hex_ctx.closePath();


		hex_ctx.fillStyle = color_accent;

		// Inner circles
		hex_ctx.beginPath();
		hex_ctx.arc(new_x_1, new_y_1, thickness/2, 0, Math.PI*2);
		hex_ctx.fill();
		hex_ctx.closePath();

		hex_ctx.beginPath();
		hex_ctx.arc(new_x_2, new_y_2, thickness/2, 0, Math.PI*2);
		hex_ctx.fill();
		hex_ctx.closePath();

		hex_ctx.beginPath();
		hex_ctx.arc(new_x_3, new_y_3, thickness/2, 0, Math.PI*2);
		hex_ctx.fill();
		hex_ctx.closePath();





		//Loop through to draw tons of hexagons to fill the screen!
		for ( a = -5; a < 3; a++ ) {

			for ( b = -5; b < 3; b++ ) {

				var pos = get_pos( a, b );
				//Draw_hex(pos.x, pos.y);
				ctx.drawImage( hex_canvas, pos.x, pos.y );

			}

		}


		//Start next frame
		requestAnimationFrame( animation_step );

	}; // Animation_step


	// This will call init when object is created.
	init();

} // Js_gif

function update_canvas() {
	var width = window.innerWidth;
	var height = window.innerHeight;

	canvas.width = width;
	canvas.height = height;
}

function get_pos( x, y ) {

	var width = window.innerWidth;
	var height = window.innerHeight;

	var map_x = Math.round( width / 2 +  ( size + spacing ) * 3 / 2 * x );
	var map_y = Math.round( height / 2 + ( size + spacing ) * Math.sqrt( 3 ) * ( y + x / 2 ) );

	return { x:map_x, y: map_y };
}

function draw_hex( x, y ) {

	ctx.save();

	for ( i = 0; i < thinger.angles.length; i++ ) {
		ctx.rotate( i * Math.PI / 180 );

		//Ctx.rotate(i*Math.PI/180);
		ctx.drawImage( thinger.angles[i].canvas, x, y );
	}

	ctx.restore();

}

var angle = function( size, offset ) {

	size = size || 32;
	offset = offset || 0;


	//Var canvas = document.createElement('canvas');
	var canvas = document.createElement( 'canvas' );

	//Set canvas to be just big enough to contain the hex
	canvas.width = canvas.height = size * 2.2;

	var context = canvas.getContext( '2d' );

	context.beginPath();

	//Set up drawing path
	for ( var i = 1 + offset; i < 4 + offset; i++ ) {

		//Var angle = 2 * Math.PI / 6 * (i +.5);
		var angle = 2 * Math.PI / 6 * i;

		//Center + size + cos(angle)
		var line_x = canvas.width / 2 + size * Math.cos( angle );
		var line_y = canvas.width / 2 + size * Math.sin( angle );

		if ( i == offset + 2 ) {
			var mid_x = line_x;
			var mid_y = line_y;
		}

		if ( i == 1 ) {
			context.moveTo( line_x, line_y );
		} else {
			context.lineTo( line_x, line_y );
		}

	}//Path

	context.strokeStyle = color;
	context.fillStyle = '#428';
	context.lineWidth = thickness;
	context.lineCap = 'round';


	//Draw polygon
	//context.fill();
	context.stroke();
	context.closePath();

};
