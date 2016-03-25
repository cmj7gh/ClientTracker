var BirthdayTableView = Backbone.View.extend({
	el: "#birthdays",

	// Template to render each student's name and link to profile
	studentTemplate: _.template('<a href="../students/view/<%= id%>" class="birthday-person"><%= name%></a>'),
	staffTemplate: _.template('<a class="birthday-person"><%= name%></a>'),
	initialize: function(options) {
		// Initialize the data model associated with this view
		this.model = new BirthdayTableModel();
		this.model.fetch().done(_.bind(this.render, this));
	},

	renderNextDayHeader: function() {
		var nextDay = this.model.get('nextDay');
		$('#two-days-out').text(nextDay + "'s Birthdays");
	},

	renderNone: function(day, selector) {
		if (day['staff'].length + day['students'].length == 0) {
			$("#" + selector).text("None");
		}
	},

	renderBirthdayList: function(day, selector) {
		_.each(day['staff'], function(member) {
			$('#' + selector).append(this.staffTemplate({
				name: member.name + " (STAFF)"
			}));
		}, this);

		_.each(day['students'], function(student) {
			$('#' + selector).append(this.studentTemplate(student));
		}, this);
	},

	render: function() {
		// First render the header for the day two days out
		this.renderNextDayHeader();

		// Clear all of the containers that exist
		$("#todays-birthdays").empty();
		$("#tomorrows-birthdays").empty();
		$("#two-days-out-birthdays").empty();

		// Render all the birthday lists if they are present
		this.renderBirthdayList(this.model.get('today'), 'todays-birthdays');
		this.renderBirthdayList(this.model.get('tomorrow'), 'tomorrows-birthdays');
		this.renderBirthdayList(this.model.get('dayAfter'), 'two-days-out-birthdays');

		// Render "None" if need be
		this.renderNone(this.model.get('today'), 'todays-birthdays');
		this.renderNone(this.model.get('tomorrow'), 'tomorrows-birthdays');
		this.renderNone(this.model.get('dayAfter'), 'two-days-out-birthdays');
	}
});