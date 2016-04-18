$.queryStrToJSON = function() {
	// Get the encoded query string after the "?"
	var queryString = window.location.search.substring(1);
	if (queryString) {
		var fields = _.map(queryString.split("&"), function(field) {
			return field.split("=");
		});
		return _.object(fields);
	}
	return {};
}