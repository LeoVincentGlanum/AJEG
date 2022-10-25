@extends('layout.app')
@section('css')
<style>
body {
  border: 0;
  margin: 0;
  padding: 0;
  font-family: sans-serif;
  background-color: rgba(250, 250, 250)
}

.container {

  justify-content: center;
  align-items: center;
  display: flex;
  text-align: center;
}

.container div > p span {
  color: red;
}

p {
  position: relative;
  top: 30px;
}

p a {
  color: black;
  text-decoration: none;
}

.sub {
  cursor: pointer;
  border: 0;
  border-radius: 4px;
  font-weight: 600;
  margin: 0 10px;
  width: 200px;
  padding: 10px 0;
  box-shadow: 0 0 20px rgba(104, 85, 224, 0.2);
  transition: 0.4s;
}

.reg {
  color: white;
  background-color: rgba(104, 85, 224, 1);
}

.log {
  color: rgb(104, 85, 224);
  background-color: rgba(255, 255, 255, 1);
  border: 1px solid rgba(104, 85, 224, 1);
}

button:hover {
  color: white;
  width:;
  box-shadow: 0 0 20px rgba(104, 85, 224, 0.6);
  background-color: rgba(104, 85, 224, 1);
}


</style>
@endsection


@section('content')
<h1><center class="mt-5">AJEG </center></h1>
	<div class="mt-5" style="background-image: url('https://user-images.githubusercontent.com/24803032/184064992-3b4a416e-ef1f-4023-89e3-a6abc35c6b09.png'); width: 100vw; height: 20vh; background-position: center"></div>



	<div class="container">
        <form class="mt-5" method="post" action="{{route('accounts.login')}}">
				<h2 class="mt-5">Connexion</h2>
            @csrf
            <div class="mb-3 mt-5">
                <label for="exampleInputPseudo" class="form-label">Pseudo</label>
                <input name="pseudo" type="text" class="form-control" id="exampleInputPseudo">


            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">

            </div>

			<a href=""><button id="inscription" class="sub log" onclick="return false;">Pas encore inscrit ?</button></a>
			<button type="submit" class="sub reg">Connexion</button>
        </form>
    </div>
@endsection


@section('script')
    <script>

        $(document).ready(function () {

	        $(document).on('click', '#inscription', function () {
		        console.log("coucou")
		        window.location.href = "/"
	        })
        });
    </script>

@endsection


