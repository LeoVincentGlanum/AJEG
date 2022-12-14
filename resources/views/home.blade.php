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
        <form class="mt-5" method="post" action="{{route('accounts.store')}}">
				<h2 class="mt-5">Inscription</h2>
            @csrf
            <div class="mb-3 mt-5">
                <label for="exampleInputPseudo" class="form-label">Pseudo</label>
                <input name="pseudo" type="text" class="form-control" id="exampleInputPseudo">
				<div class="alert alert-warning" id="pseudoError"></div>

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
				<div class="alert alert-warning" id="passwordError"></div>
            </div>
            <div class="mb-5">
                <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                <input name="confpassword" type="password" class="form-control" id="exampleInputPassword2">
				<div class="alert alert-warning" id="confPasswordError"></div>
            </div>

			<a href="{{route('login')}}"><button id="login" class="sub log" onclick="return false;">Deja inscrit ?</button></a>
			<button type="submit" class="sub reg">Inscription</button>
        </form>
    </div>

@endsection

@section('script')
    <script>
		var ref;
		var myfunc  = function () {
			ref        = null;
			let pseudo = $("#exampleInputPseudo").val();
			$.ajax({
				       //L'URL de la requ??te
				       url: "{{route('accounts.store')}}",

				       //La m??thode d'envoi (type de requ??te)
				       method: "POST",
				       dataType: 'json',
				       //Le format de r??ponse attendu
				       data: {
					       pseudo: pseudo,
				       },
				       headers: {
					       'Precognition': 'true',
					       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
					       'Precognition-Validate-Only': "pseudo"
				       }
			       })
				//Ce code sera ex??cut?? en cas de succ??s - La r??ponse du serveur est pass??e ?? done()
				/*On peut par exemple convertir cette r??ponse en chaine JSON et ins??rer
			     * cette chaine dans un div id="res"*/
             .done(function (response) {
				 $("#pseudoError").hide(1000)
             })

				//Ce code sera ex??cut?? en cas d'??chec - L'erreur est pass??e ?? fail()
				//On peut afficher les informations relatives ?? la requ??te et ?? l'erreur
             .fail(function (error) {
					$("#pseudoError").html(error.responseJSON.message)
					$("#pseudoError").show(1000)             })

				//Ce code sera ex??cut?? que la requ??te soit un succ??s ou un ??chec
             .always(function () {
	             //alert("Requ??te effectu??e");
             });


			//your code goes here
		};
		var wrapper = function () {
			window.clearTimeout(ref);
			ref = window.setTimeout(myfunc, 500);
		}

		$(document).ready(function () {
			 $("#pseudoError").hide()
			 $("#passwordError").hide()
			 $("#confPasswordError").hide()


			$(document).on("click", "#login", function () {
				window.location.href = "{{route('login')}}";
			})

			$(document).on("keyup", "#exampleInputPseudo", function () {
				wrapper();
			})

			var wrapperPassword = function () {
				window.clearTimeout(ref);
				ref = window.setTimeout(myfuncPassword, 500);
			}

			$(document).on("keyup", "#exampleInputPassword1", function () {
				wrapperPassword();
			})

			var myfuncPassword  = function () {
				ref          = null;
				let password = $("#exampleInputPassword1").val();
				$.ajax({
						   //L'URL de la requ??te
						   url: "{{route('accounts.store')}}",

						   //La m??thode d'envoi (type de requ??te)
						   method: "POST",
						   dataType: 'json',
						   //Le format de r??ponse attendu
						   data: {
							   password: password,
						   },
						   headers: {
							   'Precognition': 'true',
							   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
							   'Precognition-Validate-Only': "password"
						   }
					   })
						//Ce code sera ex??cut?? en cas de succ??s - La r??ponse du serveur est pass??e ?? done()
						/*On peut par exemple convertir cette r??ponse en chaine JSON et ins??rer
                         * cette chaine dans un div id="res"*/
				 .done(function (response) {
					 $("#passwordError").hide(1000)
					// $("#passwordError").html("")

				 })

						//Ce code sera ex??cut?? en cas d'??chec - L'erreur est pass??e ?? fail()
						//On peut afficher les informations relatives ?? la requ??te et ?? l'erreur
				 .fail(function (error) {
					$("#passwordError").html(error.responseJSON.message)
					$("#passwordError").show(1000)

				 })

						//Ce code sera ex??cut?? que la requ??te soit un succ??s ou un ??chec
				 .always(function () {
					 //alert("Requ??te effectu??e");
				 });
			};

			var wrapperConfirmPassword = function () {
				window.clearTimeout(ref);
				ref = window.setTimeout(myfuncConfirm, 500);
			}
			$(document).on("keyup", "#exampleInputPassword2", function () {
				console.log("ici")
				wrapperConfirmPassword();

			})

			var myfuncConfirm  = function () {

				ref          = null;
				let confpassword = $("#exampleInputPassword2").val();
				let password = $("#exampleInputPassword1").val();
				$.ajax({
						   //L'URL de la requ??te
						   url: "{{route('accounts.store')}}",

						   //La m??thode d'envoi (type de requ??te)
						   method: "POST",
						   dataType: 'json',
						   //Le format de r??ponse attendu
						   data: {
							   password : password,
							   confpassword: confpassword,
						   },
						   headers: {
							   'Precognition': 'true',
							   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
							   'Precognition-Validate-Only': "confpassword"
						   }
					   })
						//Ce code sera ex??cut?? en cas de succ??s - La r??ponse du serveur est pass??e ?? done()
						/*On peut par exemple convertir cette r??ponse en chaine JSON et ins??rer
                         * cette chaine dans un div id="res"*/
				 .done(function (response) {
					 $("#confPasswordError").hide(1000)
				 })

						//Ce code sera ex??cut?? en cas d'??chec - L'erreur est pass??e ?? fail()
						//On peut afficher les informations relatives ?? la requ??te et ?? l'erreur
				 .fail(function (error) {
					 // alert("La requ??te s'est termin??e en ??chec. Infos : " + JSON.stringify(error));
					$("#confPasswordError").html(error.responseJSON.message)
					$("#confPasswordError").show(1000)
				 })

						//Ce code sera ex??cut?? que la requ??te soit un succ??s ou un ??chec
				 .always(function () {
					 //alert("Requ??te effectu??e");
				 });
			};

		});
    </script>
@endsection
