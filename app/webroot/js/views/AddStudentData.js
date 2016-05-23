/*Refer to the "AmericanUniversities.js" and "otherUniversities.js" data for the sources. This script aims to help streamline the
educational institutions added using the jQuery UI form. This creates an array of educational 
institutions in the United States, and pushes them to a usable array for the autocomplete form.

JSON format data for americanUniversities array courtesy of https://github.com/Hipo/university-domains-list

I chose to only include universities located in the US for the array since the majority of the students go to school in the USA.
Hopefully that will speed up page loads!*/

//Data Sources for Autocomplete will be pushed here on page load
var uniArray = [];

//The following is a comprehensive list of most higher education institutions in the United States
$( document ).ready(function() {
    for (var i = 0; i <americanUniversities.length; i++) {
        if (americanUniversities[i].country === "USA") {
            uniArray.push(americanUniversities[i].name);
        }
    }
})

/*Other universities is a list of educational institutions which LP members have attended,
but are not part of the original list. */

$( document ).ready(function() {
    for (var i = 0; i <otherUniversities.length; i++) {
    	uniArray.push(otherUniversities[i].name);
    }
};

 /*This shows an autocomplete of American or Canadian universities.*/
function updateUniSearch() {
    $(".college-field").autocomplete({
            source: uniArray
        });
}