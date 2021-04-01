@extends("templates/defaultPage")

@section("breadcrumb")
	<li><a href='/home'>Home</a></li>
	<li>Profile - {{$user->}}</li>
@endsection

@section("scripts")

<script type="text/javascript">
</script>

@endsection

@section("title")
	- {{ $user->name}}
@endsection


@section("mainContent")
<div class='board'>
<div id='controls'>
	<a class='newLeaf yellow' 	leafColor = "yellow" 	href = "#" id="testButton">+</a>
	<a class='newLeaf blue' 	leafColor = "blue" 		href = "#" id="testButton">+</a>
	<a class='newLeaf green' 	leafColor = "green" 	href = "#" id="testButton">+</a>
</div>
<ul class="leaves">

	<?php 
	foreach ($book->Leafs()->get() as $leaf){ 
		?>
	<li id="leaf{{$leaf->id}}" class="leaf ui-widget-content {{$leaf->Style()->first()->styleString}}" leafId='{{$leaf->id}}' xPos='{{$leaf->xPos}}' yPos='{{$leaf->yPos}}'>
		<a href='#' class='deleteLink'>X</a>
		<div class="content"><textarea>{{$leaf->content}}</textarea></div>
	</li>
	<?php } ?>

</ul>
</div>
@endsection
@section("links")
@endsection