@extends('boilerplate::layout.index', [
    'title' => __('boilerplate-blog::bo.edit.title'),
    'subtitle' => __('boilerplate-blog::bo.edit.subtitle'),
    'breadcrumb' => [
        __('boilerplate-blog::bo.edit.title') => 'blog.post.index',
        __('boilerplate-blog::bo.edit.subtitle'),
    ]
])

@section('content')
    <x-boilerplate::card>
        <x-slot name="header">
            <div class="h2">
                Bonnes pratiques
            </div>
        </x-slot>
        <p>
        Afin d'assurer que tout le monde puisse retrouver facilement les informations dans les différents articles, voici quelques bonnes pratiques à mettre en oeuvre.
        </p>
        <p>
        1. Utiliser des titres. Vous disposez d'un éditeur de texte riche pour la rédaction des articles. Profitez-en pour segmenter vos articles de manière claire et logique. Cela permet de retrouver facilement les informations au sein d'un article.
        </p>
        <p>
        2. Renseigner le résumé de l'article. Le résumé est affiché dans la liste des articles et en tête de chaque article, il permet de savoir facilement de quoi traite l'article.
        </p>
        <p>
        3. Traiter une seule problématique par article. Sinon plus personne ne s'en sort...
        </p>
        <p>
        4. Insérer les liens vers les éventuelles resources externes et/ou présentations powerpoint en début d'article afin qu'ils soient facilement accessibles. En cas de resources concernant une sous-partie spécifique de l'article, insérer le lien dans la section appropriée.
        </p>
        <p>
        5. Renseigner une catégorie adaptée pour l'articles. Un article publié sous la mauvaise catégorie se trouvera dans la mauvaise rubrique du site. Un article sans catégorie n'apparaitra pas sur le site, même une fois publié.
        </p>
    </x-boilerplate::card>
    <x-boilerplate::card>
        <x-slot name="header">
            <div class="h2">
                F.A.Q
            </div>
        </x-slot>
        <p><strong>Q: Comment créer un nouvel article?</strong></p>
        <p>A: Rendez-vous dans la rubrique "Rédiger un article".</p>
        <p><strong>Q: À quoi sert le champ "slug"?</strong></p>
        <p>A: Le champ "slug" détermine l'extension de l'article dans l'url. Par défaut, il est auto-généré à partir du titre.</p>
        <p><strong>Q: Est ce que je peux enregistrer mon article sans le rendre visible aux autres?</strong></p>
        <p>A: Oui. Au moment de la rédaction de l'article, il suffit de cliquer sur "Enregistrer le brouillon" au lieu de "Enregistrer et publier"</p>
        <p><strong>Q: Comment publier un article déjà enregistré en brouillon?</strong></p>
        <p>A: Depuis la liste des articles (rubrique "Gestion des articles"), vous aurez l'option de modifier et (dé)publier vos articles.</p>
        <p><strong>Q: J'ai fait une erreur lors de la rédaction de mon article! Que faire?</strong></p>
        <p>A: Rendez-vous dans la rubrique "Gestion des articles" et recherchez l'article en question, vous aurez alors l'option de l'éditer.</p>
        <p><strong>Q: Pourquoi les modifications apportées à un article n'apparaissent pas sur le site?</strong></p>
        <p>A: Vérifiez que vous avez bien enregistré <em>et publié</em> les changements. Si un badge "en attente de validation" apparait sur l'article dans la liste, c'est que les changements n'ont pas étés publiés.</p>
        <p><strong>Q: Pourquoi un article que j'ai écrit n'apparait pas ou plus sur le site?</strong></p>
        <p>A: Vérifiez que la date de publication de l'article est passée (par défaut il s'agit de la date de rédaction de l'article) et qu'il n'y a pas de date de fin.</p>
        <p><strong>Q: Comment insérer des images dans mon article?</strong></p>
        <p>A: Il suffit d'utiliser le bouton de la toolbar permettant d'insérer une image à partir d'une URL externe ou depuis la médiathèque interne du serveur.</p>
        <p><strong>Q: Comment insérer des vidéos dans mon article?</strong></p>
        <p>A: Il suffit d'utiliser le bouton de la toolbar permettant d'insérer une vidéo à partir d'une URL externe ou depuis la médiathèque interne du serveur.</p>
        <p><strong>Q: Comment insérer d'autres pièces jointes (ex: présentation powerpoint) dans mon article?</strong></p>
        <p>A: Il suffit d'utiliser le bouton de la toolbar permettant d'insérer un lien. Celui-ci vous permettra d'insérer une URL externe ou alors de télécharger un fichier dans la médiathèque interne puis de créer un lien vers celui-ci.</p>
    </x-boilerplate::card>
@endsection
