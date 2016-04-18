var SearchSemestersCollection = Backbone.Collection.extend({
	url: "/semesters",
	model: SearchSemestersModel,

	// Fetch immediately upon initialization
	initialize: function() {
		this.fetch();
	}
})