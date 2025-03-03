@props(['product'])

<div id="review-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

    <div class="relative p-4 w-full max-w-md max-h-full">
        <form id="review-form">

            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 border-solid rounded-t ">
                    <h3 class="text-xl font-semibold text-gray-900 ">
                        {{ __('common.regist_review') }}
                    </h3>
                    <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                            data-modal-hide="review-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->

                <div class="p-4 md:p-5 space-y-4">
                    <div class="flex flex-row">
                        <span class="text-base leading-relaxed text-gray-500 mr-2">{{ __('common.rating') }}</span>
                        <div class="flex items-center space-x-1">
                            <!-- 별 모양 컨테이너 -->
                            <div id="star-rating" class="flex space-x-1 cursor-pointer">
                                <!-- 별 모양 5개 -->
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg data-value="{{$i}}"
                                         class="w-4 h-4 text-gray-300 hover:text-yellow-300 transition-colors"
                                         aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                         viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                @endfor
                            </div>

                            <!-- 숨겨진 입력 필드 -->
                            <input type="hidden" id="rating" name="rating" value="0">
                            <input type="hidden" id="product_seq" name="product_seq" value="{{$product['id']}}">
                        </div>
                    </div>
                    <input type="text" name="title" class="input" required
                           placeholder="{{ __('messages.subject') }}">
                    <textarea name="content" rows="5"
                              class="input"
                              required
                              placeholder="{{ __('messages.review_info') }}"></textarea>
                    <div id="response-message" class="mt-4"></div>

                </div>

                <!-- Modal footer -->
                <div
                    class="flex flex-row items-center gap-3 p-4 md:p-5 border-t border-gray-200 border-solid rounded-sm">
                    <button type="submit"
                            class="rounded-sm text-center w-full p-3 border border-solid border-base-color bg-base-color flex items-center justify-center font-normal text-sm text-white shadow-sm">{{ __('messages.submit') }}</button>
                    <button data-modal-hide="review-modal" type="button"
                            class="rounded-sm group p-3 border border-solid border-gray-600 bg-white text-gray-600 font-normal text-sm w-full flex items-center justify-center gap-2 shadow-sm shadow-transparent">{{ __('messages.cancel') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>