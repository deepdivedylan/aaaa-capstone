import {Component, OnInit} from "@angular/core";
import {Router} from "@angular/router";
import {ApplicationService} from "../services/application-service";
import {Application} from "../classes/application";

@Component({
	selector: "navbar",
	templateUrl: "./templates/navbar.php"
})
export class NavbarComponent implements OnInit {

	searchResults: Application[] = []; // search results

	ApplicationLastName: string = "";
	ApplicationFirstName: string = "";

	applicationResults: Application;

	constructor(private applicationService: ApplicationService) {}

	ngOnInit() : void {
		this.applicationService.getAllApplications();
	}

	searchForApplicationLastName(): void {
		this.applicationService.getApplicationByApplicationLastName(this.ApplicationLastName).subscribe(Application=>this.searchResults = Application);
	}

	searchForApplicationFirstName(): void {
		this.applicationService.getApplicationsByApplicationFirstName(this.ApplicationFirstName).subscribe(Application=>this.searchResults = Application);
	}
}
