$(document).ready(function() {
	/* TODO: Move all stats page logic into one Javascript file, including this snippet that
	 * dynamically fetches the name
	 */
	$.get("/auth-user").done(function(name) {
		$("#user-greeting").text('Welcome, ' + JSON.parse(name));
	});
	// Initialize the Birthday Table View
	new BirthdayTableView();
})