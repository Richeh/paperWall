@extends("templates/defaultPage")


@section("breadcrumb")
	<li><a href='/home'>Home</a></li>
	<li><a href='/books/'>Books</a></li>
	<li>{{$book->title}}</li>
@endsection

@section("scripts")

<script type="text/javascript">
//TODO: hedgehog this off into its own file
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

		$(".newYellowLeaf").click(function(){
			newLeaf(1);
		});
	});


	function newLeaf( bookId ){
		var response = $.ajax({url: "/api/books/"+bookId+"/leaves", "style":1, type:"GET", success:function(result, status, xhr){
			console.log(result);
			renderLeaf(result.id, result.style_id);
		}});

		return false;
	}

	function renderLeaf(leafId, styleId, content=""){
		var ticket = $("ul.tickets").prepend("<li leafId='"+leafId+"' id='leaf"+leafId+"' xPos=0 yPos=0 class='yellow'><div class='content'>"+content+"</div></li>");
		$("#leaf"+leafId).draggable();
		console.log("rendering! "+leafId);
	}

	function saveLeaf( leafId, xPos, yPos, title, content ){
		var bookId = 1;
		console.log( $.ajax({url:"/api/books/"+bookId+"/leaves/"+leafId, data:{ xPos: xPos, yPos: yPos, content:content }, type:"POST", success:function(result, status, xhr){
			console.log(result);			
		}}));
	}



</script>

@endsection

@section("title")
	- {{ $book->name}}
@endsection


@section("mainContent")
<div class='board'>
<div id='controls'><a class='newYellowLeaf' href = "#" id="testButton">New leaf</a></div>
<ul class="tickets">

	<?php 
	foreach ($book->Leafs()->get() as $leaf){ 
		?>
	<li class="leaf ui-widget-content {{$leaf->Style()->first()->styleString}}" leafId='{{$leaf->id}}' xPos='{{$leaf->xPos}}' yPos='{{$leaf->yPos}}'>
		
		<div class="content">{{$leaf->content}}</div>
	</li>
	<?php } ?>

</ul>
</div>
@endsection
@section("links")
@endsection