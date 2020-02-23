@extends("templates/defaultPage")

@section("scripts")

<script type="text/javascript">

	$(document).ready(function(){
		$(".ticket").draggable();
		$(".ticket").mouseup(function(){
			position = $(this).position();
			var leafid = $(this).attr("leafId");
			saveLeaf( leafid , position.left, position.top );
		});
	});

	function saveLeaf( leafId, xPos, yPos, title, content ){
		console.log(leafId);
	}

</script>

@endsection

@section("title")
	- Books
@endsection


@section("mainContent")

<ul class="tickets">

	@foreach ($books as $book)
	<li><a href = '/books/{{$book->id}}'>{{$book->title}}</a>
	</li>
	@endforeach

@endsection

@section("links")
@endsection