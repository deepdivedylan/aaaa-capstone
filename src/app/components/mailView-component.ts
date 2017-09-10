import {Component, OnInit, ViewChild} from "@angular/core";
import {Router, ActivatedRoute, Params} from "@angular/router";
import {NgForm} from "@angular/forms";
import {ApplicationService} from "../services/application-service";
import {ApplicationCohortService} from "../services/applicationCohort-service";
import {Note} from "../classes/note";
import {NoteService} from "../services/note-service";
import {Application} from "../classes/application";
import {ApplicationCohort} from "../classes/applicationCohort";
import {Prospect} from "../classes/prospect"
import {ProspectCohort} from "../classes/prospectCohort";
import {NoteType} from "../classes/noteType";
import {NoteTypeService} from "../services/noteType-service";
import {Status} from "../classes/status";
import {Cohort} from "../classes/cohort";
import {CohortService} from "../services/cohort-service"

import 'rxjs/add/operator/switchMap';
import {ProspectService} from "../services/prospect-service";
import {ProspectCohortService} from "../services/prospectCohort-service";
import {forEach} from "@angular/router/src/utils/collection";

@Component({
	templateUrl: "./templates/mailView.html"
})

export class MailViewComponent implements OnInit{
	//@ViewChild("mailView") mailView : any;

	application : Application = new Application(null, "", "", "", "", "", "", "", "", "", "", "", "");
	applications : Application[] = [];
	cohorts : Cohort[] = [];
	noteTypes: NoteType[] = [];
	status: Status = null;


	constructor(
		private applicationService: ApplicationService,
		// private applicationCohortService: ApplicationCohortService,
		// private noteService: NoteService,
		private noteTypeService: NoteTypeService,
		// private prospectService: ProspectService,
		// private prospectCohortService: ProspectCohortService,
		private cohortService: CohortService,
		private router: Router,
		// private activatedRoute: ActivatedRoute
	) {}

	ngOnInit() : void {

		this.reloadNoteTypes();
		this.reloadCohorts();
	}


	reloadNoteTypes() : void {
		this.noteTypeService.getAllNoteTypes()
			.subscribe(noteTypes => this.noteTypes = noteTypes);
	}
	reloadCohorts() : void {
		this.cohortService.getAllCohorts()
			.subscribe(cohorts => this.cohorts = cohorts)
	}

	getApplicationsByCohortIdAndNoteTypeId(cohort : number, note : number ) : void {
		this.applicationService.getApplicationsByNoteTypeIdAndCohortId(cohort, note)
			.subscribe(applications => this.applications = applications)

	}

	static getNoteTypeAndCohortEmails(applications: Application[] ) : any {

		let cohortAndNoteTypesEmails = [];

		for(let app of applications) {
			cohortAndNoteTypesEmails.push(app.applicationEmail)
		}
		return cohortAndNoteTypesEmails
	}
	switchApplication(application: Application) : void {
		this.router.navigate(["/detailView/", application.applicationId]);
	}


}