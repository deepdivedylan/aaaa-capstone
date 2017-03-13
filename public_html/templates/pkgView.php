<section class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<h2>Parking</h2>
			<div class="col-xs-5">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td>Notes:</td>
							<td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">+</button>
								<div id="myModal" class="modal fade">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">Confirmation</h4>
											</div>

											<!-- FORM -->
											<form #noteForm="ngForm" name="detailView" id="detailView" class="form-horizontal well" (ngSubmit)="createNote();" novalidate>
												<div class="modal-body">

													<div class="form-group" [ngClass]="{ 'has-error': noteContent.touched && noteContent.invalid }">
														<label for="noteContent">Content:</label>
														<div class="input-group">
															<div class="input-group-addon">
																<i class="fa fa-comment" aria-hidden="true"></i>
															</div>
															<textarea name="noteContent" id="noteContent" class="form-control" maxlength="255" required [(ngModel)]="note.noteContent" #noteContent="ngModel" rows="5"></textarea>
														</div>
														<div [hidden]="noteContent.valid || noteContent.pristine" class="alert alert-danger" role="alert">
															<p *ngIf="noteContent.errors?.required">Note content is required.</p>
															<p *ngIf="noteContent.errors?.maxlength">Note content is too long.</p>
														</div>
													</div>
													<label>Note Type:</label>
													<select class="form-control" id="noteNoteTypeId" name="noteNoteTypeID" [(ngModel)]="note.noteNoteTypeId" required>
														<option *ngFor="let noteType of noteTypes" value="{{noteType.noteTypeId}}">{{noteType.noteTypeName}}</option>
													</select>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-info" value="Submit">
												</div>
											</form>
											<!-- FORM -->

										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>Date</td>
							<td>Preview</td>
						</tr>
					</thead>
					<tr *ngFor="let note of notes">
						<td>{{ note.noteDateTime | date : 'medium' }}</td>
						<td>{{ note.noteContent | slice:0:15 }}</td>
					</tr>
				</table>
			</div>
			<table class="table table-bordered table-hover table-parking">
				<thead>
					<tr>
						<td>Last</td>
						<td>First</td>
						<td>Cohort</td>
						<td>Swipe #</td>
						<td>Placard #</td>
						<td>Check Out Date</td>
						<td>Check In Date</td>
						<td>Status</td>
					</tr>
				</thead>
				<tr *ngFor = "let studentPermit of studentPermits">
					<td>{{studentPermit.info[3].applicationLastName}}</td>
					<td>{{studentPermit.info[3].applicationFirstName}}</td>

					<td>
						<ul class="list-unstyled">
							<li *ngFor="let cohort of studentPermit.info[4]">
								{{cohort.cohortName}}
							</li>
						</ul>
					</td>

					<td>{{studentPermit.info[1].swipeNumber}}</td>
					<td>{{studentPermit.info[0].placardNumber}}</td>
					<td>{{studentPermit.studentPermitCheckOutDate | date: 'medium'}}</td>
					<td>{{studentPermit.studentPermitCheckInDate | date: 'medium'}}</td>
					<td>{{studentPermit.info[2].statusTypeName}}</td>
				</tr>
			</table>
		</div>
	</div>
</section>