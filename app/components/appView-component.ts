import {Component, OnInit, ViewChild} from "@angular/core";
import {Router, ActivatedRoute} from "@angular/router";
import {Application} from "../classes/application";
import {ApplicationService} from "../services/application-service";
import {Cohort} from "../classes/cohort";
import {CohortService} from "../services/cohort-service";
import {ApplicationCohort} from "../classes/applicationCohort";
import {ApplicationCohortService} from "../services/applicationCohort-service";
import {Status} from "../classes/status";
import {Observable} from "rxjs/Observable";

@Component({
	templateUrl: "./templates/appView.php"
})

export class AppViewComponent implements OnInit{
	@ViewChild("appView") appView : any;
	applications : Application[] = [];
	filteredApplications : Application[] = [];


	applicationCohorts : ApplicationCohort[] = [];
	cohorts : Cohort[] = [];
	status: Status = null;
	applicationFilterByName: string;
	//applicationStream : Observable<Application> = null;
	application : Application = new Application(null,null, null, null, null, null, null, null, null, null, null, null, null);

	constructor(
		private applicationService: ApplicationService,
		private applicationCohortService: ApplicationCohortService,
		private cohortService: CohortService,
		private router: Router,
		private route: ActivatedRoute
	) {}

	ngOnInit() : void {
		this.reloadApplications();
		this.reloadApplicationCohorts();
		this.reloadCohorts();
	}

	reloadApplications()	 : void {
		this.applicationService.getAllApplications()
			.subscribe(applications => {
				this.applications = applications;
			});
	}

	reloadApplicationCohorts()	 : void {
		this.applicationCohortService.getAllApplicationCohorts()
			.subscribe(applicationCohorts => this.applicationCohorts = applicationCohorts);

	}

	/*filterApplicationsByLastName() : void {
		this.applicationService.getApplicationsByApplicationLastName()
			.subscribe(applications => this.applications = applications);
	}*/

	// filterApplicationsByFirstName

	reloadCohorts() : void {
		this.cohortService.getAllCohorts()
			.subscribe(cohorts => this.cohorts = cohorts);
	}
	switchApplication(application: Application) : void {
		this.router.navigate(["/detailView/", application.applicationId]);
	}

	filterApplicationByName() : void {
		if(this.applicationFilterByName !== null) {
			this.filteredApplications = this.applications
				.filter((application: Application) =>application.applicationFirstName.indexOf(this.applicationFilterByName));
		}
	}
}