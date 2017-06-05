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

import 'rxjs/add/operator/switchMap';
import {ProspectService} from "../services/prospect-service";
import {ProspectCohortService} from "../services/prospectCohort-service";

@Component({
	templateUrl: "./templates/mailView.php"
})

export class MailViewComponent implements OnInit{
	@ViewChild("mailView") mailView : any;
	application : Application = new Application(null, "", "", "", "", "", "", "", "", "", "", "", "");
	applicationCohorts : ApplicationCohort[] = [];
	prospect : Prospect = new Prospect(null, "", "", "", "");
	prospectCohorts : ProspectCohort[] = [];
	notes : Note[] = [];
	note : Note = new Note(null, null, null, null, "", "");
	status: Status = null;
	noteTypes: NoteType[] = [];
	testDate: string = null;

	constructor(
		private applicationService: ApplicationService,
		private applicationCohortService: ApplicationCohortService,
		private noteService: NoteService,
		private noteTypeService: NoteTypeService,
		private prospectService: ProspectService,
		private prospectCohortService: ProspectCohortService,
		private router: Router,
		private activatedRoute: ActivatedRoute
	) {}

	ngOnInit() : void {
		this.reloadApplication();
		this.reloadProspect();
		this.reloadNoteTypes();
	}

	reloadApplication()	 : void {
		this.activatedRoute.params
			.switchMap((params : Params) => this.applicationService.getApplicationByApplicationId(+params["applicationId"]))
			.subscribe(application => {
				this.application = application;
				this.testDate = application.applicationDateTime;
				this.note.noteApplicationId = this.application.applicationId;

				this.noteService.getNotesByNoteApplicationId(this.application.applicationId)
					.subscribe(notes => this.notes = notes.reverse());

				this.applicationCohortService.getApplicationCohortsByApplicationId(this.application.applicationId)
					.subscribe(applicationCohorts => this.applicationCohorts = applicationCohorts);

			});
	}
	reloadProspect()	 : void {
		this.activatedRoute.params
			.switchMap((params : Params) => this.prospectService.getProspectByProspectId(+params["prospectId"]))
			.subscribe(prospect => {
				this.prospect = prospect[0];
				this.note.noteProspectId = this.prospect.prospectId;


				this.noteService.getNotesByNoteProspectId(this.prospect.prospectId)
					.subscribe(notes => this.notes = notes.reverse());

				this.prospectCohortService.getProspectCohortsByProspectId(this.prospect.prospectId)
					.subscribe(prospectCohorts => this.prospectCohorts = prospectCohorts);



			});
	}
	reloadNoteTypes() : void {
		this.noteTypeService.getAllNoteTypes()
			.subscribe(noteTypes => this.noteTypes = noteTypes);
	}
	createNote() : void {
		this.noteService.createNote(this.note)
			.subscribe(status => {
				this.status = status;
				if(status.apiStatus === 200) {
					this.reloadApplication();
					this.mailView.reset();
				}
			});
	}

}
// export class SimpleFormComp {
// 	onSubmit(f: NgForm) {
// 		console.log(f.value);  // { first: '', last: '' }
// 		console.log(f.valid);  // false
// 	}
// }