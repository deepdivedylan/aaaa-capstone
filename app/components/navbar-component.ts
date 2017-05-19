import {Component, OnInit, Output} from "@angular/core";
import {Router} from "@angular/router";
import {ApplicationService} from "../services/application-service";
import {Application} from "../classes/application";
import {EventEmitter} from "@angular/core";

@Component({
	selector: "navbar",
	templateUrl: "./templates/navbar.php"
})

export class NavbarComponent implements OnInit {

	@Output() open: EventEmitter<any> = new EventEmitter();
	@Output() close: EventEmitter<any> = new EventEmitter();

	searchResults: Application[] = []; // search results

	ApplicationLastName: string = "";
	ApplicationFirstName: string = "";

	applicationResults: Application;

	constructor(private applicationService: ApplicationService) {}

	ngOnInit() : void {
		this.applicationService.getAllApplications();
	}

/*	searchForApplicationLastName(): void {
		this.applicationService.getApplicationByApplicationLastName(this.ApplicationLastName).subscribe(Application=>this.searchResults = Application);
	}

	searchForApplicationFirstName(): void {
		this.applicationService.getApplicationsByApplicationFirstName(this.ApplicationFirstName).subscribe(Application=>this.searchResults = Application);
	}*/
}
