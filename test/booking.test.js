const booking = require( "../res/js/booking" );
const assert = require( "assert" );
const d = new Date();

describe( "GX App sample Unit Tests", function () 
{
    describe( "Add 2 numbers", function () 
	{
        it( "This should be correct", function () 
		{
			assert.equal(booking.addNumbers(2,2), 4);
        });

		it( "This should fail", function () 
		{
			assert.equal(booking.addNumbers(2,2), 5);
        });
    });

    describe( "Subtract 2 numbers", function () 
	{
        it( "This should be correct", function () 
		{
			assert.equal(booking.subtractNumbers(10, 5), 5);
        });

		it( "This should fail", function () 
		{
			assert.equal(booking.subtractNumbers(10, 5), 10);
        });
    });

    describe( "Get current date items", function () 
	{
		let day = d.getDate();
        it( "The day", function () 
		{
			assert.equal(booking.showDate(0), day);
        });

		let dayName = d.getDay();
        it( "The day's name", function () 
		{
			assert.equal(booking.showDate(1), dayName);
        });

		let year = d.getFullYear();
        it( "The year", function () 
		{
			assert.equal(booking.showDate(2), year);
        });

		let fullDate = d;
        it( "The full date: Should fail as date is fetched at 2 instances", function () 
		{
			assert.equal(booking.showDate(3), fullDate);
        });

    });
});
