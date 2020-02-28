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
		document.bookId = {{$book->id}};
		$(".leaf").draggable();

		$(".leaf").mouseup(function(){
			var position = $(this).position();
			var leafid = $(this).attr("leafId");
			var content = $(this).find("textarea").first().html()
			saveLeaf( leafid , position.left, position.top, content );
		});

		$(".leaf").each(function(){
			$(this).css("left", $(this).attr("xPos")+"px");
			$(this).css("top", $(this).attr("yPos")+"px");
		});

		$(".leaf textarea").focusout(function(){
			var leaf = $(this).parents("li.leaf").first();
			var position = $(leaf).position();
			var leafid = $(leaf).attr("leafId");
			var content = $(this).val();
			saveLeaf( leafid , position.left, position.top, content );
		});

		$(".newLeaf").click(function(){
			var leafColor = $(this).leafColor;
			newLeaf(document.bookId, leafColor);
			return false;
		});
	});


	function newLeaf( bookId, leafStyle){
		console.log(bookId);

		var leafStyleIds = {yellow:1, blue:2, green:3};
		var response = $.ajax({url: "/api/books/"+bookId+"/leaves", "style":leafStyleIds.leafStyle, type:"GET", success:function(result, status, xhr){
			renderLeaf(result.id, result.style_id);
		}});
		return false;
	}

	function renderLeaf(leafId, styleId, content=""){
		var ticket = $("ul.leaves").prepend("<li id='leaf"+leafId+"' leafId='"+leafId+"' id='leaf"+leafId+"' xPos=0 yPos=0 class='yellow leaf'><form method='POST' action='/api/books/{{$book->id}}/leaves/"+leafId+"'><input type='hidden' name='_method' value='DELETE'><input type='submit' value='X' ></input></form><div class='content'><textarea>"+content+"</textarea></div></li>");
		$("#leaf"+leafId).draggable();
		$("#leaf"+leafId+" .delete").click(function(){ deleteLeaf($(this).attr("leafid")); return false; });
		$("#leaf"+leafId+" textarea").focusout(function(){
			var leaf = $(this).parents("li.leaf").first();
			var position = $(leaf).position();
			var leafid = $(leaf).attr("leafId");
			var content = $(this).val();
			saveLeaf( leafid , position.left, position.top, content );
		});
		$("#leaf"+leafId).mouseup(function(){
			var position = $(this).position();
			var leafid = $(this).attr("leafId");
			var content = $(this).find("textarea").first().html()
			saveLeaf( leafid , position.left, position.top, content );
		});

	}

	function saveLeaf( leafId, xPos, yPos, content ){
		var bookId = $(document).bookId;
		$.ajax({url:"/api/books/"+bookId+"/leaves/"+leafId, data:{ xPos: xPos, yPos: yPos, content:content }, type:"POST", success:function(result, status, xhr){
		}});

	function deleteLeaf(leafId){
		console.log("deleting "+leafId);
		var leaf = $("#leaf"+leafId);

		var response = $.ajax({
				url:"/api/books/"+bookId+"/leaves/"+leafId, 
				type:"POST", 
				data:{ _method:"DELETE"}, 
				success: function(result, status, xhr){
					$("#leaf"+result.leafId).remove();
				}
			});
	}
	}



</script>

@endsection

@section("title")
	- {{ $book->name}}
@endsection


@section("mainContent")
<div class='board'>
<div id='controls'>
	<a class='newLeaf yellow' leafColor = "yellow" href = "#" id="testButton">New leaf</a>
	<a class='newLeaf blue' leafColor = "blue" href = "#" id="testButton">New leaf</a>
	<a class='newLeaf green' leafColor = "green" href = "#" id="testButton">New leaf</a>

</div>
<ul class="leaves">

	<?php 
	foreach ($book->Leafs()->get() as $leaf){ 
		?>
	<li id="leaf{{$leaf->id}}" class="leaf ui-widget-content {{$leaf->Style()->first()->styleString}}" leafId='{{$leaf->id}}' xPos='{{$leaf->xPos}}' yPos='{{$leaf->yPos}}'>
		<form method='POST' action='/api/books/{{$book->id}}/leaves/{{$leaf->id}}'><input type='hidden' name='_method' value='DELETE'><input type='submit' value='X' ></input></form>
		<div class="content"><textarea>{{$leaf->content}}</textarea></div>
	</li>
	<?php } ?>

</ul>
</div>
@endsection
@section("links")
@endsection