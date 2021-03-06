<!DOCTYPE html>
<html>

	<head lang="en">
		<script data-require="jquery@2.2.0" data-semver="2.2.0"
				  src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link data-require="bootstrap@3.3.6" data-semver="3.3.6" rel="stylesheet"
				href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
		<script data-require="bootstrap@3.3.6" data-semver="3.3.6"
				  src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="style.css"/>
		<script src="script.js"></script>

		<?php require_once("../public_html/php/partials/headlib.php"); ?>

		<?php require_once("../public_html/php/partials/navbar.php"); ?>		<title> Streamline CNM Applicant</title>

	</head>
	<body>
		<section>
			<div class="container">
				<ul class="nav nav-tabs nav-justified">
					<li role="presentation"><a href="/public_html/templates/appView.html">Applicants</a></li>
					<li role="presentation"><a href="/public_html/templates/prsView.html">Prospects</a></li>
				</ul>
				<div class="row">
					<div class="col-sm-12">
					</div>
				</div>
			</div>
		</section>

		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Cohort</th>
					<th>Date</th>
					<th>Email</th>

					<th>Email</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Name</th>
					<th>Position</th>
					<th>Office</th>
					<th>Age</th>
					<th>Date</th>
					<th></th>
				</tr>
			</tfoot>
			<tbody>
				<tr>
					<td>Tiger Nixon</td>
					<td>System Architect</td>
					<td>Edinburgh</td>
					<td>61</td>
					<td>2011/04/25</td>
					<td>$320,800</td>
				</tr>
				<tr>
					<td>Garrett Winters</td>
					<td>Accountant</td>
					<td>Tokyo</td>
					<td>63</td>
					<td>2011/07/25</td>
					<td>$170,750</td>
				</tr>
				<tr>
					<td>Ashton Cox</td>
					<td>Junior Technical Author</td>
					<td>San Francisco</td>
					<td>66</td>
					<td>2009/01/12</td>
					<td>$86,000</td>
				</tr>
				<tr>
					<td>Cedric Kelly</td>
					<td>Senior Javascript Developer</td>
					<td>Edinburgh</td>
					<td>22</td>
					<td>2012/03/29</td>
					<td>$433,060</td>
				</tr>
				<tr>
					<td>Airi Satou</td>
					<td>Accountant</td>
					<td>Tokyo</td>
					<td>33</td>
					<td>2008/11/28</td>
					<td>$162,700</td>
				</tr>
				<tr>
					<td>Brielle Williamson</td>
					<td>Integration Specialist</td>
					<td>New York</td>
					<td>61</td>
					<td>2012/12/02</td>
					<td>$372,000</td>
				</tr>
				<tr>
					<td>Herrod Chandler</td>
					<td>Sales Assistant</td>
					<td>San Francisco</td>
					<td>59</td>
					<td>2012/08/06</td>
					<td>$137,500</td>
				</tr>
				<tr>
					<td>Rhona Davidson</td>
					<td>Integration Specialist</td>
					<td>Tokyo</td>
					<td>55</td>
					<td>2010/10/14</td>
					<td>$327,900</td>
				</tr>
				<tr>
					<td>Colleen Hurst</td>
					<td>Javascript Developer</td>
					<td>San Francisco</td>
					<td>39</td>
					<td>2009/09/15</td>
					<td>$205,500</td>
				</tr>
				<tr>
					<td>Sonya Frost</td>
					<td>Software Engineer</td>
					<td>Edinburgh</td>
					<td>23</td>
					<td>2008/12/13</td>
					<td>$103,600</td>
				</tr>
				<tr>
					<td>Jena Gaines</td>
					<td>Office Manager</td>
					<td>London</td>
					<td>30</td>
					<td>2008/12/19</td>
					<td>$90,560</td>
				</tr>
				<tr>
					<td>Quinn Flynn</td>
					<td>Support Lead</td>
					<td>Edinburgh</td>
					<td>22</td>
					<td>2013/03/03</td>
					<td>$342,000</td>
				</tr>
				<tr>
					<td>Michael Bruce</td>
					<td>Javascript Developer</td>
					<td>Singapore</td>
					<td>29</td>
					<td>2011/06/27</td>
					<td>$183,000</td>
				</tr>
				<tr>
					<td>Donna Snider</td>
					<td>Customer Support</td>
					<td>New York</td>
					<td>27</td>
					<td>2011/01/25</td>
					<td>$112,000</td>
				</tr>
			</tbody>
		</table>
		<div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
			<ul class="pagination">
				<li class="pagination_button previous disabled" id="example_previous">
					<a href="#" arial-controls="example" data-dt-idx="0" tabindex="0">Previous</a>
				</li>
				<li class="paginate_button active"><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0">1</a>
				</li>
				<li class="paginate_button active"><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0">2</a>
				</li>
				<li class="paginate_button active"><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0">3</a>
				</li>
				<li class="paginate_button active"><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0">4</a>
				</li>
				<li class="paginate_button active"><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0">5</a>
				</li>
				<li class="paginate_button active"><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0">6</a>
				</li>
				<li class="paginate_button next" id="example_next"><a href="#" aria-controls="example" data-dt-idx="7" tabindex="0">Next</a>
				</li>
			</ul>
		</div>
	</body>

</html>