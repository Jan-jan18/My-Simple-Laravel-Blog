
        
<!-- Content Container -->
<div class="container px-4 px-lg-5 mt-5"> <!-- Added 'mt-5' for top margin -->
    <h1 class="text-center">{{ $post->title }}</h1>
    <p class="text-center">{{ $post->created_at->format('F j, Y') }}</p>
    <p class="text-center">{{ $post->content }}</p>
</div>







