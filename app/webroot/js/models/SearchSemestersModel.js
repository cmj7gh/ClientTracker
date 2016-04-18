var SearchSemestersModel = Backbone.Model.extend({
	defaults: {
		id: "",
		semester: "",
		startingDate: "",
		year: ""
	},
	// Delegate to superclass
	initialize: function() {
		Backbone.Model.prototype.initialize.apply(this, arguments);
	},
});