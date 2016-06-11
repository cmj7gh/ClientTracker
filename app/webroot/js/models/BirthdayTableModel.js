/* This model will transform the data from raw nested SQL results into a
 * one-level nested set of data
 */
var BirthdayTableModel = Backbone.Model.extend({
	// Defined the REST endpoint in PHP
	url: "/birthdays",

	parse: function(response) {
		// Go over all of the keys that were returned except for nextDay
		var birthdayInfo = _.omit(response, 'nextDay');

		// Move the id and name up to same level for all staff and students
		birthdayInfo = _.mapObject(birthdayInfo, function(groups, day) {
			return _.mapObject(groups, function(birthdays, group) {
				return _.map(birthdays, function(element, name) {
					return {
						name: element[0]['name'],
						id: (element['students'] ? element['students']['id'] : (element['users']['id']))
					}
				});
			});
		});

		// Merge this information back in
		birthdayInfo['nextDay'] = response['nextDay'];
		this.set(birthdayInfo);
	}
});