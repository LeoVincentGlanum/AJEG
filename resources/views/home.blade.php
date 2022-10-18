@extends('layout.app')


@section('content')
    <div class="container">
        <form class="mt-5" method="post" action="{{route('accounts.store')}}">
            @csrf
            <div class="mb-3 mt-5">
                <label for="exampleInputPseudo" class="form-label">Pseudo</label>
                <input name="pseudo" type="text" class="form-control" id="exampleInputPseudo">
				<div id="pseudoError"></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
				<div id="passwordError"></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                <input name="confpassword" type="password" class="form-control" id="exampleInputPassword2">
				<div id="confPasswordError"></div>
            </div>
            <button type="submit" class="btn btn-primary">Inscription</button>
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
				       //L'URL de la requête
				       url: "{{route('accounts.store')}}",

				       //La méthode d'envoi (type de requête)
				       method: "POST",
				       dataType: 'json',
				       //Le format de réponse attendu
				       data: {
					       pseudo: pseudo,
				       },
				       headers: {
					       'Precognition': 'true',
					       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
					       'Precognition-Validate-Only': "pseudo"
				       }
			       })
				//Ce code sera exécuté en cas de succès - La réponse du serveur est passée à done()
				/*On peut par exemple convertir cette réponse en chaine JSON et insérer
			     * cette chaine dans un div id="res"*/
             .done(function (response) {
				 $("#pseudoError").hide(1000)
             })

				//Ce code sera exécuté en cas d'échec - L'erreur est passée à fail()
				//On peut afficher les informations relatives à la requête et à l'erreur
             .fail(function (error) {
					$("#pseudoError").html(error.responseJSON.message)
					$("#pseudoError").show(1000)             })

				//Ce code sera exécuté que la requête soit un succès ou un échec
             .always(function () {
	             //alert("Requête effectuée");
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
						   //L'URL de la requête
						   url: "{{route('accounts.store')}}",

						   //La méthode d'envoi (type de requête)
						   method: "POST",
						   dataType: 'json',
						   //Le format de réponse attendu
						   data: {
							   password: password,
						   },
						   headers: {
							   'Precognition': 'true',
							   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
							   'Precognition-Validate-Only': "password"
						   }
					   })
						//Ce code sera exécuté en cas de succès - La réponse du serveur est passée à done()
						/*On peut par exemple convertir cette réponse en chaine JSON et insérer
                         * cette chaine dans un div id="res"*/
				 .done(function (response) {
					 $("#passwordError").hide(1000)
					// $("#passwordError").html("")

				 })

						//Ce code sera exécuté en cas d'échec - L'erreur est passée à fail()
						//On peut afficher les informations relatives à la requête et à l'erreur
				 .fail(function (error) {
					$("#passwordError").html(error.responseJSON.message)
					$("#passwordError").show(1000)

				 })

						//Ce code sera exécuté que la requête soit un succès ou un échec
				 .always(function () {
					 //alert("Requête effectuée");
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
						   //L'URL de la requête
						   url: "{{route('accounts.store')}}",

						   //La méthode d'envoi (type de requête)
						   method: "POST",
						   dataType: 'json',
						   //Le format de réponse attendu
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
						//Ce code sera exécuté en cas de succès - La réponse du serveur est passée à done()
						/*On peut par exemple convertir cette réponse en chaine JSON et insérer
                         * cette chaine dans un div id="res"*/
				 .done(function (response) {
					 $("#confPasswordError").hide(1000)
				 })

						//Ce code sera exécuté en cas d'échec - L'erreur est passée à fail()
						//On peut afficher les informations relatives à la requête et à l'erreur
				 .fail(function (error) {
					 // alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
					$("#confPasswordError").html(error.responseJSON.message)
					$("#confPasswordError").show(1000)
				 })

						//Ce code sera exécuté que la requête soit un succès ou un échec
				 .always(function () {
					 //alert("Requête effectuée");
				 });
			};

		});
    </script>
@endsection
