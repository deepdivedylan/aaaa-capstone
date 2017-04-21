import {Component, OnInit, ViewChild} from "@angular/core";
import {Router} from "@angular/router";
import {StudentPermitService} from "../services/studentPermit-service";
import {StudentPermit} from "../classes/studentPermit";
import {Status} from "../classes/status";
import {ApplicationService} from "../services/application-service";
import {ApplicationCohortService} from "../services/applicationCohort-service";
import {Placard, PlacardService} from "../services/placard-service";
import {Swipe, SwipeService} from "../services/swipe-service";
import {StatusType, StatusTypeService} from "../services/statusType-service";


@Component({
	templateUrl: "./templates/pkgView.php"
})

export class PkgViewComponent implements OnInit{
	@ViewChild("pkgView") pkgView : any;
	studentPermits : StudentPermit[] = [];
	status: Status = null;

	constructor(
		private applicationService: ApplicationService,
		private applicationCohortService: ApplicationCohortService,
		private studentPermitService: StudentPermitService,
		private placardService: PlacardService,
		private swipeService: SwipeService,
		private statusType: StatusTypeService,
		private router: Router
	) {}

	ngOnInit() : void {
		this.reloadApplication();
		this.reloadStudentPermits();
		this.reloadSwipes();
	}
	reloadApplication()	 : void {
		this.activatedRoute.params
			.switchMap((params: Params) => this.applicationService.getApplicationByApplicationId(+params["applicationId"]))
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
	reloadStudentPermits()	 : void {
		this.studentPermitService.getAllStudentPermits()
			.subscribe(studentPermits => this.studentPermits = studentPermits);
	}
	reloadSwipes() : void {
		this.swipeService.getAllSwipes()
			.subscribe(swipes => this.swipes = swipes);
			}
}