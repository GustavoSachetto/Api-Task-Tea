<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao TaskTea!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #cce5ff;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        
        section{
            text-align: center;
        }

        .logo {
            display: block;
            margin: 0 auto;
            max-width: 800px;
            margin-bottom: 20px;
        }

        h1 {
            color: #007bff;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .footer {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
            text-align: center;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .highlight {
            background-color: #ffecb3;
            padding: 5px;
            border-radius: 5px;
        }
        a{
            color: #212121;
            text-decoration: none;
        }

        button {
            background-color: #ffffff;
            border: 1px solid rgb(209, 213, 219);
            border-radius: 0.5rem;
            color: #111827;
            font-size: 0.875rem;
            font-weight: 600;
            line-height: 1.25rem;
            padding: 0.75rem 1rem;
            text-align: center;
            -webkit-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            cursor: pointer;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-user-select: none;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
        }
    </style>
</head>

<body>
    <div class="container">

        <img src="https://lh3.googleusercontent.com/pw/AP1GczM2rUNG09xjrDRHy0Mnq_OwT_mZv_M98Lrz5xJ2l6pJbU4_dRPstsJl0GlWBzYuLZhAiKIk_QjRgWnorq5OJsedbzrObIvGSGzeGUW1Q4SC-afs9BpiYVrj8Tlul8n62GThAuBtx9W0ZdHZ9XtymdqbBA=w606-h341-s-no-gm?authuser=0"
            alt="Logo do TaskTea" class="logo">
        <section>
            <h1>Bem-vindo ao TaskTea!</h1>

            <h2 style="color: #111827;">Olá! {{$name}}</h2>
    
            <button>
                <a href="{{$verificationUrl}}">Clique aqui para verificar o seu email</a>
            </button> 
            
            <p>Atenciosamente,<br>
                A equipe do TaskTea.
            </p>
        </section>
    </div>
    <div class="footer">
        <h5>Todos os direitos reservados TaskTea.</h5>
    </div>
</body>

</html>
