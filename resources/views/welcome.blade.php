@extends('layouts.front')

@section('top-content')
<div class="jumbotron">
	<div class="container">
		<h1 class="display-4">Welcome Assoc 2019 test</h1>
		<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore earum repellat ipsam nam in provident laborum fuga nemo tenetur, explicabo non praesentium veniam! Numquam ab quos veniam temporibus, asperiores dignissimos!.</p>
	</div>
</div>

@endsection


@section('content')
<div class="card">
	<div class="card-header">Un petit rappel du git flow basique:</div>
	<div class="card-body">
		<ul>
			<li>git add .</li>
			<li>git status</li>
			<li>git commit -m "Message for the commit"</li>
		</ul>
		<ul>
			<li>
				git push -u origin master
			</li>
		</ul>

	</div>
</div>

@endsection
