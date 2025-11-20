<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            // NIVEL EASY
            [
                'title' => 'Diga "Boa tarde!" para alguém',
                'description' => 'Cumprimente alguém com um "Boa tarde!"',
                'tip' => 'Use essa expressão à tarde quando encontrar alguém.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskBoaTarde.jpg'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Pergunte ao amigo o que ele gosta de comer',
                'description' => 'Descubra o prato favorito de um amigo.',
                'tip' => 'Isso pode ser útil para quando quiserem almoçar juntos.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskComida.jpg'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Diga "Oi!" para alguém',
                'description' => 'Diga "Oi!" para alguém que você conhece.',
                'tip' => 'Escolha uma pessoa que você vê todos os dias para começar.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskOi.jpg'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Diga para o amigo onde você foi no fim de semana',
                'description' => 'Conte para o seu amigo o que você fez ou onde foi no fim de semana.',
                'tip' => 'Compartilhar experiências é uma ótima forma de criar laços.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskFimDeSemana.jpg'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Fale para o amigo que você gostou da camiseta dele',
                'description' => 'Faça um elogio para o seu amigo sobre a roupa que ele está usando.',
                'tip' => 'Elogios sinceros sempre deixam as pessoas felizes.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskCamiseta.jpg'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Diga "Boa noite!" para alguém',
                'description' => 'Cumprimente alguém com um "Boa noite!"',
                'tip' => 'Diga isso à noite, antes de dormir ou ao sair.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskBoaNoite.jpg'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Pergunte para um amigo qual é a sua cor favorita',
                'description' => 'Descubra a cor favorita de um amigo.',
                'tip' => 'Seja curioso! Talvez a cor favorita dele seja diferente da sua.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskCorFavorita.jpg'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Diga "Obrigado" para alguém',
                'description' => 'Agradeça alguém por algo que fizeram por você.',
                'tip' => 'Pode ser algo simples, como segurar a porta para você.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskObrigado.jpg'),
                'categories_id' => 6, 
            ],
            [
                'title' => 'Diga "Por Favor" ao pedir algo',
                'description' => 'Use a expressão "Por favor" ao pedir algo.',
                'tip' => 'Lembre-se de ser educado ao fazer um pedido.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskPorFavor.jpg'),
                'categories_id' => 6, 
            ],
            [
                'title' => 'Diga "Com Licença" para alguém',
                'description' => 'Peça "Com licença" ao passar por alguém.',
                'tip' => 'Use essa frase em situações como ao entrar em um local.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskComLicenca.png'),
                'categories_id' => 6, 
            ],
            [
                'title' => 'Diga para sua Mãe ou Pai "Eu Te Amo"',
                'description' => 'Expresse seus sentimentos, dizendo "Eu Te Amo" para sua mãe ou pai.',
                'tip' => 'Pode ser uma ótima forma de fortalecer o vínculo.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskEuTeAmo.jpg'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Diga ao amigo "Você é Legal"',
                'description' => 'Faça um elogio simples, dizendo "Você é Legal" para um amigo.',
                'tip' => 'Elogios ajudam a fortalecer amizades.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskVoceLegal.jpg'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Diga "Tchau!" para alguém',
                'description' => 'Diga "Tchau!" quando você sair.',
                'tip' => 'Pode ser para alguém com quem você passou o dia.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskTchau.jpg'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Diga "Bom dia!" para alguém',
                'description' => 'Cumprimente alguém com um "Bom dia!"',
                'tip' => 'Diga isso pela manhã para quem você encontrar primeiro.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskBomDia.jpg'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Pergunte ao amigo que time ele torce',
                'description' => 'Descubra para qual time de futebol o seu amigo torce.',
                'tip' => 'Mesmo que você não goste do mesmo time, pode ser divertido conhecer.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskTime.png'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Pergunte ao amigo quem é seu super-herói favorito',
                'description' => 'Converse com um amigo e pergunte qual é o super-herói favorito dele.',
                'tip' => 'Isso pode abrir uma conversa sobre histórias e filmes de super-heróis.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskHeroi.png'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Diga para sua Mãe ou Pai o que você comeu na merenda',
                'description' => 'Conte para seus pais o que você comeu durante a merenda escolar.',
                'tip' => 'Isso pode iniciar uma conversa sobre alimentação saudável.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskMerenda.png'),
                'categories_id' => 3, 
            ],
            [
                'title' => 'Pergunte ao amigo como ele está',
                'description' => 'Pergunte a um amigo como ele está se sentindo.',
                'tip' => 'Mostrar interesse pelos outros ajuda a construir boas amizades.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskComoEsta.jpg'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Perguntar para um amigo que jogo ele mais gosta',
                'description' => 'Pergunte a um amigo qual é o jogo favorito dele, tente falar com calma e demonstrar interesse.',
                'tip' => 'Tente falar com calma e ouça a resposta com atenção. Se precisar, pode pedir ajuda a um adulto para começar a conversa.',
                'level' => 'easy',
                'image' => Storage::url('sistem/images/tasks/taskJogoFavorito.jpg'),
                'categories_id' => 2, 
            ],

            // NIVEL MEDIUM
            [
                'title' => 'Chame um amigo para brincar',
                'description' => 'Convide um amigo para brincar com você.',
                'tip' => 'Escolha algo que você goste e pergunte se ele quer participar.',
                'level' => 'medium',
                'image' => Storage::url('sistem/images/tasks/taskBrincar.png'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Pedir para brincar com o amigo',
                'description' => 'Pergunte para um amigo se ele quer brincar com você.',
                'tip' => 'Pode ser uma brincadeira simples, como pega-pega ou esconde-esconde.',
                'level' => 'medium',
                'image' => Storage::url('sistem/images/tasks/taskBrincarAmigo.png'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Compartilhe um brinquedo com um amigo',
                'description' => 'Ofereça um brinquedo seu para um amigo brincar também.',
                'tip' => 'Compartilhar é uma ótima maneira de construir amizades.',
                'level' => 'medium',
                'image' => Storage::url('sistem/images/tasks/taskCompartilharBrinquedo.png'),
                'categories_id' => 6, 
            ],
            [
                'title' => 'Dê um elogio a um colega',
                'description' => 'Faça um elogio sincero para um colega ou amigo.',
                'tip' => 'Foque em algo positivo que você realmente admire.',
                'level' => 'medium',
                'image' => Storage::url('sistem/images/tasks/taskElogio.jpg'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Desenhe algo com um amigo e converse sobre isso',
                'description' => 'Desenhe algo com seu amigo e compartilhem suas ideias.',
                'tip' => 'O importante é se divertir e trocar ideias durante a atividade.',
                'level' => 'medium',
                'image' => Storage::url('sistem/images/tasks/taskDesenhar.png'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Faça um cartão de agradecimento para alguém que te ajudou',
                'description' => 'Crie um cartão para agradecer a alguém que te ajudou.',
                'tip' => 'Pode ser um cartão simples com palavras gentis.',
                'level' => 'medium',
                'image' => Storage::url('sistem/images/tasks/taskCartaoAgradecimento.jpg'),
                'categories_id' => 6, 
            ],
            [
                'title' => 'Pergunte ao amigo sobre o filme favorito dele',
                'description' => 'Descubra o filme favorito de um amigo.',
                'tip' => 'Converse sobre o que vocês mais gostaram no filme.',
                'level' => 'medium',
                'image' => Storage::url('sistem/images/tasks/taskFilmeFavorito.png'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Agradeça alguém que te ajudou recentemente',
                'description' => 'Expresse sua gratidão para quem te ajudou recentemente.',
                'tip' => 'Seja específico sobre o que a pessoa fez por você.',
                'level' => 'medium',
                'image' => Storage::url('sistem/images/tasks/taskAgradecimentoRecente.png'),
                'categories_id' => 6, 
            ],
            [
                'title' => 'Comente sobre um filme que você assistiu e pergunte se o amigo já viu',
                'description' => 'Fale sobre um filme que você gostou e veja se o amigo já assistiu.',
                'tip' => 'Pergunte o que ele achou do filme se já tiver visto.',
                'level' => 'medium',
                'image' => Storage::url('sistem/images/tasks/taskFilmeComentado.png'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Pergunte ao amigo qual é o seu animal favorito',
                'description' => 'Converse com um amigo sobre os animais favoritos dele.',
                'tip' => 'Isso pode ser o começo de uma conversa sobre animais de estimação.',
                'level' => 'medium',
                'image' => Storage::url('sistem/images/tasks/taskAnimalFavorito.jpg'),
                'categories_id' => 2, 
            ],

            // NIVEL HARD
            [
                'title' => 'Pergunte ao amigo como foi o fim de semana dele',
                'description' => 'Converse com um amigo sobre como foi o fim de semana dele.',
                'tip' => 'Seja curioso e mostre interesse genuíno.',
                'level' => 'hard',
                'image' => Storage::url('sistem/images/tasks/taskFimDeSemanaAmigo.png'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Pergunte ao amigo qual é o seu lugar favorito para visitar',
                'description' => 'Descubra o lugar favorito de um amigo.',
                'tip' => 'Converse sobre os lugares que vocês mais gostam.',
                'level' => 'hard',
                'image' => Storage::url('sistem/images/tasks/taskLugarFavorito.png'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Proponha um desafio de desenho com um amigo',
                'description' => 'Convide seu amigo para um desafio de desenho, onde cada um desenha algo diferente.',
                'tip' => 'Pode ser algo simples como desenhar um animal ou paisagem.',
                'level' => 'hard',
                'image' => Storage::url('sistem/images/tasks/taskDesenhoDesafio.png'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Pergunte ao amigo o que ele gostaria de aprender',
                'description' => 'Converse com seu amigo sobre o que ele gostaria de aprender.',
                'tip' => 'Isso pode abrir uma conversa interessante sobre novos hobbies e interesses.',
                'level' => 'hard',
                'image' => Storage::url('sistem/images/tasks/taskAprender.png'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Diga a um colega que você gostou do jeito que ele se veste',
                'description' => 'Faça um elogio sobre o estilo de vestir de um colega.',
                'tip' => 'Seja sincero ao elogiar o estilo de alguém.',
                'level' => 'hard',
                'image' => Storage::url('sistem/images/tasks/taskEstilo.jpg'),
                'categories_id' => 2, 
            ],
            [
                'title' => 'Diga a um colega que você se divertiu com ele',
                'description' => 'Converse com um colega sobre a última vez que brincaram juntos e como foi divertido.',
                'tip' => 'Reviver bons momentos fortalece os laços de amizade.',
                'level' => 'hard',
                'image' => Storage::url('sistem/images/tasks/taskBrincarJunto.png'),
                'categories_id' => 2, 
            ]
        ];
        foreach ($tasks as $task) {
            Task::factory()->create(array_merge($task, [
                'user_creator_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
