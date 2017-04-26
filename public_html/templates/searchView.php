

<h1>Search Students</h1>


<div class="row">
	<div class="col-md-6">
		<div class="input-group">
			<input type="number" class="form-control" placeholder="Search By Last Name&hellip;" [(ngModel)]="Search" (keyup)="filterByLastName();" />
			<span class="input-group-addon"><i class="fa fa-search"></i></span>
		</div>
	</div>
	<div class="col-md-6">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Search By First Name&hellip;" [(ngModel)]="searchNameWordSearch" (keyup)="filterByFirstName();" />
			<span class="input-group-addon"><i class="fa fa-search"></i></span>
		</div>
	</div>
</div>
<table class="table table-bordered table-hover table-responsive table-striped">
	<tr><th>Search</th><th>Name</th></tr>
	<tr class="cursor-pointer" *ngFor="let searchStudentName of searchStudentNameFiltered)" (click)="searchStudentName(searchStudentName);">
		<td>{{ searchStudentName.lastName }}</td>
		<td>{{ searchStudentName.firstName }}</td>
	</tr>
</table>
