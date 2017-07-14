import {Component, OnInit, ViewChild, OnChanges} from "@angular/core";
import {Router, ActivatedRoute} from "@angular/router";
import {Application} from "../classes/application";
import {ApplicationService} from "../services/application-service";
import {Cohort} from "../classes/cohort";
import {CohortService} from "../services/cohort-service";
import {ApplicationCohort} from "../classes/applicationCohort";
import {ApplicationCohortService} from "../services/applicationCohort-service";
import {Status} from "../classes/status";
import {Observable} from "rxjs/Observable";
import {Subject} from 'rxjs/Subject';
import {subscribeOn} from "rxjs/operator/subscribeOn";
@Component({
	templateUrl: "./templates/appView.php"
})

export class AppViewComponent implements OnInit, OnChanges{
	@ViewChild("appView") appView : any;
	applications : Application[] = [];
	filteredApplications : Application[] = [];


	applicationCohorts : ApplicationCohort[] = [];
	cohorts : Cohort[] = [];
	status: Status = null;
	applicationFilterByName: string;

	//observable used for searching Applications by name
	termStream = new Subject<string>();

	application : Application = new Application(null,null, null, null, null, null, null, null, null, null, null, null, null);

	constructor(
		private applicationService: ApplicationService,
		private applicationCohortService: ApplicationCohortService,
		private cohortService: CohortService,
		private router: Router,
		private route: ActivatedRoute,




	) {
		this.termStream.subscribe(term  => this.filterApplicationByName(term));
	}

	ngOnInit() : void {
		this.reloadApplications();
		this.reloadApplicationCohorts();
		this.reloadCohorts();
	}
	ngOnChanges() : void {

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

	reloadCohorts() : void {
		this.cohortService.getAllCohorts()
			.subscribe(cohorts => this.cohorts = cohorts);
	}
	switchApplication(application: Application) : void {
		this.router.navigate(["/detailView/", application.applicationId]);
	}

	filterApplicationByName(term : string ) : void {
		this.applicationService.getApplicationsByApplicationName(term)
			.subscribe(applications => {
				this.filteredApplications = applications
			});
		console.log(this.filteredApplications);
	}
}