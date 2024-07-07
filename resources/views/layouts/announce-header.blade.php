<section class="flex bg-white shadow h-10 py-2 border-b-2">
    <div class="container mx-auto flex justify-between">
        <p class="">今日も楽しみだ</p>
        <div class="flex">
            @auth
                <a href="{{route('profile.edit')}}" class="ml-auto" color="white">マイページ</a>
            @endauth
            @guest
                <a href="{{route('register')}}" class="mr-2">ユーザ登録</a>
                <a href="{{route('login')}}" class="">ログイン</a>
        </div>
    </div>
@endauth
</section>