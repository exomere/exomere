@props(['review'])

<div>
    <!-- No surplus words or unnecessary actions. - Marcus Aurelius -->

        <!-- Header with user info -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                    <span class="text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             fill="currentColor" stroke="none" viewBox="0 0 16 16">
                            <path stroke="none" stroke-width=".1"
                                  d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"></path>
                        </svg>
                    </span>
                </div>
                <span class="text-gray-700">{{ $review->author_name }}</span>
            </div>
            <span class="hidden text-gray-500 text-sm">수정</span>
        </div>

        <!-- Rating -->
        <div class="flex items-center gap-1 mb-4">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $review->rating)
                    <!-- 채워진 별 -->
                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                    </svg>
                @else
                    <!-- 빈 별 -->
                    <svg class="w-4 h-4 text-gray-300" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                    </svg>
                @endif
            @endfor
            <span class="ml-1 text-lg">{{ $review->rating }}</span>
        </div>

        <!-- Store info -->
        <div class="font-bold text-gray-600 mb-4">
            {{ $review->title }}
        </div>

        <!-- Review content -->
        <div class="text-gray-800 mb-4 leading-relaxed">
            {!!  nl2br($review->content)  !!}
        </div>

        <!-- Review image -->
        <div class="mb-6">
            @if(isset($review->file1) && is_file($review->file1))
                <img src="{{ asset($review->file1) }}" alt="Product review"
                     class="rounded-lg w-full h-auto object-cover"
                     onerror="this.src='//exomere.co.kr/storage/data/noimg.jpg';"/>
            @endif
            @if(isset($review->file2) && is_file($review->file2))
                <img src="{{ asset($review->file2) }}" alt="Product review"
                     class="rounded-lg w-full h-auto object-cover"
                     onerror="this.src='//exomere.co.kr/storage/data/noimg.jpg';"/>
            @endif
            @if(isset($review->file3) && is_file($review->file3))
                <img src="{{ asset($review->file3) }}" alt="Product review"
                     class="rounded-lg w-full h-auto object-cover"
                     onerror="this.src='//exomere.co.kr/storage/data/noimg.jpg';"/>
            @endif
            @if(isset($review->file4) && is_file($review->file4))
                <img src="{{ asset($review->file4) }}" alt="Product review"
                     class="rounded-lg w-full h-auto object-cover"
                     onerror="this.src='//exomere.co.kr/storage/data/noimg.jpg';"/>
            @endif
            @if(isset($review->file5) && is_file($review->file5))
                <img src="{{ asset($review->file5) }}" alt="Product review"
                     class="rounded-lg w-full h-auto object-cover"
                     onerror="this.src='//exomere.co.kr/storage/data/noimg.jpg';"/>
            @endif
        </div>

        <!-- Footer -->
        <div class="flex items-center justify-between text-gray-500 text-sm">
            <div class="flex items-center gap-4">
                <button class="flex items-center gap-1 like-button"
                        type="button"
                        @if(request()->session()->get('member_seq'))
                            onclick="ajaxLikeReview({{ $review->id }})"
                        @else
                            onclick="alert('로그인 후 이용해 주세요');"
                        @endif>
                    <span>
                        {{--좋아요--}}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                             class="liked size-4 {{ $review->liked ? '' : 'hidden' }}">
                          <path
                              d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z"/>
                        </svg>

                        {{--좋아요x--}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor"
                             class="unliked size-4 {{  $review->liked ? 'hidden' : '' }}">
                          <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z"/>
                        </svg>
                    </span>
                    <span>
                        {{ __('common.helpful_review') }}
                        <span class="helpful_count">{{ $review->likes_count ?? 0 }}</span>
                    </span>
                </button>
            </div>
            <span>{{ $review->created_at->format('Y.m.d') }}</span>
        </div>

        <!-- Comment Display -->
        @if($review->comments)
            @foreach($review->comments as $comment)
                <div class="mt-4 bg-gray-50 rounded-xl p-6">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="font-medium">{{ $comment->author_name }}</span>
                        <span
                            class="text-exomere text-sm px-2">관리자</span>
                    </div>
                    <div class="text-gray-800 mb-4">
                        {{ $comment->content }}
                    </div>

                    <div class="flex items-center text-gray-500 text-sm gap-4">
                        <span>{{ $comment->created_at->format('Y.m.d') }}</span>
                    </div>
                </div>

            @endforeach
        @endif

</div>