@extends("templates/defaultPage")

@section("scripts")

<script type="text/javascript">

	$(document).ready(function(){
		$(".leaf").draggable();
		$(".leaf").mouseup(function(){
			position = $(this).position();
			var leafid = $(this).attr("leafId");
			saveLeaf( leafid , position.left, position.top );
		});

		$(".leaf").each(function(){
			$(this).css("left", $(this).attr("xPos")+"px");
			$(this).css("top", $(this).attr("yPos")+"px");
		});
	});

	function saveLeaf( leafId, xPos, yPos, title, content ){
		console.log(leafId);
	}

</script>

@endsection

@section("title")
	- {{ $book->name}}
@endsection


@section("mainContent")
<div class='board'>

<ul class="tickets">

	<?php 
	foreach ($book->Leafs()->get() as $leaf){ 
		?>
	<li class="leaf ui-widget-content {{$leaf->Style()->first()->styleString}}" leafId='{{$leaf->id}}' xPos='{{$leaf->xPos}}' yPos='{{$leaf->yPos}}'>
		
		<div class="content">{{$leaf->content}}</div>
	</li>
	<?php } ?>

@endsection
</ul>
</div>
@section("links")
@endsection