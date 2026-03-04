<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
        <url>
           <loc>{{url('/')}}</loc>
           <lastmod>2022-11-11T13:33:05+00:00</lastmod>
           <priority>1.00</priority>
        </url>
        @foreach ($games as $game)
        <url>
            <loc>{{ url('/') }}/app/{{ $game->slug }}</loc>
            <lastmod>{{ $game->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <priority>0.8</priority>
        </url>
        @endforeach

        @if(false)
        @foreach ($blogs as $app)
        <url>
            <loc>{{ url('/') }}/blog/{{ $app->slug }}</loc>
            <lastmod>{{ $app->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <priority>0.8</priority>
        </url>
         @endforeach
         @endif
         
</urlset>