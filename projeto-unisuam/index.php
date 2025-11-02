<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> GiroGeek - Início</title>
  <link rel="stylesheet" href="css/style.css">
  <script defer src="js/script.js"></script>
</head>

<body>
  <?php
  include 'components/header.php';
  ?>

  <main>
    <h2 class="titulo">Principais Notícias</h2>

    <div class="noticias-grid">

      <article class="card gigante">
        <img src="img/RPGESPACIAL.jpg" alt="">
        <div class="conteudo-gigante">
          <h3><a href="#"> Lançamento do RPG espacial é o destaque do ano</a></h3>
          <p>Esta notícia é a principal do portal, trazendo todos os detalhes do lançamento mais aguardado pelos fãs de
            ficção científica e RPG. Saiba tudo sobre a história, personagens e novidades deste jogo incrível.</p>
          <a href="noticia.php" class="botao-leia-mais">Leia Mais →</a>
        </div>
      </article>

      <article class="card destaque">
        <img src="img/NvidiaS5000.webp" alt="">
        <h3><a href="#"> Lançamento do nova Placa de Vídeo</a></h3>
        <p>Nova Placa de Vídeo promete melhores gráficos em jogos da nova Geração</p>
      </article>

      <article class="card medio">
        <img src="img/Gadgets.jpeg" alt="">
        <h3><a href="#">Tecnologia: gadgets para gamers</a></h3>
        <p>Novos periféricos prometem melhorar a experiência de jogos.</p>
      </article>

      <article class="card medio">
        <img src="img/MarvelComic.jpg" alt="">
        <h3><a href="#">Quadrinhos: Marvel lança novas séries</a></h3>
        <p>Histórias inéditas prometem agitar os fãs de super-heróis.</p>
      </article>

      <article class="card pequeno">
        <h3><a href="#">Animações: estreia de anime</a></h3>
      </article>

      <article class="card pequeno">
        <h3><a href="#">Cinema: filme sci-fi quebra recordes</a></h3>
      </article>

      <article class="card pequeno">
        <h3><a href="#">Board games: ranking do mês</a></h3>
      </article>

      <article class="card pequeno">
        <h3><a href="#">Board games: ranking do mês</a></h3>
      </article>

    </div>

    <h2 class="titulo">Notícias de Anime</h2>

    <div class="noticias-grid">

      <article class="card medio">
        <img src="img/Dandadan.webp" alt="Estreia de novo anime">
        <h3><a href="#">Estreia de novo anime promete sucesso</a></h3>
        <p>O anime mais aguardado da temporada chega com episódios semanais cheios de ação e emoção.</p>
      </article>

      <article class="card medio">
        <img src="img/AnimeJapanEvento.webp" alt="Evento de anime no Japão">
        <h3><a href="#">Evento de anime no Japão atrai milhares</a></h3>
        <p>Fãs se reuniram para celebrar as últimas novidades do mundo dos animes e mangás.</p>
      </article>

      <article class="card medio">
        <img src="img/AnimeNovaTemporada.jpeg" alt="Lançamento de temporada de anime">
        <h3><a href="#">Nova temporada de anime estreia hoje</a></h3>
        <p>Prepare-se para episódios cheios de reviravoltas e novos personagens incríveis.</p>
      </article>

      <article class="card medio">
        <img src="img/DemonSlayerAdaptaçãoCinemas.webp" alt="Anime popular recebe filme">
        <h3><a href="#">Anime popular ganha adaptação cinematográfica</a></h3>
        <p>Os fãs poderão assistir aos seus personagens favoritos em uma aventura inédita nas telonas.</p>
      </article>

    </div>

    <h2 class="titulo">Filmes e Séries</h2>

    <div class="noticias-grid">

      <article class="card medio">
        <img src="img/GuardasGalaxiasfilmeAventura.webp" alt="Estreia do filme de aventura">
        <h3><a href="#">Filme de Aventura Estreia nos Cinemas</a></h3>
        <p>A estreia do novo filme de aventura promete emocionar o público com efeitos especiais impressionantes e uma
          história envolvente.</p>
      </article>

      <article class="card medio">
        <img src="img/StrangersThings.webp" alt="Nova série de ficção científica">
        <h3><a href="#">Nova Série de Ficção Científica Lança Episódio Piloto</a></h3>
        <p>O episódio piloto da nova série de ficção científica surpreende com roteiros criativos e personagens
          complexos.</p>
      </article>

      <article class="card medio">
        <img src="img/freeGuyComedia.jpg" alt="Filme de comédia estreia">
        <h3><a href="#">Filme de Comédia Conquista Público Jovem</a></h3>
        <p>Uma divertida comédia chega aos cinemas e já é apontada como a favorita do público jovem.</p>
      </article>

      <article class="card medio">
        <img src="img/mandalorianserie.jpg" alt="Série dramática aclamada">
        <h3><a href="#">Série Dramática Recebe Aplausos da Crítica</a></h3>
        <p>A série dramática aborda temas contemporâneos e tem sido elogiada pelo roteiro e atuação do elenco.</p>
      </article>

    </div>
  </main>

  <?php
  include 'components/footer.php'
  ?>
</body>

</html>
