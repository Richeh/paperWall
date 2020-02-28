@extends("layouts.app")

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
	- {{ $book->name}}
@endsection


@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

            	<h2>{{$book->title}} - Edit</h2>
            	<form action="/books/{{$book->id}}/" method="POST">
            	@csrf
				<dl>
					<dt><label for = "title">Title</label></dt>
					<dd><input name="title" value='{{$book->title}}' /></dd>
				</dl>
				<input type="submit" value="Save" />
				</form>
            </div>
             <div class="card">

            	<form action="/books/{{$book->id}}/" method="POST">
            	@method("DELETE")
            	@csrf
				<input type="submit" value="Delete" />
			</form>
            </div>
        </div>
    </div>
</div>


@endsection

@section("links")
@endsection