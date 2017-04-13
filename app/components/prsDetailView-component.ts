import {Component, OnInit, ViewChild} from "@angular/core";
import {Router, ActivatedRoute, Params} from "@angular/router";
import {NgForm} from "@angular/forms";
import {ProspectService} from "../services/prospect-service";
import {ProspectCohortService} from "../services/ProspectCohort-service";
import {Note} from "../classes/note";
import {NoteService} from "../services/note-service";
import {Prospect} from "../classes/prospect";
import {ProspectCohort} from "../classes/ProspectCohort";
import {NoteType} from "../classes/noteType";
import {NoteTypeService} from "../services/noteType-service";
import {Status} from "../classes/status";

import 'rxjs/add/operator/switchMap';

@Component({
	templateUrl: "./templates/prsDetailView.php"
})

export class PrsDetailViewComponent implements OnInit{
	@ViewChild("prsDetailView") prsDetailView : any;
	prospect : Prospect = new Prospect(null, "", "", "", "");
	prospectCohorts : ProspectCohort[] = [];
	notes : Note[] = [];
	note : Note = new Note(null, null, null, null, "", "");
	status: Status = null;
	noteTypes: NoteType[] = [];
	testDate: string = null;


	constructor(
		private prospectService: ProspectService,
		private prospectCohortService: ProspectCohortService,
		private noteService: NoteService,
		private noteTypeService: NoteTypeService,
		private router: Router,
		private activatedRoute: ActivatedRoute
	) {}

	ngOnInit() : void {
		this.reloadProspect();
		this.reloadNoteTypes();
	}

	reloadProspect()	 : void {
		this.activatedRoute.params
			.switchMap((params : Params) => this.prospectService.getProspectByPospectId(+params["prospectId"]))
			.subscribe(application => {
				this.application = application;
				this.testDate = application.applicationDateTime;
				this.note.noteApplicationId = this.application.applicationId;

				this.noteService.getNotesByNoteApplicationId(this.application.applicationId)
					.subscribe(notes => this.notes = notes);

				this.applicationCohortService.getApplicationCohortsByApplicationId(this.application.applicationId)
					.subscribe(applicationCohorts => this.applicationCohorts = applicationCohorts);

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
					this.detailView.reset();
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