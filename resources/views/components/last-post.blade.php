<section class="bg-white text-dark mt-3 py-4">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h3 class="text-main fs-1">BÀI VIẾT MỚI</h3>

            <div class="row">
               <div class="col-md-6">
                  @if($post_new->isNotEmpty())
                     @php
                        $latest_post = $post_new->first();
                     @endphp
                     <a href="/chi-tiet-bai-viet/{{ $latest_post->slug }}" >
                        <img class="img-fluid" src="{{ asset('images/posts/' . $latest_post->image) }}" alt="{{ $latest_post->image }}" />
                     </a>
                     <h3 class="post-title fs-4 py-2">
                        <a href="/chi-tiet-bai-viet/{{ $latest_post->slug }}" class="text-main" style="text-decoration: none;">
                           {{ $latest_post->title }}
                        </a>
                     </h3>
                     <p>{{ $latest_post->detail }}</p>
                  @endif
               </div>

               <div class="col-md-6">
                  @foreach ($post_new->slice(1, 3) as $post)
                     <div class="row mb-3">
                        <h3 class="post-title fs-5">
                           <a href="/chi-tiet-bai-viet/{{ $post->slug }}" class="text-main" style="text-decoration: none;">
                              {{ $post->title }}
                           </a>
                        </h3>
                        <div class="col-md-4 pt-2">                          
                           <a href="/chi-tiet-bai-viet/{{ $post->slug }}" >
                              <img class="img-fluid" src="{{ asset('images/posts/' . $post->image) }}" alt="{{ $post->image }}" />
                           </a>
                        </div>
                        <div class="col-md-8">                           
                           <p>{{ \Illuminate\Support\Str::limit($post->detail, 200, '...') }}</p>
                        </div>
                     </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
