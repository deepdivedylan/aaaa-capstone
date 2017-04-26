import {Component} from "@angular/core";
import {Router} from "@angular/router";

@Component({
	selector: "navbar",
	templateUrl: "./templates/navba.php"
})

export class NavbarComponent { }



filterByLastName() : void {
	this.searchByLastNameFiltered = [];
if(this.searchByLastNameSearch !== null) {
	this.searchByLastNameWordSearch = null;
	this.searchByLastNameObservable
		.filter(searchByLastName => searchBy.lastName.indexOf(this.lastNameSearch) >= 0)
		.subscribe(search => this.searchByLastNameFiltered.push(search));
} else {
	this.searchByLastNameObservable
		.subscribe(searchByLastName => this.searchByLastNameFiltered.push(searchByLastName))
}
}

filterByFirstName() : void {
	this.searchByFirstNameFiltered = [];
if(this.searchByFirstNameSearch !== null) {
	this.searchByFirstNameSearch = null;
	this.searchByFirstNameObservable
		.filter(searchByFirstName => searchBy.firstName.indexOf(this.firstNameSearch.toLowerCase()) >= 0)
		.subscribe(searchFirstName => this.searchByFirstNameFiltered.push(searchByFirstName));
} else {
	this.searchByFirstNameObservable
		.subscribe(searchByFirstName => this.searchByFirstNameFiltered.push(searchByLastName))
}

}

private searchByNameUrl = "api/searchByName/";

getAllNames() : Observable<Names[]> {
	return(this.http.get(this.searchUrl)
	.map(this.extractData)
	.catch(this.handleError));
}

getNames(: number) : Observable<Diceware> {
	return(this.http.get(this.dicewareUrl + roll)
	.map(this.extractData)
	.catch(this.handleError));
}
