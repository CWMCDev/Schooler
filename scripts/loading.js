var loadingScreen = $('#loading');

function startLoadingAnimation(){
	var square = new Sonic({

		width: 100,
		height: 50,
		padding: 10,

		stepsPerFrame: 2,
		trailLength: 1,
		pointDistance: .03,

		strokeColor: '#FF7B24',
		
		step: 'fader',

		multiplier: 2,

		setup: function() {
			this._.lineWidth = 5;
		},

		path: [
		
			['arc', 10, 10, 10, -270, -90],
			['bezier', 10, 0, 40, 20, 20, 0, 30, 20],
			['arc', 40, 10, 10, 90, -90],
			['bezier', 40, 0, 10, 20, 30, 0, 20, 20]
		]
	});

square.play();

document.body.appendChild(square.canvas);
}

function stopLoadingAnimation(){
	loadingScreen.addClass('hidden');
}