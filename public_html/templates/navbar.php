<nav class="navbar navbar-default">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
				  data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand">CNM Stream Line</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<form class="navbar-form navbar-right">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search First Name" id="applicantFirstName" name="applicantFirstName" title="applicantFirstName" [(ngModel)]="ApplicationFirstName" (keyup)="searchForApplicationFirstName();">
				<input type="text" class="form-control" placeholder="Search Last Name" id="applicantLastName" name="applicantLastName" title="applicantLastName" [(ngModel)]="ApplicationLastName" (keyup)="searchForApplicationLastName();">
			</div>
			<button type="submit" class="btn btn-default">Search</button>
		</form>
		<ul class="nav navbar-nav navbar-right">
			<li><a routerLink="/">Sign Out</a></li>
			<li><a routerLink="/pkgView/">Parking</a></li>
			<li><a routerLink="/appView/">Applications</a></li>
			<li><a routerLink="/mobView/">Quick Prospect</a></li>
			<li><a routerLink="/prsView/">Prospects</a></li>
			<li><!-- Button trigger modal -->
				<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
					Mailing List
				</button>

				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Mailing List</h4>
							</div>
							<div class="modal-body">
								<!-- FORM -->
								<form #mailListForm="ngForm" name="mailList" id="mailList" class="form-horizontal well"
										(ngSubmit)="createMailList();" novalidate>
									<div class="modal-body">
										<label>Note Type:</label>
										<select class="form-control" id="noteNoteTypeId" name="noteNoteTypeID"
												  [(ngModel)]="note.noteNoteTypeId" required>
											<option *ngFor="let noteType of noteTypes" value="{{noteType.noteTypeId}}">
												{{noteType.noteTypeName}}
											</option>
										</select>
									</div>
									<div class="modal-footer">
										<input type="submit" class="btn btn-info" value="Submit">
										<div class="jumbotron">

										</div>
									</div>
								</form>
								<!-- FORM -->
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div></li>

			<li role="separator" class="divider"></li>
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>
