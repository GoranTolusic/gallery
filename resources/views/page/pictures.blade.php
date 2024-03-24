<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.head')

<body>
    @include('layouts.partials.header')
    <!-- Modal -->
    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal-content">
            <!-- Slider -->
            <div class="slider">
                @foreach($pictures as $pictureSlide)
                <div class="slide">
                    <img src="/images/{{$pictureSlide->url_path}}" alt="{{$pictureSlide->title}}">
                </div>
                @endforeach
            </div>
            <!-- Strelice za navigaciju -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
    </div>

    <main class="content">
        <div class="search-container">
            <form action="/pictures" method="GET" class="search-form">
                <input type="text" name="keyword" class="search-input" placeholder="Search..." value="{{getHiddenParams('keyword')}}">
                <button type="submit" class="search-btn"></button>
            </form>
            <button onclick="openModal()" class="search-input">Slide Preview</button>
        </div>
        <br>
        <div class="gallery">
            @foreach($pictures as $picture)
            <div class="block">
                <a href="/picture/{{$picture->id}}"><img src="/thumbnails/{{$picture->url_path}}" title="{{$picture->description}}"></a>
                <h3>{{$picture->title}}</h3>
            </div>
            @endforeach
        </div>
    </main>
    <div class="pagination-container">
        {{ $pictures->links() }}
    </div>
    <br>
    @include('layouts.partials.footer')

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        // Funkcija za prikaz slajdova
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            const slides = document.getElementsByClassName("slide");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
        }

        // Funkcija za otvaranje moda
        function openModal() {
            document.getElementById("myModal").style.display = "block";
        }

        // Funkcija za zatvaranje moda
        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        // Zatvaranje moda klikom izvan moda
        window.onclick = function(event) {
            if (event.target == document.getElementById("myModal")) {
                closeModal();
            }
        }
    </script>

</body>

</html>