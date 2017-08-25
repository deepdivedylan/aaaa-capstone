import {Component, OnInit} from "@angular/core";
import {SessionService} from "./services/session-service";

@Component({
	// Update selector with YOUR_APP_NAME-app. This needs to match the custom tag in webpack/index.php
	selector: 'aaaacapstone',

	// templateUrl path to your public_html/templates directory.
	templateUrl: './templates/aaaa-capstone-app.html'
})

export class AppComponent implements OnInit{
	navCollapse = true;

	toggleCollapse() {
		this.navCollapse = !this.navCollapse;
	}

	constructor(private sessionService: SessionService) {

	}

	ngOnInit() : void {
		this.sessionService.setSession().subscribe(response => response);
	}
}

