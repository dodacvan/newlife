/**
 * Custom scripts needed for the colorpicker, image button selectors,
 * and navigation tabs.
 */

jQuery(document).ready(function($) {
	$("#mmode").detach().appendTo("body");
	$("#mmode").css("height", "100%");
	
	
	var clock;
	// Grab the current date
	var currentDate = new Date();
	
	
	
	var mdate = new Date( mmode.mmode_date );
	mdate.setHours ( mmode.mmode_hours );
	mdate.setMinutes ( 0 );
	
	var futureDate  = mdate;
	//var futureDate = new Date(year, month, day, hours, minutes, seconds, milliseconds)
				
	// Calculate the difference in seconds between the future and current date
	var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;

	//console.log("mmode.mmode_date : "+mmode.mmode_date+"\n"+"mmode.mmode_hours : "+mmode.mmode_hours+"\n"+"mdate 2 : "+mdate);

	// Instantiate a coutdown FlipClock
	if( diff > 0 )
	{
		clock = $('.mm-clock').FlipClock(diff, {
			clockFace: 'DailyCounter',
				countdown: true
		});
	}

	
});