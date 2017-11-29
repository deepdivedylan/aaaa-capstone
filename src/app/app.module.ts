import {NgModule} from "@angular/core";
import {BrowserModule} from "@angular/platform-browser";
import {FormsModule} from "@angular/forms";
import {HttpModule} from "@angular/http";
import {AppComponent} from "./app.component";
import {allAppComponents, appRoutingProviders, routing} from "./app.routes";
import {NoteTypeService} from "./services/noteType-service";
import {ApplicationService} from "./services/application-service";
import {ProspectService} from "./services/prospect-service";
import {StudentPermitService} from "./services/studentPermit-service";
import {CohortService} from "./services/cohort-service";
import {ApplicationCohortService} from "./services/applicationCohort-service";
import {NoteService} from "./services/note-service";
import {ProspectCohortService} from "./services/prospectCohort-service";
import {ActiveDirectoryService} from "./services/activeDirectory-service";
import {SessionService} from "./services/session-service";
import {APP_BASE_HREF} from "@angular/common";

const moduleDeclarations = [AppComponent];

@NgModule({
	imports:      [BrowserModule, FormsModule, HttpModule, routing],
	declarations: [...moduleDeclarations, ...allAppComponents],
	bootstrap:    [AppComponent],
	providers:    [
		appRoutingProviders,
		NoteTypeService,
		{provide: APP_BASE_HREF, useValue: window["_base_href"]},
		ApplicationService,
		ProspectService,
		NoteService,
		StudentPermitService,
		ApplicationCohortService,
		ProspectCohortService,
		CohortService,
		ActiveDirectoryService,
		SessionService
	]
})

export class AppModule {}