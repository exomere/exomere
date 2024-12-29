<div id="reviews-container" class="bg-white space-y-10">
    <!-- Be present above all else. - Naval Ravikant -->

    {{--리뷰아이템--}}
    @foreach($reviews as $review)
        <x-review-item :review="$review"/>
    @endforeach

    {{--페이지네이션 --}}
    <div class="mt-6" id="review-pagination">
        {{ $reviews->links() }}
    </div>
</div>