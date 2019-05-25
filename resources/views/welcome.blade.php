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
<div class="row">

	<div class="col-sm-6">

		<div class="card mb-5">
			<div class="card-header">Un petit rappel du git flow basique:</div>
			<div class="card-body">
				<ul class="list-group">
					<li class="list-group-item">git add .</li>
					<li class="list-group-item">git status</li>
					<li class="list-group-item">git commit -m "Message for the commit"</li>
				</ul>
				<ul class="list-group">
					<li class="list-group-item">
						git push origin master
					</li>
				</ul>
			</div>
		</div>

	</div>

	<div class="col-sm-6">

		<div class="card">
			<div class="card-header"><a href="https://seesparkbox.com/foundry/semantic_commit_messages">Semantic Commit Message</a></div>
			<div class="card-body">
				<ul class="list-group">
					<li class="list-group-item">
						<span class="badge badge-info">chore</span>:
					add Oyster build script</li>
					<li class="list-group-item">
						<span class="badge badge-info">docs</span>:
					explain hat wobble</li>
					<li class="list-group-item">
						<span class="badge badge-info">feat</span>:
					add beta sequence</li>
					<li class="list-group-item">
						<span class="badge badge-info">fix</span>:
					remove broken confirmation message</li>
					<li class="list-group-item">
						<span class="badge badge-info">refactor</span>:
					share logic between 4d3d3d3 and flarhgunnstow</li>
					<li class="list-group-item">
						<span class="badge badge-info">style</span>:
					convert tabs to spaces</li>
					<li class="list-group-item">
						<span class="badge badge-info">test</span>:
					ensure Tayne retains clothing</li>

					<li class="list-group-item">
						<span class="badge badge-success">wip</span>:
					Work in Progress ( ajout perso )</li>
				</ul>
			</div>
		</div>

	</div>

</div>


@endsection
