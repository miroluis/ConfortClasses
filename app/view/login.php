<?php
namespace app\view;
class Login {
    public function render() {
        $var = <<< END
	
       
        <!DOCTYPE html>
        <html lang="pt">
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width,
                initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>Login</title>

            <link href="../third/jscss/bootstrap.min.css" rel="stylesheet" />
        </head>
        <body>
            FICA O FORMULARIO DO LOGIN...
            <script src="../third/jscss/bootstrap.min.js"></script>
        </body>
        </html>
    END;
        echo $var;
    }
        
}


//  <form method="POST" action="login.php">
        
//         <!-- Utilizador | Text input-->
//         <div class="form-group row">
//             <label class="col-md-4 col-form-label" for="login">Utilizador</label>
//             <div class="col-md-4">
//                 <input id="login" name="login" type="text" placeholder="" class="form-control input-md" required="">
                
//             </div>
//         </div>

//         <!-- Senha | Passwrod input-->
//         <div class="form-group row">
//             <label class="col-md-4 col-form-label" for="pass">Senha</label>
//             <div class="col-md-4">
//                 <input id="pass" name="pass" type="password" placeholder="" class="form-control input-md" required="">
                
//             </div>
//         </div>

//         <!--  | Button -->
//         <div class="form-group row">
//             <label class="col-md-4 col-form-label" for="singlebutton"></label>
//             <div class="col-md-4">
//                 <button id="singlebutton" name="singlebutton" class="btn btn-primary">Entrar</button>
//             </div>
//         </div>

//         </form>

