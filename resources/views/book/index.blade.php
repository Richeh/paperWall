@extends('layouts.app')

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

@section("breadcrumb")
	<li><a href='/home'>Home</a></li>
	<li>Books</li>
@endsection

@section("title")
	- Books
@endsection


@section("content")


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

            	<h2>My Books</h2>
				<ul class="itemList books">

					@foreach ($books as $book)
					<li><a href = '/books/{{$book->id}}'>{{$book->title}}</a> - <a href = '/books/{{$book->id}}/edit'>edit</a></li>
					@endforeach
				</ul>                
            </div>
            <div class="card">
                <div class="card-header">Create new Book</div>
            	<form action = "/books/" method="POST" >
            		@method("POST")
            		@csrf
            		<label for="title">Title</label>
            		<input name='title' id="title"/>
            		<input type="submit" value = "Create" />
            	</form>
            </div>
        </div>
    </div>
</div>


@endsection

@section("links")
@endsection