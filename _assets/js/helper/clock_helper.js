/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//Clock
function updateClock( )
{
      //var dayNames = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
      var dayNames = new Array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");

      //var monthNames = new Array("January","February","March","April","May","June","July","August","September","October","November","December");
      var monthNames = new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

      var currentTime = new Date( );

      var currentDate = currentTime.getDate( );
      var currentMonth = currentTime.getMonth( );
      var currentYear = currentTime.getYear( );
      // Y2K compliant
      if (currentYear < 1000) currentYear +=1900;

      var currentHours = currentTime.getHours( );
      var currentMinutes = currentTime.getMinutes( );
      var currentSeconds = currentTime.getSeconds( );

      // Pad the minutes and seconds with leading zeros, if required
      currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
      currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

      // Choose either "AM" or "PM" as appropriate
      var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

      // Convert the hours component to 12-hour format if needed
      currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

      // Convert an hours component of "0" to "12"
      currentHours = ( currentHours == 0 ) ? 12 : currentHours;

      // Compose the string for display
      var currentTimeString = dayNames[currentTime.getDay( )] + ", " + currentDate + " " + monthNames[currentMonth] + " " + currentYear + " | " + currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;

      // Update the time display
      document.getElementById("clock").firstChild.nodeValue = currentTimeString;
}

//datetime now
function Now_date()
{
      //var dayNames = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
      var dayNames = new Array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");

      //var monthNames = new Array("January","February","March","April","May","June","July","August","September","October","November","December");
      var monthNames = new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

      var currentTime = new Date( );

      var currentDate = currentTime.getDate( );
      var currentMonth = currentTime.getMonth( )+1;
      var currentYear = currentTime.getYear( );
      // Y2K compliant
      if (currentYear < 1000) currentYear +=1900;

      var currentHours = currentTime.getHours( );
      var currentMinutes = currentTime.getMinutes( );
      var currentSeconds = currentTime.getSeconds( );

      // Pad the minutes and seconds with leading zeros, if required
      currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
      currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
      
      currentMonth = ( currentMonth < 10 ? "0" : "" ) + currentMonth;
      currentDate = ( currentDate < 10 ? "0" : "" ) + currentDate;

      // Choose either "AM" or "PM" as appropriate
      var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

      // Convert the hours component to 12-hour format if needed
      currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

      // Convert an hours component of "0" to "12"
      currentHours = ( currentHours == 0 ) ? 12 : currentHours;

      // Compose the string for display
      var currentTimeString = currentDate + "/" + currentMonth + "/" + currentYear;

      return currentTimeString;
}
