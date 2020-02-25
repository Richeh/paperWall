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
			console.log(content);
			saveLeaf( leafid , position.left, position.top, content );
		});

		$(".newYellowLeaf").click(function(){
			console.log("click");
			newLeaf(document.bookId);
			return false;
		});
	});


	function newLeaf( bookId ){
		console.log(bookId);
		var response = $.ajax({url: "/api/books/"+bookId+"/leaves", "style":1, type:"GET", success:function(result, status, xhr){
			renderLeaf(result.id, result.style_id);
		}});

		return false;
	}

	function renderLeaf(leafId, styleId, content=""){
		var ticket = $("ul.leaves").prepend("<li leafId='"+leafId+"' id='leaf"+leafId+"' xPos=0 yPos=0 class='yellow leaf'><div class='content'><textarea>"+content+"</textarea></div></li>");
		$("#leaf"+leafId).draggable();
	}

	function saveLeaf( leafId, xPos, yPos, content ){
		var bookId = $(document).bookId;
		$.ajax({url:"/api/books/"+bookId+"/leaves/"+leafId, data:{ xPos: xPos, yPos: yPos, content:content }, type:"POST", success:function(result, status, xhr){
			console.log(result);			
		}});
	}



</script>

@endsection

@section("title")
	- {{ $book->name}}
@endsection


@section("mainContent")
<div class='board'>
<div id='controls'><a class='newYellowLeaf' href = "#" id="testButton">New leaf</a></div>
<ul class="leaves">

	<?php 
	foreach ($book->Leafs()->get() as $leaf){ 
		?>
	<li class="leaf ui-widget-content {{$leaf->Style()->first()->styleString}}" leafId='{{$leaf->id}}' xPos='{{$leaf->xPos}}' yPos='{{$leaf->yPos}}'>
		
		<div class="content"><textarea>{{$leaf->content}}</textarea></div>
	</li>
	<?php } ?>

</ul>
</div>
@endsection
@section("links")
@endsection