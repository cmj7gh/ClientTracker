var SearchSemestersView = Backbone.View.extend({
	selectOptionTemplate: _.template('<option value="<%= id%>"><%= semester%> <%= year%></option>'),
	initialize: function(options) {
		this.collection = new SearchSemestersCollection();

		// Immediately upon fetching, render the view
		this.collection.fetch().done(_.bind(this.render, this));
	},
	render: function() {
		var urlParams = $.queryStrToJSON();

		this.collection.each(_.bind(function(semester) {

			// Generate the HTML from the template
			var optionHtml = this.selectOptionTemplate({
				id: semester.get('id'),
				semester: semester.get('semester'),
				year: semester.get('year')
			});

			if ($(optionHtml).attr('value') === urlParams['StartSemester']) {
				$('#StartSemester').append($(optionHtml).attr('selected', 'selected'));
				$('#EndSemester').append(optionHtml);
			}

			if ($(optionHtml).attr('value') === urlParams['EndSemester']) {
				$('#EndSemester').append($(optionHtml).attr('selected', 'selected'));
				$('#StartSemester').append(optionHtml);
			}

			else {
				// Render each semester in both dropdowns
				$("#StartSemester,#EndSemester").append(optionHtml);
			}
		}, this));

		// If there are no command line arguments, render with appropriate values selected for start/end
		if (_.isEmpty(urlParams)) {
			$("#StartSemester :first-child").attr("selected", "selected");
			$("#EndSemester :last-child").attr("selected", "selected");
		}
	}
});